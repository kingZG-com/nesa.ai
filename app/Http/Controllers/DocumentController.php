<?php

namespace App\Http\Controllers;

use App\Models\GeneratedDocument;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function riwayatDokumen(Request $request)
{
    // Tangkap keyword pencarian dari URL (contoh: ?search=rpp)
    $search = $request->input('search');

    $documents = GeneratedDocument::where('user_id', auth()->id())
                    ->when($search, function ($query, $search) {
                        // Cari berdasarkan nama dokumen ATAU kategorinya
                        return $query->where(function($q) use ($search) {
                            $q->where('title', 'like', "%{$search}%")
                              ->orWhere('category', 'like', "%{$search}%");
                        });
                    })
                    ->latest()
                    ->paginate(10)
                    ->withQueryString(); // INI PENTING: Biar keyword search gak hilang pas klik Next Page

    return view('riwayat-dokumen', compact('documents'));
}
}
