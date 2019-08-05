<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use File;
use App\QuizCategory;
use App\QuizType;
use App\Quiz;
use App\Question;
use DataTables;
use DB;
use Validator;
use Excel;
use App\Imports\QuestionImport;


class QuizController extends Controller
{

  public function getData()
  {
    $data = Quiz::all()->sortBy('title');
    return datatables()->of($data)
    ->addColumn('action', function($row){
      $btn = '<a href="'.route('quiz.show',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $btn = $btn.'  <a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      // $btn = $btn.'  <a href="'.route('quiz.edit',$row->id).'" title="Edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
      // $btn = $btn.'  <a href="'.route('quiz.destroy',$row->id).'" title="Delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
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
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $quizcategory = QuizCategory::all()->sortBy('name');
    $quiztype = QuizType::all()->sortBy('name');
    return view('quiz.index', compact('quiztype','quizcategory'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $quiztype = QuizType::all()->sortBy('name');
    return view('quiz.create', compact('quiztype'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $rules = [
        'quiz_type' => 'required',
        'title' => 'required|max:150|unique:quizs',
        'description' => 'required|max:191',
        // 'total_question' => 'required',
        'total_visible_question' => 'required',
        'picture' => 'max:2048|mimes:png,jpg,jpeg',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }else{
        if(!empty($request->picture)){
             $file = $request->file('picture');
             $extension = strtolower($file->getClientOriginalExtension());
             $filename = $request->title . '.' . $extension;
             Storage::put('public/images/quiz/' . $filename, File::get($file));
           }else{
             $filename='blank.jpg';
           }
           // dd($filename);
        $data = Quiz::create(
          [
                'quiz_type_id' => request('quiz_type'),
                'title' => request('title'),
                'description'=>request('description'),
                // 'sum_question'=>request('total_question'),
                'tot_visible'=>request('total_visible_question'),
                'pic_url'=>$filename
          ]
        );
        return response()->json(['success'=>'Data added successfully','data'=>$data]);
        // return redirect('admin/quiz/question/'.$data->id);
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $quiz = Quiz::where('id', $id)->first();
    $question = Question::where('quiz_id', $quiz->id)->paginate(3);
    // $question = DB::table('questions')->where('quiz_id', $quiz->id)->paginate(3);
    return view('quiz.view', compact('quiz','question'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $data = Quiz::where('id', $id)->with('QuizType')->first();
    return response()->json(['status' => 'ok','data'=>$data],200);
    // return view('quiz.edit', compact('data','quiztype'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $data= Quiz::find($id);
    $rules = [
      'quiz_type_edit' => 'required',
      'title_edit' => 'required|max:150|unique:quizs,title,'.$data->id.',id',
      'description_edit' => 'required|max:191',
      'total_visible_question_edit' => 'required',
      'picture_edit' => 'max:2048|mimes:png,jpg,jpeg',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }else{
      if(!empty($request->picture_edit)){
           $file = $request->file('picture_edit');
           $extension = strtolower($file->getClientOriginalExtension());
           $filename = $request->name . '.' . $extension;
           Storage::delete('public/images/quiz/' . $data->pic_url);
           Storage::put('public/images/quiz/' . $filename, File::get($file));
      }else{
           $filename=$data->pic_url;
      }
    }
    $data->quiz_type_id=$request->quiz_type_edit;
    $data->title=$request->title_edit;
    $data->description=$request->description_edit;
    $data->tot_visible=$request->total_visible_question_edit;
    $data->pic_url=$filename;
    $data->save();
    return response()->json(['success'=>'Data updated successfully']);
    // return redirect()->route('quiz.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $data = Quiz::find($id);
    Storage::delete('public/images/quiz/'.$data->pic_url);
    $data->delete();

    return redirect()->route('quiz.index');
  }

  public function picture($id)
  {
    $picture = Quiz::find($id);
    return Image::make(Storage::get('public/images/quiz/'.$picture->pic_url))->response();
  }

  public function import($id)
  {
    $data = Quiz::find($id);
    return view('quiz.import',compact('data'));
  }

  public function saveImport(Request $request, $id)
  {
    $this->validate(request(),
      [
        'excel' => 'required|mimes:xlsx',
      ]
    );
    $data = Quiz::find($id);

    $file = $request->file('excel');
    $import = Excel::load($file, function($reader) {
      $reader->skipRows(5);
    })->get();

    $import_data_filter = array_filter($import->toArray());
    $totalQuestion = count($import_data_filter);
    $messages_error = [];
    foreach ($import_data_filter as $key => $value) {
      $messages_error[$key.'.question.required'] = "Question field number ".($key+1)." is empty.";
      $messages_error[$key.'.question.distinct'] = "Question field number ".($key+1)." has duplicate value.";
      $messages_error[$key.'.question.unique'] = "Question field number ".($key+1)." has already been taken.";
      $messages_error[$key.'.option_a.required'] = "Option A field number ".($key+1)." is empty.";
      $messages_error[$key.'.option_b.required'] = "Option B field number ".($key+1)." is empty.";
      $messages_error[$key.'.option_c.required'] = "Option C field number ".($key+1)." is empty.";
      $messages_error[$key.'.option_d.required'] = "Option D field number ".($key+1)." is empty.";
      $messages_error[$key.'.option_e.required'] = "Option E field number ".($key+1)." is empty.";
    }

    $validator = Validator::make($import_data_filter,[
      '*.question' => 'required|distinct|unique:questions,question',
      '*.option_a' => 'required',
      '*.option_b' => 'required',
      '*.option_c' => 'required',
      '*.option_d' => 'required',
      '*.option_e' => 'required'
    ],$messages_error);

    $get_error = [];
    foreach ($validator->errors()->messages() as $key => $value) {
      $get_error[] = $key;
    }
    $error = array_unique($get_error);
    //dd($error);
    $question = [];
    $answers = [];
    $option = ['A', 'B', 'C', 'D', 'E'];

    $count_error = 0;
    foreach ($import as $key => $row) {
      if (in_array($key, $error)) {
        continue;
        $count_error++;
      } else {      
        $question[$key] = [
            'quiz_id'       => $id,
            'question'      => $row->question,
        ];

        $content = [$row->option_a,$row->option_b,$row->option_c,$row->option_d,$row->option_e];

        for ($i=0; $i < 5 ; $i++) {
            $answers[$key][$i] = [
                'option'  => $option[$i],
                'content' => $content[$i],
                'isTrue'  => $row->true_answer == $option[$i] ? 1 : 0,
            ];
        }
      }
    }
    $totalQuestionSuccess = count($question);

    foreach ($question as $key => $q) {
        Question::create($q)->answer()->createMany($answers[$key]);
    }

    $data->sum_question = $data->sum_question + $totalQuestionSuccess;
    $data->save();
    return redirect()->route('quiz.show',$id)->withErrors($validator)->with('totalQuestion',$totalQuestion)->with('totalQuestionSuccess',$totalQuestionSuccess);
  }

  public function downloadTemplate()
  {
    $path = 'template/Template Import Quiz.xlsx';
    return response()->download($path);
  }

  /*START OF API*/
  public function api_index($id){
    $data = Quiz::where('quiz_type_id', $id)
                  ->leftJoin('quiz_types', 'quizs.quiz_type_id', '=', 'quiz_types.id')
                  ->orderBy('title')
                ->select('quizs.id',// 'quiz_types.name as type',
                'quizs.sum_question','quizs.pic_url')
                // 
                //   ->select('quizs.id', 'quiz_types.name as type', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
                   ->get();
    if (empty($data[0])) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Not found quiz data.'
      ]);
    }
    // foreach ($data as $key => $value) {
    //   if($value->pic_url == 'blank.jpg'){
    //     $value->pic_url = asset('img/'.$value->pic_url.'');
    //   }else {
    //     $value->pic_url = route('quiz.picture',$value->id);
    //   }
    // }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

}

?>
