<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SummernoteImageupload extends Controller
{
    //
    public function summernoteUpload(Request $request)
    {
       if ($request->hasFile('image')) {

        $file = $request->file('image');
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();

        // destination path inside public
        $destinationPath = public_path('images/editor-images');

        // create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // move file to public/images/editor-images
        $file->move($destinationPath, $filename);

        // return full URL
        return asset('images/editor-images/' . $filename);
    }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
