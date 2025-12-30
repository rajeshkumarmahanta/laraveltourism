<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    //
    public function store(Request $request){
        Inquiry::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ]);
        return redirect()->back()->with('success', 'Thank you for contact us!');
    }
    public function index() {
        $enquiries = Inquiry::orderBy('id', 'desc')->get();
        return view('admin.inquiry.index',compact('enquiries'));
    }
    public function delete($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        return redirect()->back()->with('success', 'Inquiry deleted successfully!');
    }
}
