<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizCollager;
use Auth;
use DB;

class QuizCollagerController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {

  }

  /*START OF API*/

  public function api_store(Request $request)
  {
    $data = QuizCollager::create(
      [
            'quiz_id' => request('quiz_id'),
            'collager_id' => Auth::user()->collager->id,
            'total_score'=>request('total_score'),
      ]
    );
    return response()->json([
        'status' => 'success',
        'result'   => $data
    ]);
  }

  public function api_history(){
    $data = QuizCollager::where('collager_id', Auth::user()->collager->id)
                          ->leftJoin('quizs', 'quiz_collagers.quiz_id', 'quizs.id')
                          ->leftJoin('quiz_types', 'quizs.quiz_type_id', 'quiz_types.id')
                          ->select('quiz_collagers.*', 'quizs.title', 'quizs.pic_url as quiz_pic_url', 'quiz_types.name as quiz_type')
                          ->get();
    foreach ($data as $key => $value) {
      if($value->quiz_pic_url == 'blank.jpg'){
        $value->quiz_pic_url = asset('img/'.$value->quiz_pic_url.'');
      }else {
        $value->quiz_pic_url = route('quiz.picture',$value->id);
      }
    }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

  public function api_leaderbord(){
    $data = DB::table('quiz_collagers')->leftJoin('quizs', 'quiz_collagers.quiz_id', 'quizs.id')
                          ->leftJoin('quiz_types', 'quizs.quiz_type_id', 'quiz_types.id')
                          ->leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->groupBy('collagers.user_id', 'users.username', 'users.picture', 'collagers.id')
                          ->selectRaw('collagers.user_id, collagers.id as collagers_id, users.username, users.picture, sum(quiz_collagers.total_score) as score')
                          ->get()
                          ->sortByDesc('score');
    foreach ($data as $key => $value) {
      if($value->picture == 'avatar.png'){
        $value->picture = asset('img/'.$value->picture.'');
      }else {
        $value->picture = route('user.picture',$value->user_id);
      }
    }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

  public function api_leaderbordQuizPodium($id){
    $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->selectRaw('quiz_collagers.id as quiz_collagers_id, collagers.user_id, collagers.id as collagers_id, users.username, users.picture, quiz_collagers.total_score')
                          ->orderBy('total_score','DESC')
                          ->limit(3)
                          ->get();
    foreach ($data as $key => $value) {
      if($value->picture == 'avatar.png'){
        $value->picture = asset('img/'.$value->picture.'');
      }else {
        $value->picture = route('user.picture',$value->user_id);
      }
    }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

  public function api_leaderbordQuizNotPodium($id){
    $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->selectRaw('quiz_collagers.id as quiz_collagers_id, collagers.user_id, collagers.id as collagers_id, users.username, users.picture, quiz_collagers.total_score')
                          ->orderBy('total_score','DESC')
                          ->limit(12)
                          ->skip(3)
                          ->get();
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

}

?>
