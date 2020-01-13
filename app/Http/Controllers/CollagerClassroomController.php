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
           $btn = '<a id="btn-detail" href="'.route('history.show',$row->collager->user->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-eye"></i></a>';
           $btn = $btn.' <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
           return $btn;
       })
       ->rawColumns(['action'])
       ->make(true);
    }
    public function getDataAdd($lecture_user_id, $class_id)
    {
       $checking = [];
       foreach (CollagerClassroom::where('classroom_id', $class_id)->get() as $key => $value) {
         $checking[] = $value->collager_id;
       }

       if (Auth::user()->hasRole('teacher')) {
         $data = User::whereHas("roles", function($q) { $q->where("name", 'student'); })
                     ->whereHas('collager', function($q) use ($checking) { $q->whereNotIn('id',$checking); })
                     ->where('school_id',Auth::user()->school_id)
                     ->get();
       } else {
         $lecture = User::where('id',$lecture_user_id)->first();
         if ($lecture->lecture) {
           $data = User::whereHas("roles", function($q) { $q->where("name", 'student'); })
                       ->whereHas('collager', function($q) use ($checking) { $q->whereNotIn('id',$checking); })
                       ->where('school_id',$lecture->school_id)
                       ->get();
         } else {
           $data = User::whereHas("roles", function($q) { $q->where("name", 'student'); })
                       ->whereHas('collager', function($q) use ($checking) { $q->whereNotIn('id',$checking); })
                       ->get();
         }
       }

       return datatables()->of($data)
         ->addColumn('action', function($row){
           $checkbox = '<div class="checkbox"><label><input name="student['.$row->id.']" value="'.$row->id.'" type="checkbox" class="styled"></label></div>';
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
      if (!empty($request->student)) {
        foreach ($request->student as $value) {
          $data = new CollagerClassroom;
          $data->collager_id = User::find($value)->collager->id;
          $data->classroom_id = $request->classrom_id;
          $data->save();
        }
        return response()->json(['success'=>'Data added successfully']);
      }
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
    public function destroy($id)
    {
      $data = CollagerClassroom::find($id)->delete();
    }
    public function resetClass($id)
    {
      $data = CollagerClassroom::where('classroom_id',$id)->delete();
    }
}
