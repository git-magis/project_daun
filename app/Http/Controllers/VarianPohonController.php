<?php

namespace App\Http\Controllers;

use App\Models\JenisPohon;

class VarianPohonController extends Controller
{
    public function index()
    {
        $varianpohon = JenisPohon::all()->sortBy('nama_jenis_pohon');
        return view('varian_pohon', compact('varianpohon'));
    }

    public function show($id)
    {
        $jenisPohon = JenisPohon::findOrFail($id); // Find specific tree kind by ID
        return view('varian_pohon', compact('jenisPohon')); // Replace with your Blade view path
    }
}
