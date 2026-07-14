@extends('layouts.app')

@section('title', 'Ruang Belajar - Kurikulum AI Edupath')

@section('content')
    {{-- NAVBAR INCLUDE --}}
    @include('components.navbar')

    {{-- AMBIENT BACKGROUND BIAR KERASA LUXURY --}}
    <div class="relative flex-1 w-full bg-[#f8fafc]">
        {{-- Glow Orbs di Background --}}
        <div class="fixed top-0 left-1/4 w-96 h-96 bg-emerald-300/10 rounded-full blur-[120px] pointer-events-none z-0"></div>
        <div class="fixed bottom-1/4 right-1/4 w-[30rem] h-[30rem] bg-indigo-300/10 rounded-full blur-[150px] pointer-events-none z-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-12 pb-32 relative z-10">

            {{-- HEADER HALAMAN (Makin Bold & Premium) --}}
            <div class="mb-14 text-center sm:text-left">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight mb-4 leading-tight">
                    Kurikulum <br class="hidden sm:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-500 to-indigo-600">
                        Transformasi Guru
                    </span>
                </h1>
                <p class="text-slate-500 font-medium max-w-2xl text-base md:text-lg leading-relaxed">
                    10 Modul komprehensif yang dirancang eksklusif untuk memandu Anda menguasai Kecerdasan Buatan. Dari fundamental hingga otomatisasi tingkat lanjut.
                </p>
            </div>

            {{-- GRID CARD MODUL --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 md:gap-10">
                
                @foreach ($curriculum as $index => $modul)
                    {{-- CARD MODUL: Mewah, Soft Shadow, Seamless Blend --}}
                    <div class="group bg-white/80 backdrop-blur-xl rounded-[2rem] border border-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_60px_-15px_rgba(16,185,129,0.15)] hover:border-emerald-200/60 transition-all duration-500 overflow-hidden flex flex-col h-full relative">
                        
                        {{-- 1. COVER IMAGE DENGAN SEAMLESS BLEND KE PUTIH --}}
                        <div class="relative w-full h-56 shrink-0 overflow-hidden bg-slate-100">
                            <img src="{{ $modul->image }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110" alt="Cover Modul">
                            
                            {{-- Jurus Rahasia: Gradasi Putih biar luntur mulus ke body card --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-white via-white/40 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Badge Level (Floating Glassmorphism) --}}
                            <span class="absolute top-5 left-5 inline-flex px-3 py-1.5 rounded-xl text-[10px] font-extrabold uppercase tracking-wider {{ $modul->badge_color }} border border-white/40 shadow-sm backdrop-blur-md">
                                {{ $modul->level }}
                            </span>
                        </div>

                        {{-- 2. KONTEN UTAMA (Ditarik sedikit ke atas menimpa gradasi) --}}
                        <div class="px-8 pb-4 relative z-10 flex-1 flex flex-col -mt-8">
                            <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 leading-tight mb-2 group-hover:text-emerald-600 transition-colors duration-300">
                                {{ $modul->title }}
                            </h2>
                            <p class="text-sm font-semibold text-slate-500 mb-6">
                                {{ $modul->subtitle }}
                            </p>

                            <div class="w-12 h-1 bg-gradient-to-r from-emerald-400 to-indigo-400 rounded-full mb-6"></div>

                            {{-- 3. LIST MATERI (Premium Minimalist Scroll) --}}
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Silabus Modul</span>
                                <span class="text-[10px] font-bold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full">{{ $modul->materials->count() }} Topik</span>
                            </div>
                            
                            <div class="space-y-4 max-h-[200px] overflow-y-auto pr-3 custom-scrollbar flex-1 relative">
                                
                                {{-- PERUBAHAN ADA DI SINI: Pakai ->materials, bukan ['materials'] --}}
                                @foreach ($modul->materials as $key => $materi)
                                    <div class="flex items-start gap-3.5 group/item">
                                        <div class="shrink-0 mt-1">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-300 group-hover/item:bg-emerald-500 group-hover/item:scale-150 transition-all duration-300 shadow-sm"></div>
                                        </div>
                                        
                                        {{-- PERUBAHAN ADA DI SINI: Pakai ->title --}}
                                        <p class="text-xs md:text-sm text-slate-600 font-medium leading-relaxed group-hover/item:text-slate-900 transition-colors">
                                            {{ $materi->title }}
                                        </p>
                                    </div>
                                @endforeach
                                
                                {{-- Fading effect at bottom of list --}}
                                <div class="sticky bottom-0 w-full h-8 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                            </div>
                        </div>

                        {{-- 4. TOMBOL FOOTER (Sleek Dark Mode) --}}
                        <div class="p-8 pt-4 mt-auto relative z-10 bg-white">
                            <a href="{{ route('belajar.show', \Illuminate\Support\Str::slug($modul->title)) }}" class="flex items-center justify-center gap-2 w-full py-3.5 px-4 bg-slate-900 hover:bg-emerald-600 text-white rounded-2xl text-sm font-bold transition-colors duration-300 shadow-lg shadow-slate-900/20 hover:shadow-emerald-600/30 group/btn">
                                Akses Modul <i class="fas fa-arrow-right text-[11px] group-hover/btn:translate-x-1.5 transition-transform duration-300"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection