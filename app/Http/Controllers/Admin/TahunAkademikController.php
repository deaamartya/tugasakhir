<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use DB;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Tahun Akademik';
        $page_description = 'Menampilkan seluruh data tahun akademik';
        $action = 'table_datatable_basic';
        $tahunakademik = TahunAkademik::all();
        return view('admin.tahunakademik', compact('page_title', 'page_description','action','tahunakademik'));
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
            "tahun_akademik" => 'required|min:10|unique:App\Models\TahunAkademik,TAHUN_AKADEMIK'
        ]);
        DB::transaction(function() use($request){
            TahunAkademik::insert([
                "TAHUN_AKADEMIK" => ucwords(strtolower(trim($request->tahun_akademik))),
            ]);
        });
        return redirect()->route('admin.tahun-akademik.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request,$id){
            $tahunAkademik = TahunAkademik::find($id);
            if($tahunAkademik->TAHUN_AKADEMIK != $request->tahun_akademik)
            {
                $request->validate([
                    "tahun_akademik" => 'required|min:3|unique:App\Models\TahunAkademik,TAHUN_AKADEMIK'
                ]);
            }
            $tahunAkademik->update([
                "TAHUN_AKADEMIK" => ucwords(strtolower(trim($request->tahun_akademik))),
            ]);
        });
        return redirect()->route('admin.tahun-akademik.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TahunAkademik::find($id)->delete();
        return redirect()->route('admin.tahun-akademik.index')->with('deleted','Data berhasil dihapus');
    }
}
