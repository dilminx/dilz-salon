<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BlockedDate;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service'])->latest()->get();
        $services = Service::all();
        $blockedDates = BlockedDate::all();
        
        return view('admin.dashboard', compact('bookings', 'services', 'blockedDates'));
    }

    public function cancelBooking(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);
        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function blockDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:blocked_dates,date',
            'reason' => 'nullable|string'
        ]);

        BlockedDate::create($request->all());
        return back()->with('success', 'Date blocked successfully.');
    }

    public function unblockDate(BlockedDate $blockedDate)
    {
        $blockedDate->delete();
        return back()->with('success', 'Date unblocked.');
    }
}
