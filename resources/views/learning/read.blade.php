@extends('layouts.app')

@section('title', $material->title . ' - Edupath')

@section('content')
{{-- OPINI KERAS: Matikan navbar utama di halaman baca biar user fokus! --}}
{{-- @include('components.navbar') --}}

<div class="w-full min-h-screen bg-[#f8fafc] relative">

    {{-- FIXED TOPBAR (Jurus Ultimate Sidebar-Proof & Layout Baru) --}}
<div class="fixed top-0 md:pl-20 left-0 w-full h-16 bg-white/80 backdrop-blur-xl border-b border-slate-200 z-50 flex items-center justify-between px-4 sm:px-6">

    {{-- KIRI: Fokus ke Judul Saja --}}
    <div class="flex items-center gap-4 min-w-0">
        <div class="min-w-0"> {{-- Hapus 'hidden sm:block' kalau judul mau dipaksa tampil di HP --}}
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] truncate">
                {{ $material->module->title }}
            </p>
            <p class="text-sm font-bold text-slate-800 truncate">
                {{ $material->title }}
            </p>
        </div>
    </div>

    {{-- KANAN: Tombol Kembali + Badge --}}
    <div class="flex items-center gap-3 shrink-0">
        
        {{-- TOMBOL KEMBALI --}}
        <a href="{{ url()->previous() }}"
           class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 transition-all duration-300 shadow-sm">
            <i class="fas fa-arrow-left text-sm"></i>
            <span class="hidden sm:inline font-semibold text-sm">Kembali</span>
        </a>

        {{-- BADGE (Tetap hidden di mobile biar nggak sempit) --}}
        <div class="hidden md:flex items-center gap-2 px-4 py-2 rounded-full bg-slate-100 text-xs font-semibold text-slate-500 shadow-sm">
            <i class="fas fa-book-open text-emerald-500"></i>
            Materi Pembelajaran
        </div>

    </div>

</div>

    {{-- CONTENT --}}
    {{-- WAJIB DITAMBAH pt-24 (padding-top) biar konten nggak nyungsep di bawah navbar yang di-fixed --}}
    <div class="w-full px-4 sm:px-6 lg:px-10 pb-8 pt-24">

        <div class="content-wrapper">
            {!! $material->content !!}
        </div>

    </div>

</div>

<style>
/* CSS Kamu yang sebelumnya tetep aman di sini */
html,
body {
    scroll-behavior: smooth;
    overflow-x: hidden;
}

/* WRAPPER */
.content-wrapper {
    width: 70%;
    font-family: 'Outfit', sans-serif;
    color: #1e293b;
    margin:auto;
}

/* SECTION */
.content-wrapper section {
    width: 100%;
    padding-top: 5rem;
    padding-bottom: 5rem;
    border-bottom: 1px solid #e2e8f0;
}

/* TYPOGRAPHY */
.content-wrapper h1,
.content-wrapper h2,
.content-wrapper h3,
.content-wrapper h4,
.content-wrapper h5,
.content-wrapper h6 {
    color: #0f172a;
    font-weight: 800;
    line-height: 1.1;
}

.content-wrapper h1 { font-size: 3rem; }
.content-wrapper h2 { font-size: 2.5rem; }
.content-wrapper h3 { font-size: 1.75rem; }
.content-wrapper p { color: #475569; line-height: 1.9; }

/* MEDIA & CODE BOXES */
.content-wrapper img {
    width: 100%;
    max-width: 100%;
    display: block;
    object-fit: cover;
    border-radius: 1.75rem;
}

.content-wrapper iframe,
.content-wrapper video {
    width: 100%;
    border-radius: 1.5rem;
    overflow: hidden;
}

.content-wrapper table {
    width: 100%;
    overflow-x: auto;
    display: block;
    border-collapse: collapse;
    margin-top: 1.5rem;
}

.content-wrapper table th,
.content-wrapper table td {
    border: 1px solid #e2e8f0;
    padding: 1rem;
}

.content-wrapper pre {
    background: #0f172a;
    color: white;
    padding: 1.25rem;
    border-radius: 1.5rem;
    overflow-x: auto;
    margin-top: 1.5rem;
}

.content-wrapper code { color: #10b981; }

.content-wrapper blockquote {
    border-left: 4px solid #10b981;
    padding-left: 1rem;
    margin-top: 1.5rem;
    color: #64748b;
    font-style: italic;
}

/* MOBILE RESPONSIVE */
@media (max-width: 1024px) {
    .content-wrapper section { padding-top: 3rem; padding-bottom: 3rem; }
    .content-wrapper h1 { font-size: 2.3rem; }
    .content-wrapper h2 { font-size: 2rem; }
    .content-wrapper h3 { font-size: 1.5rem; }
    .content-wrapper { width: 90%; } /* Sedikit modifikasi biar di tablet gak terlalu sempit */
}

@media (max-width: 640px) {
    .content-wrapper { width: 100%; }
    .content-wrapper section { padding-top: 2.5rem; padding-bottom: 2.5rem; }
    .content-wrapper h1 { font-size: 2rem; }
    .content-wrapper h2 { font-size: 1.7rem; line-height: 1.25; }
    .content-wrapper h3 { font-size: 1.3rem; }
    .content-wrapper p { font-size: 15px; line-height: 1.9; }
    .content-wrapper img { border-radius: 1.25rem; }
    .content-wrapper table { font-size: 14px; }
}
</style>

@endsection