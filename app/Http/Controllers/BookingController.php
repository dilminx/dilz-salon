<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BlockedDate;
use App\Models\Service;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'service_id' => 'required|exists:services,id'
        ]);

        $date = $request->date;
        $service = Service::find($request->service_id);

        $dateObj = Carbon::parse($date);
        
        // Check if Sunday
        if ($dateObj->isSunday()) {
            return response()->json(['message' => 'The salon is closed on Sundays.', 'slots' => []]);
        }

        // Check if date is blocked
        if (BlockedDate::where('date', $date)->exists()) {
            return response()->json(['message' => 'This date is blocked.', 'slots' => []]);
        }

        $startTime = Carbon::createFromTimeString('09:00');
        $endTime = Carbon::createFromTimeString('18:00');
        $slots = [];

        // Fetch existing bookings for this date
        $existingBookings = Booking::where('booking_date', $date)
            ->where('status', 'confirmed')
            ->pluck('start_time')
            ->map(function($time) {
                return Carbon::createFromTimeString($time)->format('H:i');
            })
            ->toArray();

        while ($startTime->lt($endTime)) {
            $timeSlot = $startTime->format('H:i');
            
            // Check if slot is in the past for today
            $isPast = Carbon::parse($date)->isToday() && $startTime->lt(now());

            if (!in_array($timeSlot, $existingBookings) && !$isPast) {
                $slots[] = $timeSlot;
            }

            $startTime->addMinutes(30);
        }

        return response()->json(['slots' => $slots]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
        ]);

        if (Carbon::parse($request->booking_date)->isSunday()) {
            return back()->withErrors(['booking_date' => 'The salon is closed on Sundays.']);
        }

        // Double check availability (real-time)
        $exists = Booking::where('booking_date', $request->booking_date)
            ->where('start_time', $request->start_time)
            ->where('status', 'confirmed')
            ->exists();

        if ($exists) {
            return back()->withErrors(['start_time' => 'This slot is no longer available.']);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'start_time' => $request->start_time,
            'status' => 'confirmed'
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking confirmed!');
    }
}
