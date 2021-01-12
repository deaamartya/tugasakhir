<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratorium;
use DB;

class LaboratoriumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Laboratorium';
        $page_description = 'Menampilkan seluruh data laboratorium';
        $action = 'table_datatable_basic';
        $lab = Laboratorium::all();
        return view('admin.lab', compact('page_title', 'page_description','action','lab'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "NAMA_LABORATORIUM" => 'required|min:3|unique:App\Models\Laboratorium,NAMA_LABORATORIUM'
        ]);
        DB::transaction(function() use($request){
            Laboratorium::insert([
                "NAMA_LABORATORIUM" => trim($request->NAMA_LABORATORIUM)
            ]);
        });
        return redirect()->route('admin.lab.index')->with('created','Data berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request,$id){
            $lab = Laboratorium::find($id);
            if($lab->NAMA_LABORATORIUM != $request->NAMA_LABORATORIUM)
            {
                $request->validate([
                    "NAMA_LABORATORIUM" => 'required|min:3|unique:App\Models\Laboratorium,NAMA_LABORATORIUM'
                ]);
            }
            $lab->update([
                "NAMA_LABORATORIUM" => trim($request->NAMA_LABORATORIUM)
            ]);
        });
        return redirect()->route('admin.lab.index')->with('updated','Data berhasil diubah');
    }
}
