<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LearningController extends Controller
{
    public function index(){
        $curriculum = Module::all();
        return view('learning.index', compact('curriculum'));
    }
    public function show($slug)
    {
        // Ambil semua modul
        $modules = Module::all();

        // Cari modul yang slug judulnya cocok dengan parameter $slug
        $module = $modules->first(function ($m) use ($slug) {
            return Str::slug($m->title) === $slug;
        });

        // Jika modul tidak ditemukan, tampilkan error 404
        if (!$module) {
            abort(404);
        }

        // Kirim data modul ke view detail
        return view('learning.show', compact('module'));
    }
    public function readMaterial($module_slug, $material_slug)
{
    // Cari materi berdasarkan slug, sekalian tarik data modulnya (Eager Loading)
    $material = \App\Models\Material::with('module')->where('slug', $material_slug)->firstOrFail();
    
    return view('learning.read', compact('material'));
}
}
