<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
       if (!empty(Auth::user()->lecture)) {
         $data = Classroom::where('lecturer_id',Auth::user()->lecture->id)->with('lecture.user')->get()->sortBy('name');
       } else {
         $data = Classroom::with('lecture.user')->get()->sortBy('name');
       }
       return datatables()->of($data)
         ->addColumn('action', function($row){
           $btn = '<a id="detail" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="icon-eye"></i></a>';
           $btn = $btn.'  <a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
           $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
           return $btn;
       })
       ->rawColumns(['action'])
       ->make(true);
    }
    public function index()
    {
        return view('classroom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = [
        'name' => 'required|max:150|unique:classrooms',
        'code' => 'required|max:5',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }
      else{
        Classroom::create(
          [
                'name' => request('name'),
                'code'=> request('code'),
                // 'code'=> strtoupper(substr(md5(microtime()),rand(0,26),5)),
                'lecturer_id'=>Auth::user()->lecture->id
          ]
        );
        return response()->json(['success'=>'Data added successfully']);
        // return redirect(route('quizcategory.index'));
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Classroom::find($id);
      return response()->json(['status' => 'ok','data'=>$data],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data= Classroom::find($id);
      $rules = [
        'name_edit' => 'required|max:150|unique:quiz_categorys,name,'.$data->id.',id',
        'code_edit' => 'required|max:5',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }else{
        $data->name=$request->name_edit;
        $data->code=$request->code_edit;
        $data->save();
        return response()->json(['success'=>'Data updated successfully']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Classroom::find($id)->delete();
    }
}
