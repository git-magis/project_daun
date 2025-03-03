<?php

namespace App\Http\Controllers;

use App\Models\JenisPohon;
use App\Models\Atribut;

class DetailPohonController extends Controller
{
    public function index()
    {
        $detailpohon = JenisPohon::all();
        return view('detail_pohon', compact('detailpohon'));
    }

    public function show($id)
    {
        $jenisPohon = JenisPohon::findOrFail($id);

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
        
        return view('detail_pohon', compact('jenisPohon', 'attributes', 'lokasiPohon')); // Replace with your Blade view path
    }
}
