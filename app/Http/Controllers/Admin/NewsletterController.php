<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //
    public function index(){
        $subscribers = Newsletter::orderBy('id', 'desc')->get();
        return view('admin.newsletter.index',compact('subscribers'));
    }
    
    public function store(Request $request){
        $exist = Newsletter::where('email',$request->email)->exists();
        if($exist){
            return redirect()->back()->with('success', 'Email already exists!');
        }
        Newsletter::create([
            'email' => $request->email ?? '',
        ]);
        return redirect()->back()->with('success', 'Thank you for subscribe!');
    }
     public function delete($id)
    {
        $subscriber = Newsletter::findOrFail($id);
        $subscriber->delete();
        return redirect()->back()->with('success', 'Subscriber deleted successfully!');
    }
}
