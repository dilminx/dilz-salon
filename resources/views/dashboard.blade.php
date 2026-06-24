<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Glow & Style</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white border-r border-gray-200">
            <div class="p-6">
                <div class="text-xl font-bold tracking-tighter text-stone-800">GLOW & STYLE</div>
            </div>
            <nav class="px-4 space-y-1">
                <a href="#" class="block px-4 py-2 bg-stone-100 rounded-lg font-semibold text-stone-900">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-500 hover:text-stone-900 transition">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-8" x-data="bookingSystem()">
            <div class="max-w-4xl mx-auto">
                <header class="mb-10">
                    <h1 class="text-3xl font-bold text-gray-900">Hello, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-500">Book your next appointment below.</p>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- New Booking Form -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold mb-6">Book an Appointment</h2>
                        
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Service</label>
                                    <select name="service_id" x-model="serviceId" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-stone-500 outline-none">
                                        <option value="">Choose a service...</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->duration }} min) - ${{ $service->price }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Choose Date</label>
                                    <input type="date" name="booking_date" x-model="date" @change="fetchSlots()" 
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full p-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-stone-500 outline-none">
                                </div>

                                <div x-show="slots.length > 0">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Time Slot</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        <template x-for="slot in slots" :key="slot">
                                            <label class="cursor-pointer">
                                                <input type="radio" name="start_time" :value="slot" class="hidden peer">
                                                <div class="p-2 text-center text-sm border border-gray-200 rounded-lg peer-checked:bg-stone-900 peer-checked:text-white peer-checked:border-stone-900 transition">
                                                    <span x-text="slot"></span>
                                                </div>
                                            </label>
                                        </template>
                                    </div>
                                </div>

                                <div x-show="loading" class="text-sm text-gray-500 italic">Checking availability...</div>
                                <div x-show="!loading && date && serviceId && slots.length === 0" class="text-sm text-red-500" x-text="message || 'No slots available for this date.'"></div>

                                <button type="submit" :disabled="!date || !serviceId" 
                                        class="w-full py-4 bg-stone-900 text-white rounded-full font-semibold hover:bg-stone-800 disabled:opacity-50 transition">
                                    Confirm Booking
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Upcoming Appointments -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-bold uppercase tracking-widest text-xs text-gray-400">Upcoming Appointments</h2>
                        @forelse($upcomingBookings as $booking)
                            <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-stone-800 border bg-stone-50/30 flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-lg">{{ $booking->service->name }}</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}</p>
                                </div>
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                    @csrf
                                    <button class="text-red-500 text-sm font-semibold hover:underline">Cancel</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-400 italic">No upcoming appointments.</p>
                        @endforelse

                        <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mt-12 mb-4">Past History</h2>
                        @forelse($pastBookings as $booking)
                            <div class="bg-white rounded-2xl border border-gray-100 p-5 flex justify-between items-center mb-3">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center
                                        {{ $booking->status === 'cancelled' ? 'bg-red-50 text-red-400' : 'bg-green-50 text-green-500' }}">
                                        @if($booking->status === 'cancelled')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $booking->service->name }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, M d Y') }}
                                            &bull; {{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->start_time)->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-bold text-gray-700">${{ number_format($booking->service->price, 2) }}</span>
                                    <div class="mt-1">
                                        @if($booking->status === 'cancelled')
                                            <span class="inline-block px-3 py-1 bg-red-50 text-red-500 text-xs font-bold rounded-full uppercase tracking-wider">Cancelled</span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full uppercase tracking-wider">Completed</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                                <p class="text-gray-400 text-sm">No past appointments yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function bookingSystem() {
            return {
                serviceId: '',
                date: '',
                slots: [],
                message: '',
                loading: false,
                fetchSlots() {
                    if (!this.serviceId || !this.date) return;
                    this.loading = true;
                    this.slots = [];
                    this.message = '';
                    
                    fetch(`/available-slots?date=${this.date}&service_id=${this.serviceId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.slots = data.slots || [];
                            this.message = data.message || '';
                            this.loading = false;
                        })
                        .catch(() => {
                            this.loading = false;
                        });
                }
            }
        }
    </script>
</body>
</html>
