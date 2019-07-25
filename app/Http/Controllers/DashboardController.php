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
      $quiz = Quiz::all()->sortBy('quiz_type_id');
      $totalQuiz = $quiz->count();
      return view('index', compact ('quiz','memberOnline','totalMember','totalQuiz','totalQuizType','totalGamePlayed','totalGamePlayedBefore'));
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
