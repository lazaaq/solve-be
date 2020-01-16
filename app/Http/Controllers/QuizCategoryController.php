<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\QuizCategory;
use Validator;
use File;
use Auth;

class QuizCategoryController extends Controller
{
  public function getData()
  {
    $data = QuizCategory::all()->sortBy('name');
    return datatables()->of($data)
    ->addColumn('action', function($row){
      $btn = '<a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
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
    $rules = [
      'name' => 'required|max:150|unique:quiz_categorys',
      'description' => 'required|max:191',
      'pic_url' => 'max:2048|mimes:png,jpg,jpeg',
      'pic_url_2' => 'max:2048|mimes:png,jpg,jpeg',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }
    else{
      if(!empty($request->picture)){
           $file = $request->file('picture');
           $extension = strtolower($file->getClientOriginalExtension());
           $filename = uniqid() . '.' . $extension;
           Storage::put('public/images/quizcategory/' . $filename, File::get($file));
       }else{
          $filename='blank.jpg';
       }

       if(!empty($request->picture2)){
        $file2 = $request->file('picture2');
        $extension2 = strtolower($file2->getClientOriginalExtension());
        $filename2 = uniqid() . '.' . $extension2;
        Storage::put('public/images/quizcategory/' . $filename2, File::get($file2));
       } else{
          $filename2='blank.jpg';
       }

      QuizCategory::create(
        [
              'name' => request('name'),
              'description'=>request('description'),
              'pic_url'=>$filename,
              'pic_url_2'=>$filename2,
              'created_by'=>Auth::id()
        ]
      );
      return response()->json(['success'=>'Data added successfully']);
      // return redirect(route('quizcategory.index'));
    }
  }
  public function edit($id)
  {
    $data = QuizCategory::find($id);
    return response()->json(['status' => 'ok','data'=>$data],200);
    // return view('quiz-category.edit', compact('data'));
  }

  public function update(Request $request, $id)
  {
    // dd($id);
    $data= QuizCategory::find($id);
    $rules = [
      'name_edit' => 'required|max:150|unique:quiz_categorys,name,'.$data->id.',id',
      'description_edit' => 'required|max:191',
      'pic_url' => 'max:2048|mimes:png,jpg,jpeg',
      'pic_url_2' => 'max:2048|mimes:png,jpg,jpeg',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }else{
      if(!empty($request->picture_edit)){
           $file = $request->file('picture_edit');
           $extension = strtolower($file->getClientOriginalExtension());
           $filename = uniqid() . '.' . $extension;
           Storage::delete('public/images/quizcategory/' . $data->pic_url);
           Storage::put('public/images/quizcategory/' . $filename, File::get($file));
      }else{
           $filename=$data->pic_url;
      }
      if(!empty($request->picture_edit2)){
        $file2 = $request->file('picture_edit2');
        $extension2 = strtolower($file2->getClientOriginalExtension());
        $filename2 = uniqid() . '.' . $extension2;
        Storage::delete('public/images/quizcategory/' . $data->pic_url_2);
        Storage::put('public/images/quizcategory/' . $filename2, File::get($file2));
      }else{
            $filename2=$data->pic_url_2;
      }
      $data->name=$request->name_edit;
      $data->description=$request->description_edit;
      $data->pic_url=$filename;
      $data->pic_url_2=$filename2;
      $data->created_by=Auth::id();
      $data->save();
      return response()->json(['success'=>'Data updated successfully']);
      // return redirect()->route('quizcategory.index');
    }
  }

  public function destroy($id)
  {
    $data = QuizCategory::find($id);
    Storage::delete('public/images/quizcategory/'.$data->pic_url);
    Storage::delete('public/images/quizcategory/'.$data->pic_url_2);
    $data->delete();

    return redirect()->route('quizcategory.index');
  }

  public function picture($id)
  {
    $picture = QuizCategory::find($id);
    return Image::make(Storage::get('public/images/quizcategory/'.$picture->pic_url))->response();
  }

  public function picture2($id)
  {
    $picture = QuizCategory::find($id);
    return Image::make(Storage::get('public/images/quizcategory/'.$picture->pic_url_2))->response();
  }

  public function getSelect(Request $request)
  {
    $param  = $request->get('term');
    $data = QuizCategory::select('id','name')->orWhere('name','like',"%$param%")->get()->sortBy('name');
    $list = [];
      foreach ($data as $key => $value) {
          $list[] = [
              'id'=>$value->id,
              'text'=>$value->name
          ];
      }
      return response()->json($list);
  }

  public function getPreSelect(Request $request, $id)
  {
    $data = QuizCategory::select('id','name')->where('name',$id)->first();
    return response()->json($data);
  }


  /* START OF API */

  function api_index(){
    $data = QuizCategory::orderBy('id')->get();
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

}
