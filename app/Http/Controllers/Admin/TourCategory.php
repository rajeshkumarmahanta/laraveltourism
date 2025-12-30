<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourCategory as ModelsTourCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourCategory extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = ModelsTourCategory::orderBy('id', 'desc')
        ->get();
        return view('admin.tour.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.tour.category.create');
    }
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/tour_category');

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image to public/images/tour_category
            $imageFile->move($imageDir, $imageName);

            // Save relative path (for DB)
            $imagePath = 'images/tour_category/' . $imageName;
        }

        ModelsTourCategory::create([
            'name' => $request->name ?? '',
            'image' => $imagePath,
            'slug'=>$request->slug,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Tour category created successfully.');
    }
    public function update(Request $request, $id)
    {
       $category = ModelsTourCategory::findOrFail($id);
       $imagePath = null;

/* ============== CATEGORY IMAGE ============== */
if ($request->hasFile('image')) {

            // Delete old image if exists
            if (!empty($category->image)) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/tour_category');

            // Create folder if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/tour_category/' . $imageName;

        } else {
            // Keep old image
            $imagePath = $request->old_image;
        }
        $category->name = $request->name ?? '';
        $category->image = $imagePath;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->save();
        return redirect()->back()->with('success', 'Tour category update successfully.');
    }
    public function edit(Request $request,$id)
    {
       $category = ModelsTourCategory::findOrFail($id);
        return view('admin.tour.category.edit', compact('category'));
    }
    
    public function delete($id)
    {
       $category = ModelsTourCategory::findOrFail($id);
       $category->delete();
        return redirect()->back()->with('success', 'Tour category delete successfully.');
    }
    
}
