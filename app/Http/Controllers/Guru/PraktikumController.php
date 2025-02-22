<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlatBahan;
use DB;
use Auth;
use App\Models\TahunAkademik;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Data praktikum guru';
        $action = 'app_calender';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_guru = Auth::user()->ID_USER;
        $id_ta = Auth::user()->id_tahun_akademik();
        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('kelas as k','peminjaman_alat_bahan.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('r.ID_LABORATORIUM','=',$id_lab)->get();

        return view('guru.praktikum', compact('page_title', 'page_description','action','praktikum'));
    }

    public function seluruhJadwal()
    {
        $data = [];
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_guru = Auth::user()->ID_USER;
        $id_ta = Auth::user()->id_tahun_akademik();
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('kelas as k','peminjaman_alat_bahan.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('r.ID_LABORATORIUM','=',$id_lab)->where('STATUS_PEMINJAMAN','=','MENUNGGU KONFIRMASI')->get();
        
        $i = 0;
        foreach($peminjaman as $p)
        {
            $obj = new \StdClass();
            $kelas = $p->kelas->jenis_kelas->NAMA_JENIS_KELAS;
            $obj->title = $p->praktikum->JUDUL_PRAKTIKUM." ".$kelas;

            $jammulai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_MULAI;
            $jamselesai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_SELESAI;

            $date_start = date_create_from_format('Y-m-d H:i', $jammulai);
            $date_end = date_create_from_format('Y-m-d H:i', $jamselesai);

            $obj->start = date_format($date_start, 'Y-m-d H:i');
            $obj->end = date_format($date_end, 'Y-m-d H:i');

            if(strpos($kelas, 'X MIPA') !== false)
            {
                $obj->className = "bg-primary p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XI MIPA') !== false)
            {
                $obj->className = "bg-success p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XII MIPA') !== false)
            {
                $obj->className = "bg-danger p-1 border-0 mb-1 rounded-2 m-1";
            }

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }

    public function seluruhJadwalNama(Request $request)
    {
        $data = [];
        $praktikum = Praktikum::find($request->prakt);
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_guru = Auth::user()->ID_USER;
        $id_ta = Auth::user()->id_tahun_akademik();
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','peminjaman_alat_bahan.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('r.ID_LABORATORIUM','=',$id_lab)
        ->where('p.JUDUL_PRAKTIKUM','LIKE',"%".$praktikum->JUDUL_PRAKTIKUM."%")->where('STATUS_PEMINJAMAN','=','MENUNGGU KONFIRMASI')->get();
        
        $i = 0;
        foreach($peminjaman as $p)
        {
            $obj = new \StdClass();
            $kelas = $p->kelas->jenis_kelas->NAMA_JENIS_KELAS;
            $obj->title = $p->praktikum->JUDUL_PRAKTIKUM." ".$kelas;

            $jammulai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_MULAI;
            $jamselesai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_SELESAI;

            $date_start = date_create_from_format('Y-m-d H:i', $jammulai);
            $date_end = date_create_from_format('Y-m-d H:i', $jamselesai);

            $obj->start = date_format($date_start, 'Y-m-d H:i');
            $obj->end = date_format($date_end, 'Y-m-d H:i');

            if(strpos($kelas, 'X MIPA') !== false)
            {
                $obj->className = "bg-primary p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XI MIPA') !== false)
            {
                $obj->className = "bg-success p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XII MIPA') !== false)
            {
                $obj->className = "bg-danger p-1 border-0 mb-1 rounded-2 m-1";
            }

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }
}
