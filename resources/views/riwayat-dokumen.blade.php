@extends('layouts.app')
{{-- Sesuaikan dengan nama layout utama kamu --}}

@section('title', 'Riwayat Dokumen - EDUPATH')

@section('content')
    <main class="flex-1 overflow-y-auto bg-slate-50/50 p-4 md:p-8">
        <div class="max-w-7xl mx-auto w-full">

            {{-- Header Halaman --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 font-semibold text-xs mb-3 border border-indigo-100">
                        <i class="fas fa-archive"></i> Arsip EDUPATH
                    </div>
                    <h1 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">Riwayat Dokumen AI</h1>
                    <p class="text-sm text-slate-500 mt-1.5">Kelola dan unduh kembali semua dokumen yang pernah Sistan
                        buatkan untukmu.</p>
                </div>

                {{-- Kolom Pencarian & Filter --}}
                <div class="flex items-center gap-3">
                    {{-- Ubah div jadi form dengan method GET --}}
                    <form action="{{ route('riwayat.dokumen') }}" method="GET" class="relative group m-0">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fas fa-search text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                        </div>
                        
                        {{-- Tambahin attribute name="search" dan value request('search') --}}
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..."
                            class="w-full md:w-64 pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all shadow-sm">
                        
                        {{-- Tombol submit tersembunyi (opsional, karena tekan Enter di input udah otomatis submit) --}}
                        <button type="submit" class="hidden"></button>
                    </form>

                    {{-- Tombol Reset/Clear Search (Muncul kalau lagi nyari aja) --}}
                    @if(request('search'))
                        <a href="{{ route('riwayat.dokumen') }}" title="Hapus Pencarian" 
                            class="w-10 h-10 flex items-center justify-center bg-rose-50 border border-rose-100 rounded-xl text-rose-500 hover:text-white hover:bg-rose-500 transition-all shadow-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    @else
                        
                    @endif
                </div>
            </div>

            {{-- Tabel Utama --}}
            <div
                class="bg-white rounded-2xl border border-slate-200/80 shadow-[0_5px_30px_-10px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left text-sm min-w-[800px]">
                        <thead>
                            <tr
                                class="bg-slate-50/80 text-slate-400 uppercase tracking-wider text-[11px] border-b border-slate-100">
                                <th class="px-6 py-4 font-semibold w-[40%]">Info Dokumen</th>
                                <th class="px-6 py-4 font-semibold">Kategori</th>
                                <th class="px-6 py-4 font-semibold">Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($documents as $doc)
                                @php
                                    $isPdf = $doc->format === 'pdf';
                                    $iconBg = $isPdf
                                        ? 'bg-rose-50 text-rose-500 ring-rose-100/50'
                                        : 'bg-blue-50 text-blue-500 ring-blue-100/50';
                                    $badgeBg = $isPdf
                                        ? 'bg-rose-50 text-rose-600 ring-rose-200/50'
                                        : 'bg-indigo-50 text-indigo-600 ring-indigo-200/50';
                                    $dotColor = $isPdf ? 'bg-rose-500' : 'bg-indigo-500';
                                    $iconType = $isPdf ? 'fa-file-pdf' : 'fa-file-word';
                                @endphp

                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0 shadow-sm ring-1 group-hover:scale-105 transition-transform duration-300">
                                                <i class="fas {{ $iconType }} text-xl"></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-slate-800 font-bold text-[15px] group-hover:text-indigo-600 transition-colors line-clamp-1">
                                                    {{ $doc->title }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="text-xs font-semibold text-slate-400 uppercase tracking-wide">{{ $doc->format }}</span>
                                                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                                    <span
                                                        class="text-xs text-slate-400">{{ $doc->file_size ?? 'AI Generated' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg {{ $badgeBg }} text-xs font-bold ring-1">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }} animate-pulse"></span>
                                            {{ $doc->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-slate-700 font-medium">
                                            {{ $doc->created_at->translatedFormat('d F Y') }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $doc->created_at->format('H:i') }} WIB
                                        </p>
                                    </td>
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 ring-8 ring-slate-50/50">
                                                <i class="fas fa-folder-open text-3xl text-slate-300"></i>
                                            </div>
                                            <h3 class="text-base font-bold text-slate-700 mb-1">Arsip Masih Kosong</h3>
                                            <p class="text-sm text-slate-500 max-w-sm">Kamu belum pernah meminta Sistan
                                                untuk membuatkan dokumen. Yuk, mulai obrolan barumu!</p>
                                            <a href="{{ route('app.assistant.chat') }}"
                                                class="mt-5 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-md shadow-indigo-200 transition-all">
                                                <i class="fas fa-robot mr-1.5"></i> Buka Sistan
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginasi Laravel Tailwind --}}
                @if ($documents->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection
