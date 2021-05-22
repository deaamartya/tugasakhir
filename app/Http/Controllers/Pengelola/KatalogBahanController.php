<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatalogBahan;
use App\Models\Laboratorium;
use DB;
use Auth;

class KatalogBahanController extends Controller
{
    public function index()
    {
        $page_title = 'Data Katalog Bahan';
        $page_description = 'Menampilkan seluruh data katalog bahan';
        $action = 'table_datatable_basic';
        $katalogbahan = KatalogBahan::orderBy('ID_KATALOG_BAHAN','DESC')->get();
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.katalog-bahan', compact('page_title', 'page_description','action','katalogbahan','lab'));
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
            'ID_KATALOG_BAHAN' => 'required|unique:App\Models\KatalogBahan,ID_KATALOG_BAHAN',
            'ID_LABORATORIUM' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
            'NAMA_KATALOG_BAHAN' => 'required',
        ]);

        DB::transaction(function() use($request){
            KatalogBahan::insert([
                "ID_KATALOG_BAHAN" => $request->ID_KATALOG_BAHAN,
                "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
                "NAMA_KATALOG_BAHAN" => $request->NAMA_KATALOG_BAHAN,
            ]);
        });
        return redirect()->route('pengelola.katalog-bahan.index')->with('created','Data berhasil dibuat');
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
            'ID_LABORATORIUM' => 'required|exists:App\Models\Laboratorium,ID_LABORATORIUM',
            'NAMA_KATALOG_BAHAN' => 'required',
        ]);

        $katalogbahan = KatalogBahan::find($request->ID_KATALOG_LAMA);

        if($katalogbahan->ID_KATALOG_BAHAN != $request->ID_KATALOG_BAHAN){
            $request->validate([
                'ID_KATALOG_BAHAN' => 'required|unique:App\Models\KatalogBahan,ID_KATALOG_BAHAN',
            ]);
        }

        $katalogbahan->update([
            "ID_KATALOG_BAHAN" => $request->ID_KATALOG_BAHAN,
            "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
            "NAMA_KATALOG_BAHAN" => $request->NAMA_KATALOG_BAHAN,
        ]);
        
        return redirect()->route('pengelola.katalog-bahan.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        KatalogBahan::find($request->ID_KATALOG_LAMA)->delete();
        return redirect()->route('pengelola.katalog-bahan.index')->with('deleted','Data berhasil dihapus');
    }
}
