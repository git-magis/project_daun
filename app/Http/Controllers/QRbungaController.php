<?php

namespace App\Http\Controllers;

use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Atribut;

class QRbungaController extends Controller
{
    public function index()
    {
        $detailpohon = JenisBunga::all();
        return view('detail_bunga', compact('detailpohon'));
    }

    public function show($id)
    {
        $bunga = Bunga::with('jenisBunga', 'taman')->findOrFail($id);

        $attributes = Atribut::where('entity_id', $bunga->jenisBunga->id)
                            ->where('entity_type','bunga')
                            ->get();
        
        return view('qr_bunga', compact('bunga', 'attributes'));
    }
}
