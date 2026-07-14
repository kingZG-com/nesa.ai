<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // <--- WAJIB TAMBAHIN INI
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Biasanya buat binding service, di sini biarin kosong dulu gak papa
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    View::composer(['chat', 'components.sidebar'], function ($view) {

        $avatarInitials = 'G';
        $displayName = 'Akun Guest';
        $userEmail = '';
        $avatarDisplay = null; 
        $clickAction = 'window.openGoogleLoginModal()';
        $fullName = '';
        if (Auth::check()) {
            $user = Auth::user();
            $fullName = $user->name;
            $userEmail = $user->email;
            
            $words = explode(' ', trim($fullName));
            $displayName = ucfirst(strtolower($words[0]));

            if (count($words) >= 2) {
                $avatarInitials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
            } else {
                $avatarInitials = strtoupper(substr($words[0], 0, 2));
            }
            $avatarDisplay = $user->avatar ?? null; 
            $clickAction = 'window.toggleAccountModal(event)';
        }

        $view->with([
            'avatarInitials' => $avatarInitials,
            'displayName'    => $displayName,
            'userEmail'      => $userEmail,
            'clickAction'    => $clickAction,
            'avatarDisplay'  => $avatarDisplay,
            'fullName'       => $fullName,
        ]);
    });
}
}
