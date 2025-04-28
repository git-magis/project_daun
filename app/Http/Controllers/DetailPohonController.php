<?php

namespace App\Http\Controllers;

use App\Models\JenisPohon;
use App\Models\Pohon;
use App\Models\Atribut;

class DetailPohonController extends Controller
{
    public function index()
    {
        $pohons = Pohon::whereNotNull('gambar_pohon')->get();
        return view('detail_pohon', compact('pohons'));
    }

    public function show($id)
    {
        $jenisPohon = JenisPohon::findOrFail($id);
        
        $pohons = Pohon::where('jenis_id', $id)
            ->whereNotNull('gambar_pohon')
            ->get();

        $wordsToRemove = ['Bambu', 'Pohon'];
        $filteredName = str_replace($wordsToRemove, '', $jenisPohon->nama_jenis_pohon);
        $speciesCode = strtoupper(substr(str_replace(' ', '', $filteredName), 0, 4));

        $lokasiPohon = JenisPohon::select('jenispohons.id', 'jenispohons.nama_jenis_pohon')
        ->join('pohons', 'pohons.jenis_id', '=', 'jenispohons.id')
        ->join('tamans', 'pohons.lokasi_id', '=', 'tamans.id')
        ->where('jenispohons.id', $id)
        ->selectRaw('COUNT(DISTINCT pohons.lokasi_id) as total_taman')
        ->groupBy('jenispohons.id', 'jenispohons.nama_jenis_pohon')
        ->first(); // Get a single result

        $attributes = Atribut::where('entity_id', $id)
                            ->where('entity_type','pohon')
                            ->get();
        
        return view('detail_pohon', compact('jenisPohon', 'attributes', 'lokasiPohon', 'speciesCode', 'pohons')); // Replace with your Blade view path
    }
}
