@extends('layouts.app')

@section('title', $module->title . ' - Edupath')

@section('content')
    @include('components.navbar')

    <div class="relative flex-1 w-full bg-[#f8fafc] min-h-screen">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 relative z-10">

            {{-- Tombol Kembali --}}
            <a href="{{ route('edupath.learning') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors mb-8">
                <i class="fas fa-arrow-left"></i> Kembali ke Kurikulum
            </a>

            {{-- Header Modul --}}
            <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-slate-200/60 mb-8">
                <span
                    class="inline-flex px-3 py-1.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ $module->badge_color }} border border-white/40 shadow-sm mb-4">
                    {{ $module->level }}
                </span>

                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight mb-4">
                    {{ $module->title }}
                </h1>

                <p class="text-lg text-slate-600 font-medium leading-relaxed">
                    {{ $module->subtitle }}
                </p>
            </div>

            {{-- Daftar Materi --}}
            <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-sm border border-slate-200/60">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <i class="fas fa-list-ul text-emerald-500"></i> Silabus Pembelajaran
                </h2>

                <div class="space-y-4">
                    @foreach ($module->materials as $index => $materi)
                        {{-- Ubah div jadi a href, dan panggil route belajar.read --}}
                        <a href="{{ route('belajar.read', [
                                'module_slug' => \Illuminate\Support\Str::slug($module->title), 
                                'material_slug' => $materi->slug
                            ]) }}"
                            class="block p-4 rounded-xl border border-slate-100 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group decoration-none">
                            
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 shrink-0 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-sm font-bold text-slate-400 group-hover:text-emerald-600 group-hover:border-emerald-300 transition-colors shadow-sm">
                                    {{ $index + 1 }}
                                </div>
                                <div class="pt-1.5">
                                    {{-- Ingat, sekarang pake $materi->title karena dia ngambil dari database --}}
                                    <p class="text-slate-700 font-medium leading-relaxed group-hover:text-slate-900 transition-colors m-0">
                                        {{ $materi->title }}
                                    </p>
                                </div>
                            </div>

                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
