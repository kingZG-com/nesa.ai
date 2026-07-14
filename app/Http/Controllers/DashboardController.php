<?php

namespace App\Http\Controllers;

use App\Models\GeneratedDocument;
use App\Models\Module;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    // Ambil 5 dokumen terakhir milik user yang lagi login
    $recentDocs = GeneratedDocument::where('user_id', auth()->id())
                    ->latest()
                    ->take(5)
                    ->get();
    
    $totalDocs = GeneratedDocument::where('user_id', auth()->id())->count();
    $modules = Module::orderBy('id', 'asc')->take(4)->get();

    return view('dashboard', compact('recentDocs', 'totalDocs', 'modules'));
}
}
