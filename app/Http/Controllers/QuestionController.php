<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Arr;
use DataTables;
use App\QuizType;
use App\Quiz;
use App\Answer;
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
    $this->validate($request,
    [
      'question.*' => 'required',
      'picture.*' => 'mimes:png,jpg,jpeg|max:2048',
      'choice.*.*' => 'required_without:picture_choice.*.*',
      'picture_choice.*.*' => 'mimes:png,jpg,jpeg|max:2048|required_without:choice.*.*',
    ],
    [
      'question.*.required' => 'The question field is required.',
      'picture.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',
      'choice.*.*.required_without' => 'The choice field is required when file field is not present.',
      'picture_choice.*.*.required_without' => 'The file field is required when choice field is not present.',
      'picture_choice.*.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',

    ]);
    $quiz = Quiz::find($request->quiz_id);
    $questionCount = Question::where('quiz_id', $quiz->id)->get()->count();
    DB::beginTransaction();
    /*fitur add question*/
    if ($quiz->sum_question == $questionCount) {
      $quiz->sum_question+= @count($request->question);
      $quiz->save();
    }
    $quiz->sum_question = $quiz->sum_question - @count($request->question);
    /*end of fitur add question*/
    $question = [];

    for ($i=0; $i < @count($request->question); $i++) {
        if (!empty($request->picture[$i])) {
            $file[$i] = $request->file('picture.'.$i);
            $extension[$i] = strtolower($file[$i]->getClientOriginalExtension());
            $filename[$i] = uniqid() . '.' . $extension[$i];
            $img[$i] = Image::make($file[$i])->resize(300, 200);
            \Storage::put('public/images/question/' . $filename[$i], $img[$i]->encode());
        } else {
          $filename[$i] = '';
        }
        $question[$i] = [
            'quiz_id'       => $request->quiz_id,
            'question'      => $request->question[$i],
            'pic_url'       => $filename[$i],
        ];

    }

    $answers = [];
    $option = ['A', 'B', 'C', 'D', 'E'];
    for ($i=0; $i < @count($request->choice); $i++) {
        for ($j=0; $j < @count($request->choice[$i]); $j++) {
            $answers[$i][$j] = [
                 'option'        => $option[$j],
                 'content'       => $request->choice[$i][$j],
                 'isTrue'        => $request->true_answer[$i] == $j+1 ? 1 : 0
            ];
        }

        for ($j=0; $j < @count($request->choice[$i]); $j++) {
          if (!empty($request->picture_choice[$i][$j])) {
              $fileChoice[$i][$j] = $request->file('picture_choice.'.$i.'.'.$j);
              $extensionChoice[$i][$j] = strtolower($fileChoice[$i][$j]->getClientOriginalExtension());
              $filenameChoice[$i][$j] = uniqid() . '.' . $extensionChoice[$i][$j];
              $imgChoice[$i][$j] = Image::make($fileChoice[$i][$j])->resize(300, 200);
              \Storage::put('public/images/option/' . $filenameChoice[$i][$j], $imgChoice[$i][$j]->encode());
          } else {
            $filenameChoice[$i][$j] = '';
          }
           $answers[$i][$j] = array_slice($answers[$i][$j], 0, 2, true) + array("pic_url" => $filenameChoice[$i][$j]) + array_slice($answers[$i][$j], 2, count($answers[$i][$j]) - 1, true);
        }
    }
    foreach ($question as $key => $q) {
      Question::create($q)->answer()->createMany($answers[$key]);
    }
    DB::commit();
    if ($quiz->sum_question == $questionCount) {
      return redirect()->route('quiz.show',$quiz->id);
    }
      return redirect()->route('quiz.index');
  }

  public function add(Request $request, $id)
  {
      $quiz = Quiz::find($id);
      $total = $request->total_add;
      return view('question.create-add', compact('quiz','total'));
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
    $data = Question::find($id);
    $quiz = Quiz::find($data->quiz_id);
    $option = ['First','Second','Third','Fourth','Fifth'];
    $option_value = ['A','B','C','D','E'];
    // dd($data);
    return view('question.edit', compact('data','quiz','option','option_value'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request,
    [
      'question' => 'required',
      'picture' => 'mimes:png,jpg,jpeg|max:2048',
      'choice.*' => 'required_without:picture_choice.*',
      'picture_choice.*' => 'mimes:png,jpg,jpeg|max:2048|required_without:choice.*',
    ],
    [
      'question.*.required' => 'The question field is required.',
      'picture.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',
      'choice.*.required_without' => 'The choice field is required when file field is not present.',
      'picture_choice.*.required_without' => 'The file field is required when choice field is not present.',
      'picture_choice.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',

    ]);

    $data = Question::find($id);
    $quiz = Quiz::find($data->quiz_id);

    DB::beginTransaction();
    if (!empty($request->picture)) {
        $file = $request->file('picture');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '.' . $extension;
        $img = Image::make($file)->resize(300, 200);
        \Storage::put('public/images/question/' . $filename, $img->encode());
        $data->pic_url=$filename;
    }
    $data->question=$request->question;
    $data->save();
    if (!$data) {
      DB::rollback();
      return 'failed DB transaction';
    }

    foreach ($data->answer as $key => $value) {
        $value->content       = $request->choice[$key];
        $value->isTrue        = $request->true_answer[0] == $value->option ? 1 : 0;
        $value->save();
    }

    foreach ($data->answer as $key => $value2) {
      if (!empty($request->picture_choice[$key])) {
          $fileChoice[$key] = $request->file('picture_choice.'.$key);
          $extensionChoice[$key] = strtolower($fileChoice[$key]->getClientOriginalExtension());
          $filenameChoice[$key] = uniqid() . '.' . $extensionChoice[$key];
          $img[$key] = Image::make($fileChoice[$key])->resize(300, 200);
          \Storage::put('public/images/option/' . $filenameChoice[$key], $img[$key]->choice());
          $value2->pic_url = $filenameChoice[$key];
      }
      $value2->save();
    }
    DB::commit();
    return redirect()->route('quiz.show',$data->quiz_id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    DB::beginTransaction();
    $data = Question::find($id);

    $answer = Answer::where('question_id', $id)->get();
    foreach ($answer as $key => $value) {
      Storage::delete('public/images/answer/'.$value->pic_url);
      $value->delete();
    }
    if (!$answer) {
      DB::rollback();
      return 'failed DB transaction';
    }

    Storage::delete('public/images/question/'.$data->pic_url);
    $data->delete();
    if (!$data) {
      DB::rollback();
      return 'failed DB transaction';
    }

    $quiz = Quiz::where('id', $data->quiz_id)->first();
    $quiz->sum_question = $quiz->sum_question - 1;
    $quiz->save();
    if (!$quiz) {
      DB::rollback();
      return 'failed DB transaction';
    }
    DB::commit();
    return redirect()->route('quiz.show',$quiz->id);
  }

  public function picture($id)
  {
    $data = Question::find($id);
    return \Image::make(\Storage::get('public/images/question/'.$data->pic_url))->response();
  }

  /*START OF API*/
  public function api_index($id)
  {
      $quiz = Quiz::where('id', $id)->first();
      if(!empty($quiz)){
          $question = Question::where('quiz_id', $quiz->id)->with('answer')->get();
          // return $question;

      } else {
        return response()->json([
            'status' => 'failed',
            'message'   => 'Quiz not found'
        ]);
      }

      // $option  = [];
      // foreach ($question as $key => $item) {
      //     $option[$key] = $item->answer()->orderBy('option', 'asc')->get();
      // }
      //
      // $collection = [];
      // foreach ($question as $i => $item) {
      //   $array_option = [];
      //
      //   for ($j=0; $j < count($option[$i]) ; $j++) {
      //     $array_option[] = ['opsi' => $option[$i]->get($j)->content,
      //                        'pic' => $option[$i]->get($j)->pic_url,
      //                        'isTrue' => $option[$i]->get($j)->isTrue];
      //   }
      //
      //   $collection[$i] = [
      //     'id' => $item['id'],
      //     'question' => $item['question'],
      //     'pic_question' => $item['pic_url'],
      //     'option' => $array_option,
      //     'trueAnswer' => $option[$i]->where('isTrue', 1)->first()->content,
      //     'trueAnswerPic' => $option[$i]->where('isTrue', 1)->first()->pic_url,
      //   ];
      // }
      $collection = [];
      foreach ($question as $i => $item) {
        $opt = $item->answer()->orderBy('option', 'asc')->get();
        foreach ($opt as $key => $value) {
          $value->choosen = 0;
        }
        $collection[$i] = [
          'id' => $item['id'],
          'question' => $item['question'],
          'pic_question' => $item['pic_url'],
          'duration' => $item['time'],
          'trueAnswer' => $item->answer()->orderBy('option', 'asc')->get()->where('isTrue', 1)->first()->content,
          'trueAnswerPic' => $item->answer()->orderBy('option', 'asc')->get()->where('isTrue', 1)->first()->pic_url,
          'user_answer' => null,
          'option' => $opt,
        ];
      }

      $data = Arr::random($collection, $quiz->tot_visible);
      return response()->json([
          'status' => 'success',
          'quiz'   => $quiz,
          'question'   => $data
      ]);
  }

  public function api_store(Request $request)
  {
    dd(json_decode($request->getContent(), true));
  }
}

?>
