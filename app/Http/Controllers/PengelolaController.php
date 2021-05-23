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
use DB;
use App\Models\PerubahanJadwalPeminjaman;

class PengelolaController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        $id_lab = Auth::user()->ID_LABORATORIUM;

        $total_alat_bagus = Alat::join('katalog_alat as ka','ka.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->join('kategori_alat as kt','kt.ID_KATEGORI_ALAT','ka.ID_KATEGORI_ALAT')->where('kt.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_BAGUS');

        $total_alat_rusak = Alat::join('katalog_alat as ka','ka.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->join('kategori_alat as kt','kt.ID_KATEGORI_ALAT','ka.ID_KATEGORI_ALAT')->where('kt.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_RUSAK');

        $total_bahan = Bahan::join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->sum('JUMLAH');

        $total_bahan_kimia = BahanKimia::join('lemari as l','l.ID_LEMARI','bahan_kimia.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->sum('JUMLAH_BAHAN_KIMIA');

        $jadwal = PeminjamanAlatBahan::select('ID_PRAKTIKUM')->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->get()->toArray();

        $menunggu_penjadwalan = Praktikum::where('ID_LABORATORIUM',$id_lab)->whereNotIn('ID_PRAKTIKUM',$jadwal)->count('ID_PRAKTIKUM');

        $sedang_pinjam = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')->count('ID_PRAKTIKUM');

        $dikembalikan = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->count('ID_PRAKTIKUM');

        $total_peminjaman = Praktikum::where('ID_LABORATORIUM',$id_lab)->count('ID_PRAKTIKUM');
        $tahun = date('Y');
        if(date('m') >= 6 ){
            $tgl_awal_semester = $tahun.'-06-01';
            $tgl_akhir_semester = $tahun.'-12-31';
        }
        else {
            $tgl_awal_semester = $tahun.'-01-01';
            $tgl_akhir_semester = $tahun.'-05-31';
        }
        $tgl_awal_tahun = $tahun.'-01-01';
        $tgl_akhir_tahun = $tahun.'-12-31';

        $beban_lab_semester = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_semester, $tgl_akhir_semester])->count('ID_PEMINJAMAN');

        $beban_lab_tahun = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_tahun, $tgl_akhir_tahun])->count('ID_PEMINJAMAN');

        $jadwal_ulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','p.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PERUBAHAN',0)->count('ID_PERUBAHAN_JADWAL');

        return view('pengelola.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia','menunggu_penjadwalan','sedang_pinjam','dikembalikan','total_peminjaman','beban_lab_semester','beban_lab_tahun','jadwal_ulang'));
    }
}
