<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $curriculum = [
            // KELAS DASAR
            [
                'level' => 'Kelas Dasar: Fondasi AI',
                'badge_color' => 'bg-emerald-100/80 text-emerald-700',
                'icon' => 'fas fa-robot',
                'icon_color' => 'text-emerald-500 bg-emerald-50 ring-emerald-200',
                'title' => 'Modul 1: Introduction to AI in Education',
                'subtitle' => 'Pengantar AI dalam Pendidikan',
                'image' => 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Evolusi Edukasi: Dari Era Papan Tulis Kapur ke Era Kecerdasan Buatan.',
                    'Membedah Otak AI: Bagaimana LLM (Large Language Models) Bekerja Memahami Teks?',
                    'Mengenal Raksasa AI: Perbandingan ChatGPT, Gemini, dan Claude untuk Kebutuhan Guru.',
                    'Mitos dan Ketakutan: Akankah AI Menggantikan Peran Pendidik di Masa Depan?',
                    'Etika Dasar AI: Memahami Bias, "Halusinasi" Mesin, dan Batasan Sistem.',
                    'Privasi Data Sekolah: Apa yang Boleh dan Dilarang Keras Diinput ke Platform AI.',
                    'Glosarium AI: Memahami Istilah Prompt, Token, Parameter, dan Context Window.',
                    'Mindset Guru 4.0: Mengubah Peran dari Sekadar "Pengajar" Menjadi "Fasilitator".',
                    'Peta Ekosistem Edu-Tech: Eksplorasi Tools AI Populer Spesifik untuk Pendidikan Dasar & Menengah.',
                    'Live Demo: Melihat Keajaiban AI Menyelesaikan Tugas Administrasi dalam 5 Detik.'
                ]
            ],
            [
                'level' => 'Kelas Dasar: Fondasi AI',
                'badge_color' => 'bg-emerald-100/80 text-emerald-700',
                'icon' => 'fas fa-magic',
                'icon_color' => 'text-emerald-500 bg-emerald-50 ring-emerald-200',
                'title' => 'Modul 2: The Art of Prompt Engineering',
                'subtitle' => 'Seni Menyusun Perintah AI',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Anatomi Prompt Sempurna: Rumus Ampuh (Konteks + Tugas + Format + Persona).',
                    'Teknik Zero-Shot vs Few-Shot Prompting untuk Mendapatkan Hasil yang Sangat Presisi.',
                    'Membangun "Persona" AI: Mengubah AI Menjadi Pakar Mata Pelajaran Spesifik.',
                    'Strategi Iterasi: Memperbaiki dan Menyempurnakan Jawaban AI yang Kurang Tepat.',
                    'Reverse Prompting: Meminta AI Menginterogasi, Mewawancarai, dan Menguji Anda.',
                    'Menggunakan Delimiter (Karakter Pemisah) untuk Mencegah Kebingungan Otak AI.',
                    'Meminta Output Terstruktur: Cara AI Menghasilkan Tabel, Format JSON, Markdown, dan CSV.',
                    'Menghindari Prompt Bias: Menyaring Jawaban AI agar Netral dan Objektif.',
                    'Menguasai Chain of Thought Prompting untuk Memecahkan Soal/Masalah Rumit secara Bertahap.',
                    'Bedah Kasus: Mengubah Prompt Gagal Menjadi Prompt Sukses (Studi Kasus Guru).'
                ]
            ],
            // KELAS MENENGAH
            [
                'level' => 'Kelas Menengah: Produktivitas',
                'badge_color' => 'bg-indigo-100/80 text-indigo-700',
                'icon' => 'fas fa-file-alt',
                'icon_color' => 'text-indigo-500 bg-indigo-50 ring-indigo-200',
                'title' => 'Modul 3: Pabrik Administrasi Kurmer',
                'subtitle' => 'Otomatisasi Berkas Kurikulum Merdeka',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Ekstraksi Capaian Pembelajaran (CP) Menjadi Tujuan Pembelajaran (TP & ATP) Otomatis.',
                    'Merancang Modul Ajar (RPP Plus) 1 Lembar Super Kilat dan Terstruktur.',
                    'Menyusun Program Tahunan (Prota) Berbasis Analisis Kalender Akademik.',
                    'Membuat Program Semester (Promes) Tanpa Pusing Menghitung Minggu Efektif.',
                    'Generator Bahan Bacaan Siswa Berdasarkan Tingkat Literasi (Penyesuaian Kosakata).',
                    'Merancang Lembar Kerja Peserta Didik (LKPD) yang Interaktif dan Memicu Kreativitas.',
                    'Menyusun Rubrik Penilaian Proyek P5 (Profil Pelajar Pancasila) dengan Indikator Akurat.',
                    'Adaptasi Modul Ajar untuk Pembelajaran Berdiferensiasi (Kesiapan, Minat, Gaya Belajar).',
                    'Membuat Penyesuaian Modul Khusus untuk Anak Berkebutuhan Khusus (Pendidikan Inklusi).',
                    'Dokumentasi Akreditasi: Menyusun Narasi Laporan Kinerja Guru dengan Bantuan AI.'
                ]
            ],
            [
                'level' => 'Kelas Menengah: Produktivitas',
                'badge_color' => 'bg-indigo-100/80 text-indigo-700',
                'icon' => 'fas fa-tasks',
                'icon_color' => 'text-indigo-500 bg-indigo-50 ring-indigo-200',
                'title' => 'Modul 4: Revolusi Evaluasi & Asesmen',
                'subtitle' => 'Pembuatan Soal HOTS & Kisi-kisi',
                'image' => 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Fundamental HOTS: Berpindah dari Hafalan (C1-C3) Menuju Analisis (C4-C6) Taksonomi Bloom.',
                    'Prompting Spesifik untuk Menghasilkan Soal Analitis Taraf HOTS Secara Otomatis.',
                    'Membuat Distractor (Pengecoh) Pilihan Ganda yang Logis, Kredibel, dan Tidak Sembarangan.',
                    'Menulis Skenario dan Studi Kasus Berbasis Isu Lokal untuk Soal Cerita yang Relatable.',
                    'Generator Soal AKM (Asesmen Kompetensi Minimum): Fokus Literasi dan Numerasi.',
                    'Membuat Soal Esai Terstruktur Beserta Kriteria Penilaian Berjenjang.',
                    'Validasi dan Analisis Kualitas Butir Soal (Tingkat Kesukaran & Daya Beda) dengan AI.',
                    'Pembuatan Soal Remedial dan Materi Pengayaan Secara Otomatis dalam 1 Klik.',
                    'Translasi Soal Berbahasa Indonesia ke Format Bilingual/Bahasa Asing untuk Kelas Internasional.',
                    'Menyusun Format Cetak Kisi-Kisi Ujian Siap Pakai untuk Diserahkan ke Kurikulum.'
                ]
            ],
            [
                'level' => 'Kelas Menengah: Produktivitas',
                'badge_color' => 'bg-indigo-100/80 text-indigo-700',
                'icon' => 'fas fa-photo-video',
                'icon_color' => 'text-indigo-500 bg-indigo-50 ring-indigo-200',
                'title' => 'Modul 5: Inovasi Media Pembelajaran',
                'subtitle' => 'Konten Interaktif & Menarik',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Mengubah Teks Buku Paket yang Membosankan Menjadi Skrip Drama Kelas / Roleplay.',
                    'Menyusun Outline Presentasi (Slide) yang Estetik, Konseptual, dan Terstruktur.',
                    'Prompts Rahasia untuk AI Image Generator (Midjourney/DALL-E) Khusus Ilustrasi Edukasi.',
                    'Merancang Kasus Problem-Based Learning (PBL) Sesuai Konteks Daerah (Contoh: Ekonomi Pesisir).',
                    'Gamifikasi Kelas: Meminta AI Membuat Teka-Teki Silang, Bingo, dan Kuis Trivia Cerdas.',
                    'Menciptakan Lirik Lagu, Puisi, atau Jembatan Keledai (Mnemonic) untuk Menghafal Materi Sulit.',
                    'Skenario Escape Room Virtual Berbasis Teks Menggunakan Bantuan Alur AI.',
                    'Membuat Bahan Ajar Microlearning untuk Konsumsi Media Sosial (TikTok/Reels Edukasi).',
                    'Merancang Project-Based Learning (PjBL) Multidisipliner Lintas Mata Pelajaran.',
                    'Storytelling Pendidikan: Meminta AI Menulis Cerita Fabel atau Fiksi dengan Pesan Moral Spesifik.'
                ]
            ],
            // KELAS LANJUTAN
            [
                'level' => 'Kelas Lanjutan: Analisis Siswa',
                'badge_color' => 'bg-blue-100/80 text-blue-700',
                'icon' => 'fas fa-chart-pie',
                'icon_color' => 'text-blue-500 bg-blue-50 ring-blue-200',
                'title' => 'Modul 6: AI untuk Bimbingan Konseling',
                'subtitle' => 'Rasionalisasi PTN & Potensi',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Pengantar Data Science Sederhana: Membaca Angka Menjadi Pola Potensi Siswa.',
                    'Teknik Membersihkan dan Menyiapkan Data Nilai Rapor Siswa Semester 1-5 untuk Diinput ke AI.',
                    'Prompting Prediksi Rasionalisasi SNBP Berdasarkan Tren Nasional dan Keketatan Jurusan.',
                    'Menggali Insight Kekuatan Akademik Tersembunyi Siswa dari Data Nilai Mentah.',
                    'Merancang Pertanyaan Tes Minat Bakat (Holland Code/RIASEC) Sederhana dengan AI.',
                    'Menyusun Rekomendasi Jurusan Alternatif yang Underrated namun Memiliki Prospek Tinggi.',
                    'Menyusun Rencana Cadangan (Plan B) Terarah untuk Persiapan SNBT/Ujian Mandiri.',
                    'Meminta AI Membuat Skenario Percakapan Konseling Karir untuk Anak yang Bingung/Demotivasi.',
                    'Analisis Komprehensif: Mencocokkan Jurusan dengan Kepribadian dan Kondisi Finansial Keluarga.',
                    'Memproduksi Laporan Profil Potensi Siswa Secara Massal untuk Dibagikan ke Orang Tua.'
                ]
            ],
            [
                'level' => 'Kelas Lanjutan: Analisis Siswa',
                'badge_color' => 'bg-blue-100/80 text-blue-700',
                'icon' => 'fas fa-users',
                'icon_color' => 'text-blue-500 bg-blue-50 ring-blue-200',
                'title' => 'Modul 7: Manajemen Kelas Humanis',
                'subtitle' => 'Komunikasi & Psikologi AI',
                'image' => 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Generator Narasi Evaluasi Rapor yang Positif, Personal, dan Tidak Kelihatan Template.',
                    'Teknik Menulis Email atau Surat Undangan Panggilan Wali Murid dengan Nada Empatik.',
                    'Simulasi Resolusi Konflik: Meminta Saran Strategi AI Menghadapi Siswa Tantrum/Bermasalah.',
                    'Menyusun Naskah Ice Breaking dan Motivasi Pagi Harian yang Segar dan Relevan.',
                    'Merancang Tata Tertib Kelas yang Kolaboratif, Menggunakan Kalimat Positif (Bukan Larangan).',
                    'Membuat Skenario dan Kalender Cek Kesehatan Mental (Mental Health Check-in) Mingguan.',
                    'Strategi Mitigasi dan Intervensi Kasus Bullying Berdasarkan Panduan Psikologi via AI.',
                    'Trik Merespon Keluhan atau Kemarahan Orang Tua Siswa Secara Profesional dan Diplomatis.',
                    'Skenario Sesi Circle Time untuk Meningkatkan Kecerdasan Emosional (EQ) Siswa.',
                    'Mengelola Kelelahan Guru (Burnout): Meminta AI Menjadi Mitra Diskusi Profesional.'
                ]
            ],
            // KELAS MASTER
            [
                'level' => 'Kelas Master: Profesional',
                'badge_color' => 'bg-purple-100/80 text-purple-700',
                'icon' => 'fas fa-microscope',
                'icon_color' => 'text-purple-500 bg-purple-50 ring-purple-200',
                'title' => 'Modul 8: Akselerasi PTK & Jurnal',
                'subtitle' => 'Penelitian Tindakan Kelas',
                'image' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Brainstorming Ide Judul PTK yang Valid Berdasarkan Permasalahan Nyata di Kelas Anda.',
                    'Merumuskan Latar Belakang Masalah Secara Tajam, Terstruktur, dan Akademis.',
                    'Trik Mencari dan Merangkum Literatur Teori / Kajian Pustaka Pendukung dengan Cepat.',
                    'Menyusun Kerangka Metodologi Penelitian Secara Sistematis (Siklus 1, Siklus 2, dst).',
                    'Membuat Instrumen Penelitian Sekejap (Lembar Observasi, Kuesioner, Pedoman Wawancara).',
                    'Membantu Menganalisis Data Hasil Penelitian (Statistik Deskriptif Dasar via AI).',
                    'Menggunakan AI sebagai Proofreader Tangguh dan Editor Tata Bahasa Akademik Baku.',
                    'Teknik Parafrase Etis Menggunakan AI agar Teks Terhindar dari Deteksi Plagiarisme (Turnitin).',
                    'Merumuskan Kesimpulan dan Saran Penelitian yang Actionable Secara Komprehensif.',
                    'Mengubah Format Laporan PTK Menjadi Artikel Jurnal Ringkas yang Siap Publikasi.'
                ]
            ],
            [
                'level' => 'Kelas Master: Profesional',
                'badge_color' => 'bg-purple-100/80 text-purple-700',
                'icon' => 'fas fa-shield-alt',
                'icon_color' => 'text-purple-500 bg-purple-50 ring-purple-200',
                'title' => 'Modul 9: Menghadapi Gen-Z',
                'subtitle' => 'Integritas Akademik di Era Digital',
                'image' => 'https://images.unsplash.com/photo-1526948531399-320e7ae40f1f?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Psikologi Gen-Z: Memahami Alasan dan Cara Siswa Memanfaatkan AI untuk Mengerjakan Tugas.',
                    'Mitigasi Risiko: Cara Cerdas Mengatasi "Tsunami" Tugas Hasil Copy-Paste Mentah dari ChatGPT.',
                    'Anatomi AI Detector: Kelebihan, Kekurangan, dan Bahaya Tuduhan False-Positive pada Siswa.',
                    'Mendesain Penugasan "Kebal AI": Merancang Tugas Berbasis Observasi Fisik, Wawancara, dan Empati.',
                    'Menyusun SOP dan Kebijakan Penggunaan AI yang Adil dan Transparan di Lingkungan Sekolah.',
                    'Menggeser Paradigma: Mengintegrasikan AI ke Dalam "Proses" Penilaian, Bukan Sekadar "Hasil Akhir".',
                    'Mengajarkan Literasi AI Kepada Siswa: Membimbing Mereka Menjadi Pengguna yang Kritis dan Beretika.',
                    'Diskusi Bias Algoritma: Menyadarkan Siswa tentang Bahaya Rasisme/Seksisme yang Tersembunyi dalam AI.',
                    'Plagiarisme 2.0: Mendefinisikan Ulang Makna "Menyontek" dan "Karya Asli" di Era Generative AI.',
                    'Debat Terbuka Kelas: Menavigasi Masa Depan Pekerjaan dan Skill Apa yang Paling Dibutuhkan Siswa.'
                ]
            ],
            [
                'level' => 'Kelas Master: Profesional',
                'badge_color' => 'bg-purple-100/80 text-purple-700',
                'icon' => 'fas fa-project-diagram',
                'icon_color' => 'text-purple-500 bg-purple-50 ring-purple-200',
                'title' => 'Modul 10: The Future Edu-Tech',
                'subtitle' => 'Otomatisasi Alur Kerja (Lanjut)',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800&auto=format&fit=crop',
                'materials' => [
                    'Pengenalan No-Code Tools Dasar untuk Otomatisasi Pekerjaan Guru (Contoh: Zapier, Make.com).',
                    'Integrasi Google Forms dengan AI untuk Analisis Sentimen dan Umpan Balik Siswa Secara Real-time.',
                    'Menyambungkan Spreadsheet (Data Nilai Rapor) dengan Generator Dokumen PDF Otomatis.',
                    'Membuat Asisten Chatbot Sederhana Berbasis WhatsApp untuk Tanya Jawab Materi Murid 24/7.',
                    'Melatih Custom GPT (OpenAI) Menggunakan Dokumen Kurikulum Spesifik Milik Sekolah Anda Sendiri.',
                    'Otomatisasi Rekap Kehadiran Siswa Menggunakan Teknologi Image Recognition Dasar.',
                    'Workflow Pembuatan E-Sertifikat Apresiasi Siswa Berprestasi Secara Massal dan Cepat.',
                    'Membangun Database Pengetahuan Sekolah (Knowledge Base) Internal Berbasis AI.',
                    'Strategi Membangun Komunitas Praktisi AI di Ruang Guru (Cara Menjadi Inisiator Diseminasi).',
                    'Puncak Transformasi: Melepaskan Ego Lama dan Mentransformasi Diri Menjadi Arsitek Pembelajaran.'
                ]
            ],
        ];

        foreach ($curriculum as $modul) {
            // JURUS RAHASIA: Buang key 'materials' dari array sebelum di-create
            unset($modul['materials']); 
            
            // Sekarang aman, cuma sisa data judul, icon, gambar, dll.
            Module::create($modul);
        }
    }
}
