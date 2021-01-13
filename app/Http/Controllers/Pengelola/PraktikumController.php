<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Praktikum;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Laboratorium;
use DB;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'table_datatable_basic';
        $id_lab = 1;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->groupBy('NAMA_PRAKTIKUM')->get();
        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);
        $matapelajaran = MataPelajaran::select('mata_pelajaran.*')->where('NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.praktikum', compact('page_title', 'page_description','action','praktikum','kelas','matapelajaran','lab'));
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
            'ID_MAPEL' => 'required|exists:App\Models\MataPelajaran,ID_MAPEL',
            'ID_KELAS' => 'required',
            'NAMA_PRAKTIKUM' => 'required',
        ]);

        DB::transaction(function() use($request){
            if($request->ID_KELAS == "X" || $request->ID_KELAS == "XI" || $request->ID_KELAS == "XII"){
                $lab = strrchr(Laboratorium::find($request->ID_LABORATORIUM)->value('NAMA_LABORATORIUM'),' ');
                $lab = str_replace(" ","",$lab);
                $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->join('jenis_kelas as j','j.ID_JENIS_KELAS','=','kelas.ID_JENIS_KELAS')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->where('j.NAMA_JENIS_KELAS','LIKE',"%".$request->ID_KELAS." MIPA%")->get();

                $data = [];

                foreach($kelas as $k){
                    $data[] = [
                        'ID_LABORATORIUM' => $request->ID_LABORATORIUM,
                        'ID_MAPEL' => $request->ID_MAPEL,
                        'ID_KELAS' => $k->ID_KELAS,
                        'NAMA_PRAKTIKUM' => $request->NAMA_PRAKTIKUM,
                    ];
                }

                Praktikum::insert($data);
            }
            else{
                $request->validate([
                    'ID_KELAS' => 'exists:App\Models\Kelas,ID_KELAS',
                ]);

                Praktikum::insert([
                    'ID_LABORATORIUM' => $request->ID_LABORATORIUM,
                    'ID_MAPEL' => $request->ID_MAPEL,
                    'ID_KELAS' => $request->ID_KELAS,
                    'NAMA_PRAKTIKUM' => $request->NAMA_PRAKTIKUM,
                ]);
            }
            
        });
        return redirect()->route('pengelola.praktikum.index')->with('created','Data berhasil dibuat');
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
        
        return redirect()->route('pengelola.praktikum.index')->with('updated','Data berhasil diubah');
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
        return redirect()->route('pengelola.praktikum.index')->with('deleted','Data berhasil dihapus');
    }
}
