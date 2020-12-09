<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipeUser;
use Illuminate\Http\Request;
use DB;

class TipeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Data Tipe User';
        $page_description = 'Menampilkan seluruh data tipe user';
        $action = 'table_datatable_basic';
        $tipeuser = TipeUser::all()->sortByDesc("ID_TIPE_USER");
        return view('admin.tipeuser', compact('page_title', 'page_description','action','tipeuser'));
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
            "nama_tipe_user" => 'required|min:3|unique:App\Models\TipeUser,NAMA_TIPE_USER'
        ]);
        DB::transaction(function() use($request){
            TipeUser::insert([
                "NAMA_TIPE_USER" => ucwords(strtolower(trim($request->nama_tipe_user))),
            ]);
        });
        return redirect()->route('admin.tipe-user.index')->with('created','Data berhasil dibuat');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipeUser  $tipeUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        DB::transaction(function() use($request,$id){
            $tipeuser = TipeUser::find($id);
            if($tipeuser->NAMA_TIPE_USER != $request->nama_tipe_user)
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
     * @param  \App\Models\TipeUser  $tipeUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TipeUser::find($id)->delete();
        return redirect()->route('admin.tipe-user.index')->with('deleted','Data berhasil dihapus');
    }
}
