<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;

class PengelolaController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        $total_alat_bagus = Alat::sum('JUMLAH_BAGUS');
        $total_alat_rusak = Alat::sum('JUMLAH_RUSAK');
        $total_bahan = Bahan::sum('JUMLAH');
        $total_bahan_kimia = BahanKimia::sum('JUMLAH_BAHAN_KIMIA');

        return view('pengelola.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia'));
    }
}
