<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

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
        return redirect()->route('admin.tahunakademik.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TahunAkademik $tahunAkademik)
    {
        DB::transaction(function() use($request,$id){
            $tipeuser = TipeUser::find($id);
            if($user->NAMA_TIPE_USER != $request->nama_tipe_user)
            {
                $request->validate([
                    "nama_tipe_user" => 'required|min:3|unique:App\Models\TipeUser,NAMA_TIPE_USER'
                ]);
            }
            $tipeuser->update([
                "NAMA_TIPE_USER" => ucwords(strtolower(trim($request->nama_tipe_user))),
            ]);
        });
        return redirect()->route('admin.tipe-user.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunAkademik $tahunAkademik)
    {
        //
    }
}
