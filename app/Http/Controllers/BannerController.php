<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use File;
use App\Banner;
use Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
     $data = Banner::all();
     return datatables()->of($data)
        ->addColumn('action', function($row){
            // $btn = '<a href="'.route('banner.show',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
            $btn = '<a href="'.route('banner.edit',$row->id).'" title="Edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
            $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
            // $btn = $btn.'  <a href="'.route('banner.destroy',$row->id).'" title="Delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></a>';
            return $btn;
        })
        ->addColumn('isViewed', function($row){
            if ($row->isView == '1') {
              $btn = '<button id="change-is-view" title="Change to invisible view" class="btn border-success btn-xs text-success btn-flat btn-icon"><i class="fa fa-toggle-on"></i></button>';
            }else {
              $btn = '<button id="change-is-view" title="Change to visible" class="btn border-default btn-xs text-default btn-flat btn-icon"><i class="fa fa-toggle-off"></i></button>';
            }
            return $btn;
        })
        ->addColumn('pictures', function($row){
          $row->picture = route('banner.picture',$row->id);
          $picture = '<img class="img-responsive" src="'.route('banner.picture',$row->id).'" alt="Banner" title="Banner" width="100%">';
          return $picture;
        })
        ->rawColumns(['action','pictures','isViewed'])
        ->make(true);
    }
    public function index()
    {
        return view('banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request;
      $rules = [
        'description' => 'required|max:191',
        'picture' => 'required|max:2048|mimes:png,jpg,jpeg',
        'link_to' => 'unique:banners,linkTo|required|max:191',
        'is_view' => 'required',
      ];

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()->all()]);
      }else{
        if(!empty($request->picture)){
             $file = $request->file('picture');
             $extension = strtolower($file->getClientOriginalExtension());
             $filename = uniqid() . '.' . $extension;
             Storage::put('public/images/banner/' . $filename, File::get($file));
           }else{
             $filename='';
           }

         $data = Banner::create(
           [
                 'description'=>request('description'),
                 'picture'=>$filename,
                 'linkTo' => request('link_to'),
                 'isView' => request('is_view'),
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
        $data=Banner::find($id);
        return view('banner.edit', compact('data'));
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
       $data= Banner::find($id);
       $this->validate(request(),
         [
           'description' => 'required|max:191',
           'picture' => 'max:2048|mimes:png,jpg,jpeg',
           'link_to' => 'required|max:191',
           'is_view' => 'required',
         ]
       );
       if(!empty($request->picture)){
            $file = $request->file('picture');
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = uniqid() . '.' . $extension;
            Storage::delete('public/images/banner/' . $data->picture);
            Storage::put('public/images/banner/' . $filename, File::get($file));
       }else{
            $filename=$data->picture;
       }
       $data->description=$request->description;
       $data->linkTo=$request->link_to;
       $data->isView=$request->is_view;
       $data->picture=$filename;
       $data->save();
       return redirect()->route('banner.index');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $data = Banner::find($id);
       Storage::delete('public/images/banner/'.$data->picture);
       $data->delete();
     }

     public function changeIsView($id)
     {
       $data = Banner::find($id);
       if ($data->isView == '1') {
         $data->isView = '0';
       }else {
         $data->isView = '1';
       }
       $data->save();
       return redirect()->route('banner.index');
     }

    public function picture($id)
    {
      $data = Banner::find($id);
      return Image::make(Storage::get('public/images/banner/'.$data->picture))->response();
    }

    /*START OF API*/

    public function api_index(){
      $data = Banner::where('isView', '1')->get();
      return response()->json([
        'status'=>'success',
        'result'=>$data
      ]);
    }
}
