<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use DataTables;
use Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('school.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
      $data = School::all();
      return datatables()->of($data)
      ->addColumn('action', function($row){
          $btn = '<a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
          $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
          return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    public function getSelect(Request $request)
    {
      $param  = $request->get('term');
      $data = School::select('id','name')->orWhere('name','like',"%$param%")->orWhere('address','like',"%$param%")->get()->sortBy('name');
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
        $data = School::find($id);
        return response()->json($data);
    }

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
            'name' => 'required',
            'address' => 'required',
          ];
    
          $validator = Validator::make($request->all(), $rules);
          if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
          }else{
             $data = School::create(
               [
                 'name'=>request('name'),
                 'address'=>request('address'),
               ]
             );
            return response()->json(['success'=>'Data added successfully','data'=>$data]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = School::find($id);
        return response()->json(['status' => 'ok','data'=>$data],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data= School::find($id);
        $rules = [
            'name_edit' => 'required',
            'address_edit' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $data->name=$request->name_edit;
        $data->address=$request->address_edit;
        $data->save();
        return response()->json(['success'=>'Data updated successfully','data'=>$data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = School::find($id);
        $data->delete();
    }
}
