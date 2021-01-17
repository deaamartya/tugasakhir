<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\PeminjamanAlatBahan;

class PeminjamanController extends Controller
{
    public function index()
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';

        $id_lab = 1;
        
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();

        return view('pengelola.peminjaman.index', compact('page_title', 'page_description','action','peminjaman'));
    }
}
