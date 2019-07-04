<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use DataTables;
use App\QuizType;
use App\Quiz;
use App\Question;
use File;
use DB;

class QuestionController extends Controller
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
  public function create($id)
  {
    $quiz = Quiz::find($id);
    return view('question.create', compact('quiz'));
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

  public function api_index($id){
    $data = Question::where('quiz_id', $id)->get();
    foreach ($data as $key => $value) {
      if(!empty($value->pic_url)){
        $value->pic_url = asset('img/question/'.$value->pic_url.'');
      }
    }
    return response()->json([
      'status'=>'success',
      'user'=>$data
    ]);
  }

}

?>
