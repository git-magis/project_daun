<?php

namespace App\Http\Controllers;

use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Atribut;

class QRpohonController extends Controller
{
    public function index()
    {
        $detailpohon = JenisPohon::all();
        return view('detail_pohon', compact('detailpohon'));
    }

    public function show($id)
    {
        $pohon = Pohon::with('jenisPohon', 'taman')->findOrFail($id);

        $attributes = Atribut::where('entity_id', $pohon->jenisPohon->id)
                            ->where('entity_type','pohon')
                            ->get();
        
        return view('qr_pohon', compact('pohon', 'attributes'));
    }
}
