<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BookingController extends Controller
{
    //

    public function store(Request $request){
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = Str::random(20) . '.' . $imageFile->getClientOriginalExtension();
            $imageDir  = public_path('images/id_proof');

            // Create directory if not exists
            if (!file_exists($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Move image
            $imageFile->move($imageDir, $imageName);

            // Save relative path (DB)
            $imagePath = 'images/id_proof/' . $imageName;
        }
        // Create a new booking record
        Booking::create([
            'tour_id' => $request->tour_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'travenlers_no' => $request->travenlers_no,
            'pickup_address' => $request->pickup_address,
            'id_type' => $request->id_type,
            'id_image' => $imagePath,
            'price' => $request->price,
            'additional_message' => $request->additional_message,
        ]);

        return redirect()->back()->with('success', 'Booking submitted successfully!');
    }
}
