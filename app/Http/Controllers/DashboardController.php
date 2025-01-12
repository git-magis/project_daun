<?php

namespace App\Http\Controllers;

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
        $tamans = Taman::all();

        // Controller for the ChartJS
        // $chartsData = [];
        // foreach ($tamans as $taman) {
        //     // Fetch tree data for the current taman
        //     $treeKinds = JenisPohon::join('pohons', 'pohons.jenis_id', '=', 'jenispohons.id')
        //         ->where('pohons.lokasi_id', $taman->id)
        //         ->select('jenispohons.nama_jenis_pohon as name', JenisPohon::raw('COUNT(*) as count'))
        //         ->groupBy('jenispohons.id', 'jenispohons.nama_jenis_pohon')
        //         ->get();

        //     // Fetch flower data for the current taman
        //     $flowerKinds = JenisBunga::join('bungas', 'bungas.jenisb_id', '=', 'jenisbungas.id')
        //         ->where('bungas.lokasib_id', $taman->id)
        //         ->select('jenisbungas.nama_jenis_bunga as name', JenisBunga::raw('COUNT(*) as count'))
        //         ->groupBy('jenisbungas.id', 'jenisbungas.nama_jenis_bunga')
        //         ->get();

        //     // Combine data into one structure for the chart
        //     $chartsData[] = [
        //         'taman' => $taman->nama,
        //         'trees' => $treeKinds,
        //         'flowers' => $flowerKinds,
        //     ];
        // }

        // $chartsData = $tamans->map(function ($taman) {
        //     return [
        //         'title' => "Composition of Plants in {$taman->nama}", // Replace 'name' with the column for Taman's name
        //         'labels' => array_merge(
        //             $taman->jenisPohon->pluck('nama_jenis_pohon')->toArray(),
        //             $taman->jenisBunga->pluck('nama_jenis_bunga')->toArray()
        //         ),
        //         'data' => array_merge(
        //             $taman->jenisPohon->pluck('jumlah')->toArray(),
        //             $taman->jenisBunga->pluck('jumlah')->toArray()
        //         ),
        //         'colors' => array_merge(
        //             array_fill(0, $taman->jenisPohon->count(), '#FF5733'),
        //             array_fill(0, $taman->jenisBunga->count(), '#33FF57')
        //         ),
        //     ];
        // });

        return view('admin.admin_index', compact('totalPohon', 'totalJenisPohon', 'totalJenisBunga', 'totalTaman'));
    }

    // public function getChartData()
    // {
    //     $tamans = Taman::with(['jenisPohon', 'jenisBunga'])->get();

    //     $chartsData = $tamans->map(function ($taman) {
    //         return [
    //             'title' => "Composition of Plants in {$taman->nama}", // Replace 'name' with the column for Taman's name
    //             'labels' => array_merge(
    //                 $taman->jenisPohon->pluck('nama_jenis_pohon')->toArray(),
    //                 $taman->jenisBunga->pluck('nama_jenis_bunga')->toArray()
    //             ),
    //             'data' => array_merge(
    //                 $taman->jenisPohon->pluck('jumlah')->toArray(),
    //                 $taman->jenisBunga->pluck('jumlah')->toArray()
    //             ),
    //             'colors' => array_merge(
    //                 array_fill(0, $taman->jenisPohon->count(), '#FF5733'),
    //                 array_fill(0, $taman->jenisBunga->count(), '#33FF57')
    //             ),
    //         ];
    //     });

    //     return view('admin.admin_index', compact('chartsData'));
    // }
}