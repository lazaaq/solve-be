<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Collager;
use App\QuizCollager;
use App\Quiz;
use App\Question;
use App\AnswerSave;
use DataTables;
use Auth;

class HistoryQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('history-quiz.index');
    }

    public function getData()
    {
      if (Auth::user()->hasRole('admin')) {
        $user_id = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->pluck('id')->toArray();
      } else {
        $school_id = Auth::user()->school_id;
        $user_id = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->orWhere('school_id',$school_id)->pluck('id')->toArray();
      }
      $data = Quiz::whereIn('created_by',$user_id)->get()->sortBy('title');

      return datatables()->of($data)
      ->addColumn('action', function($row){
        $btn = '<a href="'.route('history-quiz.show',$row->id).'" title="View Detail" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
        $btn = $btn.'  <a href="'.route('reporting-quiz',$row->id).'" title="Download Excel" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="glyphicon glyphicon-download-alt"></i></a>';
        return $btn;
      })
      ->rawColumns(['action'])
      ->addColumn('quiz_category', function($row){
        return $row->quizType->quizCategory->name;
      })
      ->addColumn('quiz_type', function($row){
        return $row->quizType->name;
      })
      ->make(true);
    }

    public function getDataQuiz($id)
    {
      if (Auth::user()->hasRole('admin')) {
        $user = Collager::whereHas('user.roles', function($q) { $q->where('name', 'student'); })->pluck('id')->toArray();
      } else {
        $school_id = Auth::user()->school_id;
        $user = Collager::whereHas('user.roles', function($q) { $q->where('name', 'student'); })->whereHas('user', function($q) use ($school_id) { $q->where('school_id',$school_id); })->pluck('id')->toArray();
      }
      $data = QuizCollager::where('quiz_id',$id)->whereIn('collager_id',$user)->with(['collager.user.school','quiz.quizType.quizCategory'])->get();

      return datatables()->of($data)
      ->addColumn('isTrue', function($row){
        return $row->answerSave->where('isTrue',1)->count();
      })
      ->addColumn('isFalse', function($row){
        return $row->answerSave->where('isTrue',0)->count();
      })
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        return view('history-quiz.view', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
