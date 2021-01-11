<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisKelas;
use Illuminate\Http\Request;
use DB;

class JenisKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Jenis Kelas';
        $page_description = 'Menampilkan seluruh data jenis kelas';
        $action = 'table_datatable_basic';
        $jeniskelas = JenisKelas::all();
        return view('admin.jeniskelas', compact('page_title', 'page_description','action','jeniskelas'));
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
            "nama_jenis_kelas" => 'required|min:3|unique:App\Models\JenisKelas,NAMA_JENIS_KELAS'
        ]);
        DB::transaction(function() use($request){
            JenisKelas::insert([
                "NAMA_JENIS_KELAS" => trim($request->nama_jenis_kelas)
            ]);
        });
        return redirect()->route('admin.jenis-kelas.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request,$id){
            $mataPelajaran = JenisKelas::find($id);
            if($mataPelajaran->NAMA_MAPEL != $request->mata_pelajaran)
            {
                $request->validate([
                    "nama_jenis_kelas" => 'required|min:3|unique:App\Models\JenisKelas,NAMA_JENIS_KELAS'
                ]);
            }
            $mataPelajaran->update([
                "NAMA_JENIS_KELAS" => trim($request->nama_jenis_kelas)
            ]);
        });
        return redirect()->route('admin.jenis-kelas.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisKelas  $jenisKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JenisKelas::find($id)->delete();
        return redirect()->route('admin.jenis-kelas.index')->with('deleted','Data berhasil dihapus');
    }
}
