<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerkTipeAlat;
use DB;
use Auth;

class MerkTipeController extends Controller
{
    public function index()
    {
        $page_title = 'Data Merk/Tipe';
        $page_description = 'Menampilkan seluruh data merk/tipe alat bahan';
        $action = 'table_datatable_basic';
        $merktipe = MerkTipeAlat::orderBy('ID_MERK_TIPE','DESC')->get();
        return view('pengelola.tipe', compact('page_title', 'page_description','action','merktipe'));
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
            'NAMA_MERK_TIPE' => 'required',
        ]);

        DB::transaction(function() use($request){
            MerkTipeAlat::insert([
                "NAMA_MERK_TIPE" => $request->NAMA_MERK_TIPE,
            ]);
        });
        return redirect()->route('pengelola.tipe.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_MERK_TIPE' => 'required',
        ]);

        $ruanglab = MerkTipeAlat::find($id);
        $ruanglab->update([
            "NAMA_MERK_TIPE" => $request->NAMA_MERK_TIPE,
        ]);
        
        return redirect()->route('pengelola.tipe.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MerkTipeAlat::find($id)->delete();
        return redirect()->route('pengelola.tipe.index')->with('deleted','Data berhasil dihapus');
    }
}
