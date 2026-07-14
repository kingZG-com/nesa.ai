<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPromptLimit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kalo user udah login via Google, langsung lolos tanpa batas!
        if (Auth::check()) {
            return $next($request);
        }

        // 2. Kalo statusnya masih Guest, cek session 'prompt_count'
        $promptCount = session('prompt_count', 0);

        if ($promptCount >= 3) {
            // Kuota habis! Kirim respons error 403 biar JavaScript tau harus munculin GIS Login
            return response()->json([
                'status' => 'limit_reached',
                'message' => 'Batas penggunaan gratis Anda telah habis. Silakan melakukan autentikasi menggunakan akun Google untuk melanjutkan layanan tanpa batas.',
                'is_logged_in' => false
            ], 403);
        }

        // 3. Kalo kuota masih ada, izinkan request masuk ke Controller
        return $next($request);
    }
}
