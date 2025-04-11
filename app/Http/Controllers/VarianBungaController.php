<?php

namespace App\Http\Controllers;

use App\Models\JenisBunga;

class VarianBungaController extends Controller
{
    public function index()
    {
        $varianbunga = JenisBunga::all()->sortBy('nama_jenis_bunga');
        return view('varian_bunga', compact('varianbunga'));
    }

    public function show($id)
    {
        $jenisBunga = JenisBunga::findOrFail($id); // Find specific tree kind by ID
        return view('varian_pohon', compact('jenisBunga')); // Replace with your Blade view path
    }
}
