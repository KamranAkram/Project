<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

use function PHPUnit\Framework\isNull;

class BlogController extends Controller
{
    public function index(){
        return view('frontend.blog');
    }

    public function write(){
        return view('admin.write-blog');
    }

    public function show(){
        $data['blogs'] = Blog::all();
        return view('admin.blog')->with($data);
    }


    public function store(Request $request){
            $request->validate(
                [
                "image" => "required",
                "topic" => "required",
                "post" => "required",
                "author" => "required",
            ]
        );

        $New_File = time() . "blog." . $request->file('image')->getClientOriginalExtension();
        $save =  $request->file('image')->storeAs('public/blog_images', $New_File);

        $blog = new Blog;

        $blog->image = $New_File;
        $blog->topic = $request['topic'];
        $blog->post  = $request['post'];
        $blog->author = $request['author'];
        $blog->writtendate = $request['writtendate'];
        $blog->save();

        return redirect('/admin/write-blog');

    }


    public function edit($id){
        $data['blog'] = Blog::find($id);
        return view('admin.update-blog')->with($data);
    }


    public function update(Request $request , $id){
        $request->validate(
            [
            "image" => "required",
            "topic" => "required",
            "post" => "required",
            "author" => "required",
        ]);

        $New_File = time() . "blog." . $request->file('image')->getClientOriginalExtension();
        $save =  $request->file('image')->storeAs('public/blog_images', $New_File);

        $blog = Blog::find($id);

        $blog->image = $New_File;
        $blog->topic = $request['topic'];
        $blog->post  = $request['post'];
        $blog->author = $request['author'];
        $blog->writtendate = $request['writtendate'];
        $blog->save();

        return redirect('/admin/show-blog');

    }

    public function destroy($id){
        $value = Blog::find($id);

        if(!is_null($value)){
            $value->delete();
        }

        return redirect('/admin/show-blog');
    }
}