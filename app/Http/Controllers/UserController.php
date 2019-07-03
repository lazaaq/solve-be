<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Datatables;
 
class UserController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return view('user.index');
  }

  public function getData()
  {
    $data = User::orderBy('name')->get();
    return datatables()->of($data)->addColumn('action', function($row){
          $btn = '<a href="'.route('user.edit',$row->id).'" class="btn btn-primary btn-sm">Edit</a>';
          $btn = $btn.'  <a href="'.route('user.destroy',$row->id).'" class="btn btn-danger btn-sm">Delete</a>';
          return $btn;
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
    return view('user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

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
    return view('user.edit');
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


  /*START OF API*/

   public function api_collagerRegister(Request $request)
   {
     $request->validate([
       'email' => 'required|string|email|unique:users|max:50',
       'username' => 'required|unique:users|max:20',
       'password' => 'required|string|max:191',
       'name' => 'required|max:50',
     ]);
     $user = User::create([
       // 'id' => Carbon::now()->format('ymd').rand(1000,9999),
       'email'=>$request->email,
       'username'=>$request->username,
       'password'=>bcrypt($request->password),
       'name'=>$request->name,
     ])
      ->collager()->create([
        // 'id' => 'BY'.Carbon::now()->format('ymdH').rand(100,999),
     ]);

     $collager = User::where('id', $user->user_id)->with('collager')->first();
     return response()->json([
       'status'=>'success',
       'user'=>$collager
     ]);
   }

   public function api_collagerLogin(Request $request){
    if(Auth::attempt([
      'email' => request('email'),
      'password' => request('password'),
    ]))
    {
        $user = Auth::user();
        $email = $request->get('email');
        $password = $request->get('password');

        $success['token'] =  $user->createToken('MyApp')-> accessToken;
        $success['email'] = $email;
        $success['password'] = $password;

        $collager = User::where('email', $success['email'])->with('collager')->first();
        $collager->token = $success['token'];
        // $collager->foto= asset('images/'.$collager->foto.'');

        return response()->json([
            'status'=>'success',
            'user' => $collager
        ]);
    }
    else{
        $success['status'] = 'failed';
        $success['error'] = 'Unauthorised';
        $success['message'] = 'Your email or password incorrect!';
        return response()->json($success,401);
    }
  }

}

?>
