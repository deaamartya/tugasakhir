<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerubahanJadwalPeminjaman;
use DB;
use App\Models\PeminjamanAlatBahan;

class PenjadwalanUlangController extends Controller
{
    public function index()
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'app_calender';

        $id_lab = 1;
        
        $jadwalulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','p.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('perubahan_jadwal_peminjaman.ID_PEMINJAMAN','DESC')->get();

        return view('pengelola.jadwal-ulang.index', compact('page_title', 'page_description','action','jadwalulang'));
    }

    public function edit($id)
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';

        $id_lab = 1;
        $praktikum = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('laboratorium as l','l.ID_LABORATORIUM','p.ID_LABORATORIUM')
        ->where('l.ID_LABORATORIUM','=',$id_lab)
        ->get();
        $jadwalulang = PerubahanJadwalPeminjaman::find($id);

        return view('pengelola.jadwal-ulang.edit', compact('page_title', 'page_description','action','jadwalulang','peminjaman'));
    }
}
