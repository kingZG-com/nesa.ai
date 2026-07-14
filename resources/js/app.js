import.meta.glob('./**/*.js', { eager: true });
import.meta.glob('../css/**/*.css', { eager: true });
import Swal from 'sweetalert2';
import Reveal from 'reveal.js';
import 'reveal.js/dist/reveal.css';
import 'reveal.js/dist/theme/white.css';

window.Swal = Swal;

// Inisialisasi Reveal cuma kalau elemennya ada di halaman
const revealElement = document.querySelector('.reveal');
if (revealElement) {
    let deck = new Reveal();
    deck.initialize({
        hash: true, // Biar slide punya URL unik
        slideNumber: 'c/t', // Tampilkan nomor slide
        // Lu bisa nambahin konfigurasi lain di sini
    });
}

import './echo';