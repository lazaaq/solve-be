<?php

namespace App\Http\Controllers;
use App\MaterialModule;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;

use Symfony\Component\HttpFoundation\StreamedResponse;


class MaterialInfoController extends Controller
{

  

    public function getFileMateri($material_id) {
        if (Auth::user()->hasRole('admin')) {
            $data = MaterialModule::where('material_id', $material_id)->get();
        }
        $data = MaterialModule::where('material_id', $material_id)->get();
        return datatables()->of($data)
        ->addColumn('action', function($row){
          $btn = '<a href="'.route('material.show',$row->id).'" title="View" class="btn border-success btn-xs text-success-600 btn-flat btn-icon"><i class="glyphicon glyphicon-eye-open"></i></a>';
          $btn = $btn.'  <a id="btn-edit" class="btn border-info btn-xs text-info-600 btn-flat btn-icon"><i class="icon-pencil6"></i></a>';
          $btn = $btn.'  <button id="delete" class="btn border-warning btn-xs text-warning-600 btn-flat btn-icon"><i class="icon-trash"></i></button>';
          return $btn;
        })
        ->editColumn('updated_at', function ($row) {
            return Carbon::parse($row->updated_at)->format('Y-m-d H:i:s');  // Mengubah format waktu
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    public function storeFileMateri(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'file_materi' => 'required|mimes:pdf|max:10240',  // Maksimal ukuran 10MB
        ]);

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        // Simpan data ke database
        try {
            $file = $request->file('file_materi');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = 'public/materials/' .$fileName;
            $file->storeAs($filePath);  // Simpan file ke direktori storage/app/public/materials

            $materialModule = new MaterialModule;
            $materialModule->name = $request->name;
            $materialModule->description = $request->description;
            $materialModule->material_id = $request->material_id;
            $materialModule->file_url = $fileName;
            $materialModule->save();

            return response()->json(['success'=>'Data added successfully','data'=>$materialModule],201);


        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan, kembalikan pesan error
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
            ], 500);
        }
    }





    public function destroyFileMateri($id) {
        $materialModule = MaterialModule::findOrFail($id);
        $materialModule->delete();
        return response()->json(['success'=>'Data deleted successfully'],204);
    }

    public function editFileMateri(Request $request, $id)
    {
        // Mencari data materi berdasarkan ID
        $materialModule = MaterialModule::find($id);
        if (!$materialModule) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'material_id' => 'required|integer',
            'file_url' => 'nullable|mimes:pdf|max:10240', // Max 10 MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Mengupdate data
        if ($request->hasFile('file_materi')) {
            // Simpan file baru dan hapus file lama jika ada
            $file = $request->file('file_materi');
            $filePath = $file->storeAs('materials', $file->getClientOriginalName());

            // Hapus file lama
            if ($materialModule->file_path) {
                Storage::delete($materialModule->file_path);
            }

            $materialModule->file_path = $filePath;
        }

        $materialModule->name = $request->name;
        $materialModule->description = $request->description;
        $materialModule->material_id = $request->material_id;
        
        $materialModule->save();

        return response()->json(['message' => 'Material updated successfully']);
    }
    
    public function api_showFileMateri($material_id) {
        $data = [];
        $data = MaterialModule::where('material_id', $material_id)->get();
        return responseAPI(200, true, $data);
     }

     public function api_DetailFileMateri($id) {
        $data = MaterialModule::where('id', $id)->get();
        return responseAPI(200, true, $data);
     }


     public function loadFileMateri($filename)
     {
         $path = 'materials/' . $filename;
     
         if (!Storage::disk('public')->exists($path)) {
             abort(404);
         }
     
         $file = Storage::disk('public')->get($path);
         $type = Storage::disk('public')->mimeType($path);
     
         $response = new StreamedResponse(function () use ($file) {
             echo $file;
         });
     
         $response->headers->set('Content-Type', $type);
     
         return $response;
     }
 }


