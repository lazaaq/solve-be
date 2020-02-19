<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\QuizType;
use App\User;
use File;
use Validator;
use Cache;
use Auth;

class QuizTypeController extends Controller
{
  public function getData()
  {
    if (Auth::user()->hasRole('admin')) {
      $data = QuizType::all()->sortBy('name');
    } else {
      $school_id = Auth::user()->school_id;
      $teacher = User::where('school_id',$school_id)->whereHas('lecture')->get();
      $teacher_id = [];
      foreach ($teacher as $key => $value) {
        $teacher_id[] = $value->id;
      }
      $data = QuizType::whereIn('created_by',$teacher_id)->get()->sortBy('name');
    }
    return datatables()->of($data)->addColumn('action', function($row){
      $btn = '<a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
      return $btn;
    })
    ->rawColumns(['action'])
    ->addColumn('quiz_category', function($row){
      return $row->quizCategory->name;
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
    // return $request;
    $rules = [
      'quiz_category' => 'required',
      'name' => 'required|max:150',
      'description' => 'required|max:191',
      'picture' => 'max:2048|mimes:png,jpg,jpeg',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()->all()]);
    }else{
      $cek = QuizType::where('quiz_category_id',$request->quiz_category)->where('name',$request->name)->first();
      if ($cek) {
        return response()->json(['errors'=>['Combination of Category Name & Type Name has already been taken.']]);
      }
      if(!empty($request->picture)){
        $file = $request->file('picture');
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = uniqid() . '.' . $extension;
        Storage::put('public/images/quiztype/' . $filename, File::get($file));
      }else{
        $filename='blank.jpg';
      }

      QuizType::create(
        [
              'name' => request('name'),
              'quiz_category_id' => request('quiz_category'),
              'description'=>request('description'),
              'pic_url'=>$filename,
              'created_by'=>Auth::id()
        ]
      );

      return response()->json(['success'=>'Data added successfully']);
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
      $data = QuizType::find($id);
      return response()->json(['status' => 'ok','data'=>$data],200);
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
    return response()->json(['status' => 'ok','data'=>$data],200);
    // return view('quiz-type.edit', compact('data'));
  }

  public function picture($id)
  {
    $picture = Cache::remember('imgquiztype'.$id, 24*60, function() use ($id) {
      return QuizType::find($id)->pic_url;
    });

    return Image::make(Storage::get('public/images/quiztype/'.$picture))->response();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    // return $request;
    $data= QuizType::find($id);
    $rules = [
      'quiz_category_edit' => 'required',
      'name_edit' => 'required|max:150',
      'description_edit' => 'required|max:191',
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
        Storage::put('public/images/quiztype/' . $filename, File::get($file));
      }else{
        $filename='blank.jpg';
      }
    }

    $data->name=$request->name_edit;
    $data->quiz_category_id=$request->quiz_category_edit;
    $data->description=$request->description_edit;
    $data->pic_url=$filename;
    $data->created_by=Auth::id();
    $data->save();

    Cache::forget('quiztype'.$id);
    Cache::forget('imgquiztype'.$id);

    return response()->json(['success'=>'Data updated successfully']);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $data = QuizType::find($id);
    if (!empty($data->quiz)) {
      return response()->json([
        'status'=>'failed',
        'message'=>'Data is being used by another table.',
      ]);
    }
    else {
      Storage::delete('public/images/quiztype/'.$data->pic_url);
      $data->delete();
      Cache::forget('quiztype'.$id);
      Cache::forget('imgquiztype'.$id);
    }
  }

  /*START OF API*/

  function api_index($id){

    $data = Cache::remember('quiztype'.$id, 24*60, function() use ($id) {
      return QuizType::where('quiz_category_id', $id)->orderBy('id')->get();
    });
    // foreach ($data as $key => $value) {
    //   if($value->pic_url == 'blank.jpg'){
    //     $value->pic_url = asset('img/'.$value->pic_url.'');
    //   }else {
    //     $value->pic_url = route('quiztype.picture',$value->id);
    //   }
    // }
    return response()->json([
      'status'=>'success',
      'result'=>$data
    ]);
  }

}

?>
