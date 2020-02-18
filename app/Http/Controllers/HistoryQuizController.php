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
      $data = Quiz::all()->sortBy('title');
      return datatables()->of($data)
      ->addColumn('action', function($row){
        $btn = '<a href="'.route('reporting-quiz',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
        // admin/reporting') }}"+"/"+$('#school').val()
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
        //
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
