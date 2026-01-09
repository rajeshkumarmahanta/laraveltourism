<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactQuote;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function index(){
        $contact_quotes = ContactQuote::all();
        return view('admin.contact.contact-quotes',compact('contact_quotes'));
    }
    public function delete($id){
        $contact_quote = ContactQuote::findOrFail($id);
        $contact_quote->delete();
        return redirect()->back()->with('success','Contact Quote deleted successfully!');
    }
}
