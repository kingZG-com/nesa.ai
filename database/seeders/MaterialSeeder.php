<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Material;
use Illuminate\Support\Str;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tarik Master Data
        $curriculumMaterials = require database_path('data/curriculum.php');

        // 2. ENGINE LOOPING UTAMA
        foreach ($curriculumMaterials as $moduleTitle => $materials) {

            $module = Module::where('title', $moduleTitle)->first();

            if (!$module) {
                continue;
            }

            $selesaiUrl = url()->previous();
            // 3. Loop setiap item materi
            foreach ($materials as $index => $item) {

                // MENGAPA INI PINTAR?
                // Karena kita tidak lagi memanggil satu template (slide-template),
                // melainkan memanggil template yang ditentukan di data curriculum.php
                $fullHtmlContent = view($item['template'], [
                    'title'      => $item['title'],
                    'selesaiUrl' => $selesaiUrl,
                    'content'    => $item['data'] ?? [] // Menyuntikkan data unik (gambar/teks) ke Blade
                ])->render();

                // 4. Simpan ke database
                Material::updateOrCreate(
                    ['slug' => Str::slug($item['title'])], // Cek slug biar gak duplikat
                    [
                        'module_id' => $module->id,
                        'title'     => $item['title'],
                        'content'   => $fullHtmlContent,
                        'order'     => $index + 1,
                    ]
                );
            }
        }
    }
}
