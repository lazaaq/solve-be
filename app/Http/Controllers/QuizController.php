<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use File;
use App\QuizType;
use App\Quiz;
use DataTables;

class QuizController extends Controller
{

  public function getData()
  {
    $data = Quiz::all()->sortBy('title');
    return datatables()->of($data)->addColumn('action', function($row){
      // $btn = '<a href="'.url('master/admin/quiz/question/'.$row->id.).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = '<a href="'.route('quiz.edit',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <a href="'.route('quiz.destroy',$row->id).'" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
      return $btn;
    })
    ->rawColumns(['action'])
    ->addColumn('total_question', function($row){
      return $row->question->count();
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
        ]
      );
      if(!empty($request->picture)){
           $file = $request->file('picture');
           $extension = strtolower($file->getClientOriginalExtension());
           $filename = $request->title . '.' . $extension;
           Storage::put('images/quiz/' . $filename, File::get($file));
           $file_server = Storage::get('images/quiz/' . $filename);
           $img = Image::make($file_server)->resize(141, 141);
           $img->save(base_path('public/img/quiz/' . $filename));
         }else{
           $filename='-';
         }
         // dd($filename);
      $data = Quiz::create(
        [
              'quiz_type_id' => request('quiz_type'),
              'title' => request('title'),
              'description'=>request('description'),
              'pic_url'=>$filename
        ]
      );
      // return view('question.create', compact('data'));
      return redirect('admin/quiz/question/'.$user->id);

      // return redirect('master/penjual/barang-jual/'.$data->id);

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

}

?>
