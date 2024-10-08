<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
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
        return view('admin.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        $category = new Category;

        $category->name = $request['name'];
        $category->slug = $request['slug'];
        $category->save();

        return redirect('/admin/add-category');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = Category::orderBy('id')->paginate(10);
        return view('admin.category' , compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['category'] = Category::find($id);
        return view('admin.update-category')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        $category = Category::find($id);

        $category->name = $request['name'];
        $category->slug = $request['slug'];
        $category->save();

        return redirect('/admin/add-category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $value = Category::find($id);
        if(!is_null($value)){
            $value->delete();
        }
        return redirect('/admin/show-category');
    }
}