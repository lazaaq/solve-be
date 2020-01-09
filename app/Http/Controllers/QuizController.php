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
use Redirect;
use Carbon\Carbon;
use Auth;

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
    ->addColumn('status', function($row){
        if ($row->status == 'active') {
          $btn = '<button id="change-status" title="Change to inactive" class="btn border-success btn-xs text-success btn-flat btn-icon"><i class="fa fa-toggle-on"></i> Active</button>';
        }else {
          $btn = '<button id="change-status" title="Change to active" class="btn border-default btn-xs text-default btn-flat btn-icon"><i class="fa fa-toggle-off"></i> Inactive</button>';
        }
        return $btn;
    })
    ->rawColumns(['action','status'])
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
        'time' => 'required'
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }else{
        if(!empty($request->picture)){
             $file = $request->file('picture');
             $extension = strtolower($file->getClientOriginalExtension());
             $filename = uniqid() . '.' . $extension;
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
                'code' => strtoupper(substr(md5(microtime()),rand(0,26),5)),
                // 'sum_question'=>request('total_question'),
                'start_time'=>request('start_time'),
                'end_time'=>request('end_time'),
                'tot_visible'=>request('total_visible_question'),
                'pic_url'=>$filename,
                'time'=>request('time'),
                'created_by'=>Auth::id()
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
    $question = Question::where('quiz_id', $quiz->id)->paginate(10);
    $number = $question->firstItem();
    // $question = DB::table('questions')->where('quiz_id', $quiz->id)->paginate(3);
    return view('quiz.view', compact('quiz','question','number'));
  }

  public function search(Request $request, $id)
  {
    if($request->ajax())
     {
      $quiz = Quiz::where('id', $id)->first();
      $query = $request->get('query');
      $query = str_replace(" ", "%", $query);
      $question = Question::where('quiz_id', $quiz->id)->where('question', 'like', '%'.$query.'%')->paginate(10);
      $number = $question->firstItem();
      return view('quiz.view_data', compact('quiz','question','number'))->render();
     }
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
    $data->start_time = Carbon::parse($data->start_time)->format('Y-m-d\TH:i:s');
    $data->end_time = Carbon::parse($data->end_time)->format('Y-m-d\TH:i:s');
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
           $filename = uniqid() . '.' . $extension;
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
    $data->start_time = $request->start_time_edit;
    $data->end_time = $request->end_time_edit;
    $data->time=$request->time_edit;
    $data->created_by=Auth::id();
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
    DB::beginTransaction();

    $file = $request->file('excel');
    $import = Excel::load($file)->get();
    if (!$import) {
      DB::rollback();
      return redirect()->route('quiz.show',$id)->with('dbTransactionError','Something wrong!');
    }
    $import_data_filter = array_filter($import->toArray());

    foreach ($import_data_filter as $key => $value) {
      if (($check = array_search('Diantara berikut ini yang bukan merupakan anggota girlband Blackpink adalah?', $value)) !== false) {
        unset($import_data_filter[$key]);
      }
      else {
        if (implode($value) == null) {
          unset($import_data_filter[$key]);
        }
      }
    }

    $import_data_filter = array_values($import_data_filter);

    $totalQuestion = count($import_data_filter);
    $messages_error = [];
    foreach ($import_data_filter as $key => $value) {
      $messages_error[$key.'.question.required'] = "Question field number ".($key+1)." is empty.";
      $messages_error[$key.'.question.distinct'] = "Question field number ".($key+1)." has duplicate value.";
      $messages_error[$key.'.question.unique'] = "Question field number ".($key+1)." has already been taken.";
      $messages_error[$key.'.option_a.required'] = "Option A field number ".($key+1)." is empty.";
      $messages_error[$key.'.option_b.required'] = "Option B field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_c.required'] = "Option C field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_d.required'] = "Option D field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_e.required'] = "Option E field number ".($key+1)." is empty.";
    }

    $validator = Validator::make($import_data_filter,[
      '*.question' => 'required|distinct|unique:questions,question',
      '*.option_a' => 'required',
      '*.option_b' => 'required',
      // '*.option_c' => 'required',
      // '*.option_d' => 'required',
      // '*.option_e' => 'required'
    ],$messages_error);

    $get_error = [];
    foreach ($validator->errors()->messages() as $key => $value) {
      $get_error[] = $key;
    }
    $error = array_unique($get_error);
    $question = [];
    $answers = [];
    $option = ['A', 'B', 'C', 'D', 'E'];

    $count_error = 0;
    foreach ($import_data_filter as $key => $row) {
      if (in_array($key, $error)) {
        continue;
        $count_error++;
      } else {
        $question[$key] = [
            'quiz_id'       => $id,
            'question'      => $row['question'],
        ];

        $content = [$row['option_a'],$row['option_b'],$row['option_c'],$row['option_d'],$row['option_e']];
        $content = array_filter($content);
        for ($i=0; $i < count($content) ; $i++) {
            $answers[$key][$i] = [
                'option'  => $option[$i],
                'content' => $content[$i],
                'isTrue'  => $row['true_answer'] == $option[$i] ? 1 : 0,
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
    DB::commit();
    return redirect()->route('quiz.show',$id)->withErrors($validator)->with('totalQuestion',$totalQuestion)->with('totalQuestionSuccess',$totalQuestionSuccess);
  }

  public function downloadTemplate()
  {
    $path = 'template/Template Import Quiz.xlsx';
    return response()->download($path);
  }

  public function export($id)
  {
      $quiz = Quiz::where('id', $id)->first();
      $question = Question::where('quiz_id', $quiz->id)->get();
      $option  = [];
      foreach ($question as $key => $item) {
          $option[$key] = $item->answer()->orderBy('option', 'asc')->get();
      }
      $collection = [];
      foreach ($question as $i => $item) {
        $collection[$i] = [
          'id' => $item['id'],
          'question' => $item['question'],
          'a' => $option[$i]->get(0)->content,
          'b' => $option[$i]->get(1)->content,
          'c' => $option[$i]->get(2)->content,
          'd' => $option[$i]->get(3)->content,
          'e' => $option[$i]->get(4)->content,
          'isTrueOpt' => $option[$i]->where('isTrue', 1)->first()->option,
        ];
      }
      return Excel::create('Export Quiz '.$quiz->title, function($excel) use ($collection)
      {
          $excel->sheet('Sheet1', function($sheet) use ($collection)
          {
              $sheet->freezeFirstRow();
              $sheet->setStyle(array(
                  'font' => array(
                      'name'      =>  'Calibri',
                      'size'      =>  12,
                  )
              ));
              $sheet->setAutoSize(array(
                  'A', 'C', 'D', 'E', 'F', 'G', 'H'
              ));
              $sheet->setWidth(array(
                  'B'     =>  74,
              ));

              $sheet->cell('A1:H1', function($cell)
              {
                  $cell->setBackground('#ede185');
                  $cell->setFontWeight('bold');
              });
              $sheet->cell('A1', function($cell)
              {
                  $cell->setValue('NO');
              });

              $sheet->cell('B1', function($cell)
              {
                  $cell->setValue('QUESTION');
              });

              $sheet->cell('C1', function($cell)
              {
                  $cell->setValue('OPTION A');
              });
              $sheet->cell('D1', function($cell)
              {
                  $cell->setValue('OPTION B');
              });
              $sheet->cell('E1', function($cell)
              {
                  $cell->setValue('OPTION C');
              });
              $sheet->cell('F1', function($cell)
              {
                  $cell->setValue('OPTION D');
              });
              $sheet->cell('G1', function($cell)
              {
                  $cell->setValue('OPTION E');
              });
              $sheet->cell('H1', function($cell)
              {
                  $cell->setValue('TRUE ANSWER');
              });

              if (!empty($collection))
              {
                  foreach ($collection as $key => $value)
                  {
                      $i= $key+2;
                      $sheet->cell('A'.$i, $key+1);
                      $sheet->cell('B'.$i, $value['question']);
                      $sheet->cell('C'.$i, $value['a']);
                      $sheet->cell('D'.$i, $value['b']);
                      $sheet->cell('E'.$i, $value['c']);
                      $sheet->cell('F'.$i, $value['d']);
                      $sheet->cell('G'.$i, $value['e']);
                      $sheet->cell('H'.$i, $value['isTrueOpt']);
                  }
              }
          });
      })->download('xlsx');
  }

  /*START OF API*/
  public function api_index($id){
    $data = Quiz::where('quiz_type_id', $id)
                  ->leftJoin('quiz_types', 'quizs.quiz_type_id', '=', 'quiz_types.id')
                  ->orderBy('quizs.id')
                  // ->select('quizs.id', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
                  // ->select('quizs.id', 'quiz_types.name as type', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
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
    foreach ($data as $key => $value) {
      $jam = date('H', strtotime($value->time)) * 60;
      $menit = date('i', strtotime($value->time)) * 1;
      $value->time = $jam+$menit;
    }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }


  public function api_indexByCode($id){
    $data = Quiz::where('code', $id)
                  ->leftJoin('quiz_types', 'quizs.quiz_type_id', '=', 'quiz_types.id')
                  ->orderBy('quizs.id')
                  // ->select('quizs.id', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
                  ->get();
    if (empty($data[0])) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Not found quiz data.'
      ]);
    }
    // if ($data[0]->status == 'inactive' || Carbon::now() >= $data[0]->end_time || Carbon::now() >= $data[0]->start_time) {
    if ($data[0]->status == 'inactive' || Carbon::now() >= $data[0]->end_time || Carbon::now() <= $data[0]->start_time) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Quis is currently unavailable.'
      ]);
    }

    foreach ($data as $key => $value) {
      $jam = date('H', strtotime($value->time)) * 60;
      $menit = date('i', strtotime($value->time)) * 1;
      $value->time = $jam+$menit;
    }
    
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

  public function changeStatus($id){
    $data = Quiz::find($id);
    if ($data->status == 'active') {
      $data->status = 'inactive';
    }else {
      $data->status = 'active';
    }
    $data->save();
    return response()->json(['success'=>'Data changed successfully','data'=>$data]);
  }

}

?>
