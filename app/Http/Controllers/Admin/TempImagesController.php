<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
// use Intervention\Image\Image;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\Laravel\Facades\Image;
// config/packages/intervention_image.yaml

// use function Pest\Laravel\json;

class TempImagesController extends Controller
{
    public function create(Request $request){
        $image = $request->image;


        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $file = time() . '.' . $ext;

            $tempImage = new TempImage;
            $tempImage->name = $file;
            $tempImage->save();

            $image->move(public_path(). '/temp' , $file);

            // Generating Thumbnail
            $sourcePath = public_path(). ' /temp/ '. $file;
            $destPath = public_path(). ' /temp/thumb/ '. $file;
            // $image = Image::make($sourcePath);
            $image->resize(300,275);
            $image->save($destPath);



            return response()->json([
                "status" => true,
                "image_id" => $tempImage->id,
                "ImagePath" => asset('/temp/thumb/'. $file),
                "message" =>"Image Uploaded Successfully"
            ]);
        }
    }
}