<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        return view('admin.add-brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        $brand = new Brand;

        $brand->name = $request['name'];
        $brand->slug = $request['slug'];
        $brand->save();

        return redirect('/admin/add-brand');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $brands = Brand::orderBy('id')->paginate(10);
        return view('admin.brand' , compact('brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['brand'] = Brand::find($id);
        return view('admin.update-brand')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        $brand = Brand::find($id);

        $brand->name = $request['name'];
        $brand->slug = $request['slug'];
        $brand->save();

        return redirect('/admin/show-brand');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $value = Brand::find($id);
        if(!is_null($value)){
            $value->delete();
        }
        return redirect('/admin/show-brand');
    }
}