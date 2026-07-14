<?php


namespace App\Services;

class DataStore {
    public static function getLaundryData() {
        return [
            ['nama' => 'Smart Laundry Unnes', 'rating' => 4.8, 'alamat' => 'Jl. Kalimasada No.1a'],
            ['nama' => 'MY WASH LAUNDRY', 'rating' => 4.7, 'alamat' => 'Jl. Taman Siswa No.4'],
            // ... masukin semua data laundry lo di sini
        ];
    }

    public static function getMuaData() {
        return [
            ['nama' => 'Prameshwari MUA', 'rating' => 5.0, 'alamat' => 'Perum Ayodya Sekaran'],
            ['nama' => 'Lookby Maheswarini', 'rating' => 4.9, 'alamat' => 'Jl. Taman Siswa No.65'],
            // ... masukin semua data MUA lo di sini
        ];
    }
}