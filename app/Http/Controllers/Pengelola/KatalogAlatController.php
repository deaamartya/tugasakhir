<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatalogAlat;
use App\Models\KategoriAlat;
use DB;

class KatalogAlatController extends Controller
{
    public function index()
    {
        $page_title = 'Data Katalog Alat';
        $page_description = 'Menampilkan seluruh data katalog alat';
        $action = 'table_datatable_basic';
        $katalogalat = KatalogAlat::orderBy('ID_KATALOG_ALAT','DESC')->get();
        $id_lab = Auth::user()->tipe_user->ID_LABORATORIUM;
        $kategori = KategoriAlat::where('ID_LABORATORIUM',$id_lab)->get();
        return view('pengelola.katalog-alat', compact('page_title', 'page_description','action','katalogalat','kategori'));
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
            'ID_KATEGORI_ALAT' => 'required|exists:App\Models\KategoriAlat,ID_KATEGORI_ALAT',
            'NAMA_ALAT' => 'required',
            'ID_KATALOG_ALAT' => 'required|unique:App\Models\KatalogAlat,ID_KATALOG_ALAT',
            'UKURAN' => 'required',
        ]);

        DB::transaction(function() use($request){
            KatalogAlat::insert([
                "ID_KATALOG_ALAT" => $request->ID_KATALOG_ALAT,
                "UKURAN" => $request->UKURAN,
                "ID_KATEGORI_ALAT" => $request->ID_KATEGORI_ALAT,
                "NAMA_ALAT" => $request->NAMA_ALAT,
            ]);
        });
        return redirect()->route('pengelola.katalog-alat.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'ID_KATEGORI_ALAT' => 'required|exists:App\Models\KategoriAlat,ID_KATEGORI_ALAT',
            'NAMA_ALAT' => 'required',
            'UKURAN' => 'required',
            'ID_KATALOG_ALAT' => 'required',
        ]);

        $katalogalat = KatalogAlat::find($request->ID_KATALOG_LAMA);

        if($katalogalat->ID_KATALOG_ALAT != $request->ID_KATALOG_ALAT){
            $request->validate([
                'ID_KATALOG_ALAT' => 'unique:App\Models\KatalogAlat,ID_KATALOG_ALAT',
            ]);
        }

        $katalogalat->update([
            "ID_KATALOG_ALAT" => $request->ID_KATALOG_ALAT,
            "UKURAN" => $request->UKURAN,
            "ID_KATEGORI_ALAT" => $request->ID_KATEGORI_ALAT,
            "NAMA_ALAT" => $request->NAMA_ALAT,
        ]);
        
        return redirect()->route('pengelola.katalog-alat.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        KatalogAlat::find($request->ID_KATALOG_LAMA)->delete();
        return redirect()->route('pengelola.katalog-alat.index')->with('deleted','Data berhasil dihapus');
    }
}
