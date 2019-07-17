<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use File;
use App\QuizType;
use App\Quiz;
use App\Question;
use DataTables;
use DB;
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
      $btn = $btn.'<a href="'.route('quiz.edit',$row->id).'" title="Edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
      // $btn = $btn.'  <a href="'.route('quiz.destroy',$row->id).'" title="Delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
      return $btn;
    })
    ->rawColumns(['action'])
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

    return view('quiz.index');
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
      $this->validate(request(),
        [
          'quiz_type' => 'required',
          'title' => 'required|max:50|unique:quizs',
          'description' => 'required|max:191',
          'total_question' => 'required',
          'picture' => 'max:2048|mimes:png,jpg,jpeg',
        ]
      );
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
              'sum_question'=>request('total_question'),
              'pic_url'=>$filename
        ]
      );
      return redirect('admin/quiz/question/'.$data->id);
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
    return view('quiz.view', compact('quiz'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $data = Quiz::find($id);
    $quiztype = QuizType::all()->sortBy('name');
    return view('quiz.edit', compact('data','quiztype'));
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
    $this->validate(request(),
      [
        'quiz_type' => 'required',
        'title' => 'required|max:20|unique:quizs,title,'.$data->id.',id',
        'description' => 'required|max:191',
        'picture' => 'max:2048|mimes:png,jpg,jpeg',
      ]
    );
    if(!empty($request->picture)){
         $file = $request->file('picture');
         $extension = strtolower($file->getClientOriginalExtension());
         $filename = $request->name . '.' . $extension;
         Storage::delete('public/images/quiz/' . $data->pic_url);
         Storage::put('public/images/quiz/' . $filename, File::get($file));
    }else{
         $filename=$data->pic_url;
    }

    $data->quiz_type_id=$request->quiz_type;
    $data->title=$request->title;
    $data->description=$request->description;
    $data->pic_url=$filename;
    $data->save();
    return redirect()->route('quiz.index');
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
    $tes = Excel::import(new QuestionImport($id), $file);

    $question = Question::where('quiz_id',$id)->count();
    $data->sum_question = $data->sum_question + $question;
    $data->save();
    return redirect()->route('quiz.show',$id);
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
                  ->select('quizs.id', 'quiz_types.name as type', 'quizs.title', 'quizs.description', 'quizs.sum_question','quizs.pic_url')
                  ->get();
    if (empty($data[0])) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Not found quiz data.'
      ]);
    }
    foreach ($data as $key => $value) {
      if($value->pic_url == 'blank.jpg'){
        $value->pic_url = asset('img/'.$value->pic_url.'');
      }else {
        $value->pic_url = route('quiz.picture',$value->id);
      }
    }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

}

?>
