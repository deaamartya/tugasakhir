<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatalogAlat;
use App\Models\Lemari;
use App\Models\MerkTipeAlat;
use App\Models\Alat;

use DB;

class AlatController extends Controller
{
    public function index()
    {
        $page_title = 'Data Alat';
        $page_description = 'Menampilkan seluruh data alat';
        $action = 'table_datatable_basic';
        $id_lab = 1;
        $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();
        $katalog = KatalogAlat::all();
        $tipe = MerkTipeAlat::all();
        $alat = Alat::all();
        return view('pengelola.alat', compact('page_title', 'page_description','action','lemari','katalog','tipe','alat'));
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
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'ID_MERK_TIPE' => 'required|exists:App\Models\MerkTipeAlat,ID_MERK_TIPE',
            'ID_KATALOG_ALAT' => 'required|exists:App\Models\KatalogAlat,ID_KATALOG_ALAT',
            'JUMLAH_BAGUS' => 'required',
            'JUMLAH_RUSAK' => 'required'
        ]);

        DB::transaction(function() use($request){
            Alat::insert([
                'ID_LEMARI' => $request->ID_LEMARI,
                'ID_MERK_TIPE' => $request->ID_MERK_TIPE,
                'ID_KATALOG_ALAT' => $request->ID_KATALOG_ALAT,
                'JUMLAH_BAGUS' => $request->JUMLAH_BAGUS,
                'JUMLAH_RUSAK' => $request->JUMLAH_RUSAK
            ]);
        });
        return redirect()->route('pengelola.alat.index')->with('created','Data berhasil dibuat');
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
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'ID_MERK_TIPE' => 'required|exists:App\Models\MerkTipeAlat,ID_MERK_TIPE',
            'ID_KATALOG_ALAT' => 'required|exists:App\Models\KatalogAlat,ID_KATALOG_ALAT',
            'JUMLAH_BAGUS' => 'required',
            'JUMLAH_RUSAK' => 'required'
        ]);

        $alat = Alat::find($request->ID_ALAT_LAMA);
        $alat->update([
            'ID_LEMARI' => $request->ID_LEMARI,
            'ID_MERK_TIPE' => $request->ID_MERK_TIPE,
            'ID_KATALOG_ALAT' => $request->ID_KATALOG_ALAT,
            'JUMLAH_BAGUS' => $request->JUMLAH_BAGUS,
            'JUMLAH_RUSAK' => $request->JUMLAH_RUSAK
        ]);
        
        return redirect()->route('pengelola.alat.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Alat::find($request->ID_ALAT_LAMA)->delete();
        return redirect()->route('pengelola.alat.index')->with('deleted','Data berhasil dihapus');
    }
}
