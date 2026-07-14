<?php

use App\Http\Controllers\AssistantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LearningController;
use Illuminate\Support\Facades\Route;

// landing page
Route::get('/', [AssistantController::class, 'index'])->name('assistant.index');

// autentikasi google
Route::post('/auth/google/gis', [AuthController::class, 'handleGisCallback']); // Routes Baru untuk Google Socialite Standard (Bukan POST lagi, gunakan GET)
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
// Guest user (user yg bukan login email)
Route::get('/chat', [ChatController::class, 'chatGateway'])->name('chat.gateway');
Route::post('/api/chat/prompt', [ChatController::class, 'handlePrompt'])
    ->middleware('check.prompt')
    ->name('chat.prompt');

    // KHUSUS UNTUK USER LOGIN
Route::middleware('auth')->group(function () {
    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/belajar', [LearningController::class, 'index'])->name('edupath.learning');
    Route::get('/belajar/{slug}', [LearningController::class, 'show'])->name('belajar.show');
    Route::get('/belajar/{module_slug}/{material_slug}', [LearningController::class, 'readMaterial'])->name('belajar.read');
    Route::get('/riwayat-dokumen', [DocumentController::class, 'riwayatDokumen'])->name('riwayat.dokumen');

    // App routes
    Route::prefix('app')->name('app.')->group(function () {
        Route::get('/', [ChatController::class, 'index'])->name('assistant.chat');
        Route::post('/process', [ChatController::class, 'chatProcess'])->name('assistant.process');
        Route::get('/{id}', [ChatController::class, 'showChat'])->name('app.chat.show');
        Route::patch('/chat/{id}', [ChatController::class, 'renameChat'])->name('chat.rename');
        Route::delete('/chat/{id}', [ChatController::class, 'destroy']);
        Route::patch('/chat/{id}/pin', [ChatController::class, 'pinChat']);
        Route::post('/export-document', [ChatController::class, 'exportDocument'])->name('app.export');
    });
});

//route khusus developer
Route::get('/cek-model', function () {
    try {
        if (!auth()->check() || auth()->user()->email !== 'zakariashofi24@gmail.com') {
            return response()->json([
                'status' => 'Error 403',
                'message' => 'Hayo mau ngapain! Jalur ini ilegal buat lo ! Cuma Developer yang boleh masuk.'
            ], 403);
        }

        $client = \Gemini::client(env('GEMINI_API_KEY'));
        $models = $client->models()->list();

        $list = [];
        foreach ($models->models as $model) {
            $list[] = $model->name;
        }

        return response()->json([
            'status' => 'Berhasil narik data',
            'developer' => auth()->user()->name,
            'available_models' => $list
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
})->middleware('auth'); // Wajibin login dulu biar email-nya kebaca sistem
