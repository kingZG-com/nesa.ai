<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EDUPATH - Platform Pendidikan & Rasionalisasi Jurusan</title>

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="EDUPATH" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body
    class="bg-[#fafafa] text-slate-800 selection:bg-emerald-100 selection:text-emerald-900 overflow-x-hidden min-h-screen relative antialiased">

    <div
        class="absolute top-0 left-0 w-full h-screen bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(16,185,129,0.1),rgba(255,255,255,0))] pointer-events-none z-0">
    </div>

    <header
        class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-xl border-b border-slate-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
            <div class="flex items-center gap-1.5 md:gap-2 cursor-pointer">
                <span class="text-xl md:text-2xl text-emerald-600"><i class="fas fa-graduation-cap"></i></span>
                <span class="text-lg md:text-xl font-extrabold tracking-tight text-slate-900">EDUPATH</span>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <a href="#solusi"
                    class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Solusi</a>
                <a href="#fitur"
                    class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Fitur AI</a>
                <a href="#kreator"
                    class="text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors">Developer</a>
            </div>
        </div>
    </header>

    <div class="relative w-full overflow-hidden">
        <div
            class="absolute inset-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/graphy.png')] -z-10 pointer-events-none">
        </div>

        <section
            class="reveal-hero relative z-10 pt-25 md:pt-20 pb-12 md:pb-24 px-4 sm:px-6 max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12">

            <div class="flex-1 text-center lg:text-left">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-100 mb-6 mx-auto lg:mx-0">
                    <span class="text-[10px] md:text-xs font-bold text-emerald-700 uppercase tracking-widest">Platform
                        Edukasi AI Terintegrasi</span>
                </div>

                <h1
                    class="text-[2.5rem] sm:text-5xl md:text-[4.5rem] font-extrabold tracking-tight leading-[1.15] md:leading-[1.1] mb-5 md:mb-8 text-slate-950 drop-shadow-sm">
                    Akselerasi Belajar.<br />
                    <span class="text-gradient">Tanpa Batasan.</span>
                </h1>

                <p
                    class="text-sm sm:text-lg md:text-xl text-slate-600 mb-8 md:mb-12 font-medium leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Menghubungkan kecerdasan buatan dengan kebutuhan nyata sekolah. Bantu guru merancang materi ajar
                    otomatis, dan bimbing siswa merasionalisasi jurusan kuliah secara presisi.
                </p>

                <div class="relative inline-block w-full sm:w-auto">
                    <a href="{{ route('auth.google') }}" class="w-full sm:w-auto decoration-none">
                        <button type="button"
                            class="bg-gradient-premium hero-btn-guru w-full sm:w-auto cursor-pointer inline-flex items-center justify-center gap-2 px-6 py-3.5 md:px-8 md:py-4 text-white rounded-2xl font-bold text-sm md:text-base hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-google text-white"></i>
                            Mulai via Google
                        </button>
                    </a>
                </div>
            </div>
            <div class="flex-1 relative w-full max-w-lg lg:max-w-full mx-auto">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-emerald-400 to-indigo-500 rounded-[2rem] md:rounded-[3rem] transform rotate-3 scale-105 opacity-20 blur-xl">
                </div>
                <div class="relative rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-2xl border-4 border-white">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                        alt="Students and Teachers"
                        class="w-full h-[350px] md:h-[500px] object-cover hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </section>
    </div>

    <section class="reveal-fade relative z-10 max-w-6xl mx-auto px-5 sm:px-6 py-10 md:py-20 mb-4 md:mb-10">
        <div class="flex flex-col items-center text-center">
            <i class="fas fa-quote-left text-2xl md:text-4xl text-slate-200 mb-4 md:mb-6"></i>
            <h2 class="text-lg md:text-3xl font-medium text-slate-800 leading-relaxed max-w-4xl mx-auto">
                "Kisah ini berawal dari realita di kampung halaman, <span class="font-bold text-emerald-600">Desa
                    Sinanggul, Mlonggo, Jepara.</span> Kami melihat sebuah ironi: di saat dunia melesat dengan
                kecerdasan buatan, banyak guru yang energi dan waktunya justru habis tersita untuk tumpukan administrasi
                rumit. Dampaknya? Mereka kehilangan ruang untuk berinovasi, dan siswa-siswa potensial pun kehilangan
                arah karena minimnya pendampingan di era digital.
                <span class="font-bold text-slate-950">EDUPATH hadir untuk mendisrupsi batasan tersebut.</span> Kami
                membangun pusat literasi terpadu tempat Bapak/Ibu guru bisa belajar menguasai teknologi, dipadukan
                dengan asisten AI cerdas (Sistan) untuk mengeksekusi tugas repetitif. Kami mengambil alih kerumitan
                administrasi, agar pendidik bisa kembali pada esensi sejatinya: menginspirasi masa depan."
            </h2>
            <div class="w-10 md:w-12 h-1 bg-gradient-premium mx-auto mt-6 md:mt-10 rounded-full"></div>
            <p class="text-slate-500 font-medium mt-4 md:mt-6 tracking-wide uppercase text-[10px] md:text-sm">Visi
                Transformasi Akar Rumput</p>
        </div>
    </section>

    <section class="reveal-cards relative z-20 max-w-5xl mx-auto px-4 sm:px-6 -mb-8 md:-mb-12">
        <div
            class="bg-white/80 backdrop-blur-xl rounded-2xl md:rounded-3xl shadow-luxury border border-white p-5 md:p-8 grid grid-cols-2 md:grid-cols-4 gap-y-5 md:gap-y-8 gap-x-3 md:gap-x-8 text-center ring-1 ring-slate-900/5">
            <div class="pb-2 md:pb-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">100%</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-slate-400 uppercase">Kurikulum Merdeka
                </p>
            </div>
            <div class="border-l border-slate-100 pb-2 md:pb-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">AI</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-emerald-500 uppercase">Gemini
                    Terintegrasi</p>
            </div>
            <div class="border-t md:border-t-0 md:border-l border-slate-100 pt-3 md:pt-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">&lt; 3s</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-slate-400 uppercase">Generate RPP</p>
            </div>
            <div class="border-t md:border-t-0 border-l border-slate-100 pt-3 md:pt-0">
                <p class="text-2xl md:text-4xl font-extrabold text-slate-900 mb-0.5 md:mb-1">20+</p>
                <p class="text-[9px] md:text-xs font-bold tracking-widest text-indigo-500 uppercase">Prodi Terpetakan
                </p>
            </div>
        </div>
    </section>

    <section id="solusi"
        class="reveal-fade relative z-10 bg-white pt-20 md:pt-32 pb-12 md:pb-24 border-y border-slate-200/60 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-24 items-center">
            <div class="order-2 md:order-1 relative w-full max-w-sm mx-auto md:max-w-none mt-4 md:mt-0">
                <div
                    class="absolute inset-0 bg-gradient-to-tr from-emerald-100/80 to-indigo-50/80 rounded-[2rem] md:rounded-[3rem] transform -rotate-3 md:-rotate-6 scale-105 -z-10 transition-transform duration-700 hover:rotate-0">
                </div>

                <div
                    class="bg-white/60 backdrop-blur-2xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-8 shadow-luxury border border-white h-[280px] md:h-[400px] flex flex-col items-center justify-center relative overflow-hidden group cursor-pointer">
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div
                            class="w-40 md:w-64 h-40 md:h-64 border border-emerald-200/60 rounded-full animate-ping opacity-20">
                        </div>
                        <div class="w-28 md:w-48 h-28 md:h-48 border border-indigo-200/60 rounded-full animate-ping opacity-40"
                            style="animation-delay: 0.5s;"></div>
                    </div>

                    <div
                        class="relative z-10 w-16 h-16 md:w-28 md:h-28 bg-gradient-premium rounded-[1rem] md:rounded-[2rem] flex items-center justify-center text-white text-2xl md:text-5xl shadow-[0_10px_40px_-10px_rgba(16,185,129,0.6)] mb-5 md:mb-8 transform group-hover:scale-110 transition-transform duration-500">
                        <i class="fas fa-brain"></i>
                    </div>

                    <div class="relative z-10 w-full max-w-[140px] md:max-w-[200px] space-y-2 md:space-y-3">
                        <div class="h-1.5 md:h-2.5 w-full bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="h-full bg-emerald-400 w-1/2 rounded-full animate-pulse"></div>
                        </div>
                        <div class="h-1.5 md:h-2.5 w-4/5 mx-auto bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-400 w-3/4 rounded-full animate-pulse"
                                style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>

                    <div class="absolute top-5 md:top-10 left-3 md:left-6 bg-white px-2.5 md:px-4 py-1 md:py-2 rounded-lg md:rounded-2xl shadow-lg border border-slate-100 flex items-center gap-1.5 md:gap-2 transform -rotate-6 group-hover:rotate-0 transition-transform duration-300 animate-bounce"
                        style="animation-duration: 3s;">
                        <i class="fas fa-file-alt text-emerald-500 text-[10px] md:text-sm"></i>
                        <span class="text-[9px] md:text-xs font-extrabold text-slate-700">Auto RPP</span>
                    </div>
                    <div class="absolute bottom-6 md:bottom-12 right-3 md:right-6 bg-white px-2.5 md:px-4 py-1 md:py-2 rounded-lg md:rounded-2xl shadow-lg border border-slate-100 flex items-center gap-1.5 md:gap-2 transform rotate-6 group-hover:rotate-0 transition-transform duration-300 animate-bounce"
                        style="animation-duration: 3.5s; animation-delay: 0.5s;">
                        <i class="fas fa-university text-indigo-500 text-[10px] md:text-sm"></i>
                        <span class="text-[9px] md:text-xs font-extrabold text-slate-700">Rasionalisasi PTN</span>
                    </div>
                </div>
            </div>

            <div class="order-1 md:order-2 px-1">
                <div
                    class="inline-flex items-center gap-1.5 md:gap-2 px-3 py-1 md:py-1.5 rounded-full bg-emerald-50 border border-emerald-100 mb-3 md:mb-6">
                    <i class="fas fa-sparkles text-emerald-500 text-[9px] md:text-xs"></i>
                    <span class="text-[9px] md:text-xs font-bold text-emerald-700 uppercase tracking-wider">Powered by
                        LLM</span>
                </div>

                <h2
                    class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-6 leading-[1.2] md:leading-[1.15] tracking-tight">
                    Lebih dari Sekadar Web.<br>Ini <span class="text-gradient">Otak Pendidikan Anda.</span>
                </h2>
                <p class="text-slate-500 text-sm md:text-lg leading-relaxed font-medium mb-5 md:mb-8">
                    Tinggalkan metode administrasi dan tebak-tebakan manual. Platform ini memproses instruksi berbasis
                    <span class="font-bold text-slate-700">bahasa natural</span> untuk menghasilkan dokumen ajar dan
                    rekomendasi jurusan dalam hitungan detik.
                </p>

                <ul class="space-y-1 md:space-y-3">
                    <li
                        class="flex items-start gap-3 md:gap-4 p-2.5 md:p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors cursor-pointer group">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chalkboard text-[10px] md:text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-slate-900 font-bold mb-0.5 md:mb-1 text-sm md:text-base">Otomatisasi
                                Administrasi Guru</h5>
                            <p class="text-[11px] md:text-sm font-medium text-slate-500 leading-snug">Generate RPP,
                                Modul Ajar, dan Soal HOTS berstandar Kurikulum Merdeka secara instan.</p>
                        </div>
                    </li>
                    <li
                        class="flex items-start gap-3 md:gap-4 p-2.5 md:p-4 rounded-2xl hover:bg-slate-50 border border-transparent hover:border-slate-100 transition-colors cursor-pointer group">
                        <div
                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chart-line text-[10px] md:text-sm"></i>
                        </div>
                        <div>
                            <h5 class="text-slate-900 font-bold mb-0.5 md:mb-1 text-sm md:text-base">Pemetaan Potensi
                                Siswa</h5>
                            <p class="text-[11px] md:text-sm font-medium text-slate-500 leading-snug">Analisis histori
                                nilai rapor dan minat bakat untuk merasionalisasi peluang masuk perguruan tinggi.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section id="fitur" class="reveal-fade relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-24">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-3xl h-64 bg-slate-100/50 rounded-full blur-[120px] pointer-events-none z-0">
        </div>

        <div class="text-center mb-10 md:mb-20 relative z-10 px-1">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-5 tracking-tight">
                Standar Kualitas <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-indigo-600">Enterprise.</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-xl max-w-2xl mx-auto">
                Infrastruktur andal yang memastikan proses akademik dan bimbingan konseling berjalan mulus tanpa kendala
                teknis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-8 relative z-10">
            <div
                class="bg-white/80 backdrop-blur-xl p-6 md:p-12 rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-200/60 hover:-translate-y-1.5 md:hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 cursor-pointer group relative overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 md:-top-24 md:-right-24 w-40 h-40 md:w-48 md:h-48 bg-emerald-100/60 rounded-full blur-[50px] group-hover:bg-emerald-200/80 transition-colors duration-500">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-0 h-1 md:h-1.5 bg-gradient-to-r from-emerald-500 to-emerald-400 group-hover:w-full transition-all duration-700 ease-out">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-[1.25rem] bg-white border border-emerald-100 shadow-[0_8px_16px_-6px_rgba(16,185,129,0.3)] flex items-center justify-center text-emerald-600 text-lg md:text-2xl mb-4 md:mb-8 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Prompt Natural</h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Gunakan frasa seperti <span class="text-slate-700 font-semibold">"Buatkan soal ekonomi inflasi
                            kelas 11"</span>, dan AI akan meraciknya langsung sesuai standar kognitif.
                    </p>
                </div>
            </div>

            <div
                class="bg-white/80 backdrop-blur-xl p-6 md:p-12 rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-200/60 hover:-translate-y-1.5 md:hover:-translate-y-3 hover:shadow-2xl transition-all duration-500 cursor-pointer group relative overflow-hidden">
                <div
                    class="absolute -top-20 -right-20 md:-top-24 md:-right-24 w-40 h-40 md:w-48 md:h-48 bg-indigo-100/60 rounded-full blur-[50px] group-hover:bg-indigo-200/80 transition-colors duration-500">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-0 h-1 md:h-1.5 bg-gradient-to-r from-indigo-500 to-indigo-400 group-hover:w-full transition-all duration-700 ease-out">
                </div>

                <div class="relative z-10">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 rounded-xl md:rounded-[1.25rem] bg-white border border-indigo-100 shadow-[0_8px_16px_-6px_rgba(79,70,229,0.3)] flex items-center justify-center text-indigo-600 text-lg md:text-2xl mb-4 md:mb-8 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-500">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Analisis Akurat</h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Algoritma mencocokkan <span class="text-slate-700 font-semibold">tren nilai historis
                            siswa</span> dengan ribuan database keketatan program studi kampus nasional.
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
                        <i class="fas fa-server"></i>
                    </div>
                    <h3 class="text-lg md:text-2xl font-extrabold text-slate-900 mb-2 md:mb-4">Infrastruktur Andal</h3>
                    <p class="text-slate-500 leading-relaxed font-medium text-xs md:text-lg">
                        Berdiri di atas server berkinerja tinggi, menjamin penyajian data modul atau hasil analisis
                        dalam durasi kurang dari <span class="text-slate-700 font-semibold">3 detik</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="reveal-fade relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-12 md:py-24 mb-6 md:mb-12">
        <div class="text-center mb-10 md:mb-20 relative z-10">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-6 tracking-tight">
                Dokumen Instan <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-indigo-500">Siap
                    Ekspor</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-xl max-w-2xl mx-auto px-2">
                Tidak perlu *copy-paste* berantakan. AI menyusun hasilnya dalam format terstruktur yang siap diunduh dan
                dipresentasikan.
            </p>
        </div>

        <div
            class="bg-white rounded-[1.5rem] md:rounded-[3rem] p-6 sm:p-8 md:p-14 border border-slate-200/80 shadow-luxury hover:shadow-2xl hover:border-emerald-200 transition-all duration-500 cursor-pointer group relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6 md:gap-12">
            <div
                class="absolute -right-20 -top-20 md:-right-32 md:-top-32 w-[15rem] md:w-[30rem] h-[15rem] md:h-[30rem] bg-emerald-100/40 rounded-full blur-[60px] md:blur-[100px] pointer-events-none group-hover:bg-emerald-200/50 transition-colors duration-700">
            </div>

            <div class="relative z-10 flex-1 w-full text-center md:text-left">
                <div
                    class="w-12 h-12 md:w-16 md:h-16 rounded-[1rem] md:rounded-[1.25rem] bg-emerald-50 flex items-center justify-center text-emerald-500 text-xl md:text-3xl mb-4 md:mb-8 mx-auto md:mx-0 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 shadow-sm border border-emerald-100">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <h4 class="text-xl sm:text-2xl md:text-4xl font-extrabold text-slate-900 mb-3 md:mb-5">Smart Document
                    Generator</h4>
                <p
                    class="text-slate-500 text-xs sm:text-sm md:text-lg font-medium max-w-lg mx-auto md:mx-0 leading-relaxed">
                    Baik Anda seorang guru yang mencetak <span class="text-slate-800 font-bold">RPP Kurikulum
                        Merdeka</span>, atau siswa yang menyimpan <span class="text-slate-800 font-bold">Laporan
                        Analisis Jurusan</span>, semuanya otomatis diformat menjadi PDF.
                </p>
            </div>

            <div
                class="relative z-10 w-full md:w-5/12 flex items-center justify-center min-h-[120px] md:min-h-[150px]">
                <div class="relative w-full max-w-[15rem] md:max-w-sm">
                    <div
                        class="bg-indigo-600 text-white p-2.5 md:p-4 rounded-[1rem] md:rounded-2xl rounded-tr-sm shadow-lg transform group-hover:-translate-y-1 md:group-hover:-translate-y-2 group-hover:-translate-x-1 md:group-hover:-translate-x-2 transition-transform duration-500 mb-2 md:mb-4 w-10/12 ml-auto relative z-10">
                        <p class="text-[10px] md:text-sm font-medium leading-tight">Edupath, tolong buatkan RPP Ekonomi
                            Kelas 10 bab Kelangkaan lengkap dengan asesmen.</p>
                    </div>
                    <div
                        class="bg-white border border-slate-100 text-slate-700 p-2.5 md:p-4 rounded-[1rem] md:rounded-2xl rounded-tl-sm shadow-md transform group-hover:translate-y-1 md:group-hover:translate-y-2 group-hover:translate-x-1 md:group-hover:translate-x-2 transition-transform duration-500 w-9/12 mr-auto delay-100 relative z-0">
                        <p class="text-[10px] md:text-sm font-medium leading-tight">Selesai! RPP format Kurikulum
                            Merdeka telah disiapkan. Klik tautan ini untuk mengunduh PDF. 📄✨</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="relative py-8 md:py-0">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-64 bg-emerald-100/50 rounded-full blur-[100px] pointer-events-none z-0">
        </div>

        <div class="reveal-fade text-center mb-10 md:mb-20 relative z-10 px-4 sm:px-6">
            <h2 class="text-[1.75rem] md:text-5xl font-extrabold text-slate-950 mb-3 md:mb-5 tracking-tight">
                Alur Operasional <span class="text-gradient">Cerdas</span>
            </h2>
            <p class="text-slate-500 font-medium text-sm md:text-lg max-w-2xl mx-auto">
                Konsep tiga langkah minimalis untuk resolusi maksimal. Sederhana bagi pemula, *powerful* bagi
                profesional.
            </p>
        </div>

        <div
            class="reveal-cards grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-10 relative max-w-6xl mx-auto z-10 px-4 sm:px-6">
            <div class="hidden md:block absolute top-[5.5rem] left-[15%] right-[15%] h-[2px] bg-slate-200/60 z-0">
                <div
                    class="absolute top-0 left-0 h-full w-2/3 bg-gradient-to-r from-emerald-400 to-indigo-400 opacity-60 animate-pulse">
                </div>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white/80 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-100 hover:shadow-2xl hover:border-emerald-200 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer">
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-slate-50 border-4 md:border-8 border-white shadow-md flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 rounded-full bg-emerald-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span
                        class="text-xl md:text-3xl font-extrabold text-slate-300 group-hover:text-emerald-600 relative z-10 transition-colors">1</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4">Input Data / Prompt</h4>
                <p class="text-slate-500 font-medium leading-relaxed text-xs md:text-base">
                    Guru memasukkan instruksi materi pelajaran, atau siswa mengunggah riwayat nilai rapor dan minat
                    mereka.
                </p>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white/80 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2.5rem] shadow-luxury border border-slate-100 hover:shadow-2xl hover:border-indigo-200 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer">
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-slate-50 border-4 md:border-8 border-white shadow-md flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute inset-0 rounded-full bg-indigo-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <span
                        class="text-xl md:text-3xl font-extrabold text-slate-300 group-hover:text-indigo-600 relative z-10 transition-colors">2</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4">Pemrosesan Kognitif AI</h4>
                <p class="text-slate-500 font-medium leading-relaxed text-xs md:text-base">
                    Sistem menganalisis data menggunakan LLM terkalibrasi khusus untuk kurikulum dan database PTN
                    Indonesia.
                </p>
            </div>

            <div
                class="relative z-10 flex flex-col items-center text-center p-6 md:p-10 bg-white rounded-[1.5rem] md:rounded-[2.5rem] shadow-2xl border border-emerald-100 hover:border-emerald-300 transition-all duration-500 hover:-translate-y-1 md:hover:-translate-y-3 group cursor-pointer overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-indigo-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                </div>
                <div
                    class="w-16 h-16 md:w-24 md:h-24 rounded-full bg-gradient-to-r from-emerald-600 to-indigo-600 border-4 md:border-8 border-white shadow-lg shadow-emerald-500/30 flex items-center justify-center mb-4 md:mb-8 relative group-hover:scale-110 transition-transform duration-500">
                    <span class="text-xl md:text-3xl font-extrabold text-white relative z-10">3</span>
                </div>
                <h4 class="text-lg md:text-2xl font-bold text-slate-900 mb-2 md:mb-4 relative z-10">Hasil Komprehensif
                </h4>
                <p class="text-slate-500 font-medium leading-relaxed relative z-10 text-xs md:text-base">
                    Dapatkan modul siap pakai (untuk guru) atau persentase lolos jurusan beserta sarannya (untuk siswa).
                </p>
            </div>
        </div>
    </div>

    <section id="kreator" class="reveal-fade relative z-10 max-w-6xl mx-auto px-4 sm:px-6 py-16 md:py-28">
        {{-- Glow di luar card --}}
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[80%] h-[80%] bg-gradient-to-tr from-emerald-400/20 via-indigo-300/20 to-teal-300/20 rounded-[3rem] blur-[120px] pointer-events-none z-0">
        </div>

        {{-- Main Card (Glassmorphism Light) --}}
        <div
            class="bg-white/70 backdrop-blur-2xl rounded-[2rem] md:rounded-[3rem] p-6 md:p-14 border border-white/80 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden relative group">
            
            {{-- Inner Glows --}}
            <div
                class="absolute -left-32 -bottom-32 w-[25rem] md:w-[40rem] h-[25rem] md:h-[40rem] bg-gradient-to-tr from-emerald-300/30 to-teal-200/30 rounded-full blur-[80px] md:blur-[120px] pointer-events-none transition-transform duration-1000 group-hover:scale-110">
            </div>
            <div
                class="absolute -right-20 -top-20 w-[15rem] md:w-[25rem] h-[15rem] md:h-[25rem] bg-gradient-to-br from-indigo-200/30 to-emerald-200/30 rounded-full blur-[80px] pointer-events-none transition-transform duration-1000 group-hover:scale-110">
            </div>

            <div class="relative z-10 flex flex-col xl:flex-row items-center justify-between gap-10 xl:gap-16">
                
                {{-- Bagian Avatar --}}
                <div class="flex-shrink-0 relative group/avatar">
                    <div
                        class="absolute inset-0 rounded-full bg-gradient-to-tr from-emerald-400 via-teal-400 to-indigo-400 blur-[12px] opacity-40 group-hover/avatar:opacity-70 group-hover/avatar:rotate-180 transition-all duration-700">
                    </div>
                    <div
                        class="relative w-32 h-32 md:w-48 md:h-48 rounded-full p-1.5 bg-gradient-to-tr from-emerald-400 via-teal-400 to-indigo-400 shadow-xl transform group-hover/avatar:scale-105 transition-all duration-500 flex items-center justify-center overflow-hidden">
                        <div
                            class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden ring-4 ring-white">
                            <img src="{{ asset('storage/shofi.webp') }}" alt="Achmad Shofi Zakaria"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover/avatar:scale-110 filter contrast-105">
                        </div>
                    </div>
                    
                    {{-- Badge Santri Code --}}
                    <div
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-white text-emerald-800 px-4 py-1.5 md:px-5 md:py-2 rounded-full text-[9px] md:text-[11px] font-black tracking-widest uppercase shadow-md border border-slate-100 flex items-center gap-2 whitespace-nowrap group-hover/avatar:-translate-y-1 transition-transform">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_8px_rgba(16,185,129,0.6)]"></span>
                        Santri Code
                    </div>
                </div>

                {{-- Bagian Teks & Info --}}
                <div class="flex-1 text-center xl:text-left w-full">
                    
                    {{-- Role Badge --}}
                    <div
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 mb-4 md:mb-5 shadow-sm">
                        <i class="fas fa-code-branch text-emerald-500 text-xs"></i>
                        <span
                            class="text-[10px] md:text-[11px] font-extrabold tracking-widest text-emerald-700 uppercase">Lead
                            Software Architect & AI Engineer</span>
                    </div>

                    {{-- Nama --}}
                    <h3
                        class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-slate-800 mb-4 tracking-tight leading-tight">
                        Didesain & Dibangun Oleh<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 via-teal-500 to-indigo-600">Achmad
                            Shofi Zakaria</span>
                    </h3>

                    {{-- Deskripsi --}}
                    <p
                        class="text-slate-600 text-sm md:text-base leading-relaxed font-medium mb-6 md:mb-8 max-w-2xl mx-auto xl:mx-0">
                        Mahasiswa Universitas Negeri Semarang (UNNES) & kompetitor <span
                            class="text-slate-800 font-extrabold">Google Developer Competition 2026</span>. Membangun
                        teknologi dari akar rumput untuk memecahkan problem pendidikan nyata di Indonesia.
                    </p>

                    {{-- Tech Stack Pills --}}
                    <div
                        class="flex flex-wrap justify-center xl:justify-start gap-2 mb-8 md:mb-10 w-full max-w-3xl mx-auto xl:mx-0">
                        
                        {{-- Baris 1: Core Backend, DB & Security --}}
                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full mb-1">
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fab fa-laravel text-red-500 mr-1.5"></i>Laravel 13</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fab fa-php text-indigo-500 mr-1.5"></i>PHP 8.3</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-database text-blue-600 mr-1.5"></i>PostgreSQL</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-shield-alt text-slate-700 mr-1.5"></i>Middleware Security</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-vial text-green-500 mr-1.5"></i>PHPUnit</span>
                        </div>
                        
                        {{-- Baris 2: Frontend, JS & Build Tools --}}
                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full mb-1">
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fab fa-js text-yellow-500 mr-1.5"></i>JavaScript (ES6+)</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fab fa-css3-alt text-cyan-500 mr-1.5"></i>Tailwind v4</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-bolt text-yellow-500 mr-1.5"></i>Vite 8</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-cogs text-orange-400 mr-1.5"></i>PostCSS</span>
                        </div>

                        {{-- Baris 3: Realtime WebSockets & UI Library --}}
                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full mb-1">
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-satellite-dish text-rose-500 mr-1.5"></i>Laravel Reverb</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-plug text-indigo-400 mr-1.5"></i>Echo & Pusher JS</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-comment-dots text-pink-500 mr-1.5"></i>SweetAlert2</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-eye text-teal-500 mr-1.5"></i>ScrollReveal</span>
                        </div>
                        
                        {{-- Baris 4: Core Integrations, Generator & AI --}}
                        <div class="flex flex-wrap justify-center xl:justify-start gap-2 w-full">
                            <span
                                class="px-3 py-1.5 bg-gradient-to-r from-emerald-600 to-indigo-600 border border-transparent rounded-lg text-[10px] md:text-xs font-bold text-white shadow-md hover:-translate-y-0.5 transition-all"><i
                                    class="fas fa-robot mr-1.5 text-emerald-100"></i>Gemini LLM</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fab fa-google text-blue-500 mr-1.5"></i>Google Identity Services</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-file-pdf text-red-600 mr-1.5"></i>DOMPDF</span>
                            <span
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] md:text-xs font-bold text-slate-600 shadow-sm hover:-translate-y-0.5 hover:border-emerald-300 hover:text-emerald-600 transition-all"><i
                                    class="fas fa-file-word text-blue-600 mr-1.5"></i>PHPWord</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row items-center justify-center xl:justify-start gap-4">
                        <a href="mailto:zakariashofi24@gmail.com"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-6 py-3.5 bg-emerald-500 border border-slate-200 text-white rounded-xl text-xs md:text-sm font-bold hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-600 transition-all cursor-pointer shadow-sm">
                            <i class="far fa-envelope text-base"></i> Kolaborasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="relative bg-white pt-12 md:pt-20 pb-6 md:pb-10 border-t border-slate-200 overflow-hidden">
        <div
            class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/graphy.png')] pointer-events-none z-0">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 mb-10 md:mb-16">
                <div class="md:col-span-5 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2.5 mb-4 md:mb-6 cursor-pointer">
                        <span class="text-2xl md:text-3xl text-emerald-600"><i
                                class="fas fa-graduation-cap"></i></span>
                        <span class="text-xl md:text-2xl font-extrabold tracking-tight text-slate-900">EDUPATH</span>
                    </div>
                    <p
                        class="text-slate-600 text-xs md:text-base leading-relaxed font-medium mb-6 md:mb-8 max-w-sm mx-auto md:mx-0">
                        Mendigitalisasi pendidikan Indonesia. Dari Sinanggul, Jepara, untuk ekosistem belajar yang lebih
                        cerdas dan efisien.
                    </p>
                    <a href="#"
                        class="cursor-pointer inline-flex items-center gap-2 px-5 py-2.5 md:px-6 md:py-3 bg-slate-900 text-white rounded-full font-bold text-xs md:text-sm hover:bg-slate-800 transition-all shadow-md hover:shadow-slate-900/20">
                        Coba Gratis
                    </a>
                </div>

                <div class="md:col-span-3 md:col-start-8 text-center md:text-left mt-4 md:mt-0">
                    <h5 class="text-[10px] md:text-sm font-bold uppercase tracking-widest text-slate-400 mb-3 md:mb-6">
                        Layanan</h5>
                    <ul class="space-y-2.5 md:space-y-4 text-xs md:text-base font-medium text-slate-600">
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Modul AI Guru</a></li>
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Rasionalisasi PTN</a>
                        </li>
                        <li><a href="#" class="hover:text-emerald-600 transition-colors">Analisis Rapor</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2 text-center md:text-left mt-4 md:mt-0">
                    <h5 class="text-[10px] md:text-sm font-bold uppercase tracking-widest text-slate-400 mb-3 md:mb-6">
                        Legalitas</h5>
                    <ul class="space-y-2.5 md:space-y-4 text-xs md:text-base font-medium text-slate-600">
                        <li class="cursor-pointer hover:text-emerald-600 transition-colors">Kebijakan Privasi</li>
                        <li class="cursor-pointer hover:text-emerald-600 transition-colors">Syarat Ketentuan</li>
                        <li class="cursor-pointer hover:text-emerald-600 transition-colors">Hubungi Kami</li>
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-slate-200 pt-5 md:pt-8 flex flex-col md:flex-row items-center justify-center text-[10px] md:text-sm text-slate-500 font-medium gap-4 ">
                <p>&copy; 2026 Santri Code Labs. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>
</body>

</html>
