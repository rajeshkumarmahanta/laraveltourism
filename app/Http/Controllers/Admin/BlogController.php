<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.blogs',compact('blogs'));
    }
    public function create()
    {
        return view('admin.blog.create',);
    }
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('blog'));
    }
     public function delete($id)
    {
        $page = Blog::findOrFail($id);
        $page->delete();
        return redirect()->back()->with('success', 'Blog delete successfully.');
    }
    public function store(Request $request)
    {
     $imagePath = null;

    if ($request->hasFile('image')) {

        $imageFile = $request->file('image');
        $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
        $imageDir  = public_path('images/blog');

        // Create directory if not exists
        if (!file_exists($imageDir)) {
            mkdir($imageDir, 0777, true);
        }

        // Move image
        $imageFile->move($imageDir, $imageName);

        // Save relative path (DB)
        $imagePath = 'images/blog/' . $imageName;
    }

        Blog::create([
            'title' => $request->title ?? '',
            'slug' => $request->slug,
            'content' => $request->description,
            'image' => $imagePath,
            'status' => $request->status,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'author' => $request->author,
            'short_description' => $request->short_description,
            'published_at' => $request->published_at,
            'tags' => $request->tags,
        ]);
        return redirect()->back()->with('success', 'Blog created successfully.');
    }
    public function update(Request $request,$id)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/blog');

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/blog/' . $imageName;

        } else {
            // Keep old image
            $imagePath = $request->old_image;
        }
        $blog = Blog::findOrFail($id);
        $blog->title = $request->title ?? '';
        $blog->slug = $request->slug;
        $blog->content = $request->description;
        $blog->image = $imagePath;
        $blog->status = $request->status;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->author = $request->author;
        $blog->short_description = $request->short_description;
        $blog->published_at = $request->published_at;
        $blog->tags = $request->tags;
        $blog->status = $request->status;
        $blog->save();
     
        return redirect()->back()->with('success', 'Blog update successfully.');
    }
    public function toggleStatus(Request $request)
    {
        $page = Blog::find($request->id);

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
