<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bahan;
use App\Models\Lemari;
use DB;
use Auth;

class BahanController extends Controller
{
    public function index()
    {
        $page_title = 'Data Bahan';
        $page_description = 'Menampilkan seluruh data bahan';
        $action = 'table_datatable_basic';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();
        $bahan = Bahan::join('lemari as le','le.ID_LEMARI','bahan.ID_LEMARI')->join('laboratorium as l','l.ID_LABORATORIUM','le.ID_LABORATORIUM')->where('l.ID_LABORATORIUM',$id_lab)->get();
        return view('pengelola.bahan', compact('page_title', 'page_description','action','bahan','lemari'));
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
            'ID_BAHAN' => 'required|unique:App\Models\Bahan,ID_BAHAN',
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'NAMA_BAHAN' => 'required',
            'JUMLAH' => 'required|min:0',
        ]);

        DB::transaction(function() use($request){
            Bahan::insert([
                'ID_BAHAN' => $request->ID_BAHAN,
                'ID_LEMARI' => $request->ID_LEMARI,
                'NAMA_BAHAN' => $request->NAMA_BAHAN,
                'JUMLAH' => $request->JUMLAH,
            ]);
        });
        
        return redirect()->route('pengelola.bahan.index')->with('created','Data berhasil dibuat');
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
            'ID_BAHAN' => 'required',
            'ID_LEMARI' => 'required|exists:App\Models\Lemari,ID_LEMARI',
            'NAMA_BAHAN' => 'required',
            'JUMLAH' => 'required|min:0',
        ]);

        $bahan = Bahan::find($request->ID_BAHAN_LAMA);

        if($bahan->ID_BAHAN != $request->ID_BAHAN_LAMA){
            $request->validate([
                'ID_BAHAN' => 'unique:App\Models\Bahan,ID_BAHAN'
            ]);
        }
        $bahan->update([
            'ID_BAHAN' => $request->ID_BAHAN,
            'ID_LEMARI' => $request->ID_LEMARI,
            'NAMA_BAHAN' => $request->NAMA_BAHAN,
            'JUMLAH' => $request->JUMLAH,
        ]);
        
        return redirect()->route('pengelola.bahan.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Bahan::find($request->ID_BAHAN_LAMA)->delete();
        return redirect()->route('pengelola.bahan.index')->with('deleted','Data berhasil dihapus');
    }
}
