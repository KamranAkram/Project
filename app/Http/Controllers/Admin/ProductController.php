<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
// use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('id','ASC')->get();
        $data['sub_categories'] = SubCategory::orderBy('id','ASC')->get();
        $data['brands'] = Brand::orderBy('id','ASC')->get();
        $data['attributes'] = Attribute::orderBy('id','ASC')->get();
        $data['att_values'] = AttributeValue::orderBy('id','ASC')->get();
        return view('admin.addProduct')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // @dd($request->all());
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'images' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'cat_id' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',

        ];

        if(!empty($request->track_qty) && $request->track_qty == 'Yes'){
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()){
            $product = new Product;

            // $image = array();
            // if($files = $request->file('images')){
            //     foreach($files as $file){
            //         $ext = time() . "product." . $file->getClientOriginalExtension();
            //         $upload_path = 'product_images/';
            //         $image_url = $upload_path.$ext;
            //         $file->move($upload_path,$ext);
            //         $images[] = $image_url;
            //     }
            // }
            // $product->image = implode('|' , $images);
            $product->title = $request['title'];
            $product->slug = $request['slug'];
            $product->description = $request['description'];
            $product->price = $request['price'];
            $product->compare_price = $request['compare_price'];
            $product->sku = $request['sku'];
            $product->track_qty = $request['track_qty'];
            $product->qty = $request['qty'];
            $product->status = $request['status'];
            $product->cat_id = $request['cat_id'];
            $product->sub_cat_id = $request['sub_cat_id'];
            $product->brand_id = $request['brand_id'];
            $product->is_featured = $request['is_featured'];
            $product->save();
            $product->values()->attach($request->value_id);
            $product->attributes()->attach($request->attribute_id);
            // Product::insert([
            //     'image'=> implode('|' , $images),
            //     'title' => $request->title,
            //     'slug' => $request->slug,
            //     'description' => $request->description,
            //     'price' => $request->price,
            //     'compare_price' => $request->compare_price,
            //     'sku' => $request->sku,
            //     'track_qty' => $request->track_qty,
            //     'qty' => $request->qty,
            //     'status' => $request->status,
            //     'cat_id' => $request->cat_id,
            //     'sub_cat_id' => $request->sub_cat_id,
            //     'brand_id' => $request->brand_id,
            //     'is_featured' => $request->is_featured,
            // ]);


            return response()->json([
                'status' => true,
                'message' => 'Product Added Successfully',
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        return redirect('/admin/add-product');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $products = Product::select('products.*' , 'categories.name as categoryName' , 'sub_categories.name as subCatName' , 'brands.name as brandName')
                        ->leftJoin('categories' , 'categories.id' , 'products.cat_id')
                        ->leftJoin('sub_categories' , 'sub_categories.id' , 'products.sub_cat_id')
                        ->leftJoin('brands' , 'brands.id' , 'products.brand_id');
        $products = $products->paginate(10);
        return view('admin.product' , compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        $data['categories'] = Category::orderBy('id','ASC')->get();
        $data['sub_categories'] = SubCategory::orderBy('id','ASC')->get();
        $data['brands'] = Brand::orderBy('id','ASC')->get();
        $data['attributes'] = Attribute::orderBy('id','ASC')->get();
        $data['att_values'] = AttributeValue::orderBy('id','ASC')->get();
        return view('admin.update-product')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'cat_id' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',

        ];

        if(!empty($request->track_qty) && $request->track_qty == 'Yes'){
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()){
            $product = Product::find($id);

            $product->title = $request['title'];
            $product->slug = $request['slug'];
            $product->description = $request['description'];
            $product->price = $request['price'];
            $product->compare_price = $request['compare_price'];
            $product->sku = $request['sku'];
            $product->track_qty = $request['track_qty'];
            $product->qty = $request['qty'];
            $product->status = $request['status'];
            $product->cat_id = $request['cat_id'];
            $product->sub_cat_id = $request['sub_cat_id'];
            $product->brand_id = $request['brand_id'];
            $product->is_featured = $request['is_featured'];
            $product->save();

            // $request->session()->flash('success', 'Product Added Successfully');


            return response()->json([
                'status' => true,
                'message' => 'Product Added Successfully',
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        return redirect('/admin/add-product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $value = Product::find($id);
        if(!is_null($value)){
            $value->delete();
        }
        return redirect('/admin/show-product');
    }
}
