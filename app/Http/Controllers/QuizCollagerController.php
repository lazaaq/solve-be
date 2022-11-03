<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerSave;
use App\Quiz;
use Illuminate\Http\Request;
use App\QuizCollager;
use App\QuizTemporary;
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
    if(!$request['quiz_id'] || !$request['answers']) {
      return responseAPI(400, false, null, "missing parameter");
    }
    $user = Auth::user();
    $total_score = countTotalScore($request['answers']);
    $quizCollager = QuizCollager::create(
      [
          'quiz_id' => $request['quiz_id'],
          'collager_id' => $user->collager->id,
          'total_score'=> $total_score,
      ]
    );
    $quiz = Quiz::find($request['quiz_id']);
    $answers = array();
    for($i=0; $i<count($request['answers']); $i++) {
      if($request['answers'][$i]['answered']) {
        $quizAnswer = Answer::find($request['answers'][$i]['answer_id']);
        $scoreQuestion = null;
        if($quizAnswer->isTrue) {
          $scoreQuestion = getScoreQuiz('correct');
        } else {
          $scoreQuestion = getScoreQuiz('wrong');
        }
        $answer = AnswerSave::create([
          'quiz_collager_id' => $quizCollager->id,
          'question_id' => $request['answers'][$i]['question_id'],
          'collager_answer' => $quizAnswer->content,
          'isTrue' => $quizAnswer->isTrue,
          'score' => $scoreQuestion,
        ]);
        array_push($answers, $answer);
      } else { // if user does not choose any answer
        $answer = AnswerSave::create([
          'quiz_collager_id' => $quizCollager->id,
          'question_id' => $request['answers'][$i]['question_id'],
          'collager_answer' => '',
          'isTrue' => 0,
          'score' => getScoreQuiz('empty'),
        ]);
        array_push($answers, $answer);
      } 
    }
    
    // remove quiz temporary
    $quizTemporary = QuizTemporary::where("quiz_id", $request['quiz_id'])->where("collager_id", $user->collager->id)->delete();

    $quizCollager['quiz'] = $quiz;
    $quizCollager['answers'] = $answers;
    
    return responseAPI(200, true, $quizCollager);
  }

  public function api_history(){
    $data = QuizCollager::where('collager_id', Auth::user()->collager->id)
                          ->leftJoin('quizs', 'quiz_collagers.quiz_id', 'quizs.id')
                          ->leftJoin('quiz_types', 'quizs.quiz_type_id', 'quiz_types.id')
                          ->select('quiz_collagers.*', 'quizs.title', 'quizs.pic_url as quiz_pic_url', 'quiz_types.name as quiz_type')
                          ->get();
    // foreach ($data as $key => $value) {
    //   if($value->quiz_pic_url == 'blank.jpg'){
    //     $value->quiz_pic_url = asset('img/'.$value->quiz_pic_url.'');
    //   }else {
    //     $value->quiz_pic_url = route('quiz.picture',$value->id);
    //   }
    // }
    return responseAPI(200, true, $data);
  }

  public function api_leaderboard(){
    $data = DB::table('quiz_collagers')->leftJoin('quizs', 'quiz_collagers.quiz_id', 'quizs.id')
                          ->leftJoin('quiz_types', 'quizs.quiz_type_id', 'quiz_types.id')
                          ->leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->groupBy('collagers.user_id', 'users.username', 'users.picture', 'collagers.id')
                          ->selectRaw('collagers.user_id, collagers.id as collagers_id, users.username, users.picture, sum(quiz_collagers.total_score) as score')
                          ->get()
                          ->sortByDesc('score');
    // foreach ($data as $key => $value) {
    //   if($value->picture == 'avatar.png'){
    //     $value->picture = asset('img/'.$value->picture.'');
    //   }else {
    //     $value->picture = route('user.picture',$value->user_id);
    //   }
    // }
    return responseAPI(200, true, $data);
  }

  public function api_leaderboardQuizPodium($id){
    // $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
    //                       ->leftJoin('users', 'collagers.user_id', 'users.id')
    //                       ->where('quiz_collagers.quiz_id', $id)
    //                       ->selectRaw('quiz_collagers.id as quiz_collagers_id, collagers.user_id, collagers.id as collagers_id, users.username, users.picture, quiz_collagers.total_score')
    //                       ->orderBy('total_score','DESC')
    //                       ->limit(3)
    //                       ->get();
    $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->groupBy('quiz_collagers.collager_id','users.username','users.id','users.picture')
                          ->where('quiz_collagers.quiz_id', $id)
                          ->selectRaw('users.id as user_id, quiz_collagers.collager_id, users.username, users.picture, max(quiz_collagers.total_score) as total_score')
                          ->orderBy('total_score','DESC')
                          ->limit(3)
                          ->get();
    return responseAPI(200, true, $data);
  }

  public function api_leaderboardQuizNotPodium($id){
    // $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
    //                       ->leftJoin('users', 'collagers.user_id', 'users.id')
    //                       ->where('quiz_collagers.quiz_id', $id)
    //                       ->selectRaw('quiz_collagers.id as quiz_collagers_id, collagers.user_id, collagers.id as collagers_id, users.username, users.picture, quiz_collagers.total_score')
    //                       ->orderBy('total_score','DESC')
    //                       ->limit(12)
    //                       ->skip(3)
    //                       ->get();
    $data = QuizCollager::leftJoin('collagers', 'quiz_collagers.collager_id', 'collagers.id')
                          ->leftJoin('users', 'collagers.user_id', 'users.id')
                          ->groupBy('quiz_collagers.collager_id','users.username','users.id','users.picture')
                          ->where('quiz_collagers.quiz_id', $id)
                          ->selectRaw('users.id as user_id, quiz_collagers.collager_id, users.username, users.picture, max(quiz_collagers.total_score) as total_score')
                          ->orderBy('total_score','DESC')
                          ->limit(12)
                          ->skip(3)
                          ->get();
    return responseAPI(200, true, $data);
  }

}

?>
