<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\PeminjamanAlatBahan;
use App\Models\Praktikum;
use App\Models\TahunAkademik;
use DB;

class GuruController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Dashboard Guru';
        $action = 'dashboard_1';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_ta = Auth::user()->id_tahun_akademik();
        $tahun_akademik = TahunAkademik::find($id_ta);

        // Jumlah praktikum yang selesai dalam semester.
        $dikembalikan = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->count('ID_PEMINJAMAN');

        // Jumlah praktikum yang sudah dijadwalkan dalam semester.
        $sedang_pinjam = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->count('ID_PEMINJAMAN');

        // Ambil semua praktikum guru dalam semester.
        $jadwal = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->get()->toArray();

        // Jumlah praktikum belum dijadwalkan dalam semester.
        // $menunggu_penjadwalan = Praktikum::
        // join('kelas as k','k.ID_KELAS','praktikum.ID_KELAS')
        // ->where('k.ID_USER',Auth::user()->ID_USER)
        // ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        // ->whereNotIn('ID_PRAKTIKUM',$jadwal)
        // ->count('ID_PRAKTIKUM');

        $menunggu_penjadwalan = 0;

        // Ambil seluruh praktikum terjadwal
        $praktikum = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->get();

        // Ambil 3 praktikum terjadwal
        $praktikum_menunggu = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->limit(10)->get();

        // Ambil 3 praktikum selesai
        $praktikum_selesai = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->orderBy('ID_PEMINJAMAN','DESC')
        ->limit(10)->get();

        return view('guru.dashboard', compact('page_title', 'page_description','action','dikembalikan','sedang_pinjam','menunggu_penjadwalan','praktikum','praktikum_menunggu','praktikum_selesai','tahun_akademik'));
    }
}
