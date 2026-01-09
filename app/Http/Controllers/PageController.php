<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function page($slug){
        $page = Pages::where('slug',$slug)->first();
        if($slug=='contact'){
            return view('contact',compact('page'));
        }
        return view('page',compact('page'));
    }
}
