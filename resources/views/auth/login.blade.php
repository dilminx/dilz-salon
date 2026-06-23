<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Glow & Style</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-xl border border-stone-200">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold tracking-tighter text-stone-800">GLOW & STYLE</h1>
            <p class="text-stone-500 mt-2">Sign in to your account</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded-xl">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full p-4 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-2 focus:ring-stone-500 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full p-4 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-2 focus:ring-stone-500 outline-none transition">
            </div>

            <button type="submit" class="w-full py-4 bg-stone-900 text-white rounded-full font-semibold hover:bg-stone-700 transition shadow-lg">
                Sign In
            </button>

            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-stone-200"></div></div>
                <div class="relative flex justify-center text-xs uppercase"><span class="bg-white px-2 text-stone-500">Or continue with</span></div>
            </div>

            <a href="{{ route('auth.google') }}" class="w-full py-4 border border-stone-200 flex items-center justify-center space-x-3 rounded-full hover:bg-stone-50 transition">
                <img src="https://www.google.com/favicon.ico" class="w-5 h-5">
                <span class="font-semibold text-stone-700">Google</span>
            </a>
        </form>

        <p class="mt-8 text-center text-sm text-stone-500">
            Don't have an account? <a href="{{ route('register') }}" class="text-stone-900 font-bold hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
