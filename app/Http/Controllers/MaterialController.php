<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function api_index() {
        //
    }

    public function api_show($quiz_type_id) {
        $materials = Material::with('media', 'module')->where('quiz_type_id', $quiz_type_id)->get();
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => $materials
        ]);
    }
    
    public function api_store(Request $request) {
        //
    }

    public function api_update(Request $request, $id) {
        //
    }

    public function api_destroy($id) {
        //
    }
}
