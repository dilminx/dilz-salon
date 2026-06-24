<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $upcomingBookings = $user->bookings()
            ->with('service')
            ->where('status', 'confirmed')
            ->where(function($query) {
                $query->where('booking_date', '>', now()->toDateString())
                      ->orWhere(function($sub) {
                          $sub->where('booking_date', now()->toDateString())
                              ->where('start_time', '>=', now()->format('H:i'));
                      });
            })
            ->get();

        $pastBookings = $user->bookings()
            ->with('service')
            ->where(function ($query) {
                $query->where('booking_date', '<', now()->toDateString())
                      ->orWhere('status', 'cancelled')
                      ->orWhere(function($sub) {
                          $sub->where('booking_date', now()->toDateString())
                              ->where('start_time', '<', now()->format('H:i'))
                              ->where('status', 'confirmed');
                      });
            })
            ->get();

        $services = Service::all();

        return view('dashboard', compact('upcomingBookings', 'pastBookings', 'services'));
    }

    public function cancelOwnBooking(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Your booking has been cancelled.');
    }
}
