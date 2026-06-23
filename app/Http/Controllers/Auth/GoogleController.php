<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Temporary Bypass for Local SSL Issue
            $googleDriver = Socialite::driver('google');
            
            if (app()->environment('local')) {
                $googleDriver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
            }

            $user = $googleDriver->stateless()->user();
            
            $finduser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if ($finduser) {
                // Update google_id if not set (for users who registered via email first)
                if (!$finduser->google_id) {
                    $finduser->update(['google_id' => $user->id, 'avatar' => $user->avatar]);
                }
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                    'password' => 'password_not_needed', // Placeholder
                    'role' => 'customer'
                ]);

                Auth::login($newUser);
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('login')->withErrors(['email' => 'Google Login Error: ' . $e->getMessage()]);
        }
    }
}
