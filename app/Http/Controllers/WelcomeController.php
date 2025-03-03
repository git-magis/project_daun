<?php

namespace App\Http\Controllers;

use App\Models\Pohon;
use App\Models\JenisPohon;
use App\Models\Bunga;
use App\Models\JenisBunga;
use App\Models\Taman;

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

        return view('welcome', compact('totalTanaman', 'totalJenisPohon', 'totalJenisBunga', 'totalTaman'));
    }
}
