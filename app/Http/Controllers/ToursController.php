<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Tour;
use App\Models\TourCategory;
use Illuminate\Http\Request;

class ToursController extends Controller
{
    //
    public function tours(){
        $tours_page = Pages::where('name','tours')->first();
        $tours = Tour::with('category')->where('status', 'active')->paginate(9);  
        return view("tours",compact('tours','tours_page'));
    }
    public function tourDetails($slug){
        $tour = Tour::with('category')->where('slug',$slug)->first();
        $similarTours = Tour::where('category_id', $tour->category_id)
        ->where('id', '!=', $tour->id)
        ->limit(4)
        ->get();
        return view("tourDetails",compact('tour','similarTours'));
    }
    public function search(Request $request)
    {
        $tours_page = Pages::where('name','tours')->first();
        $query = Tour::with('category')
            ->where('status', 'active'); // only active tours

        // Search by location
        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        // Search by tour title
        if ($request->filled('tour')) {
            $query->where('title', 'LIKE', '%' . $request->tour . '%');
        }
        if ($request->filled('tour')) {
            $query->orWhere('description', 'LIKE', '%' . $request->tour . '%');
        }

        $tours = $query->latest()->paginate(9)->withQueryString();

        return view('tours', compact('tours','tours_page'));
    }
    public function tourCategory($slug)
    {
        $tours_page = Pages::where('name','tours')->first();

        // Find category by slug
        $category = TourCategory::where('slug', $slug)->firstOrFail();

        // Get multiple tours with pagination
        $tours = Tour::where('category_id', $category->id)
                        ->orderBy('id', 'DESC')
                        ->paginate(9); // 9 per page (change as needed)

        return view('tours', compact('tours','tours_page','category'));
    }
}
