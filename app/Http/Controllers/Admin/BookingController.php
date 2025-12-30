<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Pest\Support\Str;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $bookings = Booking::latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }
    public function tourBookings($id){
        $tour = Tour::findOrFail($id);
        $bookings = Booking::where('tour_id', $id)->latest()->get();
        return view('admin.bookings.TourBookings', compact('bookings', 'tour'));
    }
    public function view($id){
        $booking = Booking::findOrFail($id);
        $tour = Tour::where('id', $booking->tour_id)->first();
        return view('admin.bookings.view', compact('booking', 'tour'));
    }
    public function delete($id){
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully!');
    }
    public function edit($id){
        $booking = Booking::findOrFail($id);
        return view('admin.bookings.edit', compact('booking'));
    }
    public function update(Request $request, $id){
        $booking = Booking::findOrFail($id);
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
        } else {
            $imagePath = $request->old_id_image;
        }
        $booking->tour_id = $request->tour_id;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->travel_date = $request->travel_date;
        $booking->travenlers_no = $request->travenlers_no;
        $booking->pickup_address = $request->pickup_address;
        $booking->id_type = $request->id_type;
        $booking->id_image = $imagePath;
        $booking->additional_message = $request->additional_message;
        $booking->save();
        return redirect()->back()->with('success', 'Booking updated successfully.');
    }
}
