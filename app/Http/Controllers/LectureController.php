<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lecture;
use Auth;
use DB;
use Hash;
use App\Lib\Helper;
use Spatie\Permission\Models\Role;

class LectureController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('lecturer.index');
  }

  public function getData(Request $request)
  {
    $data = User::whereHas("roles", function($q) { $q->where("name", 'teacher'); })
                  ->where('school_id',Auth::user()->school_id)
                  ->whereNotIn('id',[Auth::id()])->get();
    return datatables()->of($data)->addColumn('action', function($row){
          $btn = '<a href="'.route('lecture.edit',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
          $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
          return $btn;
    })
    ->addColumn('phone_number', function($row){
      if ($row->phone_number == NULL) {
        return '-';
      } else {
        return $row->phone_number;
      }
    })
    ->rawColumns(['action'])
    ->make(true);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return view('lecturer.create');
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
        'name' => 'required',
        'username' => 'required|unique:users,username',
        'email' => 'required|unique:users,email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'picture' => 'max:2048|mimes:png,jpg,jpeg',
      ]
    );

    if(!empty($request->picture)){
      $file = $request->file('picture');
      $extension = strtolower($file->getClientOriginalExtension());
      $filename = uniqid() . '.' . $extension;
      \Storage::put('public/images/user/' . $filename, \File::get($file));
    } else {
      $filename = 'avatar.png';
    }

    DB::beginTransaction();
    $user = new User();
    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = \Hash::make($request->password);
    $user->picture = $filename;
    $user->school_id = Auth::user()->school_id;
    $user->phone_number = $request->phone_number;
    $user->save();
    $user->roles()->sync(3);
    Lecture::create([
       'user_id' => $user->id,
    ]);
    DB::commit();
    return redirect()->route('lecture.index');
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
    $data = User::find($id);
    $role = Role::all();
    return view('lecturer.edit',compact('data','role'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $this->validate(request(),
      [
        'name' => 'required',
        'username' => 'required|unique:users,username,'.$id,
        'email' => 'required|unique:users,email,'.$id,
        'password' => 'confirmed',
        'picture' => 'max:2048|mimes:png,jpg,jpeg',
      ]
    );

    $user = User::find($id);

    if(!empty($request->picture)){
      $file = $request->file('picture');
      $extension = strtolower($file->getClientOriginalExtension());
      $filename = uniqid() . '.' . $extension;
      \Storage::delete('public/images/user/' . $user->picture);
      \Storage::put('public/images/user/' . $filename, \File::get($file));
    } else {
      $filename = $user->picture;
    }

    $user->name = $request->name;
    $user->username = $request->username;
    $user->email = $request->email;
    if ($request->password) {
      $user->password = \Hash::make($request->password);
    }
    $user->picture = $filename;
    $user->phone_number = $request->phone_number;
    $user->save();
    return redirect()->route('lecture.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $user = User::find($id);
    \Storage::delete('public/images/user/'.$user->picture);
    $user->delete();

    return response()->json(['data'=>'success delete data']);
  }

}

?>
