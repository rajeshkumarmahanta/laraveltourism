<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PageController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $pages = Pages::all();
        return view('admin.page.index', compact('pages'));
    }
    public function edit($id)
    {
        $page = Pages::findOrFail($id);
        return view('admin.page.edit', compact('page'));
    }
    public function delete($id)
    {
        $page = Pages::findOrFail($id);
        if (file_exists($page->image)) {
            unlink($page->image);
        }
        $page->delete();
         return redirect()->back()->with('success', 'Page delete successfully.');
    }
    public function create()
    {

        return view('admin.page.create');
    }
    public function store(Request $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = $_SERVER['DOCUMENT_ROOT'].'/images/page';;

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/page/' . $imageName;
        }
        Pages::create([
            'name' => $request->name ?? '',
            'image' => $imagePath,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'slug' => $request->slug,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'title' => $request->title,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Page created successfully.');
    }
    public function update(Request $request,$id)
    {
        $page = Pages::findOrFail($id);
        $imagePath = null;

    if ($request->hasFile('image')) {

        $imageFile = $request->file('image');
        $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
        $imageDir  = $_SERVER['DOCUMENT_ROOT'].'/images/page';;

        // Create directory if not exists
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }
        if (file_exists($page->image)) {
            unlink($page->image);
        }

        // Move image
        $imageFile->move($imageDir, $imageName);

        // Save relative path (DB)
        $imagePath = 'images/page/' . $imageName;

    } else {
        // Keep old image
        $imagePath = $request->old_image;
    }
        $page->name = $request->name ?? '';
        $page->image = $imagePath;
        $page->description = $request->description;
        $page->short_description = $request->short_description;
        $page->slug = $request->slug;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->title = $request->title;
        $page->save();
        return redirect()->back()->with('success', 'Page upadate successfully.');
    }
    public function toggleStatus(Request $request)
    {
        $page = Pages::find($request->id);

        if (!$page) {
            return response()->json(['success' => false, 'message' => 'Page not found']);
        }

        // Toggle status
        $page->status = $page->status == 1 ? 0 : 1;
        $page->save();

        return response()->json([
            'success' => true,
            'status' => $page->status
        ]);
    }
}
