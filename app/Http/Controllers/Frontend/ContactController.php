<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contact = new Contact;
        //Insert Query
        $contact->name = $request['name'];
        $contact->email = $request['email'];
        $contact->message = $request['message'];
        $contact->save();

        return redirect('/contact');

    }

    public function show(){
        $data['contacts'] = Contact::all();
        return view('admin.show-contact')->with($data);
    }
}
