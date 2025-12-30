<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Pages;
use App\Models\Tour;
use App\Models\TourCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Pages::find(1);
        $featured_tour = Tour::where('status', 'active')
                        ->where('featured', 1)
                        ->take(4)
                        ->get();
        $blogs = Blog::where('status', 1)
                        ->get();
        $tour_categories = TourCategory::withCount('tours')->take(8)->get();

        return view('home',compact('page','featured_tour','tour_categories','blogs'));
    }
}
