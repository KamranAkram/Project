<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        return view('admin.add-product-image' , compact('product'));
    }

    public function store(Request $request , $id){
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        $product = Product::find($id);
        $images = [];
        if($files = $request->file('images')){
            foreach($files as $key => $file){
                $ext = $file->getClientOriginalExtension();
                $filename = $key. '-' .time() . '.' . $ext;
                $upload_path = 'uploads/products/';
                // $image_url = $upload_path.$ext;
                $file->move($upload_path,$filename);
                $images[] = [
                    'product_id' => $product->id,
                    'image' => $upload_path.$filename,
                ];
            }
        }

        ProductImage::insert($images);

        return redirect()->back()->with('status', 'Uploaded Successfully');
    }
}
