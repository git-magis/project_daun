<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total trees planted

        $totalPohon = Pohon::count();
        $totalBunga = Bunga::count();
        $totalTanaman = $totalPohon + $totalBunga;

        $totalJenisPohon = JenisPohon::count();
        $totalJenisBunga = JenisBunga::count();

        $totalTaman = Taman::count();

        $totalAdmin = User::count();

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

        // Fetch the most recent data from pohons with their jenis names
        $recentPohons = DB::table('pohons')
            ->join('jenispohons', 'pohons.jenis_id', '=', 'jenispohons.id')
            ->join('users', 'pohons.user_id', '=', 'users.id')
            ->join('tamans', 'pohons.lokasi_id', '=', 'tamans.id')
            ->select(
                'pohons.id', 
                'pohons.nama_pohon AS nama', 
                'jenispohons.nama_jenis_pohon AS source', 
                'pohons.created_at', 
                'pohons.kode_unik AS kode',
                'users.name AS added_by',
                'tamans.nama AS lokasi'
            );

        // Fetch the most recent data from bungas with their jenis names
        $recentBungas = DB::table('bungas')
            ->join('jenisbungas', 'bungas.jenisb_id', '=', 'jenisbungas.id')
            ->join('users', 'bungas.user_id', '=', 'users.id')
            ->join('tamans', 'bungas.lokasib_id', '=', 'tamans.id')
            ->select(
                'bungas.id', 
                'bungas.nama_bunga AS nama', 
                'jenisbungas.nama_jenis_bunga AS source', 
                'bungas.created_at', 
                'bungas.kode_unik AS kode',
                'users.name AS added_by',
                'tamans.nama AS lokasi'
            );

        // Combine the results, sort by created_at, and limit to 5
        $recentData = $recentPohons
            ->union($recentBungas)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.admin_index', compact('recentData', 'chartsData','overallData','totalPohon', 'totalBunga', 'totalTanaman', 'totalJenisPohon', 'totalJenisBunga', 'totalTaman','totalAdmin'));
    }

    public function getMonthlyTrends(Request $request)
    {
        // Get the current year or the requested year
        $year = $request->input('year', Carbon::now()->year);

        // Fetch planted trees and flowers (not deleted)
        $plantedPohons = Pohon::whereYear('created_at', $year)
                            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('total', 'month')
                            ->toArray();

        $plantedBungas = Bunga::whereYear('created_at', $year)
                            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('total', 'month')
                            ->toArray();

        // Fetch deleted (dead) trees and flowers
        $deletedPohons = Pohon::onlyTrashed()->whereYear('deleted_at', $year)
                            ->selectRaw('MONTH(deleted_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('total', 'month')
                            ->toArray();

        $deletedBungas = Bunga::onlyTrashed()->whereYear('deleted_at', $year)
                            ->selectRaw('MONTH(deleted_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get()
                            ->pluck('total', 'month')
                            ->toArray();

        // Prepare data for chart
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = [
                'month' => Carbon::create()->month($i)->format('F'),
                'planted' => ($plantedPohons[$i] ?? 0) + ($plantedBungas[$i] ?? 0),
                'dead' => ($deletedPohons[$i] ?? 0) + ($deletedBungas[$i] ?? 0),
            ];
        }

        return response()->json($data);
    }

}