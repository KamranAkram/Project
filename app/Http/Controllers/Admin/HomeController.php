<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }

    public function country(){
        return view('admin.add-country');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:countries',
        ]);

        $country = new Country;

        $country->name = $request['name'];
        $country->save();

        return redirect('/admin/add-country');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $countries = Country::orderBy('id')->paginate(10);
        return view('admin.country' , compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['country'] = Country::find($id);
        return view('admin.update-country')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $country = Country::find($id);

        $country->name = $request['name'];
        $country->save();

        return redirect('/admin/show-country');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $value = Country::find($id);
        if(!is_null($value)){
            $value->delete();
        }
        return redirect('/admin/show-country');
    }

}