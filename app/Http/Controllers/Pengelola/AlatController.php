<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatalogAlat;
use App\Models\Lemari;
use App\Models\MerkTipeAlat;
use App\Models\Alat;
use Auth;
use DB;
use App\Models\HistoriStok;

class AlatController extends Controller
{
    public function index()
    {
        $page_title = 'Data Alat';
        $page_description = 'Menampilkan seluruh data alat';
        $action = 'table_datatable_basic';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();
        $katalog = KatalogAlat::join('kategori_alat as k','k.ID_KATEGORI_ALAT','katalog_alat.ID_KATEGORI_ALAT')->where('k.ID_LABORATORIUM','=',$id_lab)->get();
        $tipe = MerkTipeAlat::all();
        $alat = Alat::join('lemari as l','l.ID_LEMARI','alat.ID_LEMARI')->where('l.ID_LABORATORIUM','=',$id_lab)->get();
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
            ]);

            $id_alat = Alat::where([
                'ID_LEMARI' => $request->ID_LEMARI,
                'ID_MERK_TIPE' => $request->ID_MERK_TIPE,
                'ID_KATALOG_ALAT' => $request->ID_KATALOG_ALAT,
            ])->value('ID_ALAT');

            $data_stok_alat[] = [
                'ID_TIPE' => 1,
                'ID_ALAT_BAHAN' => $id_alat,
                'JUMLAH_KELUAR' => 0,
                'JUMLAH_MASUK' => $request->JUMLAH_BAGUS,
                'KONDISI' => 1,
                'KETERANGAN' => "Stok awal"
            ];

            $data_stok_alat[] = [
                'ID_TIPE' => 1,
                'ID_ALAT_BAHAN' => $id_alat,
                'JUMLAH_KELUAR' => 0,
                'JUMLAH_MASUK' => $request->JUMLAH_RUSAK,
                'KONDISI' => 0,
                'KETERANGAN' => "Stok awal"
            ];
    
            HistoriStok::insert($data_stok_alat);
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
        ]);

        $alat = Alat::find($request->ID_ALAT_LAMA);
        $alat->update([
            'ID_LEMARI' => $request->ID_LEMARI,
            'ID_MERK_TIPE' => $request->ID_MERK_TIPE,
            'ID_KATALOG_ALAT' => $request->ID_KATALOG_ALAT,
        ]);
        
        return redirect()->route('pengelola.alat.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateStock(Request $request)
    {
        $request->validate([
            'JUMLAH_BAGUS_MASUK' => 'required|min:0|integer',
            'JUMLAH_RUSAK_MASUK' => 'required|min:0|integer',
            'JUMLAH_BAGUS_KELUAR' => 'required|min:0|integer',
            'JUMLAH_RUSAK_KELUAR' => 'required|min:0|integer',
            'KETERANGAN' => 'required'
        ]);
        
        $data_stok_alat[] = [
            'ID_TIPE' => 1,
            'ID_ALAT_BAHAN' => $request->ID_ALAT_LAMA,
            'JUMLAH_KELUAR' => $request->JUMLAH_BAGUS_KELUAR,
            'JUMLAH_MASUK' => $request->JUMLAH_BAGUS_MASUK,
            'KONDISI' => 1,
            'KETERANGAN' => $request->KETERANGAN
        ];
        $data_stok_alat[] = [
            'ID_TIPE' => 1,
            'ID_ALAT_BAHAN' => $request->ID_ALAT_LAMA,
            'JUMLAH_KELUAR' => $request->JUMLAH_RUSAK_KELUAR,
            'JUMLAH_MASUK' => $request->JUMLAH_RUSAK_MASUK,
            'KONDISI' => 0,
            'KETERANGAN' => $request->KETERANGAN
        ];

        HistoriStok::insert($data_stok_alat);
        
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
