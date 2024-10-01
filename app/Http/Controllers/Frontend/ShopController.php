<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null , $subCategorySlug = null){
        // $products=Product::orderBy('id' , 'DESC')->where('status' , 1)->get();
        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        $products = Product::where('status' , 1)->with('product_image');
        $categories = Category::orderBy('id','ASC')->with('subcategories')->get();
        $brands = Brand::orderBy('id','ASC')->get();



        //Applying Filters
        if (!empty($categorySlug)) {
            $category = Category::where('slug' , $categorySlug)->first();
            $products = $products->where('cat_id', $category->id );
            $categorySelected = $category->id;
        }

        if (!empty($subCategorySlug)) {
            $subCategory = SubCategory::where('slug' , $subCategorySlug)->first();
            $products = $products->where('sub_cat_id', $subCategory->id );
            $subCategorySelected = $subCategory->id;
        }

        if(!empty($request->get('brand'))){
            $brandsArray = explode(',' , $request->get('brand'));
            $products = $products->whereIn('brand_id' , $brandsArray);
        }

        if($request->get('price_max') != '' && $request->get('price_min') != ''){
            if($request->get('price_max') == 1000){
                $products = $products->whereBetween('price' , [intval($request->get('price_min')) , 1000000]);
            }else{
            $products = $products->whereBetween('price' , [intval($request->get('price_min')) , intval($request->get('price_max'))]);
            }
        }

        if($request->get('sort') != ''){
            if($request->get('sort') == 'latest'){
                $products = $products->orderBy('id' , 'DESC');
            }elseif($request->get('sort') == 'price_asc'){
                $products = $products->orderBy('price' , 'ASC');
            }else{
                $products = $products->orderBy('price' , 'DESC');
            }
        }else{
            $products = $products->orderBy('id' , 'DESC');
        }
        $products = $products->where('status' , 1)->get();

        $data['products'] = $products;
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['sort'] = $request->get('sort');
        return view('frontend.shop')->with($data);
    }

    // public function show($id) {
    //     $user=User::findOrFail($id);
    //     $employee = $user->employees->first();

    //     return view('admin.profile')
    //             ->with(['employee' => $employee , 'user' => $user]);
    // }

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

    public function product(Request $request, $id, $slug)
    {
        $data['product'] = Product::where('id', $id)
            ->where('slug', $slug)
            ->first();

        // $data['products'] = Product::all();
        $data['products'] = Product::orderBy('id' , 'DESC')->with('product_image')->where('status' , 1)->get();
        $data['images'] = ProductImage::where('product_id' , $id)->get();
        $data['priceMax'] = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        return view('frontend.shop-details')->with($data);
    }

}


// https://skillstofreedom.lpages.co/live-streaming/
// Whatsapp Group
// https://chat.whatsapp.com/G2as2gPjPBJGGU29T2Wrxu