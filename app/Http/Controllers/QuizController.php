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
use App\User;
use Redirect;
use Carbon\Carbon;
use Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class QuizController extends Controller
{

  public function getData()
  {
    if (Auth::user()->hasRole('admin')) {
      $admin = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->get();
      $admin_id = [];
      foreach ($admin as $key => $value) {
        $admin_id[] = $value->id;
      }
      $data = Quiz::whereIn('created_by',$admin_id)->get()->sortBy('title');
    } else {
      $school_id = Auth::user()->school_id;
      $teacher = User::where('school_id',$school_id)->whereHas('lecture')->get();
      $teacher_id = [];
      foreach ($teacher as $key => $value) {
        $teacher_id[] = $value->id;
      }
      $data = Quiz::whereIn('created_by',$teacher_id)->get()->sortBy('title');
    }
    return datatables()->of($data)
    ->addColumn('action', function($row){
      $btn = '<a href="'.route('quiz.show',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
      $btn = $btn.'  <a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
      return $btn;
    })
    ->addColumn('status_quiz', function($row){
        if ($row->status == 'active') {
          $btn = '<button id="change-status" title="Change to inactive" data-target="status" class="btn border-success btn-xs text-success btn-flat btn-icon"><i class="fa fa-toggle-on"></i> Active</button>';
        }else {
          $btn = '<button id="change-status" title="Change to active" data-target="status" class="btn border-default btn-xs text-default btn-flat btn-icon"><i class="fa fa-toggle-off"></i> Inactive</button>';
        }
        return $btn;
    })
    ->addColumn('review_status', function($row){
      if ($row->status_review == 'active') {
        $btn = '<button id="change-status" title="Change to inactive" data-target="review" class="btn border-success btn-xs text-success btn-flat btn-icon"><i class="fa fa-toggle-on"></i> Active</button>';
      }else {
        $btn = '<button id="change-status" title="Change to active" data-target="review" class="btn border-default btn-xs text-default btn-flat btn-icon"><i class="fa fa-toggle-off"></i> Inactive</button>';
      }
      return $btn;
    })
    ->rawColumns(['action','status_quiz','review_status'])
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
    if (Auth::user()->hasRole('admin')) {
      $admin = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->get();
      $admin_id = [];
      foreach ($admin as $key => $value) {
        $admin_id[] = $value->id;
      }
      $quizcategory = QuizCategory::whereIn('created_by',$admin_id)->get()->sortBy('name');
      $quiztype = QuizType::whereIn('created_by',$admin_id)->get()->sortBy('name');
    } else {
      $school_id = Auth::user()->school_id;
      $teacher = User::where('school_id',$school_id)->whereHas('lecture')->get();
      $teacher_id = [];
      foreach ($teacher as $key => $value) {
        $teacher_id[] = $value->id;
      }
      $quizcategory = QuizCategory::whereIn('created_by',$teacher_id)->get()->sortBy('name');
      $quiztype = QuizType::whereIn('created_by',$teacher_id)->get()->sortBy('name');
    }
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
        } else {
          $filename='blank.jpg';
        }
        if (!empty($request->code)) {
          $code = strtoupper(substr(md5(microtime()),rand(0,26),5));
          $validation = Quiz::where('code', $code)->first();
          if (!empty($validation)) {
            $code = strtoupper(substr(md5(microtime()),rand(0,26),5));
          } else {
            $code = $code;
          }
        } else {
          $code = NULL;
        }

        $data = Quiz::create(
          [
                'quiz_type_id' => request('quiz_type'),
                'title' => request('title'),
                'description'=>request('description'),
                'code' => $code,
                // 'sum_question'=>request('total_question'),
                'start_time'=>request('start_time'),
                'end_time'=>request('end_time'),
                'tot_visible'=>request('total_visible_question'),
                'pic_url'=>$filename,
                'time'=>request('time'),
                'status'=>'active',
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
    $data->quiz_category_id = QuizType::find($data->quiz_type_id)->quiz_category_id;
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
      if ($request->code_edit == 'checked') {
        if ($request->code_container == NULL) {
            $code = strtoupper(substr(md5(microtime()),rand(0,26),5));
            $validation = Quiz::where('code', $code)->first();
            if (!empty($validation)) {
              $code = strtoupper(substr(md5(microtime()),rand(0,26),5));
            } else {
              $code = $code;
            }
        } else {
          $code = $request->code_container;
        }
      } else {
        $code = NULL;
      }
    }
    $data->code=$code;
    $data->quiz_type_id=$request->quiz_type_edit;
    $data->title=$request->title_edit;
    $data->description=$request->description_edit;
    $data->tot_visible=$request->total_visible_question_edit;
    $data->pic_url=$filename;
    $data->start_time = $request->start_time_edit;
    $data->end_time = $request->end_time_edit;
    $data->time=$request->time_edit;
    $data->updated_by=Auth::id();
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
    foreach ($data->question() as $key => $value) {
      $value->answer()->delete();
    }
    $data->question()->delete();
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
    $excel = IOFactory::load($file);
    $question_picture = [];
    $question_option = [];
    foreach ($excel->getActiveSheet()->getDrawingCollection() as $value => $drawing) {
      //check if it is instance of drawing
      if ($drawing) {
          //creating image name with extension
          $cell = substr($drawing->getCoordinates(),0,1);
          $file = file_get_contents($drawing->getPath());
          $filename = uniqid() . '.' .$drawing->getExtension();
          $img = Image::make($file)->resize(800, 500);
          switch ($cell) {
            case 'C':
              \Storage::put('public/images/question/' . $filename, $img->encode());
              $question_picture[substr($drawing->getCoordinates(),1)] = $filename;
              break;
            default:
              \Storage::put('public/images/option/' . $filename, $img->encode());
              switch ($cell) {
                case 'E':
                  $question_option[substr($drawing->getCoordinates(),1)][0] = $filename;
                  break;
                case 'G':
                  $question_option[substr($drawing->getCoordinates(),1)][1] = $filename;
                  break;
                case 'I':
                  $question_option[substr($drawing->getCoordinates(),1)][2] = $filename;
                  break;
                case 'K':
                  $question_option[substr($drawing->getCoordinates(),1)][3] = $filename;
                  break;
                case 'M':
                  $question_option[substr($drawing->getCoordinates(),1)][4] = $filename;
                  break;
              }
              break;
          }
      }
    }
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
      $messages_error[$key.'.true_answer.required'] = "True answer field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_b.required'] = "Option B field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_c.required'] = "Option C field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_d.required'] = "Option D field number ".($key+1)." is empty.";
      // $messages_error[$key.'.option_e.required'] = "Option E field number ".($key+1)." is empty.";
    }

    $validator = Validator::make($import_data_filter,[
      '*.question' => 'required|distinct|unique:questions,question,NULL,id,deleted_at,NULL',
      '*.true_answer' => 'required',
      // '*.option_a' => 'required',
      // '*.option_b' => 'required',
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
            'pic_url'       => array_key_exists($key+2,$question_picture) ? $question_picture[$key+2] : NULL
        ];

        $content = [$row['option_a'],$row['option_b'],$row['option_c'],$row['option_d'],$row['option_e']];
        $content = array_filter($content);
        $totalOption = array_key_exists($key+2,$question_option) ? count($question_option[$key+2]) : 0;
        for ($i=0; $i < max(count($content), $totalOption) ; $i++) {
            if ($row['true_answer'] == 'Isian') {
              $tipe = 'Isian';
            } else {
              $tipe = $option[$i];
            }
            if (!empty(array_key_exists($key+2,$question_option))) {
              $option_url[$i] = array_key_exists($i,$question_option[$key+2]) ? $question_option[$key+2][$i] : NULL;
            } else {
              $option_url[$i] = NULL;
            }
            $answers[$key][$i] = [
                'option'  => $tipe,
                'content' => array_key_exists($i,$content) ? $content[$i] : NULL,
                'isTrue'  => $row['true_answer'] == $tipe ? 1 : 0,
                'pic_url' => $option_url[$i]
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
    $content = ['a','b','c','d','e'];
    $content_pic = ['a_pic','b_pic','c_pic','d_pic','e_pic'];
    $option  = [];
    foreach ($question as $key => $item) {
        $option[$key] = $item->answer()->orderBy('option', 'asc')->get();
    }
    $collection = [];
    foreach ($question as $i => $item) {
      $collection[$i] = [
        'id' => $item['id'],
        'question' => $item['question'],
        'question_pic' => $item['pic_url'],
        'isTrueOpt' => $option[$i]->where('isTrue', 1)->first()->option,
      ];
      for ($j=0; $j < count($option[$i]); $j++) {
        $temp[$i][$j] = [
          $content[$j] => $option[$i]->get($j)->content,
          $content_pic[$j] => $option[$i]->get($j)->pic_url
        ];
        $collection[$i] = array_merge($collection[$i],$temp[$i][$j]);
      }
    }


    $spreadsheet = new Spreadsheet();

    $spreadsheet->getActiveSheet()->getStyle('A1:N1')->getFont()->setBold(true);
    $spreadsheet->getActiveSheet()->getStyle('E1:M1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE699');
    $spreadsheet->getActiveSheet()->getStyle('C1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFE699');
    $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');
    $spreadsheet->getActiveSheet()->getStyle('N1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF0000');

    $spreadsheet->getActiveSheet()->setCellValue('A1', 'NO');
    $spreadsheet->getActiveSheet()->setCellValue('B1', 'QUESTION');
    $spreadsheet->getActiveSheet()->setCellValue('C1', 'QUESTION PICTURE');
    $spreadsheet->getActiveSheet()->setCellValue('D1', 'OPTION A');
    $spreadsheet->getActiveSheet()->setCellValue('E1', 'OPTION PICTURE A');
    $spreadsheet->getActiveSheet()->setCellValue('F1', 'OPTION B');
    $spreadsheet->getActiveSheet()->setCellValue('G1', 'OPTION PICTURE B');
    $spreadsheet->getActiveSheet()->setCellValue('H1', 'OPTION C');
    $spreadsheet->getActiveSheet()->setCellValue('I1', 'OPTION PICTURE C');
    $spreadsheet->getActiveSheet()->setCellValue('J1', 'OPTION D');
    $spreadsheet->getActiveSheet()->setCellValue('K1', 'OPTION PICTURE D');
    $spreadsheet->getActiveSheet()->setCellValue('L1', 'OPTION E');
    $spreadsheet->getActiveSheet()->setCellValue('M1', 'OPTION PICTURE E');
    $spreadsheet->getActiveSheet()->setCellValue('N1', 'TRUE ANSWER');
    if (!empty($collection))
    {
        foreach ($collection as $key => $value)
        {
            $i= $key+2;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$i, $key+1);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$i, $value['question']);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$i, @$value['a']);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$i, @$value['b']);
            $spreadsheet->getActiveSheet()->setCellValue('H'.$i, @$value['c']);
            $spreadsheet->getActiveSheet()->setCellValue('J'.$i, @$value['d']);
            $spreadsheet->getActiveSheet()->setCellValue('L'.$i, @$value['e']);
            $spreadsheet->getActiveSheet()->setCellValue('N'.$i, $value['isTrueOpt']);

            if (@$value['question_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/question/'.@$value['question_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('C'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }
            if (@$value['a_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/option/'.@$value['a_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('E'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }
            if (@$value['b_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/option/'.@$value['b_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('G'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }
            if (@$value['c_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/option/'.@$value['c_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('I'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }
            if (@$value['d_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/option/'.@$value['d_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('K'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }
            if (@$value['e_pic']) {
              $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
              $drawing->setPath(public_path('/storage/images/option/'.@$value['e_pic']));
              $drawing->setHeight(256);
              $drawing->setCoordinates('M'.$i);
              $drawing->setWorksheet($spreadsheet->getActiveSheet());
            }

        }
    }

    foreach(range('A','N') as $columnID) {
        $sheet = $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="QUIZ '.$quiz->title.'.xlsx"');
    header('Cache-Control: max-age=0');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
  }
  public function exports($id)
  {
      $quiz = Quiz::where('id', $id)->first();
      $question = Question::where('quiz_id', $quiz->id)->get();
      $content = ['a','b','c','d','e'];
      $content_pic = ['a_pic','b_pic','c_pic','d_pic','e_pic'];
      $option  = [];
      foreach ($question as $key => $item) {
          $option[$key] = $item->answer()->orderBy('option', 'asc')->get();
      }
      $collection = [];
      foreach ($question as $i => $item) {
        $collection[$i] = [
          'id' => $item['id'],
          'question' => $item['question'],
          'question_pic' => $item['pic_url'],
          'isTrueOpt' => $option[$i]->where('isTrue', 1)->first()->option,
        ];
        for ($j=0; $j < count($option[$i]); $j++) {
          $temp[$i][$j] = [
            $content[$j] => $option[$i]->get($j)->content,
            $content_pic[$j] => $option[$i]->get($j)->pic_url
          ];
          $collection[$i] = array_merge($collection[$i],$temp[$i][$j]);
        }
      }
      // dd($collection);
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
                  'A', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'
              ));
              $sheet->setWidth(array(
                  'B'     =>  74,
              ));

              $sheet->cell('E1:M1', function($cell)
              {
                  $cell->setBackground('#FFE699');
                  $cell->setFontWeight('bold');
              });

              $sheet->cell('A1:B1', function($cell)
              {
                  $cell->setBackground('#FF0000');
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
                  $cell->setValue('QUESTION PICTURE');
                  $cell->setBackground('#FFE699');
                  $cell->setFontWeight('bold');
              });
              $sheet->cell('D1', function($cell)
              {
                  $cell->setValue('OPTION A');
                  $cell->setBackground('#FF0000');
                  $cell->setFontWeight('bold');
              });
              $sheet->cell('E1', function($cell)
              {
                  $cell->setValue('OPTION PICTURE A');
              });
              $sheet->cell('F1', function($cell)
              {
                  $cell->setValue('OPTION B');
              });
              $sheet->cell('G1', function($cell)
              {
                  $cell->setValue('OPTION PICTURE B');
              });
              $sheet->cell('H1', function($cell)
              {
                  $cell->setValue('OPTION C');
              });
              $sheet->cell('I1', function($cell)
              {
                  $cell->setValue('OPTION PICTURE C');
              });
              $sheet->cell('J1', function($cell)
              {
                  $cell->setValue('OPTION D');
              });
              $sheet->cell('K1', function($cell)
              {
                  $cell->setValue('OPTION PICTURE D');
              });
              $sheet->cell('L1', function($cell)
              {
                  $cell->setValue('OPTION E');
              });
              $sheet->cell('M1', function($cell)
              {
                  $cell->setValue('OPTION PICTURE E');
              });
              $sheet->cell('N1', function($cell)
              {
                  $cell->setValue('TRUE ANSWER');
                  $cell->setBackground('#FF0000');
                  $cell->setFontWeight('bold');
              });

              if (!empty($collection))
              {
                  foreach ($collection as $key => $value)
                  {
                      $i= $key+2;
                      $sheet->cell('A'.$i, $key+1);
                      $sheet->cell('B'.$i, $value['question']);
                      $sheet->cell('C'.$i, $value['question_pic']);
                      $sheet->cell('D'.$i, @$value['a']);
                      $sheet->cell('E'.$i, @$value['a_pic']);
                      $sheet->cell('F'.$i, @$value['b']);
                      $sheet->cell('G'.$i, @$value['b_pic']);
                      $sheet->cell('H'.$i, @$value['c']);
                      $sheet->cell('I'.$i, @$value['c_pic']);
                      $sheet->cell('J'.$i, @$value['d']);
                      $sheet->cell('K'.$i, @$value['d_pic']);
                      $sheet->cell('L'.$i, @$value['e']);
                      $sheet->cell('M'.$i, @$value['e_pic']);
                      $sheet->cell('N'.$i, $value['isTrueOpt']);
                  }
              }
          });
      })->download('xlsx');

  }

  /*START OF API*/
  public function api_index($id){
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    $data = Quiz::where('quiz_type_id', $id)
                  ->whereNull('code')
                  ->where('status', 'active')
                  ->where('start_time', '<=', $date)
                  ->where('end_time', '>=', $date)
                  ->whereRaw('sum_question >= tot_visible')
                  ->leftJoin('quiz_types', 'quizs.quiz_type_id', '=', 'quiz_types.id')
                  ->orderBy('quizs.id')
                  // ->select('quizs.id', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
                  ->select('quizs.id', 'quiz_types.name as type', 'quizs.title', 'quizs.code', 'quizs.description', 'quizs.sum_question', 'quizs.tot_visible','quizs.pic_url', 'quizs.status', 'quizs.time')
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


  public function api_indexByCode($id){
    $data = Quiz::where('code', $id)
                  ->where('status', 'active')
                  ->leftJoin('quiz_types', 'quizs.quiz_type_id', '=', 'quiz_types.id')
                  ->orderBy('quizs.id')
                  ->select('quizs.id', 'quiz_types.name as type', 'quizs.title', 'quizs.code', 'quizs.description', 'quizs.sum_question', 'quizs.tot_visible','quizs.pic_url', 'quizs.status' ,'quizs.start_time', 'quizs.end_time', 'quizs.time')
                  ->get();
    if (empty($data[0])) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Not found quiz data.'
      ]);
    }
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    if ($data[0]->status == 'inactive' || $date >= $data[0]->end_time || $date <= $data[0]->start_time) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Quiz is currently unavailable.'
      ]);
    }

    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

  public function changeStatus(Request $request, $id){
    $data = Quiz::find($id);
    if ($request->type == 'status') {
      if ($data->status == 'active') {
        $data->status = 'inactive';
      }else {
        $data->status = 'active';
      }
    } else {
      if ($data->status_review == 'active') {
        $data->status_review = 'inactive';
      }else {
        $data->status_review = 'active';
      }
    }

    $data->save();
    return response()->json(['success'=>'Data changed successfully','data'=>$data]);
  }

}

?>
