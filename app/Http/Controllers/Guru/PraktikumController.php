<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlatBahan;
use DB;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Praktikum Kelas Saya';
        $page_description = 'Data praktikum guru';
        $action = 'app_calender';
        $id_guru = 6;
        $praktikum = PeminjamanAlatBahan::join('praktikum as pr','pr.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','=','pr.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)->get();
        return view('guru.praktikum', compact('page_title', 'page_description','action','praktikum'));
    }

    public function seluruhJadwal()
    {
        $data = [];
        $id_lab = 1;
        $id_guru = 6;
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','p.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
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

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }

    public function seluruhJadwalNama(Request $request)
    {
        $data = [];
        $praktikum = Praktikum::find($request->prakt);
        $id_lab = 1;
        $id_guru = 6;
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','p.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('r.ID_LABORATORIUM','=',$id_lab)
        ->where('p.NAMA_PRAKTIKUM','LIKE',"%".$praktikum->NAMA_PRAKTIKUM."%")->get();
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

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }
}
