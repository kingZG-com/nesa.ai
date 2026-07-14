@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- 1. NAVBAR DITARUH DI LUAR AGAR FULL WIDTH --}}
    @include('components.navbar')

    {{-- 2. WADAH SCROLLABLE UNTUK KONTEN --}}
    <div class="flex-1 w-full bg-[#f8fafc] relative min-h-0">

        {{-- 🌟 ORNAMEN BACKGROUND SUBTLE --}}
        {{-- Gradient mesh halus --}}
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div
                class="absolute -top-56 -right-56 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-emerald-100/30 via-teal-50/15 to-transparent blur-[120px]">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-[500px] h-[500px] rounded-full bg-gradient-to-tr from-amber-50/25 via-rose-50/10 to-transparent blur-[100px]">
            </div>
            <div
                class="absolute top-1/3 left-1/4 w-[300px] h-[300px] rounded-full bg-gradient-to-r from-blue-50/20 to-indigo-50/15 blur-[80px]">
            </div>
        </div>

        {{-- 3. KONTEN TENGAH DENGAN BATAS LEBAR --}}
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-10 space-y-10 pb-24">

            {{-- ✨ HERO SECTION: HIJAU PREMIUM + AVATAR BLEND MASKING --}}
            {{-- ========================================== --}}
            <div
                class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-emerald-100/90 via-green-50/95 to-teal-100/90 shadow-[0_15px_45px_-12px_rgba(16,185,129,0.25)] border border-white/60 p-6 sm:p-10 lg:p-12 min-h-[400px] flex items-center">

                {{-- AREA KANAN: AVATAR MENYATU (ABSOLUTE) --}}
                {{-- Kita tarik posisinya absolute ke kanan, ambil sekitar 45% lebar layar --}}
                <div
                    class="absolute right-0 top-0 bottom-0 w-full sm:w-1/2 lg:w-[45%] hidden sm:block pointer-events-none z-0">

                    @php
                        $avatar = auth()->user()->avatar;
                        if ($avatar && str_contains($avatar, 'googleusercontent.com')) {
                            $avatar = preg_replace('/=s\d+-c/', '=s400-c', $avatar);
                        }
                        $finalAvatar =
                            $avatar ??
                            'https://ui-avatars.com/api/?name=' .
                                urlencode(auth()->user()->name ?? 'Edu') .
                                '&background=059669&color=fff&size=400';
                    @endphp

                    {{-- 1. Fotonya dengan efek Masking CSS (Kiri transparan, Kanan solid) --}}
                    <img class="w-full h-full object-cover object-center" src="{{ $finalAvatar }}" alt="User Profile" referrerpolicy="no-referrer"
                        style="-webkit-mask-image: linear-gradient(to right, transparent 0%, black 40%); mask-image: linear-gradient(to right, transparent 0%, black 40%);">

                    {{-- 2. Overlay Gradasi Ijo/Putih biar nge-blend halus sama background kiri --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-green-50/90 via-emerald-50/20 to-transparent"></div>

                    {{-- 3. Sedikit shadow gelap di bawah biar nggak terlalu flat --}}
                    <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-teal-900/10 to-transparent"></div>
                </div>

                {{-- Ornamen Lingkaran Lembut (Z-index 0 biar di belakang konten) --}}
                <div
                    class="absolute top-0 right-0 -mr-16 -mt-16 w-80 h-80 rounded-full bg-gradient-to-br from-emerald-300/20 via-teal-200/15 to-green-300/10 blur-3xl pointer-events-none z-0">
                </div>
                <div
                    class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 rounded-full bg-gradient-to-tr from-lime-200/20 via-emerald-100/15 to-transparent blur-2xl pointer-events-none z-0">
                </div>

                {{-- Garis dekoratif SVG (Ditaruh di atas foto biar estetik) --}}
                <svg class="absolute top-8 right-8 w-24 h-24 text-emerald-500/30 pointer-events-none z-10 mix-blend-multiply"
                    viewBox="0 0 100 100" fill="none">
                    <circle cx="50" cy="50" r="48" stroke="currentColor" stroke-width="1.5"
                        stroke-dasharray="8 6" />
                    <circle cx="50" cy="50" r="35" stroke="currentColor" stroke-width="0.75"
                        stroke-dasharray="4 8" />
                    <circle cx="50" cy="50" r="22" stroke="currentColor" stroke-width="1" />
                </svg>

                {{-- AREA KIRI: Konten Utama (Wajib Z-INDEX 20 biar bisa diklik & nangkring di atas gradasi) --}}
                <div class="relative z-20 w-full sm:w-2/3 lg:w-3/5 text-center sm:text-left space-y-5">

                    {{-- Badge Status --}}
                    <div
                        class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-white/60 shadow-sm text-xs font-semibold text-slate-700 mb-2 group cursor-default hover:shadow-md transition-shadow duration-300">
                        <span>Siap mengajar hari ini</span>
                        <span class="text-slate-300">•</span>
                        <span class="text-emerald-700 font-bold">{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>

                    {{-- Judul --}}
                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-800 leading-[1.08]">
                        Selamat Datang,<br>
                        <span class="relative inline-block">
                            <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-700 via-teal-600 to-green-700">
                                {{ Str::before(auth()->user()->name ?? 'Pendidik', ' ') }}!
                            </span>
                            <svg class="absolute -bottom-1 left-0 w-full h-3 text-emerald-400/50" viewBox="0 0 200 12"
                                preserveAspectRatio="none">
                                <path d="M0 6 Q50 12 100 6 Q150 0 200 6" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" />
                            </svg>
                        </span>
                        <span
                            class="inline-block animate-[wave_2.5s_ease-in-out_infinite] origin-[70%_70%] ml-3 text-4xl sm:text-5xl">👋</span>
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-slate-600 font-medium text-base sm:text-lg max-w-xl leading-relaxed">
                        Tingkatkan kualitas pengajaran Anda melalui pemanfaatan teknologi AI. Pelajari teknik <span
                            class="italic">prompting</span> yang efektif, dan biarkan Asisten Pintar membantu
                        menyederhanakan tugas administrasi Anda.
                        <br class="hidden sm:block">
                        Dengan demikian, Anda dapat memusatkan perhatian pada hal yang paling berharga:
                        <span class="relative inline-block text-slate-800 font-semibold ml-1">
                            peserta didik Anda.
                            <span class="absolute bottom-0 left-0 w-full h-1.5 bg-amber-300/60 rounded-full -mb-0.5"></span>
                        </span>
                    </p>
                    {{-- Quotes --}}
                    <div class="pt-5 mt-5 ">
                        @php
                            $quotes = [
                                'Teknologi di tangan guru hebat akan bersifat transformatif. – George Couros',
                                'Pendidikan adalah senjata paling mematikan untuk mengubah dunia. – Nelson Mandela',
                                'Tugas pendidik modern adalah mengairi gurun, bukan menebang hutan. – C.S. Lewis',
                            ];
                            $randomQuote = $quotes[array_rand($quotes)];
                        @endphp
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 mt-0.5">
                                <svg class="w-5 h-5 text-emerald-500/50" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.655-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.271 0-2.404-.655-2.917-1.179z" />
                                </svg>
                            </div>
                            <p class="text-sm text-black font-medium italic leading-relaxed relative z-20">
                                {{ $randomQuote }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ========================================== --}}
            {{-- ⚡ AKSI CEPAT - SUPER PREMIUM --}}
            {{-- ========================================== --}}
            <div>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 tracking-tight flex items-center gap-2">
                            <i class="fas fa-bolt text-amber-500"></i> Akses Cepat
                        </h2>
                        <p class="text-xs text-slate-500 mt-0.5">Pilih instrumen pembelajaran yang Anda butuhkan</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Card RPP --}}
                    <a href="{{ route('app.assistant.chat') }}"
                        class="group relative flex flex-col bg-white p-6 rounded-2xl border border-slate-200/70 shadow-[0_1px_3px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_-15px_rgba(16,185,129,0.2)] hover:border-emerald-300/60 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        {{-- Glow on hover --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 via-emerald-50/0 to-emerald-100/0 group-hover:from-emerald-50/40 group-hover:via-emerald-50/20 group-hover:to-emerald-100/30 transition-all duration-500 rounded-2xl">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 w-20 h-20 bg-emerald-400/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700">
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-50 to-emerald-100 text-emerald-600 flex items-center justify-center mb-5 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-emerald-200/50 transition-all duration-300 ring-1 ring-emerald-200/50">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base mb-1.5">RPP Kurikulum Merdeka</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Penyusunan Rencana Pelaksanaan Pembelajaran
                                (RPP) secara efisien sesuai standar terkini.</p>
                            <span
                                class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 mt-3 group-hover:gap-2 transition-all">
                                Buat Dokumen <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                        </div>
                    </a>

                    {{-- Card Bank Soal --}}
                    <a href="{{ route('app.assistant.chat') }}"
                        class="group relative flex flex-col bg-white p-6 rounded-2xl border border-slate-200/70 shadow-[0_1px_3px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_-15px_rgba(99,102,241,0.2)] hover:border-indigo-300/60 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-50/0 via-indigo-50/0 to-indigo-100/0 group-hover:from-indigo-50/40 group-hover:via-indigo-50/20 group-hover:to-indigo-100/30 transition-all duration-500 rounded-2xl">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 w-20 h-20 bg-indigo-400/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700">
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 text-indigo-600 flex items-center justify-center mb-5 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-indigo-200/50 transition-all duration-300 ring-1 ring-indigo-200/50">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base mb-1.5">Penyusunan Soal HOTS</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Pembuatan instrumen evaluasi tingkat tinggi
                                (HOTS) beserta kunci jawaban secara otomatis.</p>
                            <span
                                class="inline-flex items-center gap-1 text-xs font-semibold text-indigo-600 mt-3 group-hover:gap-2 transition-all">
                                Buat Evaluasi <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                        </div>
                    </a>

                    {{-- Card Modul Ajar --}}
                    <a href="{{ route('app.assistant.chat') }}"
                        class="group relative flex flex-col bg-white p-6 rounded-2xl border border-slate-200/70 shadow-[0_1px_3px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_40px_-15px_rgba(59,130,246,0.2)] hover:border-blue-300/60 hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-50/0 via-blue-50/0 to-blue-100/0 group-hover:from-blue-50/40 group-hover:via-blue-50/20 group-hover:to-blue-100/30 transition-all duration-500 rounded-2xl">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 w-20 h-20 bg-blue-400/10 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700">
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 text-blue-600 flex items-center justify-center mb-5 group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-blue-200/50 transition-all duration-300 ring-1 ring-blue-200/50">
                                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base mb-1.5">Pengembangan Modul Ajar</h3>
                            <p class="text-sm text-slate-500 leading-relaxed">Perancangan materi ajar yang komprehensif,
                                terstruktur, dan disesuaikan dengan kebutuhan peserta didik.</p>
                            <span
                                class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 mt-3 group-hover:gap-2 transition-all">
                                Buat Modul <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </span>
                        </div>
                    </a>

                </div>
            </div>

            {{-- ========================================== --}}
            {{-- 📚 MATERI POPULER - PREMIUM CARDS (DYNAMIC) --}}
            {{-- ========================================== --}}
            <div>
                <div class="flex justify-between items-end mb-6">
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">📚 Materi Populer</h2>
                        <p class="text-sm text-slate-500 mt-1">Modul yang paling sering diakses bulan ini</p>
                    </div>
                    <a href="{{route('edupath.learning')}}" class="group text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors flex items-center gap-1.5 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-xl">
                        Lihat Semua
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @php
                        // Mapping warna aman untuk Tailwind
                        $colorMap = [
                            'emerald' => ['text' => 'text-emerald-400', 'badge' => 'bg-emerald-500/80 ring-emerald-300'],
                            'amber'   => ['text' => 'text-amber-400',   'badge' => 'bg-amber-500/80 ring-amber-300'],
                            'rose'    => ['text' => 'text-rose-400',    'badge' => 'bg-rose-500/80 ring-rose-300'],
                            'indigo'  => ['text' => 'text-indigo-400',  'badge' => 'bg-indigo-500/80 ring-indigo-300'],
                            'blue'    => ['text' => 'text-blue-400',    'badge' => 'bg-blue-500/80 ring-blue-300'],
                            'purple'  => ['text' => 'text-purple-400',  'badge' => 'bg-purple-500/80 ring-purple-300'],
                        ];
                    @endphp

                    @forelse ($modules as $module)
                        @php
                            // Tentukan warna dari database (fallback ke indigo jika kosong/typo)
                            $iconColor = $colorMap[$module->icon_color]['text'] ?? $colorMap['indigo']['text'];
                            $badgeColor = $colorMap[$module->badge_color]['badge'] ?? $colorMap['indigo']['badge'];
                        @endphp

                        <div class="group bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden shadow-[0_8px_25px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(79,70,229,0.12)] hover:-translate-y-1.5 transition-all duration-500 flex flex-col relative">
                            
                            {{-- Ribbon Top (Hanya untuk item pertama sebagai Best Seller) --}}
                            @if($loop->first)
                                <div class="absolute top-5 -right-10 w-32 bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[10px] font-extrabold py-1.5 shadow-lg transform rotate-45 text-center uppercase tracking-widest z-20">
                                    Unggulan
                                </div>
                            @endif

                           {{-- Header Gambar Premium --}}
                            <div class="h-44 w-full relative overflow-hidden bg-slate-200 shrink-0">
                                {{-- Gambar Background --}}
                                <img src="{{ $module->image }}" alt="{{ $module->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                
                                {{-- Overlay Gradient Halus (Diperkuat saat di-hover) --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-slate-900/40 to-slate-900/20 group-hover:from-slate-900/95 group-hover:via-slate-900/50 transition-colors duration-500"></div>

                                {{-- Efek Glow Halus dari bawah saat di-hover --}}
                                <div class="absolute -bottom-4 -inset-x-4 h-16 bg-white/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-full mix-blend-overlay"></div>

                                {{-- Ikon Sudut Kanan Atas (Dibuat sedikit membesar saat di-hover) --}}
                                <div class="absolute top-4 right-4 z-10 group-hover:-translate-y-1 transition-transform duration-500 ease-out">
                                    <div class="w-10 h-10 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-lg group-hover:bg-white/20 transition-colors duration-500">
                                        <i class="{{ $module->icon }} text-lg {{ $iconColor }}"></i>
                                    </div>
                                </div>

                                {{-- Badge Level --}}
                                <div class="absolute bottom-4 left-4 z-10">
                                    <div class="backdrop-blur-md text-white text-[10px] font-bold px-3 py-1.5 rounded-lg uppercase tracking-wider shadow-md ring-1 {{ $badgeColor }}">
                                        {{ $module->level }}
                                    </div>
                                </div>
                            </div>

                            {{-- Konten Teks --}}
                            <div class="p-5 flex flex-col flex-1 bg-white relative z-20">
                                <h3 class="font-extrabold text-slate-800 text-base mb-1.5 line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors">
                                    {{ $module->title }}
                                </h3>
                                
                                <p class="text-xs text-slate-500 mb-5 line-clamp-2 leading-relaxed">
                                    {{ $module->subtitle }}
                                </p>

                               {{-- Footer Card --}}
                                <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-100">
                                    <span class="inline-flex items-center gap-1.5 text-slate-600 font-bold text-[13px] bg-slate-50 px-3 py-1.5 rounded-lg ring-1 ring-slate-200/50">
                                        <i class="fas fa-layer-group text-indigo-500"></i> 10 Topik
                                    </span>
                                    
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-4 py-12 text-center bg-slate-50 rounded-[2rem] border border-dashed border-slate-200">
                            <i class="fas fa-folder-open text-4xl text-slate-300 mb-3"></i>
                            <h3 class="text-sm font-bold text-slate-500">Belum Ada Materi Populer</h3>
                            <p class="text-xs text-slate-400 mt-1">Modul pembelajaran sedang dalam tahap penyusunan.</p>
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- ========================================== --}}
            {{-- 📋 TABEL RIWAYAT TERBARU - PREMIUM --}}
            {{-- ========================================== --}}
            <div
                class="bg-white/70 backdrop-blur-xl rounded-2xl border border-white/80 shadow-[0_4px_25px_-8px_rgba(0,0,0,0.06),0_0_0_1px_rgba(255,255,255,0.4)_inset] overflow-hidden">
                <div
                    class="px-6 py-5 border-b border-slate-100/80 flex justify-between items-center bg-gradient-to-r from-slate-50/80 to-white">
                    <div>
                        <h2 class="font-bold text-slate-800 text-base">📋 Riwayat Dokumen Terbaru</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Dokumen yang baru saja kamu buat atau akses</p>
                    </div>
                </div>
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left text-sm min-w-[640px]">
                        <thead>
                            <tr
                                class="bg-slate-50/50 text-slate-400 uppercase tracking-wider text-[11px] border-b border-slate-100">
                                <th class="px-6 py-4 font-semibold w-[40%]">Nama Dokumen</th>
                                <th class="px-6 py-4 font-semibold">Kategori</th>
                                <th class="px-6 py-4 font-semibold">Terakhir Akses</th>
                                <th class="px-6 py-4 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($recentDocs as $doc)
                                @php
                                    // Mainkan warna bedasarkan format PDF/Word
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

                                <tr
                                    class="hover:bg-gradient-to-r hover:from-slate-50/80 hover:to-transparent transition-colors group cursor-pointer">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3.5">
                                            <div
                                                class="w-10 h-10 rounded-xl {{ $iconBg }} flex items-center justify-center shrink-0 shadow-sm ring-1 group-hover:shadow-md transition-shadow">
                                                <i class="fas {{ $iconType }} text-lg"></i>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-slate-800 font-semibold text-sm group-hover:text-emerald-600 transition-colors">
                                                    {{ $doc->title }}
                                                </p>
                                                <p class="text-xs text-slate-400 mt-0.5">{{ $doc->file_size }} •
                                                    {{ $doc->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg {{ $badgeBg }} text-xs font-semibold ring-1">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                            {{ $doc->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 text-sm font-medium">
                                        {{ $doc->updated_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-all duration-200 flex items-center justify-center">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-400 text-sm italic">
                                        Belum ada dokumen yang dibuat. Yuk, minta Sistan buatin sekarang!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-3.5 border-t border-slate-100 bg-slate-50/30 text-center">
                    <span class="text-xs text-slate-400">Menampilkan {{ $recentDocs->count() }} dari {{ $totalDocs }}
                        dokumen</span>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    {{-- Animasi tambahan jika diperlukan --}}
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes wave {

            0%,
            100% {
                transform: rotate(0deg);
            }

            20% {
                transform: rotate(14deg);
            }

            40% {
                transform: rotate(-8deg);
            }

            60% {
                transform: rotate(14deg);
            }

            80% {
                transform: rotate(-4deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-\[wave_2\.5s_ease-in-out_infinite\] {
            animation: wave 2.5s ease-in-out infinite;
        }

        .animate-\[float_6s_ease-in-out_infinite\] {
            animation: float 6s ease-in-out infinite;
        }

        .animate-\[float_8s_ease-in-out_infinite_2s\] {
            animation: float 8s ease-in-out infinite 2s;
        }

        .animate-\[float_7s_ease-in-out_infinite_1s\] {
            animation: float 7s ease-in-out infinite 1s;
        }

        .animate-\[spin_30s_linear_infinite\] {
            animation: spin 30s linear infinite;
        }
    </style>
@endsection
