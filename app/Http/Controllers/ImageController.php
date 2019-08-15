<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ImageController extends Controller
{
    public function pictureUser($pictureName)
    {
        $user = User::where('picture',$pictureName)->first();
        return \Image::make(\Storage::get('public/images/user/'.$user->picture))->response();
    }
}
