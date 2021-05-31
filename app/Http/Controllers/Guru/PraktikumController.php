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
    private $tahun;
    private $tahunp1;
    private $tahunm1;
    private $tahun_akademik;

    public function __construct()
    {
        $this->tahun = intval(date('Y'));
        $this->tahunp1 = $this->tahun+1;
        $this->tahunm1 = $this->tahun-1;

        $tahun_akademik;
        if(date('m') >= 7 ){
            $tahun_akademik = $this->tahun.'/'.$this->tahunp1.' Gasal';
        }
        else {
            $tahun_akademik = $this->tahunm1.'/'.$this->tahun.' Genap';
        }
    
        $this->tahun_akademik = TahunAkademik::where('TAHUN_AKADEMIK',$tahun_akademik)->value('ID_TAHUN_AKADEMIK');
    }

    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Data praktikum guru';
        $action = 'app_calender';

        $praktikum = PeminjamanAlatBahan::
        join('ruang_laboratorium as l','l.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->where('l.ID_LABORATORIUM',Auth::user()->ID_LABORATORIUM)
        ->join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','p.ID_KELAS')
        ->where('k.ID_USER',Auth::user()->ID_USER)
        ->where('k.ID_TAHUN_AKADEMIK',$this->tahun_akademik)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->orderBy('TANGGAL_PEMINJAMAN','ASC')
        ->get();

        return view('guru.praktikum', compact('page_title', 'page_description','action','praktikum'));
    }

    public function seluruhJadwal()
    {
        $data = [];
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_guru = Auth::user()->ID_USER;
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','p.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('k.ID_TAHUN_AKADEMIK',$this->tahun_akademik)
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

    public function seluruhJadwalNama(Request $request)
    {
        $data = [];
        $praktikum = Praktikum::find($request->prakt);
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $id_guru = Auth::user()->ID_USER;
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')
        ->join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','p.ID_KELAS','=','k.ID_KELAS')
        ->where('k.ID_USER','=',$id_guru)
        ->where('k.ID_TAHUN_AKADEMIK',$this->tahun_akademik)
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

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }
}
