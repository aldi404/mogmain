<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            if (!$user->isAdmin() || $user->status !== 'active') {
                Auth::logout();
                return back()->withErrors(['email' => 'Unauthorized access.']);
            }

            // Ambil token WhatsApp otomatis saat login admin berhasil
            try {
                Log::info('Auto-fetching WhatsApp token after admin login');

                $res = Http::withoutVerifying()->asForm()->post(config('whatsapp.url') . '/api/login', [
                    'email' => config('whatsapp.email'),
                    'password' => config('whatsapp.password')
                ]);

                if ($res->successful()) {
                    $responseData = $res->json();
                    $token = $responseData["data"] ?? $responseData["token"] ?? null;

                    if ($token) {
                        Cache::put("whatsapp:token", $token);
                        Log::info('WhatsApp token auto-saved to Redis after admin login');
                    }
                } else {
                    Log::warning('Failed to auto-fetch WhatsApp token', [
                        'status' => $res->status(),
                        'response' => $res->body()
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Error auto-fetching WhatsApp token: ' . $e->getMessage());
                // Tidak menggagalkan login admin meskipun WhatsApp token gagal
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
