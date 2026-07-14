<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Laundry;
use App\Models\Mua; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * ─── 1. GERBANG UTAMA MEMUAT LAYOUT + SIDEBAR ───
     * Rute: GET /app (Menampilkan halaman chat dan list riwayat)
     */
    public function index()
    {
        $userId = Auth::id();

        // 1. is_pinned DESC: chat yang is_pinned=true (1) bakal menang/di atas
        // 2. updated_at DESC: chat yang paling baru di-update bakal di bawah pin
        $chats = Chat::where('user_id', $userId)
            ->orderBy('is_pinned', 'desc')
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->get();

        return view('chat', compact('chats'));
    }

    /**
     * ─── 2. GAWANG UTAMA PROMPT GUEST & DATABASE SAVING ───
     * Rute: POST /api/chat/prompt (Ditembak oleh fetch "chat.js")
     * Dijaga oleh: middleware('check.prompt')
     */
    public function handlePrompt(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('app.assistant.chat');
        }

        // 1. Validasi input, wajib bawa teks prompt. chat_id bisa null kalau sesi baru
        $request->validate([
            'prompt' => 'required|string',
            'chat_id' => 'nullable|uuid'
        ]);

        $prompt = $request->input('prompt');
        $chatId = $request->input('chat_id');
        $isLoggedIn = Auth::check();
        $userId = Auth::id(); // Otomatis dapat ID kalau login, null kalau guest
        $remaining = 'unlimited';

        // 2. Hitung sisa kuota khusus Guest
        if (!$isLoggedIn) {
            $currentCount = session('prompt_count', 0) + 1;
            session(['prompt_count' => $currentCount]);
            $remaining = 3 - $currentCount;
        }

        // 3. LOGIKA SIMPAN SESI CHAT (TABEL CHATS)
        $isNewChat = false;
        if (empty($chatId)) {
            $isNewChat = true;

            // Potong 4 kata pertama dari prompt user buat jadi judul di sidebar
            $words = explode(' ', $prompt);
            $chatTitle = implode(' ', array_slice($words, 0, 4));
            if (strlen($chatTitle) > 30) {
                $chatTitle = substr($chatTitle, 0, 27) . '...';
            }
            $chatTitle = $chatTitle ?: 'Obrolan Pintar';

            // Simpan ke table chats
            $chat = Chat::create([
                'user_id' => $userId,
                'title' => $chatTitle
            ]);
            $chatId = $chat->id;
        } else {
            // Kalau chat_id dikirim, pastiin datanya ada di PostgreSQL
            $chat = Chat::findOrFail($chatId);
        }

        // 4. SIMPAN KETIKAN USER (TABEL CHAT_MESSAGES)
        ChatMessage::create([
            'chat_id' => $chatId,
            'role' => 'user',
            'message' => $prompt
        ]);


// ==========================================
// 🚀 MODE GEMINI + RAG LITE (Final Version)
// ==========================================

// 1. Ambil SEMUA kolom yang relevan dari database
$muas = Mua::select(
    'name', 'image_url',  'social_link', 'location', 'whatsapp', 'specialty',
    'include_hair_hijab', 'rent_accessories', 'home_service', 'accept_qris',
    'duration_hours', 'daily_capacity',
    'price_sidang', 'price_wisuda', 'price_party', 'home_service_fee',
    'price_hairdo', 'price_hijabdo', 'price_softlens_nails',
    'price_accessories_rent', 'price_companion',
    'booking_rules', 'dp_terms'
)->get();

$laundries = Laundry::select(
    'name', 'image_url', 'location', 'whatsapp', 'open_hours', 'open_on_holidays',
    'capacity_status', 'price_regular_kg', 'duration_regular_days',
    'has_express', 'price_express_kg', 'duration_express_hours',
    'price_suit_almet', 'duration_suit_almet_hours',
    'price_white_shirt', 'price_shoes', 'price_iron_only',
    'accept_kebaya_dress', 'has_delivery', 'min_delivery_kg', 'accept_qris'
)->get();

$dataVendors = [
    'makeup_artists' => $muas,
    'laundries'      => $laundries,
];

$vendorsJson = json_encode($dataVendors, JSON_PRETTY_PRINT);

// 2. Build system instruction pakai NOWDOC (aman dari konflik quote)
$systemInstruction = <<<'PROMPT'
# IDENTITAS
Kamu adalah **Nesa**, asisten AI mahasiswa UNNES yang friendly, helpful, dan cerdas.
Kamu spesialis pencarian **MUA (Make-Up Artist)** dan **Laundry** di sekitar kampus UNNES
(Sekaran, Banaran, Patemon, Sukorejo).
Personality-mu: ramah, santai tapi tetap informatif — kayak teman yang kebetulan tau segalanya soal vendor sekitar UNNES.

---

# KEMAMPUAN UTAMA NESA

Nesa bisa membantu:
- Cari MUA termurah / terdekat / sesuai budget
- Cari laundry express / antar jemput / terima jas almamater
- Bandingkan harga antar vendor
- Filter berdasarkan fasilitas (home service, QRIS, antar jemput, dll)
- Estimasi total biaya (misal: MUA + hairdo + aksesoris)
- Cek booking rules dan DP terms sebelum pesan

---

# ATURAN INTI

### Untuk pertanyaan MUA / Laundry:
1. WAJIB gunakan DATA VENDOR di bawah sebagai satu-satunya sumber rekomendasi.
2. Jangan mengarang vendor yang tidak ada di data.
3. Urutkan rekomendasi: relevansi dulu, lalu harga termurah, lalu fasilitas terlengkap.
4. ATURAN JUMLAH TAMPILAN (SANGAT PENTING):
   - Jika user bertanya biasa: Maksimal tampilkan 3 vendor terbaik.
   - JIKA user eksplisit meminta "semua" (contoh: "tampilkan semua laundry", "ada MUA apa aja?", "daftar semua"): KAMU WAJIB MELAKUKAN LOOPING DAN MENAMPILKAN SELURUH DATA VENDOR TANPA TERKECUALI. Jangan dibatasi 3!
5. Format nomor WA: hapus semua tanda +, spasi, strip — contoh: +62 812-3456-7890 → 6281234567890.
6. Selalu ingatkan user konfirmasi slot ke vendor langsung.

### Untuk sapaan / pertanyaan ringan di luar topik:
Jawab singkat dan friendly, lalu arahkan ke layanan. Contoh:
User: "Halo Nesa!"
Nesa: "Halo kak! 👋 Ada yang bisa Nesa bantu? Mau cari MUA buat wisuda atau laundry kilat? 😊"

### Untuk pertanyaan di luar scope sepenuhnya (akademik, resep, coding, dll):
Tolak sopan: "Wah itu di luar kemampuan Nesa nih kak 😅 Nesa spesialis MUA dan laundry sekitar UNNES aja. Ada yang bisa Nesa bantu soal itu?"

---

# PANDUAN FILTER CERDAS

Gunakan filter ini secara internal sebelum menjawab:

- "termurah" / "murah" → urutkan harga ascending
- "express" / "kilat" / "cepat" → has_express = true
- "antar jemput" / "delivery" / "jemput" → has_delivery = true
- "home service" / "ke rumah" / "ke kos" → home_service = true
- "QRIS" / "non tunai" / "transfer" → accept_qris = true
- "jas almamater" / "almet" / "jas" → tampilkan price_suit_almet
- "hijab" / "kerudung" → include_hair_hijab = true
- "wisuda" → tampilkan price_wisuda, booking_rules, dp_terms
- "budget [nominal]" → filter harga <= nominal
- "besok" / "mendadak" / "urgent" → highlight booking_rules, warn jika H-3
- "libur" / "minggu" / "sabtu" → open_on_holidays = true
- "sepatu" → tampilkan price_shoes
- "kebaya" / "dress" → accept_kebaya_dress = true
- "setrika" / "iron" → tampilkan price_iron_only

---

# DATA VENDOR (SUMBER TUNGGAL — JANGAN GUNAKAN PENGETAHUAN LAIN)

PROMPT_VENDOR_PLACEHOLDER

---

# FORMAT OUTPUT — WAJIB DIIKUTI PERSIS

## JIKA merekomendasikan vendor MUA:

Tulis HANYA HTML di bawah ini, ganti semua [PLACEHOLDER] dengan data nyata dari DATA VENDOR.
Jika suatu field tidak ada / null, hapus baris tersebut.
Jika home_service=false, hapus tag Home Service. Berlaku sama untuk semua tag kondisional.
Nomor WA: hapus semua karakter non-digit kecuali angka, awali dengan 62.

<div class="nesa-cards">
<p class="nesa-intro">[TULIS INTRO SINGKAT FRIENDLY — contoh: Ini dia rekomendasi MUA sesuai budget kamu kak! ✨]</p>
<div class="nesa-card-grid">

<!-- PERHATIAN AI: ULANGI BLOK <div class="nesa-card mua-card"> DI BAWAH INI UNTUK SETIAP VENDOR YANG HARUS DITAMPILKAN -->
<div class="nesa-card mua-card">
<div class="nesa-card-header">
<div class="nesa-card-avatar mua-avatar">
<img src="[IMAGE_URL]" alt="[NAMA_MUA]" onerror="this.onerror=null;this.src='/path/ke/placeholder-mua.png';" style="width: 100%; height: 100%; object-fit: cover;">
</div>
<div class="nesa-card-info">
<div class="nesa-card-name">[NAMA_MUA]</div>
<div class="nesa-card-sub">[SPECIALTY]</div>
</div>
<div class="nesa-card-badge mua-badge">MUA ✨</div>
</div>
<div class="nesa-card-body">
<div class="nesa-price-grid">
<div class="nesa-price-item">
<span class="nesa-price-icon">🎓</span>
<span class="nesa-price-label">Wisuda</span>
<span class="nesa-price-val">[PRICE_WISUDA]</span>
</div>
<div class="nesa-price-item">
<span class="nesa-price-icon">🎉</span>
<span class="nesa-price-label">Pesta</span>
<span class="nesa-price-val">[PRICE_PARTY]</span>
</div>
<div class="nesa-price-item">
<span class="nesa-price-icon">📋</span>
<span class="nesa-price-label">Sidang</span>
<span class="nesa-price-val">[PRICE_SIDANG]</span>
</div>
<div class="nesa-price-item">
<span class="nesa-price-icon">💆</span>
<span class="nesa-price-label">Hairdo</span>
<span class="nesa-price-val">[PRICE_HAIRDO]</span>
</div>
</div>
<div class="nesa-tag-row">
[JIKA home_service=true TAMBAHKAN: <span class="nesa-tag tag-green">🏠 Home Service</span>]
[JIKA include_hair_hijab=true TAMBAHKAN: <span class="nesa-tag tag-purple">💆 Hair & Hijab</span>]
[JIKA accept_qris=true TAMBAHKAN: <span class="nesa-tag tag-blue">📱 QRIS</span>]
[JIKA rent_accessories=true TAMBAHKAN: <span class="nesa-tag tag-yellow">💍 Sewa Aksesoris</span>]
</div>
</div>
<div class="nesa-card-footer">
<div class="nesa-meta-row">
<span class="nesa-meta-item">📍 [LOKASI_SINGKAT_MAKS_30_KARAKTER]</span>
<span class="nesa-meta-item">🕐 Booking [BOOKING_RULES]</span>
<span class="nesa-meta-item">💵 DP [DP_TERMS]</span>
</div>
<a href="https://wa.me/[NOMOR_WA_DIGIT_ONLY_AWALI_62]?text=Halo%20kak%2C%20saya%20tertarik%20dengan%20layanan%20MUA%20[NAMA_MUA_URL_ENCODED]" target="_blank" rel="noopener" class="nesa-wa-btn">
<svg class="nesa-wa-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
Chat di WhatsApp
</a>
</div>
</div>
<!-- AKHIR BLOK VENDOR MUA -->

</div>
<p class="nesa-closing">[TULIS CLOSING SINGKAT — contoh: Jangan lupa konfirmasi slot dulu ya kak sebelum fix booking! 💜]</p>
</div>

## JIKA merekomendasikan vendor Laundry:

<div class="nesa-cards">
<p class="nesa-intro">[TULIS INTRO SINGKAT FRIENDLY]</p>
<div class="nesa-card-grid">

<!-- PERHATIAN AI: ULANGI BLOK <div class="nesa-card laundry-card"> DI BAWAH INI UNTUK SETIAP VENDOR YANG HARUS DITAMPILKAN -->
<div class="nesa-card laundry-card">
<div class="nesa-card-header">
<div class="nesa-card-avatar laundry-avatar">
<img src="[IMAGE_URL]" alt="[NAMA_LAUNDRY]" onerror="this.onerror=null;this.src='/path/ke/placeholder-laundry.png';" style="width: 100%; height: 100%; object-fit: cover;">
</div>
<div class="nesa-card-info">
<div class="nesa-card-name">[NAMA_LAUNDRY]</div>
<div class="nesa-card-sub">⏰ [JAM_BUKA]</div>
</div>
<div class="nesa-card-badge laundry-badge">Laundry 🧺</div>
</div>
<div class="nesa-card-body">
<div class="nesa-price-grid">
<div class="nesa-price-item">
<span class="nesa-price-icon">👕</span>
<span class="nesa-price-label">Regular/kg</span>
<span class="nesa-price-val">[PRICE_REGULAR_KG]/kg</span>
</div>
[JIKA has_express=true TAMBAHKAN:
<div class="nesa-price-item highlight-express">
<span class="nesa-price-icon">⚡</span>
<span class="nesa-price-label">Express/kg</span>
<span class="nesa-price-val">[PRICE_EXPRESS_KG]/kg · [DURATION_EXPRESS_HOURS]jam</span>
</div>]
<div class="nesa-price-item">
<span class="nesa-price-icon">🎓</span>
<span class="nesa-price-label">Jas Almet</span>
<span class="nesa-price-val">[PRICE_SUIT_ALMET]</span>
</div>
<div class="nesa-price-item">
<span class="nesa-price-icon">👔</span>
<span class="nesa-price-label">Kemeja Putih</span>
<span class="nesa-price-val">[PRICE_WHITE_SHIRT]</span>
</div>
[JIKA price_shoes tidak null TAMBAHKAN:
<div class="nesa-price-item">
<span class="nesa-price-icon">👟</span>
<span class="nesa-price-label">Sepatu</span>
<span class="nesa-price-val">[PRICE_SHOES]</span>
</div>]
[JIKA price_iron_only tidak null TAMBAHKAN:
<div class="nesa-price-item">
<span class="nesa-price-icon">♨️</span>
<span class="nesa-price-label">Setrika Only</span>
<span class="nesa-price-val">[PRICE_IRON_ONLY]/kg</span>
</div>]
</div>
<div class="nesa-tag-row">
[JIKA has_express=true: <span class="nesa-tag tag-yellow">⚡ Express [DURATION_EXPRESS_HOURS]jam</span>]
[JIKA has_delivery=true: <span class="nesa-tag tag-green">🛵 Antar Jemput</span>]
[JIKA accept_qris=true: <span class="nesa-tag tag-blue">📱 QRIS</span>]
[JIKA open_on_holidays=true: <span class="nesa-tag tag-purple">📅 Buka Hari Libur</span>]
[JIKA accept_kebaya_dress=true: <span class="nesa-tag tag-pink">👗 Terima Kebaya</span>]
</div>
</div>
<div class="nesa-card-footer">
<div class="nesa-meta-row">
<span class="nesa-meta-item">📍 [LOKASI_SINGKAT]</span>
[JIKA capacity_status tidak Normal: <span class="nesa-meta-item warn">⚠️ Kapasitas [CAPACITY_STATUS]</span>]
</div>
<a href="https://wa.me/[NOMOR_WA_DIGIT_ONLY_AWALI_62]?text=Halo%20kak%2C%20saya%20mau%20tanya%20soal%20layanan%20laundry%20[NAMA_LAUNDRY_URL_ENCODED]" target="_blank" rel="noopener" class="nesa-wa-btn">
<svg class="nesa-wa-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
Chat di WhatsApp
</a>
</div>
</div>
<!-- AKHIR BLOK VENDOR LAUNDRY -->

</div>
<p class="nesa-closing">[CLOSING SINGKAT — contoh: Pastikan konfirmasi dulu ya kak, biar slot-nya aman! 🧺]</p>
</div>

## JIKA menjawab pertanyaan biasa (bukan rekomendasi vendor):
Gunakan teks biasa dengan **bold** dan *italic*.
Jangan gunakan div.nesa-cards sama sekali.

---

# REMINDER WAJIB SEBELUM TIAP JAWABAN

1. Pertanyaan soal MUA/laundry? → pakai data vendor, return HTML card (LOOP semua card jika user minta "semua")
2. Sapaan / pertanyaan ringan? → jawab singkat friendly, arahkan ke layanan
3. Di luar scope? → tolak dengan friendly, tanpa HTML card
4. Filter sudah diterapkan? → jangan rekomendasikan vendor yang tidak match kriteria
5. Nomor WA sudah bersih (digit only, awali 62)? → wajib cek sebelum tulis href
6. Closing reminder konfirmasi slot? → wajib ada di setiap rekomendasi
PROMPT;


// 3. Inject vendorsJson ke placeholder
$systemInstruction = str_replace('PROMPT_VENDOR_PLACEHOLDER', $vendorsJson, $systemInstruction);

// 4. Ambil history percakapan sebelumnya
$history = [];
if (!empty($chatId) && !$isNewChat) {
    $prevMessages = ChatMessage::where('chat_id', $chatId)
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get()
        ->reverse();

    foreach ($prevMessages as $msg) {
        $history[] = ($msg->role === 'user' ? 'User: ' : 'Nesa: ') . $msg->message;
    }
}

$historyContext = !empty($history)
    ? "\n\n## RIWAYAT PERCAKAPAN SEBELUMNYA:\n" . implode("\n", $history) . "\n\n"
    : "";

// 5. Kirim ke Gemini dengan Retry Logic (Maksimal 3x percobaan)
$maxRetries = 3;
$attempt = 0;
$aiText = "";

while ($attempt < $maxRetries) {
    try {
        $client = \Gemini::client(env('GEMINI_API_KEY'));
        
        // Panggil model Gemini
        $response = $client->generativeModel('gemini-3.1-flash-lite') 
            ->generateContent($systemInstruction . $historyContext . "User (pesan terbaru): " . $prompt);

        $aiText = $response->text();
        
        // Kalau sukses dapet balasan, langsung BREAK (keluar dari loop)
        break; 

    } catch (\Exception $e) {
        $attempt++;
        
        // Kalau udah coba 3x tapi masih gagal
        if ($attempt >= $maxRetries) {
            // Kasih pesan yang friendly ke user, jangan kasih error raw e->getMessage()
            $aiText = "Mohon maaf kak, server Nesa lagi penuh banget nih. Tunggu bentar dan coba kirim lagi ya! 🙏";
            
            // Opsional: Catat error aslinya di log Laravel buat bahan pantauan kamu
            \Illuminate\Support\Facades\Log::error("Gemini API Error: " . $e->getMessage());
        } else {
            // Kalau belum 3x, sistem bakal 'tidur' sebentar sebelum nyoba lagi
            // Percobaan 1: jeda 2 detik, Percobaan 2: jeda 4 detik
            sleep(2 ** $attempt); 
        }
    }
}
        // 6. SIMPAN JAWABAN BOT (TABEL CHAT_MESSAGES)
        ChatMessage::create([
            'chat_id' => $chatId,
            'role' => 'model',
            'message' => $aiText
        ]);

        // 7. RETURN STRUKTUR DATA KAYA KE FRONTEND (JSON)
        return response()->json([
            'status' => 'success',
            'message' => 'SmartNES (PostgreSQL): Data berhasil dicatat.',
            'chat_id' => $chatId,
            'chat_title' => $chat->title,
            'is_new_chat' => $isNewChat,
            'response' => $aiText,
            'remaining_prompts' => $remaining,
            'is_logged_in' => $isLoggedIn
        ]);
    }

    /**
     * ─── 3. SAKLAR DEBUGGING & INTEGRASI GEMINI API ───
     * Rute: POST /app/process (Rute internal lo)
     */
    public function chatProcess(Request $request)
    {
        $request->validate(['prompt' => 'required|string']);

        // 🎛️ SAKLAR DEBUGGING (Ubah ke true kalau cuma mau tes UI/Layout)
        $useDummy = true;

        if ($useDummy) {
            return response()->json([
                'success' => true,
                'response' => "Halo cah! Ini mode dummy aktif. Pesan lo: '" . $request->prompt . "'. Layout chat lo udah aman, scrolling lancar jaya!"
            ]);
        }

        try {
            $client = \Gemini::client(env('GEMINI_API_KEY'));
            $systemInstructions = "Persona: SmartNES AI, asisten santai mahasiswa UNNES. Bantu cari vendor di Sekaran, Banaran, Patemon.";

            $response = $client->generativeModel('gemini-2.0-flash-lite')
                ->generateContent($systemInstructions . "\n\nUser: " . $request->prompt);

            return response()->json([
                'success' => true,
                'response' => $response->text()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'response' => 'Waduh, koneksi ke otak AI lagi error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMessages($id)
    {
        // Pastikan chat yang dibuka emang milik user yang sedang login biar gak di-intip orang lain
        $chat = Chat::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Tarik semua pesan dari chat tersebut urut dari yang paling lama (biar kronologis kayak WhatsApp)
        $messages = ChatMessage::where('chat_id', $chat->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'chat_title' => $chat->title,
            'messages' => $messages
        ]);
    }

    public function chatGateway()
    {
        // Cek apakah user sudah login via Google
        if (Auth::check()) {
            // Kalau UDAH LOGIN, terbangkan ke halaman utama /app (User VIP)
            return redirect()->route('app.assistant.chat');
        }

        // Kalau BELUM LOGIN (Guest), alihkan ke halaman chat box publik 
        // Di sini lo bisa alihkan ke view chat utama dengan kondisi guest (tanpa data chats)
        return view('chat', ['chats' => collect()]);
    }

    public function searchView(Request $request)
    {
        $userId = Auth::id();
        $searchQuery = $request->query('q', ''); // Ambil keyword dari parameter '?q='

        // 1. Ambil list 10 chat terbaru buat disuapin ke komponen sidebar lo biar gak kosong
        $chats = Chat::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // 2. Eksekusi pencarian riyal di PostgreSQL berdasarkan judul percakapan
        $results = [];
        if (!empty($searchQuery)) {
            $results = Chat::where('user_id', $userId)
                ->where('title', 'ILIKE', '%' . $searchQuery . '%') // 'ILIKE' biar Case-Insensitive di Postgres
                ->orderBy('created_at', 'desc')
                ->get();
        }

        // 3. Lempar semua data ke view search-history baru
        return view('search-history', compact('chats', 'results', 'searchQuery'));
    }

    /**
     * ─── BUKA CHAT SPESIFIK VIA URL /app/{id} ───
     * Render SSR langsung, bukan AJAX
     */
    public function showChat($id)
    {
        // Kalau request JSON (dari JS loadSpecificChat), balikkan JSON seperti sebelumnya
        if (request()->expectsJson()) {
            return $this->getMessages($id);
        }

        // Kalau akses langsung via browser (URL bar), render view dengan data lengkap
        $userId = Auth::id();

        $chat = Chat::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail(); // Auto 404 kalau bukan miliknya

        $messages = ChatMessage::where('chat_id', $chat->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $chats = Chat::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Kirim data chat aktif ke view
        return view('chat', compact('chats', 'chat', 'messages'));
    }

    /**
     * ─── UPDATE JUDUL PERCAKAPAN ───
     */
    public function renameChat(Request $request, string $id)
    {
        if (!$id || $id === 'null' || $id === 'undefined') {
            return response()->json([
                'success' => false,
                'message' => 'ID percakapan tidak valid.'
            ], 400);
        }

        $request->validate([
            'title' => 'required|string|max:100'
        ]);

        try {
            $chat = Chat::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $chat->update([
                'title' => $request->title
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Judul percakapan berhasil diubah.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Khusus kalau datanya emang nggak ketemu di DB
            return response()->json([
                'success' => false,
                'message' => 'Percakapan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem.'
            ], 500);
        }
    }

    /**
     * ─── HAPUS PERCAKAPAN ───
     */
    public function destroy($id)
    {
        // Cek apakah $id valid (biar PostgreSQL nggak ngamuk lagi)
        if (!$id || $id === 'null' || $id === 'undefined') {
            return response()->json([
                'success' => false,
                'message' => 'ID percakapan tidak valid.'
            ], 400);
        }

        try {
            // Cari chat yang mau dihapus, pastikan punya user yang login
            $chat = Chat::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $chat->delete();

            return response()->json([
                'success' => true,
                'message' => 'Percakapan berhasil dihapus.'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Percakapan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus percakapan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pinChat($id)
    {
        try {
            $chat = Chat::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $chat->is_pinned = !$chat->is_pinned;
            // Kita update juga updated_at biar pas di-sort dia otomatis naik
            $chat->updated_at = now();
            $chat->save();

            return response()->json([
                'success' => true,
                'pinned'  => $chat->is_pinned,
                'message' => $chat->is_pinned ? 'Percakapan disematkan.' : 'Percakapan dilepas.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyematkan percakapan.'
            ], 500);
        }
    }
}
