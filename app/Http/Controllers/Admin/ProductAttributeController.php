<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index(Request $request){
        if(!empty($request->attribute_id))
        {
            $att_values = AttributeValue::where('attribute_id' , $request->attribute_id)
            ->orderBy('value' , 'ASC')
            ->get();

            return response()->json([
                'status' => true,
                'att_values' => $att_values,
            ]);
        }
        else
        {
            return response()->json([
                'status' => true,
                'att_values' => [],
            ]);
        }
    }
}
