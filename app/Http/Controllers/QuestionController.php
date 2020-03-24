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
use App\QuizCollager;
use App\AnswerSave;
use Auth;
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
            $img[$i] = Image::make($file[$i])->resize(800, 500);
            \Storage::put('public/images/question/' . $filename[$i], $img[$i]->encode());
        } else {
          $filename[$i] = '';
        }
        $question[$i] = [
            'quiz_id'       => $request->quiz_id,
            'question'      => $request->question[$i],
            'pic_url'       => $filename[$i],
            'review'        => $request->review[$i]
        ];

    }

    $answers = [];
    $option = ['A', 'B', 'C', 'D', 'E'];
    for ($i=0; $i < @count($request->choice); $i++) {
        for ($j=0; $j < @count($request->choice[$i]); $j++) {
            if (@count($request->choice[$i]) == 1) {
              $tipe = 'Isian';
            } else {
              $tipe = $option[$j];
            }
            $answers[$i][$j] = [
              'option'        => $tipe,
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
      'picture_choice.*' => 'mimes:png,jpg,jpeg|max:2048',
    ],
    [
      'question.*.required' => 'The question field is required.',
      'picture.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',
      'picture_choice.*.mimes' => 'The file must be a file of type: png, jpg, jpeg.',

    ]);

    $data = Question::find($id);
    $quiz = Quiz::find($data->quiz_id);
    $option = ['A', 'B', 'C', 'D', 'E'];

    DB::beginTransaction();
    if (!empty($request->picture)) {
        $file = $request->file('picture');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '.' . $extension;
        $img = Image::make($file)->resize(800, 500);
        Storage::delete('public/images/question/'.$data->pic_url);
        \Storage::put('public/images/question/' . $filename, $img->encode());
        $data->pic_url=$filename;
    }
    $data->question=$request->question;
    $data->review=$request->review;
    $data->save();
    if (!$data) {
      DB::rollback();
      return 'failed DB transaction';
    }
    for ($i=0; $i<=$request->jumlah; $i++) {
      if ($data->answer->count() > $request->jumlah+1) {
        #kurang
        if ($i < $request->jumlah) {
          $data->answer->get($i)->content  = $request->choice[$i];
          $data->answer->get($i)->save();
        } else {
          for ($j=$request->jumlah+1; $j <5 ; $j++) {
            if ($data->answer->get($j) != null) {
              $option = Answer::find($data->answer->get($j)->id);
              Storage::delete('public/images/option/'.$data->answer->get($j)->pic_url);
              $option->delete();
            }

          }
        }
      } elseif ($data->answer->count() < $request->jumlah+1) {
        #tambah
        if ($data->answer->get($i) != null) {
          $data->answer->get($i)->content  = $request->choice[$i];
          $data->answer->get($i)->save();
        } else {
          $answers = [
            'option'        => $option[$i],
            'content'       => $request->choice[$i],
            'isTrue'        => 0
          ];
          $data->answer()->create($answers);
        }
      } else {
          $data->answer->get($i)->content  = $request->choice[$i];
          $data->answer->get($i)->save();
      }
    }
    // foreach ($data->answer as $key => $value2) {
    //   if (!empty($request->picture_choice[$key])) {
    //       $fileChoice[$key] = $request->file('picture_choice.'.$key);
    //       $extensionChoice[$key] = strtolower($fileChoice[$key]->getClientOriginalExtension());
    //       $filenameChoice[$key] = uniqid() . '.' . $extensionChoice[$key];
    //       $imgChoice[$key] = Image::make($fileChoice[$key])->resize(300, 200);
    //       \Storage::put('public/images/option/' . $filenameChoice[$key], $imgChoice[$key]->encode());
    //       $value2->pic_url = $filenameChoice[$key];
    //       $value2->save();
    //   }
    // }

    DB::commit();
    for ($i=0; $i<=$request->jumlah; $i++) {
      if (!empty($request->picture_choice[$i])) {
        $fileChoice[$i] = $request->file('picture_choice.'.$i);
        $extensionChoice[$i] = strtolower($fileChoice[$i]->getClientOriginalExtension());
        $filenameChoice[$i] = uniqid() . '.' . $extensionChoice[$i];
        $imgChoice[$i] = Image::make($fileChoice[$i])->resize(300, 200);
        if ($data->answer->get($i) != null) {
          Storage::delete('public/images/option/'.$data->answer->get($i)->pic_url);
        }
        Storage::put('public/images/option/' . $filenameChoice[$i], $imgChoice[$i]->encode());
        $data->answer->get($i)->pic_url = $filenameChoice[$i];
        $data->answer->get($i)->save();
      }
    }
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

  public function destroyPic($id)
  {
    DB::beginTransaction();
    $data = Question::find($id);
    Storage::delete('public/images/question/'.$data->pic_url);
    $data->pic_url = '';
    $data->save();
    DB::commit();
    return redirect()->route('question.edit',$data->id);
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
        $type = 'option';
        if ($item->answer()->count() == 1) {
          $type = 'fill';
        }
        $collection2 = [];
        foreach ($opt as $key => $value) {
          $collection2[$key]= [
            'id' => $value['id'],
            'question_id' => $value['question_id'],
            'option' => $value['option'],
            'content' => $value['content'],
            'pic_url' => $value['pic_url'],
            'isTrue' => $value['isTrue'],
            'choosen' => 0,
          ];
        }
        shuffle($collection2);
        $collection[$i] = [
          'id' => $item['id'],
          'question' => $item['question'],
          'review' => $item['review'],
          'type' => $type,
          'pic_question' => $item['pic_url'],
          'duration' => $item['time'],
          'trueAnswer' => $item->answer()->orderBy('option', 'asc')->get()->where('isTrue', 1)->first()->option,
          'trueAnswerContent' => $item->answer()->orderBy('option', 'asc')->get()->where('isTrue', 1)->first()->content,
          'trueAnswerPic' => $item->answer()->orderBy('option', 'asc')->get()->where('isTrue', 1)->first()->pic_url,
          'user_answer' => '**',
          'user_answer_content' => '**',
          'option' => $collection2,
        ];
      }

      $data = Arr::random($collection, $quiz->tot_visible);
      shuffle($data);
      return response()->json([
          'status' => 'success',
          'quiz'   => $quiz,
          'question'   => $data
      ]);
  }

  public function api_store(Request $request)
  {
    $answer = json_decode($request->getContent(), true);
    // $file = $request->file('answer');
    // $answer = json_decode(File::get($file), true);
    $total_score = 0;
    DB::beginTransaction();
    $quizCollager = QuizCollager::create([
            'quiz_id' => $answer['quiz']['id'],
            'collager_id' => Auth::user()->collager->id,
            'total_score'=> $total_score,
    ]);
    foreach ($answer['question'] as $key => $value) {
      $isTrue = 0;
      $score = -1;
      // ISIAN
      if ($answer['question'][$key]['trueAnswer'] == 'Isian') {
        if (strtolower($answer['question'][$key]['trueAnswerContent']) == strtolower($answer['question'][$key]['user_answer_content'])) {
          $isTrue   = 1;
          $score    = 4;
          $answer['question'][$key]['user_answer'] = 'Isian';
        }
      }
      // OPTION
      else {
        if ($answer['question'][$key]['trueAnswer'] == $answer['question'][$key]['user_answer']) {
          $isTrue = 1;
          $score = 4;
        }
      }
      $collager_answer = $answer['question'][$key]['user_answer'];
      if ($collager_answer == '**') {
        $collager_answer = '-';
      }
      $total_score += $score;
      AnswerSave::create([
              'quiz_collager_id'=>$quizCollager->id,
              'question_id'=>$answer['question'][$key]['id'],
              'collager_answer' => $collager_answer,
              'isTrue' => $isTrue,
              'score' => $score,
      ]);
    }
    $data = QuizCollager::with('answerSave')->find($quizCollager->id);
    $data->total_score = $total_score;
    $data->save();
    $data->true_sum = $data->answerSave()->where('isTrue', 1)->count();
    $data->false_sum = $data->answerSave()->where('isTrue', 0)->count();
    DB::commit();
    return response()->json([
        'status' => 'success',
        'result'   => $data,
    ]);
  }
}

?>
