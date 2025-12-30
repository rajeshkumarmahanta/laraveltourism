<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\WebsiteSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(){
       
        //website information for admin panel
        $websiteSettings = WebsiteSettings::first();
        View::share('websiteSettings', $websiteSettings);
        $currency ="₹";
        View::share('currency', $currency);

        //header menu
        $header_menu = Menu::where('status',1)->where('group_id',1)->orderBy('sort_order')->get();
        View::share('header_menu', $header_menu);
        //footer menu 1 menu
        $footer_menu_1 = Menu::where('status',1)->where('group_id',2)->orderBy('sort_order')->get();
        View::share('footer_menu_1', $footer_menu_1);
        //header menu
        $footer_menu_2 = Menu::where('status',1)->where('group_id',3)->orderBy('sort_order')->get();
        View::share('footer_menu_2', $footer_menu_2);
        //header menu
        $footer_menu_3 = Menu::where('status',1)->where('group_id',4)->orderBy('sort_order')->get();
        View::share('footer_menu_3', $footer_menu_3);
        $footer_menu_4 = Menu::where('status',1)->where('group_id',5)->orderBy('sort_order')->get();
        View::share('footer_menu_4', $footer_menu_4);
    }
}
