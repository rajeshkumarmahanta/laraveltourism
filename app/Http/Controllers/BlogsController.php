<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Pages;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    //
    public function blogs(){
        $blogs_page = Pages::where('name','Blogs')->first();
        $blogs = Blog::where('status', 1)->paginate(9);
        return view('blogs',compact('blogs','blogs_page'));
    }
    public function blogDetails($slug){
        $blog = Blog::where('slug',$slug)->first();
        return view("blogDetails",compact('blog'));
    }
}
