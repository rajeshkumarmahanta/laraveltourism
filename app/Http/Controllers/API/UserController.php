<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Pages;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function users(){
        $users = User::all();
        return response()->json($users);
    }
    public function pages(){
        $pages = Pages::all();
        return response()->json($pages);
    }
    public function tours(){
        $tours = Tour::all();
        return response()->json($tours);
    }
    public function blogs(){
        $blogs = Blog::all();
        return response()->json($blogs);
    }
}
