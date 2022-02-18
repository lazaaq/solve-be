<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Location;
use DB;
use App\Collager;
use App\Quiz;
use App\QuizType;
use Illuminate\Support\Carbon;
use App\QuizCollager;
use Auth;
use App\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $memberOnline     = DB::table('oauth_access_tokens')
                              ->groupBy('user_id')
                              ->where('revoked', 0)
                              ->selectRaw('user_id')
                              ->get()->count();
      $totalMember      = Collager::all()->count();
      $totalQuizType    = QuizType::all()->count();
      $totalGamePlayed  = QuizCollager::whereBetween('created_at',[Carbon::today(),Carbon::today()->addDay(1)])->count();
      $totalGamePlayedBefore  = QuizCollager::whereBetween('created_at',[Carbon::today()->addDay(-1),Carbon::today()])->count();

      if (Auth::user()->hasRole('admin')) {
        $user_id = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->pluck('id')->toArray();

        $quiz_id = Quiz::whereIn('created_by',$user_id)->pluck('id')->toArray();
        $totalQuiz = count($quiz_id);

        $collager_id = Collager::whereHas('user.roles', function($q) { $q->where('name', 'student'); })->pluck('id')->toArray();

      } else {

        $admin_id = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->pluck('id')->toArray();
        $teacher_id = User::where('school_id',$school_id)->whereHas('lecture')->pluck('id')->toArray();
        $school_id = Auth::user()->school_id;

        $user_id = array_merge($teacher_id,$admin_id);

        $quiz_id = Quiz::whereIn('created_by',$user_id)->pluck('id')->toArray();
        $totalQuiz = count($quiz_id);

        $collager_id = Collager::whereHas('user.roles', function($q) { $q->where('name', 'student'); })->whereHas('user', function($q) use ($school_id) { $q->where('school_id',$school_id); })->pluck('id')->toArray();
      }

      $score = QuizCollager::whereIn('quiz_id',$quiz_id)->whereIn('collager_id',$collager_id)->get();

      $quiz = Quiz::with('quizType.QuizCategory','quizCollager.collager.user')->whereIn('created_by',$user_id)->get()->sortBy('quiz_type_id');
      $collection = [];
      foreach ($quiz as $i => $quizs) {
        $collection[$i] = [
          'quiz_id'     => $quizs['id'],
          'title'   => $quizs['title'],
          'type'        => $quizs->quizType->name,
          'category'    => $quizs->quizType->QuizCategory->name,
          'leaderboard' => $quizs->quizCollager->sortByDesc('total_score')->unique('collager_id')->take(10),
        ];
      }
      return view('index', compact ('quiz','memberOnline','totalMember','totalQuiz','totalQuizType','totalGamePlayed','totalGamePlayedBefore','collection'));
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
