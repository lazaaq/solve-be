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
    // $this->validate($request,
    // [
    //   'question.*' => 'required',
    //   'picture.*' => 'mimes:png,jpg,jpeg|max:2048',
    //   'choice.*.*' => 'required_without:picture_choice.*.*',
    //   'picture_choice.*.*' => 'mimes:png,jpg,jpeg|max:2048|required_without:choice.*.*',
    // ],
    // [
    //   'question.*.required' => 'The question field is required.',
    //   'picture.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',
    //   'choice.*.*.required_without' => 'The choice field is required when file field is not present.',
    //   'picture_choice.*.*.required_without' => 'The file field is required when choice field is not present.',
    //   'picture_choice.*.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',

    // ]);

    $question = [];

    for ($i=0; $i < @count($request->question); $i++) {
        if (!empty($request->picture[$i])) {
            $file[$i] = $request->file('picture.'.$i);
            $extension[$i] = strtolower($file[$i]->getClientOriginalExtension());
            $filename[$i] = uniqid() . '.' . $extension[$i];
            \Storage::put('public/images/question/' . $filename[$i], \File::get($file[$i]));
        } else {
          $filename = '-';
        }
        $question[$i] = [
            'quiz_id'       => $request->quiz_id,
            'question'      => $request->question[$i],
            'pic_url'       => $filename,
        ];

    }

    $answers = [];
    $option = ['1', '2', '3', '4', '5'];
    for ($i=0; $i < @count($request->choice); $i++) {
        for ($j=0; $j < @count($request->choice[$i]); $j++) {

          if (!empty($request->picture_choice[$i][$j])) {
              $file[$i][$j] = $request->file('picture_choice.'.$i.'.'.$j);
              $extension[$i][$j] = strtolower($file[$i][$j]->getClientOriginalExtension());
              $filename[$i][$j] = uniqid() . '.' . $extension[$i][$j];
              \Storage::put('public/images/option/' . $filename[$i][$j], \File::get($file[$i][$j]));
          } else {
            $filename = '-';
          }

            $answers[$i][$j] = [
                 'option'        => $option[$j],
                 'content'       => $request->choice[$i][$j],
                 'pic_url'       => $filename,
                 'isTrue'     => $request->true_answer[$i] == $j+1 ? 1 : 0
            ];
        }
    }

  foreach ($question as $key => $q) {
    Question::create($q)->answer()->createMany($answers[$key]);
  }
    return redirect()->route('quiz.index');
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
  public function api_index($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        if(!empty($quiz)){
            $quiz = Question::where('quiz_id', $quiz->id)->get();
        } else {
          return response()->json([
              'status' => 'failed',
              'message'   => 'Quiz not found'
          ]);
        }
        $option  = [];
        foreach ($quiz as $key => $item) {
            $option[$key] = $item->answer()->orderBy('option', 'asc')->get();
        }
        $collection = [];
        foreach ($quiz as $i => $item) {
          $collection[$i] = [
            'id' => $item['id'],
            'question' => $item['question'],
            'pic_question' => $item['pic_url'],
            'a' => $option[$i]->get(0)->content,
            'pic_a' => $option[$i]->get(0)->pic_url,
            'b' => $option[$i]->get(1)->content,
            'pic_b' => $option[$i]->get(1)->pic_url,
            'c' => $option[$i]->get(2)->content,
            'pic_b' => $option[$i]->get(2)->pic_url,
            'd' => $option[$i]->get(3)->content,
            'pic_d' => $option[$i]->get(3)->pic_url,
            'e' => $option[$i]->get(4)->content,
            'pic_e' => $option[$i]->get(4)->pic_url,
            'isTrue' => $option[$i]->where('isTrue', 1)->first()->content.', '.$option[$i]->where('isTrue', 1)->first()->pic_url,
          ];
        }

        return response()->json([
            'status' => 'success',
            'result'   => $collection
        ]);
    }

}

?>
