<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;

class DashboardController extends Controller
{
    public function index()
    {
        // Total trees planted
        $totalPohon = Pohon::count() + Bunga::count();

        // Total kinds of trees
        $totalJenisPohon = JenisPohon::count();

        //total kinds of flowers
        $totalJenisBunga = JenisBunga::count();

        // Total gardens
        $totalTaman = Taman::count();

        // Fetch all Tamans
        $tamans = Taman::with(['jenisPohon', 'jenisBunga'])->get();
        

        // GOOGLE PIE CHART
        $chartsData = $tamans->map(function ($taman) {
            $treeData = collect($taman->jenisPohon)->unique('id')->map(function ($jenisPohon) use ($taman) {
                
                $count = Pohon::where('jenis_id', $jenisPohon->id)
                    ->where('lokasi_id', $taman->id)
                    ->count();
                    
                    // logger("Tree: {$jenisPohon->nama_jenis_pohon}, Count: {$count}");
                        
                    return [
                        'name' => $jenisPohon->nama_jenis_pohon,
                        'count' => $count,
                    ];
                });

            $flowerData = collect($taman->jenisBunga)->unique('id')->map(function ($jenisBunga) use ($taman) {

                $count = Bunga::where('jenisb_id', $jenisBunga->id)
                    ->where('lokasib_id', $taman->id)
                    ->count();

                    // logger("Flower: {$jenisBunga->nama_jenis_bunga}, Count: {$count}");

                    return [
                        'name' => $jenisBunga->nama_jenis_bunga,
                        'count' => $count,
                    ];
            });

            // Combine and group tree and flower data
            $combinedData = $treeData->merge($flowerData);

            // Group by name to avoid duplicate names and sum the counts
            $groupedData = $combinedData->groupBy('name')->map(function ($items, $name) {
                $totalCount = $items->sum('count');

                // logger("Grouped Name: {$name}, Total Count: {$totalCount}");
                    
                return [
                        'name' => $name,
                        'count' => $totalCount,
                ];
            });

            $labels = $groupedData->pluck('name')->toArray();
            $data = $groupedData->pluck('count')->toArray();

            $total = array_sum($data);

            // logger("Taman: {$taman->nama}, Total: {$total}, Labels: " . json_encode($labels) . ", Data: " . json_encode($data));

            return [
                'taman' => $taman->nama,
                'labels' => $labels,
                'data' => $data,
                'total' => $total,
            ];
                
                
        });

        // GOOGLE BAR CHART
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



        return view('admin.admin_index', compact('chartsData','overallData','totalPohon', 'totalJenisPohon', 'totalJenisBunga', 'totalTaman'));
    }

}