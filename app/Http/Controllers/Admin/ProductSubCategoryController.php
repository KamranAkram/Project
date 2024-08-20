<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request){
        if(!empty($request->cat_id))
        {
            $sub_categories = SubCategory::where('cat_id' , $request->cat_id)
            ->orderBy('name' , 'ASC')
            ->get();

            return response()->json([
                'status' => true,
                'sub_categories' => $sub_categories,
            ]);
        }
        else
        {
            return response()->json([
                'status' => true,
                'sub_categories' => [],
            ]);
        }
    }
}
