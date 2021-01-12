<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\RuangLaboratorium;
use App\Models\Laboratorium;
use Auth;

class RuangLaboratoriumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Ruang Laboratorium';
        $page_description = 'Menampilkan seluruh data ruang laboratorium';
        $action = 'table_datatable_basic';
        $id_lab = 1;
        $ruanglab = RuangLaboratorium::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.ruang-lab', compact('page_title', 'page_description','action','ruanglab','lab'));
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
            'NAMA_RUANG_LABORATORIUM' => 'required|min:6|unique:App\Models\RuangLaboratorium,NAMA_RUANG_LABORATORIUM',
        ]);

        DB::transaction(function() use($request){
            RuangLaboratorium::insert([
                "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
                "NAMA_RUANG_LABORATORIUM" => $request->NAMA_RUANG_LABORATORIUM,
            ]);
        });
        return redirect()->route('pengelola.ruang-lab.index')->with('created','Data berhasil dibuat');
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
        ]);

        $ruanglab = RuangLaboratorium::find($id);

        if($ruanglab->NAMA_RUANG_LABORATORIUM != $request->NAMA_RUANG_LABORATORIUM)
        {
            $request->validate([
                'NAMA_RUANG_LABORATORIUM' => 'required|min:6|unique:App\Models\RuangLaboratorium,NAMA_RUANG_LABORATORIUM',
            ]);
        }

        $ruanglab->update([
            "ID_LABORATORIUM" => $request->ID_LABORATORIUM,
            "NAMA_RUANG_LABORATORIUM" => $request->NAMA_RUANG_LABORATORIUM,
        ]);
        
        return redirect()->route('pengelola.ruang-lab.index')->with('updated','Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RuangLaboratorium::find($id)->delete();
        return redirect()->route('pengelola.ruang-lab.index')->with('deleted','Data berhasil dihapus');
    }
}
