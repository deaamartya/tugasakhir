<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;
use App\Models\PeminjamanAlatBahan;
use App\Models\Praktikum;
use App\Models\HistoriStok;
use App\Models\TahunAkademik;
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

        $tahun = date('Y');
        if(date('m') >= 7 ){
            $tgl_awal_semester = $tahun.'-07-01';
            $tgl_akhir_semester = $tahun.'-12-31';
        }
        else {
            $tgl_awal_semester = $tahun.'-01-01';
            $tgl_akhir_semester = $tahun.'-05-31';
        }
        $tgl_awal_tahun = $tahun.'-01-01';
        $tgl_akhir_tahun = $tahun.'-12-31';

        $beban_lab_semester = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_semester, $tgl_akhir_semester])->count('ID_PEMINJAMAN');

        $beban_lab_tahun = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_tahun, $tgl_akhir_tahun])->count('ID_PEMINJAMAN');

        $jadwal_ulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','p.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->where('STATUS_PERUBAHAN',0)->count('ID_PERUBAHAN_JADWAL');

        $total_peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_tahun, $tgl_akhir_tahun])->count('ID_PEMINJAMAN');

        $tahun = intval(date('Y'));
        $tahunp1 = $tahun+1;
        $tahunm1 = $tahun-1;
        if(date('m') >= 7 ){
            $tahun_akademik = $tahun.'/'.$tahunp1.' Gasal';
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
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->count('ID_PEMINJAMAN');

        // Jumlah praktikum yang sudah dijadwalkan dalam semester.
        $sedang_pinjam = PeminjamanAlatBahan::
        join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')
        ->count('ID_PEMINJAMAN');

        // Ambil semua praktikum guru dalam semester.
        $jadwal = PeminjamanAlatBahan::
        select('peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->get()->toArray();

        // Jumlah praktikum belum dijadwalkan dalam semester.
        $menunggu_penjadwalan = Praktikum::
        join('kelas as k','k.ID_KELAS','praktikum.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->whereNotIn('ID_PRAKTIKUM',$jadwal)
        ->count('ID_PRAKTIKUM');

        // Ambil seluruh praktikum terjadwal
        $praktikum = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->get();

        // Ambil 3 praktikum terjadwal
        $praktikum_menunggu = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->limit(10)->get();

        // Ambil 3 praktikum selesai
        $praktikum_selesai = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->orderBy('ID_PEMINJAMAN','DESC')
        ->limit(10)->get();

        return view('pengelola.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia','menunggu_penjadwalan','sedang_pinjam','dikembalikan','total_peminjaman','beban_lab_semester','beban_lab_tahun','jadwal_ulang','dikembalikan','sedang_pinjam','menunggu_penjadwalan','praktikum','praktikum_menunggu','praktikum_selesai'));
    }

    public function seluruhJadwal()
    {
        $tahun = intval(date('Y'));
        $tahunp1 = $tahun+1;
        $tahunm1 = $tahun-1;
        
        if(date('m') >= 7 ){
            $tahun_akademik = $tahun.'/'.$tahunp1.' Gasal';
        }
        else {
            $tahun_akademik = $tahunm1.'/'.$tahun.' Genap';
        }

        $tahun_akademik = TahunAkademik::where('TAHUN_AKADEMIK',$tahun_akademik)->first();
        
        $data = [];
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        // ->join('kelas as k','p.ID_KELAS','=','k.ID_KELAS')
        // ->where('k.ID_TAHUN_AKADEMIK',$tahun_akademik->ID_TAHUN_AKADEMIK)
        ->where('r.ID_LABORATORIUM','=',$id_lab)->get();
        
        $i = 0;
        foreach($peminjaman as $p)
        {
            $obj = new \StdClass();
            $kelas = $p->praktikum->kelas->jenis_kelas->NAMA_JENIS_KELAS;
            $obj->title = $p->praktikum->NAMA_PRAKTIKUM." ".$kelas;

            $jammulai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_MULAI;
            $jamselesai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_SELESAI;

            $date_start = date_create_from_format('Y-m-d H:i', $jammulai);
            $date_end = date_create_from_format('Y-m-d H:i', $jamselesai);

            $obj->start = date_format($date_start, 'Y-m-d H:i');
            $obj->end = date_format($date_end, 'Y-m-d H:i');

            if(strpos($kelas, 'X MIPA') !== false)
            {
                $obj->className = "bg-primary";
            }
            elseif(strpos($kelas, 'XI MIPA') !== false)
            {
                $obj->className = "bg-success";
            }
            elseif(strpos($kelas, 'XII MIPA') !== false)
            {
                $obj->className = "bg-danger";
            }

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }
}
