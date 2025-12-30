<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $tours = Tour::with('category')->orderBy('id')->get();
        return view('admin.tour.index', compact('tours'));
    }
    public function create()
    {
        $categories = TourCategory::all()->sortByDesc('id');
        return view('admin.tour.create', compact('categories'));
    }
    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        $categories = TourCategory::all();
        return view('admin.tour.edit', compact('tour','categories'));
    }
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('featured_image')) {

            $imageFile = $request->file('featured_image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/tours');

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/tours/' . $imageName;
        }


        Tour::create([
            'title' => $request->title ?? '',
            'featured_image' => $imagePath,
            'slug' => $request->slug,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'category_id' => $request->category_id,
            'discount_price' => $request->discount_price,
            'price' => $request->price,
            'duration' => $request->duration,
            'location' => $request->location,
            'featured' => $request->featured,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Tour created successfully.');
    }
    public function update(Request $request,$id)
    {
        $tour = Tour::findOrFail($id);
        $imagePath = null;

        /* ============== FEATURED IMAGE ============== */
        if ($request->hasFile('featured_image')) {

            // Delete old image if exists
            if (!empty($tour->featured_image)) {
                $oldImagePath = public_path($tour->featured_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageFile = $request->file('featured_image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/tours');

            // Create folder if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image to public/images/tours
            $imageFile->move($imageDir, $imageName);

            // Save relative path (for DB)
            $imagePath = 'images/tours/' . $imageName;

        } else {
            // Keep old image
            $imagePath = $request->old_featured_image;
        }

        $tour->title = $request->title ?? '';
        $tour->featured_image = $imagePath;
        $tour->slug = $request->slug;
        $tour->meta_keywords = $request->meta_keywords;
        $tour->meta_description = $request->meta_description;
        $tour->description = $request->description;
        $tour->short_description = $request->short_description;
        $tour->category_id = $request->category_id;
        $tour->discount_price = $request->discount_price;
        $tour->price = $request->price;
        $tour->duration = $request->duration;
        $tour->location = $request->location;
        $tour->featured = $request->featured;
        $tour->status = $request->status;

        $tour->save();
        return redirect()->back()->with('success', 'Tour update successfully.');
    }
      public function delete($id)
    {
        $category = Tour::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Tour delete successfully.');
    }
    public function toggleStatus(Request $request)
    {
        $tour = Tour::find($request->id);

        if (!$tour) {
            return response()->json(['success' => false]);
        }

        // Cycle status: active → inactive → draft → active...
        $statusCycle = [
            'active' => 'inactive',
            'inactive' => 'draft',
            'draft' => 'active'
        ];

        $tour->status = $statusCycle[$tour->status];
        $tour->save();

        return response()->json([
            'success' => true,
            'status' => $tour->status
        ]);
    }
   public function toggleFeatured(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $tour->featured = $tour->featured == 1 ? 0 : 1;
        $tour->save();

        return response()->json([
            'status'   => true,
            'featured' => $tour->featured
        ]);
    }
}
