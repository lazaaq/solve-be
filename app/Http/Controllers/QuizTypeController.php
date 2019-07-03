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
    return datatables()->of($data)->make(true);
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
