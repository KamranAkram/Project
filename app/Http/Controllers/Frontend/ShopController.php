<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(){
        $data['products'] = Product::orderBy('id','ASC')->get();
        return view('frontend.shop')->with($data);
    }

    // public function singleProduct($id){
    //     $data['products'] = Product::find($id);
    //     // $data['all_products'] = Product::all();
    //     // $data['categories'] = Category::all();
    //     // $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
    //     //                     ->orderBy('sub_categories.id')
    //     //                     ->leftJoin('categories' , 'categories.id' , 'sub_categories.cat_id');
    //     $data['products'] = DB::table('products')
    //                     ->select('products.*' , 'categories.name as categoryName' , 'sub_categories.name as subCatName' , 'brands.name as brandName')
    //                     ->leftJoin('categories' , 'categories.id' , 'products.cat_id')
    //                     ->leftJoin('sub_categories' , 'sub_categories.id' , 'products.sub_cat_id')
    //                     ->leftJoin('brands' , 'brands.id' , 'products.brand_id')
    //                     ->get();
    //     return view('frontend.shop-details')->with($data);
    // }

    public function product($id, $slug)
    {
        $data['product'] = Product::where('id', $id)
            ->where('slug', $slug)
            ->first(); 
    
        $data['products'] = Product::all();
    
        return view('frontend.shop-details')->with($data);
    }
    
}
