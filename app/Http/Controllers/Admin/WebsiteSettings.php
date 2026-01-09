<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\WebsiteSettings as ModelsWebsiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WebsiteSettings extends Controller
{

    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function websiteSettings(){
        $settings = ModelsWebsiteSettings::find(1);
        return view('admin.website.settings', compact('settings'));
    }
    public function changePassword(){
        $password = User::find(1);
        return view('admin.website.change-password', compact('password'));
    }
    public function websiteSettingsUpdate(Request $request){
        $id = $request->update_id;
        $settings = ModelsWebsiteSettings::findOrFail($id);
        $logo = null;
        $favicon = null;

        /* ================= LOGO ================= */
        if ($request->hasFile('logo')) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$settings->logo)) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/'.$settings->logo);
            }
        

        $logoFile = $request->file('logo');
        $logoName = Str::random(20) . '.' . $logoFile->getClientOriginalExtension();
        $logoPath = $_SERVER['DOCUMENT_ROOT'].'/images/logo';

        // Create folder if not exists
        if (!file_exists($logoPath)) {
            mkdir($logoPath, 0777, true);
        }

        // Move file
        $logoFile->move($logoPath, $logoName);

        // Save relative path
        $logo = 'images/logo/' . $logoName;

        } else {
            // Keep old logo
            $logo = $request->old_logo;
        }

        /* ================= FAVICON ================= */
        if ($request->hasFile('favicon')) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/'. $settings->favicon)) {
                unlink($_SERVER['DOCUMENT_ROOT'].'/'. $settings->favicon);
            }
    

        $faviconFile = $request->file('favicon');
        $faviconName = Str::random(20) . '.' . $faviconFile->getClientOriginalExtension();
        $faviconPath = $_SERVER['DOCUMENT_ROOT'].'/images/favicon';

        // Create folder if not exists
        if (!file_exists($faviconPath)) {
            mkdir($faviconPath, 0777, true);
        }

        // Move file
        $faviconFile->move($faviconPath, $faviconName);

        // Save relative path
        $favicon = 'images/favicon/' . $faviconName;

        } else {
            // Keep old favicon
            $favicon = $request->old_favicon;
        }

        $settings->logo = $logo;
        $settings->favicon = $favicon;
        $settings->site_name = $request->site_name;
        $settings->site_tagline = $request->site_tagline;
        $settings->contact_email = $request->contact_email;
        $settings->contact_phone = $request->contact_phone;
        $settings->contact_address = $request->contact_address;
        $settings->facebook = $request->facebook;
        $settings->instagram = $request->instagram;
        $settings->twitter = $request->twitter;
        $settings->youtube = $request->youtube;
        $settings->meta_title = $request->meta_title;
        $settings->meta_keywords = $request->meta_keywords;
        $settings->meta_description = $request->meta_description;
        $settings->about_website = $request->about_website;

        $settings->save();
        return redirect()->back()->with('success', 'Tour update successfully.');
    }
    public function passwordUpdate(Request $request, $id){
             // Validate form fields
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    // Get logged-in or edited user
    $user = User::findOrFail($id);

    // Check current password
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Current password is incorrect.');
    }

    // Update password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->back()->with('success', 'Password changed successfully.');
    }



}
