<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class SubCategoryController extends Controller
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
        $data['categories'] = Category::all();
        return view('admin.add-subcategory')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
        ]);

        $subCategory = new SubCategory;

        $subCategory->cat_id = $request['cat_id'];
        $subCategory->name = $request['name'];
        $subCategory->slug = $request['slug'];
        $subCategory->save();

        return redirect('/admin/add-sub-cat');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
                            ->orderBy('sub_categories.id')
                            ->leftJoin('categories' , 'categories.id' , 'sub_categories.cat_id');

        $subCategories = $subCategories->paginate(10);
        return view('admin.subcategory' , compact('subCategories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['subcategory'] = SubCategory::find($id);
        $data['categories'] = Category::all();
        return view('admin.update-subcat')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cat_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
        ]);

        $subCategory = SubCategory::find($id);

        $subCategory->cat_id = $request['cat_id'];
        $subCategory->name = $request['name'];
        $subCategory->slug = $request['slug'];
        $subCategory->save();

        return redirect('/admin/add-sub-cat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $value = SubCategory::find($id);
        if(!is_null($value)){
            $value->delete();
        }
        return redirect('/admin/show-subcat');
    }
}