<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageManagerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $images = ImageManager::all();
        return view('admin.image-manager',compact('images'));
    }
    public function image_upload(Request $request){
       $imagePath = null;

        if ($request->hasFile('image')) {

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = $_SERVER['DOCUMENT_ROOT'].'/images/';

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/' . $imageName;
        }
            ImageManager::create([
                'image' => $imagePath,
            ]);
        return redirect()->back()->with('success', 'Image upload successfully.');
    }
    public function image_update(Request $request,$id){
        $image = ImageManager::findOrFail($id);
        $imagePath = null;

        if ($request->hasFile('image')) {

            // Delete old image if exists
            if (!empty($image->image)) {
                $oldImagePath = $_SERVER['DOCUMENT_ROOT'].$image->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = $_SERVER['DOCUMENT_ROOT'].'/images/';

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir,0777,true);
            }
            if (file_exists($image->image)) {
                unlink($$image->image);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/' . $imageName;

        } else {
            // Keep old image
            $imagePath = $request->old_image;
        }
        $image->image = $imagePath;
        $image->save();
        return redirect()->back()->with('success', 'Image update successfully.');
    }
    public function delete($id)
    {
        $image = ImageManager::findOrFail($id);
          if (file_exists($image->image)) {
                unlink($$image->image);
            }
        $image->delete();
        return redirect()->back()->with('success', 'Image delete successfully.');
    }
}
