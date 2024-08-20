<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Nette\Utils\Image;

use function Pest\Laravel\json;

class TempImagesController extends Controller
{
    public function create(Request $request){
        $image = $request->image;


        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $file = time() . '.' . $ext;

            $tempImage = new TempImage;
            $tempImage->image = $file;
            $tempImage->save();

            $image->move(public_path(). '/temp' , $file);

            $sourcePath = public_path(). ' /temp/ '. $file;
            $image = Image::make($sourcePath);
            $image->fit(300,300);



            return response()->json([
                "status" => true,
                "image_id" => $tempImage->id,
                "message" =>"Image Uploaded Successfully"
            ]);
        }
    }
}