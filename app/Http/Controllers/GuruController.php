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

        $tahun = intval(date('Y'));
        $tahunp1 = $tahun+1;
        $tahunm1 = $tahun-1;
        if(date('m') >= 6 ){
            $tahun_akademik = $tahun.'/'.$tahunp1.' Ganjil';
        }
        else {
            $tahun_akademik = $tahunm1.'/'.$tahun.' Genap';
        }

        $tahun_akademik = TahunAkademik::where('TAHUN_AKADEMIK',$tahun_akademik)->first();

        // Jumlah praktikum yang selesai dalam semester.
        $dikembalikan = PeminjamanAlatBahan::
        join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->count('ID_PEMINJAMAN');

        // Jumlah praktikum yang sudah dijadwalkan dalam semester.
        $sedang_pinjam = PeminjamanAlatBahan::
        join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->count('ID_PEMINJAMAN');

        // Ambil semua praktikum guru dalam semester.
        $jadwal = PeminjamanAlatBahan::
        select('peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->get()->toArray();

        // Jumlah praktikum belum dijadwalkan dalam semester.
        $menunggu_penjadwalan = Praktikum::
        join('kelas as k','k.ID_KELAS','praktikum.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->whereNotIn('ID_PRAKTIKUM',$jadwal)
        ->count('ID_PRAKTIKUM');

        // Ambil seluruh praktikum terjadwal
        $praktikum = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->get();

        // Ambil 3 praktikum terjadwal
        $praktikum_menunggu = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->limit(10)->get();

        // Ambil 3 praktikum selesai
        $praktikum_selesai = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_USER','=',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->orderBy('ID_PEMINJAMAN','DESC')
        ->limit(10)->get();

        return view('guru.dashboard', compact('page_title', 'page_description','action','dikembalikan','sedang_pinjam','menunggu_penjadwalan','praktikum','praktikum_menunggu','praktikum_selesai','tahun_akademik'));
    }
}
