<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    /**
     * Mengalihkan pengguna ke halaman login resmi Google.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Memproses data pengguna yang dikembalikan oleh Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            // Mengambil data user menggunakan Laravel Socialite bawaan
            $googleUser = Socialite::driver('google')->user();

            // Daftarkan atau login-kan user beserta avatarnya
            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                'avatar' => $googleUser->getAvatar(), // Mengambil URL foto profil dari Socialite
            ]);

            // Inisialisasi sesi login di Laravel
            Auth::login($user);
            
            // Kunci session agar tidak logout sendiri saat pindah halaman
            $request->session()->regenerate();

            session()->forget('prompt_count');

            // Alihkan langsung ke halaman dashboard
            return redirect()->to('/dashboard');

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google Auth Error: ' . $e->getMessage(), ['exception' => $e]);
            // Jika gagal, kembalikan ke landing page dengan pesan error
            return redirect()->to('/')->with('error', 'Autentikasi Google gagal: ' . $e->getMessage());
        }
    }

    /**
     * Mengakhiri sesi pengguna dan membersihkan riwayat autentikasi.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
