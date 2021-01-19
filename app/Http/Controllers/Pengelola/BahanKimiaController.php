<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lemari;
use App\Models\KatalogBahan;
use App\Models\BahanKimia;
use App\Models\Laboratorium;
use DB;

class BahanKimiaController extends Controller
{
    public function index()
    {
        $page_title = 'Data Bahan Kimia';
        $page_description = 'Menampilkan seluruh data bahan kimia';
        $action = 'table_datatable_basic';
        $id_lab = Auth::user()->tipe_user->ID_LABORATORIUM;
        $lab = Laboratorium::find($id_lab);
        $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();
        $katalogbahan = KatalogBahan::where('ID_LABORATORIUM',$id_lab)->get();
        $bahankimia = BahanKimia::join('lemari as le','le.ID_LEMARI','bahan_kimia.ID_LEMARI')->join('laboratorium as l','l.ID_LABORATORIUM','le.ID_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->get();
        return view('pengelola.bahan-kimia', compact('page_title', 'page_description','action','bahankimia','lemari','katalogbahan'));
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
            'ID_KATALOG_BAHAN' => 'required|exists:App\Models\KatalogBahan,ID_KATALOG_BAHAN',
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'RUMUS' => 'required',
            'WUJUD' => 'required',
            'JUMLAH_BAHAN_KIMIA' => 'required',
            'SPESIFIKASI_BAHAN' => 'required',
        ]);

        $request->SPESIFIKASI_BAHAN = ($request->SPESIFIKASI_BAHAN == "true") ? true : false;

        DB::transaction(function() use($request){
            BahanKimia::insert([
                'ID_KATALOG_BAHAN' => $request->ID_KATALOG_BAHAN,
                'ID_LEMARI' => $request->ID_LEMARI,
                'RUMUS' => $request->RUMUS,
                'WUJUD' => $request->WUJUD,
                'JUMLAH_BAHAN_KIMIA' => $request->JUMLAH_BAHAN_KIMIA,
                'SPESIFIKASI_BAHAN' => $request->SPESIFIKASI_BAHAN,
            ]);
        });
        return redirect()->route('pengelola.bahan-kimia.index')->with('created','Data berhasil dibuat');
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
            'ID_KATALOG_BAHAN' => 'required|exists:App\Models\KatalogBahan,ID_KATALOG_BAHAN',
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'RUMUS' => 'required',
            'WUJUD' => 'required',
            'JUMLAH_BAHAN_KIMIA' => 'required',
            'SPESIFIKASI_BAHAN' => 'required',
        ]);

        $request->SPESIFIKASI_BAHAN = ($request->SPESIFIKASI_BAHAN == "true") ? true : false;

        $bahankimia = BahanKimia::find($request->ID_BAHAN_KIMIA);
        $bahankimia->update([
            'ID_KATALOG_BAHAN' => $request->ID_KATALOG_BAHAN,
            'ID_LEMARI' => $request->ID_LEMARI,
            'RUMUS' => $request->RUMUS,
            'WUJUD' => $request->WUJUD,
            'JUMLAH_BAHAN_KIMIA' => $request->JUMLAH_BAHAN_KIMIA,
            'SPESIFIKASI_BAHAN' => $request->SPESIFIKASI_BAHAN,
        ]);
        
        return redirect()->route('pengelola.bahan-kimia.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        BahanKimia::find($request->ID_BAHAN_KIMIA)->delete();
        return redirect()->route('pengelola.bahan-kimia.index')->with('deleted','Data berhasil dihapus');
    }
}