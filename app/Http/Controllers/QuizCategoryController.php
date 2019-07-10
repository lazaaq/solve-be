<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\QuizCategory;
use File;

class QuizCategoryController extends Controller
{
  public function getData()
  {
    $data = QuizCategory::all()->sortBy('name');
    return datatables()->of($data)
    ->addColumn('action', function($row){
      $btn = '<a href="'.route('quizcategory.edit',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
      return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);
  }
  public function index()
  {
    return view('quiz-category.index');
  }

  public function create()
  {
    return view('quiz-category.create');
  }

  public function store(Request $request)
  {
    $this->validate(request(),
      [
        'name' => 'required|max:20|unique:quiz_categorys',
        'description' => 'required|max:191',
        'pic_url' => 'max:2048|mimes:png,jpg,jpeg',
      ]
    );
    if(!empty($request->picture)){
         $file = $request->file('picture');
         $extension = strtolower($file->getClientOriginalExtension());
         $filename = $request->name . '.' . $extension;
         Storage::put('public/images/quizcategory/' . $filename, File::get($file));
       }else{
         $filename='blank.jpg';
       }
       // dd($filename);
    QuizCategory::create(
      [
            'name' => request('name'),
            'description'=>request('description'),
            'pic_url'=>$filename
      ]
    );
    return redirect(route('quizcategory.index'));
  }

  public function edit($id)
  {
    $data = QuizCategory::find($id);
    return view('quiz-category.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    // dd($id);
    $data= QuizCategory::find($id);
    $this->validate(request(),
      [
        'name' => 'required|max:20|unique:quiz_categorys,name,'.$data->id.',id',
        'description' => 'required|max:191',
        'pic_url' => 'max:2048|mimes:png,jpg,jpeg',
      ]
    );
    if(!empty($request->picture)){
         $file = $request->file('picture');
         $extension = strtolower($file->getClientOriginalExtension());
         $filename = $request->name . '.' . $extension;
         Storage::delete('public/images/quizcategory/' . $data->pic_url);
         Storage::put('public/images/quizcategory/' . $filename, File::get($file));
    }else{
         $filename=$data->pic_url;
    }

    $data->name=$request->name;
    $data->description=$request->description;
    $data->pic_url=$filename;
    $data->save();
    return redirect()->route('quizcategory.index');
  }

  public function destroy($id)
  {
    $data = QuizCategory::find($id);
    Storage::delete('public/images/quizcategory/'.$data->pic_url);
    $data->delete();

    return redirect()->route('quizcategory.index');
  }

  public function picture($id)
  {
    $picture = QuizCategory::find($id);
    return Image::make(Storage::get('public/images/quizcategory/'.$picture->pic_url))->response();
  }
    //
}
