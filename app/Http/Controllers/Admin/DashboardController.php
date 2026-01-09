<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        $topTourIds = Booking::select('tour_id', DB::raw('COUNT(*) as total'))
                    ->groupBy('tour_id')
                    ->orderByDesc('total')
                    ->take(4)
                    ->pluck('tour_id');

        $topTours = Tour::whereIn('id', $topTourIds)->get();
        $totalBookings = Booking::count();
        $totalTours = Tour::count();
        $monthlyEarnings = Booking::whereMonth('created_at', now()->month)
                            ->whereYear('created_at', now()->year)
                            ->sum('price');

        // Get monthly bookings grouped by month
        $monthlyBookings = Booking::select(
                DB::raw('COUNT(*) as total'),
                DB::raw('MONTH(created_at) as month')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Ensure 12 months data exist
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $monthlyBookings[$i] ?? 0;
        }

        // Pass as pure array (NOT json_encode)
        $bookingChart = $data;
        return view('admin.dashboard',compact('topTours', 'bookingChart','totalBookings','totalTours'));
    }

}
