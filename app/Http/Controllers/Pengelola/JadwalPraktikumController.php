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
            'ID_KATALOG_BAHAN' => 'required|unique:App\Models\KatalogBahan,ID_KATALOG_BAHAN',
            'ID_LABORATORIUM' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
            'NAMA_KATALOG_BAHAN' => 'required',
        ]);

        DB::transaction(function() use($request){
            PeminjamanAlatBahan::insert([
                "ID_KATALOG_BAHAN" => $request->ID_KATALOG_BAHAN,
                "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
                "NAMA_KATALOG_BAHAN" => $request->NAMA_KATALOG_BAHAN,
            ]);
        });
        return redirect()->route('pengelola.katalog-bahan.index')->with('created','Data berhasil dibuat');
    }
}
