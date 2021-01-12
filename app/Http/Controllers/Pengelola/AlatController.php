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
        $page_title = 'Data Lemari';
        $page_description = 'Menampilkan seluruh data lemari';
        $action = 'table_datatable_basic';
        $id_lab = 1;
        $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.lemari', compact('page_title', 'page_description','action','lemari','lab'));
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
            'NAMA_LEMARI' => 'required',
        ]);

        DB::transaction(function() use($request){
            Lemari::insert([
                "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
                "NAMA_LEMARI" => $request->NAMA_LEMARI,
            ]);
        });
        return redirect()->route('pengelola.lemari.index')->with('created','Data berhasil dibuat');
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
            'NAMA_LEMARI' => 'required',
        ]);

        $ruanglab = Lemari::find($id);
        $ruanglab->update([
            "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
            "NAMA_LEMARI" => $request->NAMA_LEMARI,
        ]);
        
        return redirect()->route('pengelola.lemari.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lemari::find($id)->delete();
        return redirect()->route('pengelola.lemari.index')->with('deleted','Data berhasil dihapus');
    }
}
