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
        $admin = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->get();
        $admin_id = [];
        foreach ($admin as $key => $value) {
          $admin_id[] = $value->id;
        }

        $quiz = Quiz::whereIn('created_by',$admin_id)->get()->sortBy('quiz_type_id');
        $quiz_id = [];
        $totalQuiz = $quiz->count();
        foreach ($quiz as $key => $value) {
          $quiz_id[] = $value->id;
        }

        $student = User::whereHas('roles', function($q) { $q->where('name', 'student'); })->get();
        $collager_id = [];
        foreach ($student as $key => $value) {
          $collager_id[] = $value->collager->id;
        }

        $score = QuizCollager::whereIn('quiz_id',$quiz_id)->whereIn('collager_id',$collager_id)->get();
      } else {
        $school_id = Auth::user()->school_id;
        $teacher = User::where('school_id',$school_id)->whereHas('lecture')->get();
        foreach ($teacher as $key => $value) {
          $user_id[] = $value->id;
        }

        $quiz = Quiz::whereIn('created_by',$user_id)->get()->sortBy('quiz_type_id');
        $quiz_id = [];
        $totalQuiz = $quiz->count();
        foreach ($quiz as $key => $value) {
          $quiz_id[] = $value->id;
        }

        $student = User::where('school_id',$school_id)->whereHas('roles', function($q) { $q->where('name', 'student'); })->get();
        $collager_id = [];
        foreach ($student as $key => $value) {
          $collager_id[] = $value->collager->id;
        }

        $score = QuizCollager::whereIn('quiz_id',$quiz_id)->whereIn('collager_id',$collager_id)->get();
      }

      $collection = [];
      foreach ($quiz as $i => $quizs) {
        $collection[$i] = [
          'quiz_id'     => $quizs['id'],
          'title'  => $quizs['title'],
          'type'        => $quizs->quizType['name'],
          'category'    => $quizs->quizType->QuizCategory['name'],
          'leaderboard' => [],
        ];
        foreach ($score as $j => $scores) {
          if ($scores->quiz_id == $quizs['id']) {
            $leaderboard = $scores->leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                                  ->leftJoin('users', 'collagers.user_id', 'users.id')
                                  ->groupBy('quiz_collagers.collager_id','users.username', 'users.name','users.id','users.picture', 'quiz_collagers.quiz_id')
                                  ->where('quiz_collagers.quiz_id', $quizs['id'])
                                  ->selectRaw('users.id as user_id, quiz_collagers.collager_id, users.username, users.picture, max(quiz_collagers.total_score) as total_score, users.name, quiz_collagers.quiz_id')
                                  ->orderBy('total_score','DESC')
                                  ->limit(10)
                                  ->get();
            $collection[$i]['leaderboard'] = $leaderboard;
          }
        }
      }
      // dd($collection);
      // return response()->json($collection);

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
