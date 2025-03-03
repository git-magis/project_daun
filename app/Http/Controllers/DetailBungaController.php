<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\JenisBunga;
use App\Models\Atribut;

class DetailBungaController extends Controller
{
    public function index()
    {
        $detailbunga = JenisBunga::all();

        return view('detail_bunga', compact('detailbunga'));
    }

    public function show($id)
    {
        $detailbunga = JenisBunga::findOrFail($id);

        $lokasiBunga = JenisBunga::select('jenisbungas.id', 'jenisbungas.nama_jenis_bunga')
        ->join('bungas', 'bungas.jenisb_id', '=', 'jenisbungas.id')
        ->join('tamans', 'bungas.lokasib_id', '=', 'tamans.id')
        ->where('jenisbungas.id', $id)
        ->selectRaw('COUNT(DISTINCT bungas.lokasib_id) as total_taman')
        ->groupBy('jenisbungas.id', 'jenisbungas.nama_jenis_bunga')
        ->first(); // Get a single result

        $attributes = Atribut::where('entity_id', $id)
                            ->where('entity_type','bunga')
                            ->get();

        return view('detail_bunga', compact('attributes','detailbunga','lokasiBunga'));
    }
}
