<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
//    public function addImage(ImageRequest $request){
    public function addImage(Request $request){
        if ($request->hasFile('imageContenu'))
        {
            return "file present";
        }
        else{
            return "file not present";
        }

        return 1;
    }
}
