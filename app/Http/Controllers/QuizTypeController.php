<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuizType;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use File;

class QuizTypeController extends Controller
{
  public function getData()
  {
    $data = QuizType::orderBy('name')->get();
    return datatables()->of($data)->addColumn('action', function($row){
      $btn = '<a href="'.route('quiztype.edit',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <a href="'.route('quiztype.destroy',$row->id).'" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
      return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
  }
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('quiz-type.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('quiz-type.create');
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
        'name' => 'required|max:20|unique:quiz_types',
        'description' => 'required|max:191',
      ]
    );
    if(!empty($request->picture)){
         $file = $request->file('picture');
         $extension = strtolower($file->getClientOriginalExtension());
         $filename = $request->name . '.' . $extension;
         Storage::put('images/' . $filename, File::get($file));
         $file_server = Storage::get('images/' . $filename);
         $img = Image::make($file_server)->resize(141, 141);
         $img->save(base_path('public/img/quiztype/' . $filename));
       }else{
         $filename='-';
       }
       // dd($filename);
    QuizType::create(
      [
            'name' => request('name'),
            'description'=>request('description'),
            'pic_url'=>$filename
      ]
    );
    return redirect(route('quiztype.index'));
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
    $data = QuizType::find($id);
    return view('quiz-type.edit', compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    // dd($id);
    $data= QuizType::find($id);
    $this->validate(request(),
      [
        'name' => 'required|max:20|unique:quiz_types,name,'.$data->id.',id',
        'description' => 'required|max:191',
      ]
    );
    if(!empty($request->picture)){
         $file = $request->file('picture');
         $extension = strtolower($file->getClientOriginalExtension());
         $filename = $request->name . '.' . $extension;
         Storage::put('images/' . $filename, File::get($file));
         $file_server = Storage::get('images/' . $filename);
         $img = Image::make($file_server)->resize(141, 141);
         $img->save(base_path('public/img/quiztype/' . $filename));
    }else{
         $filename=$data->pic_url;
    }

    $data->name=$request->name;
    $data->description=$request->description;
    $data->pic_url=$filename;
    $data->save();
    return redirect()->route('quiztype.index');
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
