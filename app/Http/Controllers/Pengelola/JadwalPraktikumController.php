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

class JadwalPraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';
        $id_lab = 1;
        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->get();
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
        $id_lab = 1;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->get();
        $ruanglaboratorium = RuangLaboratorium::where('ID_LABORATORIUM',$id_lab)->get();
        return view('pengelola.jadwal-praktikum.create', compact('page_title','page_description','action','praktikum','ruanglaboratorium'));
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
        return redirect()->route('pengelola.jadwal-praktikum.create')->with('created','Data berhasil dibuat');
    }
}
