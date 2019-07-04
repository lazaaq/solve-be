<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use DataTables;

class QuizController extends Controller
{

  public function getData()
  {
    $data = Quiz::orderBy('title')->get();
    return datatables()->of($data)->addColumn('action', function($row){
      $btn = '<a href="'.route('quiz.edit',$row->id).'" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
      $btn = $btn.'  <a href="'.route('quiz.destroy',$row->id).'" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
      return $btn;
    })
    ->rawColumns(['action'])
    ->addColumn('total_question', function($row){
      return $row->question->count();
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
    return view('quiz.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

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

}

?>
