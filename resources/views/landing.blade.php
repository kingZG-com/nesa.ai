<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nesa - Asisten Cerdas Mahasiswa UNNES</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Nesa.ai" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .text-gradient {
            background: linear-gradient(135deg, #A855F7 0%, #06B6D4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .bg-gradient-premium {
            background: linear-gradient(135deg, #A855F7 0%, #06B6D4 100%);
        }

        /* Custom scrollbar mewah */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Halus banget shadow-nya ala Apple */
        .shadow-luxury {
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body
    class="bg-[#fafafa] text-slate-800 selection:bg-purple-200 selection:text-purple-900 overflow-x-hidden min-h-screen relative antialiased">

    <div
        class="absolute top-0 left-0 w-full h-screen bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(168,85,247,0.15),rgba(255,255,255,0))] pointer-events-none z-0">
    </div>

    <header
        class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-slate-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
            <div class="flex items-center gap-1.5 md:gap-2 cursor-pointer">
                <span class="text-xl md:text-2xl">🎓</span>
                <span class="text-lg md:text-xl font-extrabold tracking-tight text-slate-900">Nesa<span
                        class="text-purple-600">.ai</span></span>
            </div>
        </div>
    </header>

    <div class="relative w-full overflow-hidden">
        {{-- Master Gradient Tebal Khusus Halaman Depan / Landing (Optimasi Skala Mobile) --}}
        <div class="absolute inset-0 pointer-events-none z-0 overflow-hidden select-none">
            <div
                class="absolute -top-[10%] -left-[10%] w-[120vw] h-[120vw] md:w-[70vw] md:h-[70vw] rounded-full bg-purple-300/35 blur-[100px] md:blur-[130px]">
            </div>
            <div
                class="absolute -bottom-[10%] -right-[10%] w-[120vw] h-[120vw] md:w-[70vw] md:h-[70vw] rounded-full bg-cyan-300/35 blur-[100px] md:blur-[130px]">
            </div>
            <div
                class="absolute top-[30%] left-[10%] md:left-[20%] w-[80vw] h-[80vw] md:w-[50vw] md:h-[50vw] rounded-full bg-indigo-300/35 blur-[100px] md:blur-[140px]">
            </div>
        </div>
        <div
            class="absolute inset-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/graphy.png')] -z-10 pointer-events-none">
        </div>

        <section
            class="reveal-hero relative z-10 flex flex-col items-center justify-center pt-28 md:pt-44 pb-12 md:pb-24 px-4 sm:px-6 text-center max-w-5xl mx-auto">

            <h1
                class="text-[2.75rem] sm:text-5xl md:text-[5.5rem] font-extrabold tracking-tight leading-[1.15] md:leading-[1.05] mb-5 md:mb-8 text-slate-950 drop-shadow-sm">
                Efisiensi Akademik.<br />
                <span class="text-gradient">Tanpa Kompromi.</span>
            </h1>

            <p
                class="text-sm sm:text-lg md:text-xl text-slate-600 max-w-2xl mx-auto mb-8 md:mb-14 font-medium leading-relaxed px-2">
                Asisten pintar eksklusif untuk mahasiswa UNNES. Solusi presisi untuk manajemen vendor lokal, mulai dari
                layanan binatu hingga persiapan wisuda di area Sekaran dan sekitarnya.
            </p>

            <a href="{{ route('chat.gateway') }}"
                class="cursor-pointer inline-flex items-center gap-2 px-6 py-3.5 md:px-8 md:py-4 bg-gradient-to-r from-purple-600 to-cyan-600 text-white rounded-full font-bold text-sm md:text-base hover:from-purple-700 hover:to-cyan-700 transition-all duration-300 shadow-lg hover:shadow-purple-500/40">
                Mulai Eksplorasi <i class="fas fa-arrow-right ml-1 text-xs md:text-sm"></i>
            </a>
        </section>
    </div>

    <section class="reveal-fade relative z-10 max-w-6xl mx-auto px-5 sm:px-6 py-10 md:py-20 mb-4 md:mb-10">
        <div class="flex flex-col items-center text-center">
            <i class="fas fa-quote-left text-2xl md:text-4xl text-slate-200 mb-4 md:mb-6"></i>
            <h2 class="text-lg md:text-3xl font-medium text-slate-800 leading-relaxed max-w-4xl mx-auto">
                "Tuntutan akademik sudah cukup menyita waktu. Mengelola vendor lokal untuk keperluan mendesak kampus
                <span class="font-bold text-slate-950">seharusnya tidak menjadi beban tambahan</span> yang menghambat
                produktivitas mahasiswa."
            </h2>
            <div class="w-10 md:w-12 h-1 bg-gradient-premium mx-auto mt-6 md:mt-10 rounded-full"></div>
            <p class="text-slate-500 font-medium mt-4 md:mt-6 tracking-wide uppercase text-[10px] md:text-sm">Solusi
                Cerdas Berbasis
                Analisis Kebutuhan Mahasiswa</p>
        </div>
    </section>

    <section class="reveal-cards relative z-20 max-w-5xl mx-auto px-4 sm:px-6 -mb-8 md:-mb-12">
        <div
            class="bg-white/80 backdrop-blur-xl rounded-2xl md:rounded-3xl shadow-luxury border border-white p-5 md:p-8 grid grid-cols-2 md:grid-cols-4 gap-y-5 md:gap-y-8 gap-x-3 md:gap-x-8 text-center ring-1 ring-slate-900/5">
            <div class="pb-2 md:pb-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">40K+</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-slate-400 uppercase">Mahasiswa</p>
            </div>
            <div class="border-l border-slate-100 pb-2 md:pb-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">100%</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-purple-500 uppercase">Integrasi LLM</p>
            </div>
            <div class="border-t md:border-t-0 md:border-l border-slate-100 pt-3 md:pt-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">&lt; 3s</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-slate-400 uppercase">Latensi Respons</p>
            </div>
            <div class="border-t md:border-t-0 border-l border-slate-100 pt-3 md:pt-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">20+</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-cyan-500 uppercase">Vendor Lokal</p>
            </div>
        </div>
    </section>

    <section
        class="reveal-fade relative z-10 bg-white pt-20 md:pt-32 pb-12 md:pb-24 border-y border-slate-200/60 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-24 items-center">

            <div class="order-2 md:order-1 relative w-full max-w-sm mx-auto md:max-w-none mt-4 md:mt-0">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-purple-100/80 to-cyan-50/80 rounded-[2rem] md:rounded-[3rem] transform -rotate-3 md:-rotate-6 scale-105 -z-10 transition-transform duration-700 hover:rotate-0">
                </div>

                <div
                    class="bg-white/60 backdrop-blur-2xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-8 shadow-luxury border border-white h-[280px] md:h-[400px] flex flex-col items-center justify-center relative overflow-hidden group cursor-pointer">

                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div
                            class="w-40 md:w-64 h-40 md:h-64 border border-purple-200/60 rounded-full animate-ping opacity-20">
                        </div>
                        <div class="w-28 md:w-48 h-28 md:h-48 border border-cyan-200/60 rounded-full animate-ping opacity-40"
                            style="animation-delay: 0.5s;"></div>
                    </div>

                    <div
                        class="relative z-10 w-16 h-16 md:w-28 md:h-28 bg-gradient-premium rounded-[1rem] md:rounded-[2rem] flex items-center justify-center text-white text-2xl md:text-5xl shadow-[0_10px_40px_-10px_rgba(168,85,247,0.6)] mb-5 md:mb-8 transform group-hover:scale-110 transition-transform duration-500">
                        <i class="fas fa-brain"></i>
                    </div>

                    <div class="relative z-10 w-full max-w-[140px] md:max-w-[200px] space-y-2 md:space-y-3">
                        <div class="h-1.5 md:h-2.5 w-full bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="h-full bg-purple-400 w-1/2 rounded-full animate-pulse"></div>
                        </div>
                        <div class="h-1.5 md:h-2.5 w-4/5 mx-auto bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="h-full bg-cyan-400 w-3/4 rounded-full animate-pulse"
                                style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>

                    <div class="absolute top-5 md:top-10 left-3 md:left-6 bg-white px-2.5 md:px-4 py-1 md:py-2 rounded-lg md:rounded-2xl shadow-lg border border-slate-100 flex items-center gap-1.5 md:gap-2 transform -rotate-6 group-hover:rotate-0 transition-transform duration-300 animate-bounce"
                        style="animation-duration: 3s;">
                        <i class="fas fa-wallet text-emerald-500 text-[10px] md:text-sm"></i>
                        <span class="text-[9px] md:text-xs font-extrabold text-slate-700">Analisis Anggaran</span>
                    </div>
                    <div class="absolute bottom-6 md:bottom-12 right-3 md:right-6 bg-white px-2.5 md:px-4 py-1 md:py-2 rounded-lg md:rounded-2xl shadow-lg border border-slate-100 flex items-center gap-1.5 md:gap-2 transform rotate-6 group-hover:rotate-0 transition-transform duration-300 animate-bounce"
                        style="animation-duration: 3.5s; animation-delay: 0.5s;">
                        <i class="fas fa-map-pin text-cyan-500 text-[10px] md:text-sm"></i>
                        <span class="text-[9px] md:text-xs font-extrabold text-slate-700">Presisi Lokasi</span>
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2 px-1">
                <div
                    class="inline-flex items-center gap-1.5 md:gap-2 px-3 py-1 md:py-1.5 rounded-full bg-purple-50 border border-purple-100 mb-3 md:mb-6">
                    <i class="fas fa-sparkles text-purple-500 text-[9px] md:text-xs"></i>
                    <span class="text-[9px] md:text-xs font-bold text-purple-700 uppercase tracking-wider">Powered by
                        Gemini AI</span>
                </div>

                <h2
                    class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-6 leading-[1.2] md:leading-[1.15] tracking-tight">
                    Lebih dari Sekadar Data.<br>Ini <span class="text-gradient">Sistem Cerdas Anda.</span>
                </h2>
                <p class="text-slate-500 text-sm md:text-lg leading-relaxed font-medium mb-5 md:mb-8">
                    Tinggalkan metode penelusuran manual. Platform ini memproses instruksi berbasis <span
                        class="font-bold text-slate-700">bahasa natural</span>, mengekstraksi parameter dari puluhan
                    data vendor lokal, dan merumuskan rekomendasi komprehensif dalam hitungan detik.
                </p>

                <ul class="space-y-1 md:space-y-3">
                    <li
                        class="flex items-start gap-3 md:gap-4 p-2.5 md:p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors cursor-pointer group">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-comment-dots text-[10px] md:text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-slate-900 font-bold mb-0.5 md:mb-1 text-sm md:text-base">Analisis Sentimen
                                & Konteks</h5>
                            <p class="text-[11px] md:text-sm font-medium text-slate-500 leading-snug">Algoritma secara
                                mandiri menerjemahkan konteks, urgensi, dan spesifikasi dari setiap permintaan Anda.</p>
                        </div>
                    </li>
                    <li
                        class="flex items-start gap-3 md:gap-4 p-2.5 md:p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors cursor-pointer group">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-cyan-100 flex items-center justify-center text-cyan-600 shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-tag text-[10px] md:text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-slate-900 font-bold mb-0.5 md:mb-1 text-sm md:text-base">Perhitungan Biaya
                                Real-Time</h5>
                            <p class="text-[11px] md:text-sm font-medium text-slate-500 leading-snug">Sistem
                                mengalkulasi dan memfilter hasil berdasarkan batasan anggaran finansial yang Anda
                                tetapkan.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </section>

    <section class="reveal-fade relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-24">

        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-3xl h-64 bg-slate-100/50 rounded-full blur-[120px] pointer-events-none z-0">
        </div>

        <div class="text-center mb-10 md:mb-20 relative z-10 px-1">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-5 tracking-tight">
                Standar Layanan <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-cyan-600">Enterprise.</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-xl max-w-2xl mx-auto">
                Beralih ke platform cerdas dengan arsitektur mutakhir. Menawarkan pengalaman interaksi yang dirancang
                khusus untuk ekosistem akademis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 relative z-10">

            <div
                class="bg-white/80 backdrop-blur-xl p-6 md:p-12 rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-200/60 hover:-translate-y-1.5 md:hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 cursor-pointer group relative overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 md:-top-24 md:-right-24 w-40 h-40 md:w-48 md:h-48 bg-purple-100/60 rounded-full blur-[50px] group-hover:bg-purple-200/80 transition-colors duration-500">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-0 h-1 md:h-1.5 bg-gradient-to-r from-purple-500 to-purple-400 group-hover:w-full transition-all duration-700 ease-out">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-[1.25rem] bg-white border border-purple-100 shadow-[0_8px_16px_-6px_rgba(168,85,247,0.3)] flex items-center justify-center text-purple-600 text-lg md:text-2xl mb-4 md:mb-8 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                        <i class="fas fa-wand-magic-sparkles"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Komunikasi Natural</h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Gunakan frasa deskriptif seperti <span class="text-slate-700 font-semibold">"Butuh jasa binatu
                            kilat sore ini,"</span> dan asisten AI akan menerjemahkan kebutuhan Anda menjadi rekomendasi
                        akurat.
                    </p>
                </div>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-6 md:p-12 rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-200/60 hover:-translate-y-1.5 md:hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 cursor-pointer group relative overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 md:-top-24 md:-right-24 w-40 h-40 md:w-48 md:h-48 bg-cyan-100/60 rounded-full blur-[50px] group-hover:bg-cyan-200/80 transition-colors duration-500">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-0 h-1 md:h-1.5 bg-gradient-to-r from-cyan-500 to-cyan-400 group-hover:w-full transition-all duration-700 ease-out">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-[1.25rem] bg-white border border-cyan-100 shadow-[0_8px_16px_-6px_rgba(6,182,212,0.3)] flex items-center justify-center text-cyan-600 text-lg md:text-2xl mb-4 md:mb-8 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-500">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Data Lapangan Eksklusif
                    </h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Tidak sekadar bergantung pada peta digital publik. Kami mengintegrasikan <span
                            class="text-slate-700 font-semibold">data survei riil di lapangan</span>, mencakup vendor
                        strategis tersembunyi di wilayah kampus.
                    </p>
                </div>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-6 md:p-12 rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-200/60 hover:-translate-y-1.5 md:hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 cursor-pointer group relative overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 md:-top-24 md:-right-24 w-40 h-40 md:w-48 md:h-48 bg-blue-100/60 rounded-full blur-[50px] group-hover:bg-blue-200/80 transition-colors duration-500">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-0 h-1 md:h-1.5 bg-gradient-to-r from-blue-500 to-blue-400 group-hover:w-full transition-all duration-700 ease-out">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-[1.25rem] bg-white border border-blue-100 shadow-[0_8px_16px_-6px_rgba(59,130,246,0.3)] flex items-center justify-center text-blue-600 text-lg md:text-2xl mb-4 md:mb-8 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Infrastruktur Andal</h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Berdiri di atas infrastruktur server berkinerja tinggi, menjamin proses penyajian data
                        asinkronus dalam durasi operasional kurang dari <span class="text-slate-700 font-semibold">3
                            detik</span>.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="reveal-fade relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-24 mb-6 md:mb-12">

        <div class="text-center mb-10 md:mb-20 relative z-10">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-6 tracking-tight">
                Integrasi Alur Kerja <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-cyan-500">Terpadu</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-xl max-w-2xl mx-auto px-2">
                Seluruh tahapan komunikasi dan reservasi telah disinkronisasi untuk memangkas proses manual secara
                masif.
            </p>
        </div>

        <div class="flex flex-col gap-5 md:gap-8">

            <div
                class="bg-white rounded-[1.5rem] md:rounded-[3rem] p-6 sm:p-8 md:p-14 border border-slate-200/80 shadow-luxury hover:shadow-2xl hover:border-emerald-200 transition-all duration-500 cursor-pointer group relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6 md:gap-12">

                <div
                    class="absolute -right-20 -top-20 md:-right-32 md:-top-32 w-[15rem] md:w-[30rem] h-[15rem] md:h-[30rem] bg-emerald-100/40 rounded-full blur-[60px] md:blur-[100px] pointer-events-none group-hover:bg-emerald-200/50 transition-colors duration-700">
                </div>

                <div class="relative z-10 flex-1 w-full text-center md:text-left">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-[1rem] md:rounded-[1.25rem] bg-emerald-50 flex items-center justify-center text-emerald-500 text-xl md:text-3xl mb-4 md:mb-8 mx-auto md:mx-0 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 shadow-sm border border-emerald-100">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h4 class="text-xl sm:text-2xl md:text-4xl font-extrabold text-slate-900 mb-3 md:mb-5">Direct
                        WhatsApp Gateway
                    </h4>
                    <p
                        class="text-slate-500 text-xs sm:text-sm md:text-lg font-medium max-w-lg mx-auto md:mx-0 leading-relaxed">
                        Proses reservasi dilakukan dalam sekali sentuh. Platform ini menavigasi Anda ke WhatsApp vendor
                        dengan <span class="text-slate-800 font-bold">templat formulir pesan otomatis</span> yang
                        terstruktur rapi.
                    </p>
                </div>

                <div
                    class="relative z-10 w-full md:w-5/12 flex items-center justify-center min-h-[120px] md:min-h-[150px]">
                    <div class="relative w-full max-w-[15rem] md:max-w-sm">
                        <div
                            class="bg-emerald-500 text-white p-2.5 md:p-4 rounded-[1rem] md:rounded-2xl rounded-tr-sm shadow-lg transform group-hover:-translate-y-1 md:group-hover:-translate-y-2 group-hover:-translate-x-1 md:group-hover:-translate-x-2 transition-transform duration-500 mb-2 md:mb-4 w-10/12 ml-auto relative z-10">
                            <p class="text-[10px] md:text-sm font-medium leading-tight">Selamat siang, saya mendapatkan
                                referensi dari Nesa.Ai. Apakah layanan *express laundry* untuk besok pagi tersedia?</p>
                        </div>
                        <div
                            class="bg-white border border-slate-100 text-slate-700 p-2.5 md:p-4 rounded-[1rem] md:rounded-2xl rounded-tl-sm shadow-md transform group-hover:translate-y-1 md:group-hover:translate-y-2 group-hover:translate-x-1 md:group-hover:translate-x-2 transition-transform duration-500 w-9/12 mr-auto delay-100 relative z-0">
                            <p class="text-[10px] md:text-sm font-medium leading-tight">Selamat siang, tentu bisa!
                                Mohon melampirkan titik jemput lokasinya ya. ✨
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8">

                <div
                    class="bg-white rounded-[1.5rem] md:rounded-[3rem] p-6 md:p-12 border border-slate-200/80 shadow-luxury hover:shadow-2xl hover:border-blue-200 transition-all duration-500 cursor-pointer group relative overflow-hidden">
                    <div
                        class="absolute -right-12 md:-right-20 -bottom-12 md:-bottom-20 w-48 md:w-80 h-48 md:h-80 bg-blue-50/80 rounded-full blur-[50px] md:blur-[80px] pointer-events-none group-hover:bg-blue-100 transition-colors duration-700">
                    </div>

                    <div class="relative z-10 text-center md:text-left">
                        <div
                            class="w-12 h-12 md:w-16 md:h-16 rounded-[1rem] md:rounded-[1.25rem] bg-blue-50 flex items-center justify-center text-blue-500 text-xl md:text-3xl mb-4 md:mb-8 mx-auto md:mx-0 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-500 shadow-sm border border-blue-100">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h4 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Geolokasi
                            Terintegrasi
                        </h4>
                        <p class="text-slate-500 text-xs md:text-lg font-medium leading-relaxed mb-5 md:mb-8">
                            Akurasi jarak dikalkulasi otomatis. Anda dapat memicu rute Google Maps secara langsung dari
                            lokasi domisili menuju gerai vendor terkait.
                        </p>

                        <div
                            class="w-full h-16 md:h-24 rounded-xl md:rounded-2xl bg-slate-50 border border-slate-100 relative overflow-hidden flex items-center justify-center group-hover:border-blue-200 transition-colors">
                            <div
                                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/graphy.png')]">
                            </div>
                            <div
                                class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-full flex items-center justify-center animate-bounce shadow-sm relative z-10">
                                <i class="fas fa-map-pin text-blue-500 text-xs md:text-base"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-[1.5rem] md:rounded-[3rem] p-6 md:p-12 border border-slate-200/80 shadow-luxury hover:shadow-2xl hover:border-amber-200 transition-all duration-500 cursor-pointer group relative overflow-hidden">
                    <div
                        class="absolute -right-12 md:-right-20 -bottom-12 md:-bottom-20 w-48 md:w-80 h-48 md:h-80 bg-amber-50/80 rounded-full blur-[50px] md:blur-[80px] pointer-events-none group-hover:bg-amber-100 transition-colors duration-700">
                    </div>

                    <div class="relative z-10 text-center md:text-left">
                        <div
                            class="w-12 h-12 md:w-16 md:h-16 rounded-[1rem] md:rounded-[1.25rem] bg-amber-50 flex items-center justify-center text-amber-500 text-xl md:text-3xl mb-4 md:mb-8 mx-auto md:mx-0 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 shadow-sm border border-amber-100">
                            <i class="fas fa-tags"></i>
                        </div>
                        <h4 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Transparansi Katalog
                            Harga
                        </h4>
                        <p class="text-slate-500 text-xs md:text-lg font-medium leading-relaxed mb-5 md:mb-8">
                            Menghadirkan prediktabilitas finansial. Asisten memaparkan profil dan rentang harga vendor
                            secara mendetail pada fase negosiasi awal.
                        </p>

                        <div
                            class="w-full h-16 md:h-24 rounded-xl md:rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between px-4 md:px-6 group-hover:border-amber-200 transition-colors">
                            <div class="flex items-center gap-2 md:gap-3">
                                <div
                                    class="w-6 h-6 md:w-10 md:h-10 rounded-full bg-slate-200/50 flex items-center justify-center">
                                    <i class="fas fa-tshirt text-slate-400 text-[10px] md:text-base"></i>
                                </div>
                                <div class="h-1.5 md:h-2.5 w-12 md:w-20 bg-slate-200 rounded-full"></div>
                            </div>
                            <div
                                class="px-2.5 md:px-4 py-1 md:py-2 bg-amber-100 text-amber-700 font-bold rounded-md md:rounded-xl text-[10px] md:text-sm">
                                Rp 25.000
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="relative py-8 md:py-0">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-64 bg-purple-100/50 rounded-full blur-[100px] pointer-events-none z-0">
        </div>

        <div class="reveal-fade text-center mb-10 md:mb-20 relative z-10 px-4 sm:px-6">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-5 tracking-tight">
                Alur Operasional <span class="text-gradient">Cerdas</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-lg max-w-2xl mx-auto">
                Konsep tiga langkah minimalis untuk resolusi maksimal. Mengeliminasi kompleksitas pada sisi end-user.
            </p>
        </div>

        <div
            class="reveal-cards grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-10 relative max-w-6xl mx-auto z-10 px-4 sm:px-6">

            <div class="hidden md:block absolute top-[5.5rem] left-[15%] right-[15%] h-[2px] bg-slate-200/60 z-0">
                <div
                    class="absolute top-0 left-0 h-full w-2/3 bg-gradient-to-r from-purple-400 to-cyan-400 opacity-60 animate-pulse">
                </div>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white/80 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-100 hover:shadow-2xl hover:border-purple-200 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer">
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-slate-50 border-4 md:border-8 border-white shadow-md flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 rounded-full bg-purple-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span
                        class="text-xl md:text-3xl font-extrabold text-slate-300 group-hover:text-purple-600 relative z-10 transition-colors">1</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4">Input Spesifikasi</h4>
                <p class="text-slate-500 font-medium leading-relaxed text-xs md:text-base">
                    Uraikan parameter kebutuhan Anda ke dalam jendela obrolan AI secara gamblang dan spesifik.
                </p>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white/80 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-100 hover:shadow-2xl hover:border-cyan-200 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer">
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-slate-50 border-4 md:border-8 border-white shadow-md flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 rounded-full bg-cyan-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span
                        class="text-xl md:text-3xl font-extrabold text-slate-300 group-hover:text-cyan-600 relative z-10 transition-colors">2</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4">Pemrosesan Paralel</h4>
                <p class="text-slate-500 font-medium leading-relaxed text-xs md:text-base">
                    Sistem mengevaluasi probabilitas dan melalukan kueri database berdasarkan variabel prioritas Anda.
                </p>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white rounded-[1.5rem] md:rounded-[2.5rem] shadow-2xl border border-purple-100 hover:border-purple-300 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-purple-50/50 to-cyan-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>

                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-gradient-to-r from-purple-600 to-cyan-600 border-4 md:border-8 border-white shadow-lg shadow-purple-500/30 flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <span class="text-xl md:text-3xl font-extrabold text-white relative z-10">3</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4 relative z-10">Rekomendasi Final
                </h4>
                <p class="text-slate-500 font-medium leading-relaxed relative z-10 text-xs md:text-base">
                    Dapatkan sajian kartu informasi vendor final yang siap untuk dilanjutkan pada tahap
                    reservasi/transaksi.
                </p>
            </div>

        </div>
    </div>

    <section class="reveal-fade relative z-10 max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-28">

        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-gradient-to-tr from-purple-600/10 via-cyan-500/10 to-blue-500/10 rounded-[3rem] blur-[120px] pointer-events-none z-0">
        </div>

        <div
            class="bg-white/40 backdrop-blur-2xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-14 border border-white/60 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden relative group ring-1 ring-slate-900/5">

            <div
                class="absolute -left-32 -bottom-32 w-[25rem] md:w-[40rem] h-[25rem] md:h-[40rem] bg-gradient-to-tr from-purple-500/20 to-cyan-400/20 rounded-full blur-[80px] md:blur-[120px] pointer-events-none transition-transform duration-1000 group-hover:scale-110">
            </div>
            <div
                class="absolute -right-20 -top-20 w-[15rem] md:w-[25rem] h-[15rem] md:h-[25rem] bg-gradient-to-br from-blue-400/20 to-emerald-400/20 rounded-full blur-[80px] pointer-events-none transition-transform duration-1000 group-hover:scale-110">
            </div>

            <div class="relative z-10 flex flex-col xl:flex-row items-center justify-between gap-10 xl:gap-16">

                <div class="flex-shrink-0 relative group/avatar">
                    <div
                        class="absolute inset-0 rounded-full bg-gradient-to-tr from-purple-600 via-cyan-400 to-blue-600 blur-[8px] opacity-70 group-hover/avatar:opacity-100 group-hover/avatar:rotate-180 transition-all duration-700">
                    </div>

                    <div
                        class="relative w-32 h-32 md:w-48 md:h-48 rounded-full p-1 bg-gradient-to-tr from-purple-500 via-cyan-400 to-blue-500 shadow-2xl transform group-hover/avatar:scale-105 transition-all duration-500 flex items-center justify-center overflow-hidden">
                        <div
                            class="w-full h-full bg-slate-900 rounded-full flex items-center justify-center overflow-hidden ring-4 ring-white">
                            <img src="{{ asset('storage/shofi.webp') }}" alt="Achmad Shofi Zakaria"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover/avatar:scale-110 filter contrast-105">
                        </div>
                    </div>

                    <div
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-4 py-1.5 md:px-5 md:py-2 rounded-full text-[9px] md:text-[11px] font-black tracking-widest uppercase shadow-xl border border-slate-700 flex items-center gap-2 whitespace-nowrap">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Santri Code
                    </div>
                </div>

                <div class="flex-1 text-center xl:text-left w-full">

                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gradient-to-r from-purple-50 to-cyan-50 border border-purple-100/50 mb-4 md:mb-5 shadow-sm">
                        <i
                            class="fas fa-code-branch text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-cyan-600 text-xs"></i>
                        <span
                            class="text-[10px] md:text-[11px] font-extrabold tracking-widest text-slate-700 uppercase">Lead
                            Software Architect & AI Engineer</span>
                    </div>

                    <h3
                        class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-slate-950 mb-4 tracking-tight leading-tight">
                        Didesain & Dibangun Oleh<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 via-blue-600 to-cyan-500">Achmad
                            Shofi Zakaria</span>
                    </h3>

                    <p
                        class="text-slate-500 text-sm md:text-base leading-relaxed font-medium mb-6 md:mb-8 max-w-2xl mx-auto xl:mx-0">
                        Mahasiswa Universitas Negeri Semarang (UNNES) & kompetitor <span
                            class="text-slate-800 font-extrabold">Google Developer Competition 2026</span>. Merancang
                        arsitektur perangkat lunak level *enterprise* yang memadukan ekosistem web modern, *mobile
                        development*, hingga pemrosesan bahasa alami (NLP).
                    </p>

                    <div
                        class="flex flex-wrap justify-center xl:justify-start gap-2 mb-8 md:mb-10 w-full max-w-3xl mx-auto xl:mx-0">

                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full mb-1">
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-laravel text-red-500 mr-1.5"></i>Laravel 13
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-node-js text-green-600 mr-1.5"></i>Node.js & Express
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-layer-group text-sky-500 mr-1.5"></i>Inertia.js
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-database text-blue-600 mr-1.5"></i>PostgreSQL
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-leaf text-emerald-500 mr-1.5"></i>MongoDB (MERN)
                            </span>
                        </div>

                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full mb-1">
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-react text-sky-400 mr-1.5"></i>React.js
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-android text-green-500 mr-1.5"></i>Kotlin & Jetpack Compose
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-js text-yellow-500 mr-1.5"></i>Vanilla ES6+
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-css3-alt text-cyan-500 mr-1.5"></i>Tailwind CSS v4
                            </span>
                        </div>

                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-slate-900 to-slate-800 border border-slate-700 rounded-lg text-[10px] md:text-xs font-bold text-white shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-robot text-purple-400 mr-1.5"></i>Gemini Pro LLM
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fab fa-google text-red-500 mr-1.5"></i>Google Identity (GIS)
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-shield-alt text-teal-500 mr-1.5"></i>OAuth 2.0
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-bolt text-amber-500 mr-1.5"></i>Laravel Reverb (WebSockets)
                            </span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200/60 rounded-lg text-[10px] md:text-xs font-bold text-slate-700 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                                <i class="fas fa-code-merge text-violet-500 mr-1.5"></i>Vite Bundler
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center xl:justify-start gap-4">
                        <a href="https://github.com/Azzakariadev" target="_blank"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-xl text-xs md:text-sm font-black hover:from-slate-800 hover:to-slate-700 transition-all shadow-lg hover:shadow-slate-900/30 cursor-pointer border border-slate-700">
                            <i class="fab fa-github text-base"></i> Tinjau Repositori
                        </a>
                        <a href="mailto:zakariashofi24@gmail.com"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-white/80 backdrop-blur-md text-slate-800 border border-slate-200 rounded-xl text-xs md:text-sm font-bold hover:bg-white hover:border-cyan-300 hover:text-cyan-700 transition-all shadow-sm cursor-pointer">
                            <i class="far fa-envelope text-base text-cyan-600"></i> Inisiasi Kolaborasi
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="text-center mt-6 md:mt-16 mb-12 md:mb-8 px-4 sm:px-6">
        <a href="{{ route('chat.gateway') }}"
            class="cursor-pointer inline-flex items-center gap-2 px-6 py-3.5 md:px-8 md:py-4 bg-gradient-to-r from-purple-600 to-cyan-600 text-white rounded-full font-bold text-sm md:text-base hover:from-purple-700 hover:to-cyan-700 transition-all duration-300 shadow-lg hover:shadow-purple-500/40">
            Akses Platform Sekarang <i class="fas fa-arrow-right ml-1 text-xs md:text-sm"></i>
        </a>
    </section>

    <footer
        class="relative bg-gradient-to-r from-purple-100 via-fuchsia-50 to-cyan-100 pt-12 md:pt-20 pb-6 md:pb-10 border-t border-slate-200 overflow-hidden">

        <div
            class="absolute inset-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/graphy.png')] pointer-events-none z-0">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 mb-10 md:mb-16">
                <div class="md:col-span-5 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2.5 mb-4 md:mb-6 cursor-pointer">
                        <span class="text-2xl md:text-3xl">🎓</span>
                        <span class="text-xl md:text-2xl font-extrabold tracking-tight text-slate-900">Nesa<span
                                class="text-purple-600">.ai</span></span>
                    </div>
                    <p
                        class="text-slate-600 text-xs md:text-base leading-relaxed font-medium mb-6 md:mb-8 max-w-sm mx-auto md:mx-0">
                        Merevolusi pola manajemen operasional mahasiswa UNNES melalui integrasi kecerdasan buatan.
                        Responsif, presisi, relevan.
                    </p>
                    <a href="/assistant"
                        class="cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 md:px-6 md:py-3 bg-slate-900 text-white rounded-full font-bold text-xs md:text-sm hover:bg-slate-800 transition-all shadow-md hover:shadow-slate-900/20">
                        Luncurkan Aplikasi
                    </a>
                </div>

                <div class="md:col-span-3 md:col-start-8 text-center md:text-left mt-4 md:mt-0">
                    <h5 class="text-[10px] md:text-sm font-bold uppercase tracking-widest text-slate-500 mb-3 md:mb-6">
                        Navigasi Direktori</h5>
                    <ul class="space-y-2.5 md:space-y-4 text-xs md:text-base font-medium text-slate-600">
                        <li><a href="/assistant" class="cursor-pointer hover:text-purple-600 transition-colors">Tanya
                                Asisten AI</a></li>
                        <li><a href="/assistant"
                                class="cursor-pointer hover:text-purple-600 transition-colors">Eksplorasi Binatu</a>
                        </li>
                        <li><a href="/assistant"
                                class="cursor-pointer hover:text-purple-600 transition-colors">Reservasi MUA</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2 text-center md:text-left mt-4 md:mt-0">
                    <h5 class="text-[10px] md:text-sm font-bold uppercase tracking-widest text-slate-500 mb-3 md:mb-6">
                        Informasi Legal</h5>
                    <ul class="space-y-2.5 md:space-y-4 text-xs md:text-base font-medium text-slate-600">
                        <li class="cursor-pointer hover:text-purple-600 transition-colors">Kebijakan Privasi</li>
                        <li class="cursor-pointer hover:text-purple-600 transition-colors">Syarat & Ketentuan</li>
                        <li class="cursor-pointer hover:text-purple-600 transition-colors">Pusat Bantuan</li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-slate-300/60 pt-5 md:pt-8 flex flex-col-reverse md:flex-row items-center justify-center text-[10px] md:text-sm text-slate-500 font-medium gap-2 md:gap-4">
                <p class="text-center">&copy; 2026 Santri Code Labs. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/chat.js') }}" defer></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah di mobile (lebar < 768px)
            const isMobile = window.innerWidth < 768;

            // Inisialisasi konfigurasi ScrollReveal
            const sr = ScrollReveal({
                origin: 'bottom',
                distance: isMobile ? '20px' : '50px',
                duration: isMobile ? 800 : 1000,
                delay: isMobile ? 50 : 200,
                reset: false
            });

            // 1. Animasi untuk area Hero atas
            sr.reveal('.reveal-hero', {
                origin: 'top',
                distance: isMobile ? '15px' : '30px',
                duration: 1200
            });

            // 2. Animasi pudar berurutan halus buat teks quote, fitur, & profil kreator
            sr.reveal('.reveal-fade', {
                interval: isMobile ? 50 : 150,
                distance: isMobile ? '20px' : '40px'
            });

            // 3. Animasi kartu grid biar mencuat interaktif
            sr.reveal('.reveal-cards', {
                interval: isMobile ? 50 : 100,
                scale: 0.95,
                duration: 1100
            });
        });
    </script>
</body>

</html>
