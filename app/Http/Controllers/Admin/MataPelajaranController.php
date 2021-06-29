<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use DB;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Mata Pelajaran';
        $page_description = 'Menampilkan seluruh data mata pelajaran';
        $action = 'table_datatable_basic';
        $matapelajaran = MataPelajaran::all();
        $lab = Laboratorium::all();
        return view('admin.matapelajaran', compact('page_title', 'page_description','action','matapelajaran','lab'));
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
            "mata_pelajaran" => 'required|min:3|unique:App\Models\MataPelajaran,NAMA_MAPEL',
            "id_laboratorium" => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM'
        ]);
        DB::transaction(function() use($request){
            MataPelajaran::insert([
                "NAMA_MAPEL" => $request->mata_pelajaran,
                'ID_LABORATORIUM' => $request->id_laboratorium
            ]);
        });
        return redirect()->route('admin.mata-pelajaran.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "id_laboratorium" => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM'
        ]);
        DB::transaction(function() use($request,$id){
            $mataPelajaran = MataPelajaran::find($id);
            if($mataPelajaran->NAMA_MAPEL != $request->mata_pelajaran)
            {
                $request->validate([
                    "mata_pelajaran" => 'required|min:3|unique:App\Models\MataPelajaran,NAMA_MAPEL',
                ]);
            }
            $mataPelajaran->update([
                "NAMA_MAPEL" => $request->mata_pelajaran,
                'ID_LABORATORIUM' => $request->id_laboratorium
            ]);
        });
        return redirect()->route('admin.mata-pelajaran.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MataPelajaran::find($id)->delete();
        return redirect()->route('admin.mata-pelajaran.index')->with('deleted','Data berhasil dihapus');
    }
}
