@extends('layouts.app')

@section('title', 'Telusuri Percakapan | SmartNES AI')

@section('content')
    <div class="p-4 border-b border-slate-200 bg-white flex items-center gap-4">
        <a href="/" class="p-2 rounded-full hover:bg-slate-100 text-slate-600 transition-colors focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <h1 class="text-lg font-bold text-slate-800">Pencarian Riwayat Obrolan</h1>
    </div>

    <div class="flex-1 overflow-y-auto p-6 max-w-4xl w-full mx-auto">

        <form action="{{ route('app.chat.search') }}" method="GET" class="w-full mb-8">
            <div class="relative w-full flex items-center">
                <i class="fas fa-search absolute left-5 text-slate-400 text-base"></i>
                <input type="text" name="q" value="{{ $searchQuery }}"
                    placeholder="Ketik kata kunci judul obrolan lo di sini, Cok..."
                    class="w-full pl-12 pr-28 py-3.5 bg-white border border-slate-200 rounded-2xl shadow-sm text-sm font-medium text-slate-800 placeholder-slate-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-100 transition-all">

                <button type="submit"
                    class="absolute right-3 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition shadow-sm cursor-pointer">
                    Cari Obrolan
                </button>
            </div>
        </form>

        <div class="space-y-3">
            @if (!empty($searchQuery))
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Hasil Pencarian untuk:
                    "{{ $searchQuery }}"</h2>

                @forelse($results as $result)
                    <div onclick="window.location.href='/app?chat_id={{ $result->id }}'"
                        class="bg-white border border-slate-100 rounded-2xl p-4 shadow-sm hover:shadow-md hover:border-purple-200 transition-all cursor-pointer flex justify-between items-center group">
                        <div class="flex items-center gap-3.5 truncate">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 shrink-0 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <i class="fas fa-comment-alt text-sm"></i>
                            </div>
                            <div class="truncate text-left">
                                <h3
                                    class="text-sm font-bold text-slate-800 group-hover:text-purple-700 transition-colors truncate">
                                    {{ $result->title }}</h3>
                                <p class="text-xs text-slate-400 mt-0.5"><i class="far fa-calendar-alt mr-1"></i> Diarsip
                                    pada {{ $result->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <i
                            class="fas fa-chevron-right text-slate-300 group-hover:text-purple-600 group-hover:translate-x-1 transition-all text-xs pr-2"></i>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white border border-slate-100 rounded-2xl p-6 shadow-sm">
                        <div class="text-4xl mb-3">🔍❌</div>
                        <h3 class="text-sm font-bold text-slate-700">Obrolan Gak Ketemu, Cok!</h3>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto">Coba cek lagi keyword lo, pastiin gak ada
                            typo atau cari obrolan dengan topik yang lain.</p>
                    </div>
                @endforelse
            @else
                <div class="text-center py-16">
                    <div
                        class="w-16 h-16 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto text-xl mb-4 shadow-inner">
                        <i class="fas fa-search-location"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Mau nyari arsip obrolan yang mana?</h3>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Tulis judul topik obrolan lo di atas, SmartNES
                        bakal bongkar data lama lo di PostgreSQL detik ini juga.</p>
                </div>
            @endif
        </div>

    </div>
@endsection
