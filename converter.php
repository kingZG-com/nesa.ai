<?php

// Arahkan ke folder tempat gambar PNG kamu berada
$folderPath = 'public/storage/word/media/';
$files = glob($folderPath . '*.png'); 

if (empty($files)) {
    echo "Waduh, file PNG nggak ketemu di folder $folderPath\n";
    exit;
}

foreach ($files as $file) {
    // Baca gambar aslinya
    $img = imagecreatefrompng($file);
    
    // Bikin nama baru dengan ekstensi .webp
    $newName = str_replace('.png', '.webp', $file);
    
    // Convert dan simpan (kualitas 80 dari 100 biar enteng tapi tetap jernih)
    imagewebp($img, $newName, 80); 
    
    // Hapus dari memori biar laptop nggak ngos-ngosan
    imagedestroy($img);
    
    echo "Sukses convert: $newName\n";
}

echo "Mantap! 31 Gambar selesai di-convert ke WebP!\n";