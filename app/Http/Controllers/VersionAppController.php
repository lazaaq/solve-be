<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VersionApp;
use Validator;

class VersionAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('version.index');
    }

    public function getData()
    {
      $data = VersionApp::all()->sortBy('version');
      return datatables()->of($data)
      ->addColumn('action', function($row){
          // $btn = '<a href="'.route('banner.show',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
          $btn = '<a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
          $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
          // $btn = $btn.'  <a href="'.route('banner.destroy',$row->id).'" title="Delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
          return $btn;
      })
      ->rawColumns(['action'])
      ->make(true);
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
        'version' => 'required',
        'sub_version' => 'required',
        'year' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }else{
         $data = VersionApp::create(
           [
             'version'=>request('version'),
             'sub_version'=>request('sub_version'),
             'year'=>request('year'),
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
        $data = VersionApp::find($id);
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
      //return $request->description_edit;
      $data= VersionApp::find($id);
      $rules = [
        'version_edit' => 'required',
        'sub_version_edit' => 'required',
        'year_edit' => 'required',
      ];
      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }
      $data->version=$request->version_edit;
      $data->sub_version=$request->sub_version_edit;
      $data->year=$request->year_edit;
      $data->save();
      return response()->json(['success'=>'Data updated successfully','data'=>$data]);
      // return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = VersionApp::find($id);
      $data->delete();
    }
}
