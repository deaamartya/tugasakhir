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
        $page_title = 'Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.jadwal-praktikum.index', compact('page_title', 'page_description','action','praktikum','lab'));
    }

    public function create()
    {
        $page_title = 'Buat Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        $list_mapel = Auth::user()->list_mapel();
        $id_ta = Auth::user()->id_tahun_akademik();
        $praktikum = Praktikum::whereIn('ID_MAPEL',$list_mapel)->get();

        $ruanglaboratorium = RuangLaboratorium::where('ID_LABORATORIUM',$id_lab)->get();
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->get();
        $kelas = Kelas::where('ID_TAHUN_AKADEMIK','=',$id_ta)->where('ID_MAPEL',$praktikum[0]->ID_MAPEL)->get();

        return view('pengelola.jadwal-praktikum.create', compact('page_title','page_description','action','praktikum','ruanglaboratorium','peminjaman','kelas'));
    }

    public function getKelas(Request $request){
        $id_mapel = Praktikum::where('ID_PRAKTIKUM',$request->id_prak)->value('ID_MAPEL');
        $id_ta = Auth::user()->id_tahun_akademik();
        $kelas = Kelas::join('jenis_kelas as j','j.ID_JENIS_KELAS','kelas.ID_JENIS_KELAS')
        ->where([
            'ID_TAHUN_AKADEMIK' => $id_ta,
            'ID_MAPEL' => $id_mapel])
        ->pluck('ID_KELAS','j.NAMA_JENIS_KELAS');
        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ID_RUANG_LABORATORIUM' => 'required|exists:App\Models\RuangLaboratorium,ID_RUANG_LABORATORIUM',
            'ID_PRAKTIKUM' => 'required|exists:App\Models\Praktikum,ID_PRAKTIKUM',
            'ID_KELAS' => 'required|exists:App\Models\Kelas,ID_KELAS',
            'TANGGAL_PEMINJAMAN_submit' => 'required',
            'JAM_MULAI' => 'required',
            'JAM_SELESAI' => 'required',
        ]);

        DB::transaction(function() use($request){
            PeminjamanAlatBahan::insert([
                "ID_RUANG_LABORATORIUM" => $request->ID_RUANG_LABORATORIUM,
                "ID_PRAKTIKUM" => $request->ID_PRAKTIKUM,
                "ID_KELAS" => $request->ID_KELAS,
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
            $kelas = $p->kelas->jenis_kelas->NAMA_JENIS_KELAS;
            $obj->title = $p->praktikum->JUDUL_PRAKTIKUM." ".$kelas;

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
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')->join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('p.JUDUL_PRAKTIKUM','LIKE',"%".$praktikum->JUDUL_PRAKTIKUM."%")->get();
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
