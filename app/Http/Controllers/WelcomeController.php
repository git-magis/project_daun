<?php

namespace App\Http\Controllers;

use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalPohon = Pohon::count();
        $totalBunga = Bunga::count();
        $totalTanaman = $totalPohon + $totalBunga;

        $totalJenisPohon = JenisPohon::count();
        $totalJenisBunga = JenisBunga::count();

        $totalTaman = Taman::count();

        // BAR CHART

        $tamans = Taman::with(['jenisPohon', 'jenisBunga'])->get();

        $totalData = collect();
        $tamans->each(function ($taman) use (&$totalData) {
            Pohon::where('lokasi_id', $taman->id)
                ->join('jenispohons', 'jenispohons.id', '=', 'pohons.jenis_id')
                ->select('jenispohons.nama_jenis_pohon as name', DB::raw('COUNT(DISTINCT pohons.id) as count'))
                ->groupBy('jenispohons.nama_jenis_pohon')
                ->get()
                ->each(function ($row) use (&$totalData) {
                    $totalData->put($row->name, $totalData->get($row->name, 0) + $row->count);
                });

            // Aggregate bungas
            Bunga::where('lokasib_id', $taman->id)
                ->join('jenisbungas', 'jenisbungas.id', '=', 'bungas.jenisb_id')
                ->select('jenisbungas.nama_jenis_bunga as name', DB::raw('COUNT(DISTINCT bungas.id) as count'))
                ->groupBy('jenisbungas.nama_jenis_bunga')
                ->get()
                ->each(function ($row) use (&$totalData) {
                    $totalData->put($row->name, $totalData->get($row->name, 0) + $row->count);
                });

        });

        $overallData = $totalData->map(function ($count, $name) {
            return ['label' => $name, 'count' => $count];
        })->values()->all();

        return view('welcome', compact('totalTanaman', 'totalJenisPohon', 'totalJenisBunga', 'totalTaman', 'overallData'));
    }
}
