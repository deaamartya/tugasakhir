<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TahunAkademik;
use App\Models\JenisKelas;
use DB;
use App\Models\MataPelajaran;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Kelas';
        $page_description = 'Menampilkan seluruh data kelas';
        $action = 'table_datatable_basic';
        $kelas = Kelas::all();
        $guru = User::guru();
        $tahunakademik = TahunAkademik::all();
        $jeniskelas = JenisKelas::all();
        $mapel = MataPelajaran::all();
        return view('admin.kelas', compact('mapel','page_title', 'page_description','action','kelas','guru','tahunakademik','jeniskelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_USER' => 'required|exists:App\Models\User,ID_USER',
            'ID_TAHUN_AKADEMIK' => 'required|exists:App\Models\TahunAkademik,ID_TAHUN_AKADEMIK',
            'ID_JENIS_KELAS' => 'required|exists:App\Models\JenisKelas,ID_JENIS_KELAS',
            'ID_MAPEL' => 'required|exists:App\Models\MataPelajaran,ID_MAPEL',
        ]);

        DB::transaction(function() use($request){
            Kelas::insert([
                "ID_USER" => $request->ID_USER,
                "ID_TAHUN_AKADEMIK" => $request->ID_TAHUN_AKADEMIK,
                "ID_JENIS_KELAS" => $request->ID_JENIS_KELAS,
                "ID_MAPEL" => $request->ID_MAPEL,
            ]);
        });
        return redirect()->route('admin.kelas.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'ID_USER' => 'required|exists:App\Models\User,ID_USER',
            'ID_TAHUN_AKADEMIK' => 'required|exists:App\Models\TahunAkademik,ID_TAHUN_AKADEMIK',
            'ID_JENIS_KELAS' => 'required|exists:App\Models\JenisKelas,ID_JENIS_KELAS',
            'ID_MAPEL' => 'required|exists:App\Models\MataPelajaran,ID_MAPEL',
        ]);

        DB::transaction(function() use($request,$id){
            $kelas = Kelas::find($id)->update([
                "ID_USER" => $request->ID_USER,
                "ID_TAHUN_AKADEMIK" => $request->ID_TAHUN_AKADEMIK,
                "ID_JENIS_KELAS" => $request->ID_JENIS_KELAS,
                "ID_MAPEL" => $request->ID_MAPEL,
            ]);
        });
        return redirect()->route('admin.kelas.index')->with('updated','Data berhasil diubah');
    }
}
