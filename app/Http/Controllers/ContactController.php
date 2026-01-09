<?php

namespace App\Http\Controllers;

use App\Models\ContactQuote;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function store(Request $request){
        $contact_quote = new ContactQuote();
        $contact_quote->name = $request->name;
        $contact_quote->email = $request->email;
        $contact_quote->phone = $request->phone;
        $contact_quote->message = $request->message;
        $contact_quote->ip_address = $request->ip();
        $contact_quote->save();
        return redirect()->back()->with('success','Message sent successfully');
    }
}
