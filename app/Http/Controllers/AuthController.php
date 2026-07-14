<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Jalur Utama (Redirect): Mengarahkan pengguna ke halaman autentikasi resmi Google.
     * Menginisialisasi proses login menggunakan Laravel Socialite.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Jalur Callback (Redirect): Menangkap dan memproses data dari Google 
     * setelah pengguna berhasil melakukan autentikasi.
     */
    public function handleGoogleCallback()
    {
        try {
            // Mengambil data pengguna dari Google melalui Socialite
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
                'avatar' => $googleUser->getAvatar(),
            ]);

            // Menginisialisasi sesi autentikasi pengguna di Laravel
            Auth::login($user);

            // Menghapus riwayat batasan sesi uji coba (guest)
            session()->forget('prompt_count');

            // Mengarahkan pengguna kembali ke halaman utama aplikasi
            return redirect()->to('/app');
        } catch (\Exception $e) {
            return redirect()->to('/')->with('error', 'Proses autentikasi melalui Google gagal: ' . $e->getMessage());
        }
    }

    /**
     * Jalur Pop-up Google Identity Services (GIS) Modern.
     * Menangani proses autentikasi berbasis token JWT dari frontend.
     */
    public function handleGisCallback(Request $request)
    {
        try {
            $jwtToken = $request->input('token');

            if (!$jwtToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token autentikasi tidak ditemukan.'
                ], 400);
            }

            // Memvalidasi dan mengambil data pengguna dari token Google
            $googleUser = Socialite::driver('google')->userFromToken($jwtToken);

            $user = User::updateOrCreate([
                'email' => $googleUser->getEmail(),
            ], [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16))
            ]);

            Auth::login($user);
            session()->forget('prompt_count');

            return response()->json([
                'success' => true,
                'message' => 'Autentikasi berhasil.',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memvalidasi kredensial Google: ' . $e->getMessage()
            ], 500);
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
