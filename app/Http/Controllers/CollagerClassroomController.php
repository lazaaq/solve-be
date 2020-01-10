<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\CollagerClassroom;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;

class CollagerClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($id)
    {
       $data = CollagerClassroom::where('classroom_id',$id)->with('collager.user')->get()->sortBy('name');

       return datatables()->of($data)
         ->addColumn('action', function($row){
           $btn = '<button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
           return $btn;
       })
       ->rawColumns(['action'])
       ->make(true);
    }
    public function getDataAdd()
    {
       // $data = User::get()->sortBy('name');
       $data = User::whereHas("roles", function($q) { $q->where("name", 'student'); })
                    ->where('school_id',Auth::user()->school_id)
                    ->get();

       return datatables()->of($data)
         ->addColumn('action', function($row){
           $checkbox = '<div class="checkbox"><label><input type="checkbox" class="styled"></label></div>';
           return $checkbox;
       })
       ->rawColumns(['action'])
       ->make(true);
    }
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CollagerClassroom  $collagerClassroom
     * @return \Illuminate\Http\Response
     */
    public function show(CollagerClassroom $collagerClassroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CollagerClassroom  $collagerClassroom
     * @return \Illuminate\Http\Response
     */
    public function edit(CollagerClassroom $collagerClassroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CollagerClassroom  $collagerClassroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CollagerClassroom $collagerClassroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CollagerClassroom  $collagerClassroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(CollagerClassroom $collagerClassroom)
    {
        //
    }
}
