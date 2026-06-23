<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Glow & Style</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-stone-900 text-white min-h-screen p-6">
            <h1 class="text-xl font-bold mb-10 tracking-tighter">GLOW & STYLE</h1>
            <nav class="space-y-4">
                <a href="{{ route('admin.dashboard') }}" class="block text-stone-300 hover:text-white transition font-semibold">Bookings</a>
                <a href="#" class="block text-stone-500 hover:text-stone-300 transition">Services</a>
                <a href="#" class="block text-stone-500 hover:text-stone-300 transition">Settings</a>
                <div class="pt-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-400 hover:text-red-300 transition">Logout</button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Content -->
        <main class="flex-1 p-10">
            <div class="max-w-6xl mx-auto">
                <header class="flex justify-between items-center mb-10">
                    <h1 class="text-3xl font-bold">Manage Appointments</h1>
                    <div class="flex space-x-4">
                        <button onclick="document.getElementById('blockDateModal').classList.remove('hidden')" class="bg-stone-800 text-white px-6 py-2 rounded-lg hover:bg-stone-700 transition">
                            Block a Date
                        </button>
                    </div>
                </header>

                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-6 text-xs uppercase tracking-wider text-gray-500 font-bold">Customer</th>
                                <th class="p-6 text-xs uppercase tracking-wider text-gray-500 font-bold">Service</th>
                                <th class="p-6 text-xs uppercase tracking-wider text-gray-500 font-bold">Date & Time</th>
                                <th class="p-6 text-xs uppercase tracking-wider text-gray-500 font-bold">Status</th>
                                <th class="p-6 text-xs uppercase tracking-wider text-gray-500 font-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($bookings as $booking)
                                <tr>
                                    <td class="p-6">
                                        <div class="font-semibold">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-gray-400">{{ $booking->user->email }}</div>
                                    </td>
                                    <td class="p-6">{{ $booking->service->name }}</td>
                                    <td class="p-6">
                                        <div class="font-medium">{{ $booking->booking_date }}</div>
                                        <div class="text-xs text-gray-400">{{ $booking->start_time }}</div>
                                    </td>
                                    <td class="p-6">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="p-6">
                                        @if($booking->status === 'confirmed')
                                            <form action="{{ route('admin.bookings.cancel', $booking) }}" method="POST">
                                                @csrf
                                                <button class="text-red-500 hover:underline text-sm font-semibold">Cancel</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Blocked Dates Section -->
                <div class="mt-12">
                    <h2 class="text-xl font-bold mb-6">Currently Blocked Dates</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($blockedDates as $blocked)
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 flex justify-between items-center">
                                <div>
                                    <p class="font-bold">{{ $blocked->date }}</p>
                                    <p class="text-sm text-gray-400">{{ $blocked->reason ?? 'No reason provided' }}</p>
                                </div>
                                <form action="{{ route('admin.blocked-dates.delete', $blocked) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-stone-400 hover:text-red-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Block Date Modal -->
    <div id="blockDateModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-3xl w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6">Block a Date</h2>
            <form action="{{ route('admin.blocked-dates.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Date</label>
                        <input type="date" name="date" required class="w-full p-3 bg-gray-50 border rounded-xl">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Reason (Optional)</label>
                        <input type="text" name="reason" placeholder="Staff Training, Holiday, etc." class="w-full p-3 bg-gray-50 border rounded-xl">
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" onclick="document.getElementById('blockDateModal').classList.add('hidden')" class="flex-1 py-3 bg-gray-100 rounded-xl font-semibold">Cancel</button>
                        <button type="submit" class="flex-1 py-3 bg-stone-900 text-white rounded-xl font-semibold">Block Date</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
