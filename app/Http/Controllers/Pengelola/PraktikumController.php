<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Praktikum;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Laboratorium;
use DB;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;
use App\Models\AlatBahanPraktikum;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'table_datatable_basic';
        $id_lab = 1;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);
        $matapelajaran = MataPelajaran::select('mata_pelajaran.*')->where('NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.praktikum.index', compact('page_title', 'page_description','action','praktikum','kelas','matapelajaran','lab'));
    }

    public function create()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'uc_select2';

        $id_lab = 1;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);
        $matapelajaran = MataPelajaran::select('mata_pelajaran.*')->where('NAMA_MAPEL','LIKE',"%".$lab."%")->get();
        $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->get();

        $alat = Alat::select('m.*','alat.*','l.*','k.*')->join('merk_tipe_alat as m','m.ID_MERK_TIPE','alat.ID_MERK_TIPE')->join('lemari as l','l.ID_LEMARI','alat.ID_LEMARI')->join('katalog_alat as k','k.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan = Bahan::select('l.*','bahan.*')->join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan_kimia = BahanKimia::select('k.*','bahan_kimia.*')->join('katalog_bahan as k','k.ID_KATALOG_BAHAN','bahan_kimia.ID_KATALOG_BAHAN')->where('k.ID_LABORATORIUM',$id_lab)->get();

        $lab = Laboratorium::find($id_lab);

        return view('pengelola.praktikum.create', compact('page_title', 'page_description','action','bahan','alat','bahan_kimia','lab','praktikum','matapelajaran','kelas'));
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
                $id_praktikums = [];

                foreach($kelas as $k){
                    $id_praktikums[] = Praktikum::where([
                        'ID_LABORATORIUM' => $request->ID_LABORATORIUM,
                        'ID_MAPEL' => $request->ID_MAPEL,
                        'ID_KELAS' => $k->ID_KELAS,
                        'NAMA_PRAKTIKUM' => $request->NAMA_PRAKTIKUM,
                    ])->value('ID_PRAKTIKUM');
                }

                $data_alat_bahan = [];

                foreach($id_praktikums as $id_praktikum)
                {
                    if($request->total_alat > 0){
                        foreach($request->index_alat as $key){
                            $data_alat_bahan[] = [
                                'ID_TIPE' => 1,
                                'JUMLAH' => $request->jumlah_alat[$key],
                                'ID_ALAT_BAHAN' => $request->id_alat[$key],
                                'ID_PRAKTIKUM' => $id_praktikum
                            ];
                        }
                    }
                    if($request->total_bahan > 0){
                        foreach($request->index_bahan as $key){
                            $data_alat_bahan[] = [
                                'ID_TIPE' => 2,
                                'JUMLAH' => $request->jumlah_bahan[$key],
                                'ID_ALAT_BAHAN' => $request->id_bahan[$key],
                                'ID_PRAKTIKUM' => $id_praktikum
                            ];
                        }
                    }
                    if($request->total_bahan_kimia > 0){
                        foreach($request->index_bahan_kimia as $key){
                            $data_alat_bahan[] = [
                                'ID_TIPE' => 3,
                                'JUMLAH' => $request->jumlah_bahan_kimia[$key],
                                'ID_ALAT_BAHAN' => $request->id_bahan_kimia[$key],
                                'ID_PRAKTIKUM' => $id_praktikum
                            ];
                        }
                    }
                }
                AlatBahanPraktikum::insert($data_alat_bahan);
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

                $id_praktikum = Praktikum::where([
                    'ID_LABORATORIUM' => $request->ID_LABORATORIUM,
                    'ID_MAPEL' => $request->ID_MAPEL,
                    'ID_KELAS' => $request->ID_KELAS,
                    'NAMA_PRAKTIKUM' => $request->NAMA_PRAKTIKUM,
                ])->value('ID_PRAKTIKUM');

                $data_alat_bahan = [];

                if($request->total_alat > 0){
                    foreach($request->index_alat as $key){
                        $data_alat_bahan[] = [
                            'ID_TIPE' => 1,
                            'JUMLAH' => $request->jumlah_alat[$key],
                            'ID_ALAT_BAHAN' => $request->id_alat[$key],
                            'ID_PRAKTIKUM' => $id_praktikum
                        ];
                    }
                }

                if($request->total_bahan > 0){
                    foreach($request->index_bahan as $key){
                        $data_alat_bahan[] = [
                            'ID_TIPE' => 2,
                            'JUMLAH' => $request->jumlah_bahan[$key],
                            'ID_ALAT_BAHAN' => $request->id_bahan[$key],
                            'ID_PRAKTIKUM' => $id_praktikum
                        ];
                    }
                }

                if($request->total_bahan_kimia > 0){
                    foreach($request->index_bahan_kimia as $key){
                        $data_alat_bahan[] = [
                            'ID_TIPE' => 3,
                            'JUMLAH' => $request->jumlah_bahan_kimia[$key],
                            'ID_ALAT_BAHAN' => $request->id_bahan_kimia[$key],
                            'ID_PRAKTIKUM' => $id_praktikum
                        ];
                    }
                }
                
                AlatBahanPraktikum::insert($data_alat_bahan);
            }
            
        });
        return redirect()->route('pengelola.praktikum.index')->with('created','Data berhasil dibuat');
    }
}
