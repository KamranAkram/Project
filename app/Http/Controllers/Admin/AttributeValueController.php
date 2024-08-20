<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Attribute;

class AttributeValueController extends Controller
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
        $data['attributes'] = Attribute::orderBy('id','ASC')->get();
        return view('admin.add-att_value')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "attribute_id" => "required",
            "value" => "required",
        ]);

        $att_value = new AttributeValue;

        $att_value->attribute_id = $request['attribute_id'];
        $att_value->value = $request['value'];
        $att_value->save();

        return redirect('/admin/add-att-value');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $att_values = AttributeValue::select('attribute_values.*', 'attributes.name')
                            ->orderBy('attribute_values.id')
                            ->leftJoin('attributes' , 'attributes.id' , 'attribute_values.attribute_id');

        $att_values = $att_values->paginate(10);
        return view('admin.att-value' , compact('att_values'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
