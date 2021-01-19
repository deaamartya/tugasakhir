<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;
use App\Models\PeminjamanAlatBahan;
use App\Models\Praktikum;
use App\Models\HistoriStok;
use Auth;

class PengelolaController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        $id_lab = Auth::user()->tipe_user->ID_LABORATORIUM;

        $total_alat_bagus = Alat::join('katalog_alat as ka','ka.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->join('kategori_alat as kt','kt.ID_KATEGORI_ALAT','ka.ID_KATEGORI_ALAT')->where('kt.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_BAGUS');

        $total_alat_rusak = Alat::join('katalog_alat as ka','ka.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->join('kategori_alat as kt','kt.ID_KATEGORI_ALAT','ka.ID_KATEGORI_ALAT')->where('kt.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_RUSAK');

        $total_bahan = Bahan::join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->sum('JUMLAH');

        $total_bahan_kimia = BahanKimia::join('lemari as l','l.ID_LEMARI','bahan_kimia.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_BAHAN_KIMIA');

        $jadwal = PeminjamanAlatBahan::select('ID_PRAKTIKUM')->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->get()->toArray();

        $menunggu_penjadwalan = Praktikum::where('ID_LABORATORIUM',$id_lab)->whereNotIn('ID_PRAKTIKUM',$jadwal)->count('ID_PRAKTIKUM');

        $sedang_pinjam = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')->count('ID_PRAKTIKUM');

        $dikembalikan = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->count('ID_PRAKTIKUM');

        $total_peminjaman = Praktikum::where('ID_LABORATORIUM',$id_lab)->count('ID_PRAKTIKUM');

        return view('pengelola.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia','menunggu_penjadwalan','sedang_pinjam','dikembalikan','total_peminjaman'));
    }
}
