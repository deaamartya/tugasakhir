<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriAlat;
use App\Models\Laboratorium;
use DB;

class KategoriAlatController extends Controller
{
    public function index()
    {
        $page_title = 'Data Kategori Alat';
        $page_description = 'Menampilkan seluruh data kategori alat';
        $action = 'table_datatable_basic';
        $id_lab = Auth::user()->tipe_user->ID_LABORATORIUM;
        $kategori = KategoriAlat::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.kategori-alat', compact('page_title', 'page_description','action','kategori','lab'));
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
            'ID_LABORATORIUM' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
            'NAMA_KATEGORI' => 'required',
        ]);

        DB::transaction(function() use($request){
            KategoriAlat::insert([
                "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
                "NAMA_KATEGORI" => $request->NAMA_KATEGORI,
            ]);
        });
        return redirect()->route('pengelola.kategori-alat.index')->with('created','Data berhasil dibuat');
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
            'ID_LABORATORIUM' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
        ]);

        $kategori = KategoriAlat::find($id);

        if($kategori->NAMA_KATEGORI != $request->NAMA_KATEGORI)
        {
            $request->validate([
                'NAMA_KATEGORI' => 'required',
            ]);
        }

        $kategori->update([
            "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
            "NAMA_KATEGORI" => $request->NAMA_KATEGORI,
        ]);
        
        return redirect()->route('pengelola.kategori-alat.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KategoriAlat::find($id)->delete();
        return redirect()->route('pengelola.kategori-alat.index')->with('deleted','Data berhasil dihapus');
    }
}
