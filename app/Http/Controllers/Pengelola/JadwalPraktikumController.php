<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Praktikum;
use App\Models\Laboratorium;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use DB;
use App\Models\PeminjamanAlatBahan;
use App\Models\RuangLaboratorium;
use Calendar;
use Auth;

class JadwalPraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();
        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);
        $matapelajaran = MataPelajaran::select('mata_pelajaran.*')->where('NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.jadwal-praktikum.index', compact('page_title', 'page_description','action','praktikum','kelas','matapelajaran','lab'));
    }

    public function create()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'uc_select2';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->get();
        $ruanglaboratorium = RuangLaboratorium::where('ID_LABORATORIUM',$id_lab)->get();
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->get();
        return view('pengelola.jadwal-praktikum.create', compact('page_title','page_description','action','praktikum','ruanglaboratorium','peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_RUANG_LABORATORIUM' => 'required|exists:App\Models\RuangLaboratorium,ID_RUANG_LABORATORIUM',
            'ID_PRAKTIKUM' => 'required|exists:App\Models\Praktikum,ID_PRAKTIKUM',
            'TANGGAL_PEMINJAMAN_submit' => 'required',
            'JAM_MULAI' => 'required',
            'JAM_SELESAI' => 'required',
        ]);

        DB::transaction(function() use($request){
            PeminjamanAlatBahan::insert([
                "ID_RUANG_LABORATORIUM" => $request->ID_RUANG_LABORATORIUM,
                "ID_PRAKTIKUM" => $request->ID_PRAKTIKUM,
                "TANGGAL_PEMINJAMAN" => $request->TANGGAL_PEMINJAMAN_submit,
                "JAM_MULAI" => $request->JAM_MULAI,
                "JAM_SELESAI" => $request->JAM_SELESAI,
                "STATUS_PEMINJAMAN" => "MENUNGGU KONFIRMASI",
            ]);
        });
        return redirect()->route('pengelola.jadwal-praktikum.index')->with('created','Data berhasil dibuat');
    }

    public function seluruhJadwal()
    {
        $data = [];
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->get();
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

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

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
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('p.NAMA_PRAKTIKUM','LIKE',"%".$praktikum->NAMA_PRAKTIKUM."%")->get();
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

    public function cekRuang(Request $request) {

        $booked = PeminjamanAlatBahan::where([
            'ID_RUANG_LABORATORIUM' => $request->id_ruang,
            'TANGGAL_PEMINJAMAN' => $request->tgl
        ])->get();

        if(count($booked) > 0){
            foreach($booked as $b){
                $jam_mulai = $b->JAM_MULAI;
                $jam_selesai = $b->JAM_SELESAI;

                $jam_mulai = explode(":",$jam_mulai);
                $jam_mulai = intval($jam_mulai[0]*60) + intval($jam_mulai[1]);

                $jam_selesai = explode(":",$jam_selesai);
                $jam_selesai = intval($jam_selesai[0]*60) + intval($jam_selesai[1]);

                if($jam_mulai > $request->jam_selesai || $jam_selesai < $request->jam_mulai){
                    return response()->json(false);
                }
                else {
                    return response()->json(true);
                }
            }
        } else {
            return response()->json(false);
        }
    }
}
