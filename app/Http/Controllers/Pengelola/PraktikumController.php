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
use App\Models\TahunAkademik;
use App\Models\AlatBahanPraktikum;
use Auth;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'table_datatable_basic';
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $list_mapel = Auth::user()->list_mapel();

        $praktikum = Praktikum::whereIn('ID_MAPEL',$list_mapel)->orderBy('ID_PRAKTIKUM','DESC')->get();
        $lab = Laboratorium::find($id_lab);
        return view('pengelola.praktikum.index', compact('page_title', 'page_description','action','praktikum','lab'));
    }

    public function create()
    {
        $page_title = 'Buat Praktikum';
        $page_description = 'Membuat praktikum baru untuk laboratorium';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        $matapelajaran = MataPelajaran::where('ID_LABORATORIUM',$id_lab)->get();
        $list_mapel = Auth::user()->list_mapel();

        $praktikum = Praktikum::whereIn('ID_MAPEL',$list_mapel)->orderBy('ID_PRAKTIKUM','DESC')->get();

        $alat = Alat::select('m.*','alat.*','l.*','k.*')->join('merk_tipe_alat as m','m.ID_MERK_TIPE','alat.ID_MERK_TIPE')->join('lemari as l','l.ID_LEMARI','alat.ID_LEMARI')->join('katalog_alat as k','k.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan = Bahan::select('l.*','bahan.*')->join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan_kimia = BahanKimia::select('k.*','bahan_kimia.*')->join('katalog_bahan as k','k.ID_KATALOG_BAHAN','bahan_kimia.ID_KATALOG_BAHAN')->where('k.ID_LABORATORIUM',$id_lab)->get();

        $lab = Laboratorium::find($id_lab);

        return view('pengelola.praktikum.create', compact('page_title', 'page_description','action','bahan','alat','bahan_kimia','lab','praktikum','matapelajaran'));
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
            'ID_MAPEL' => 'required|exists:App\Models\MataPelajaran,ID_MAPEL',
            'JUDUL_PRAKTIKUM' => 'required',
        ]);

        DB::transaction(function() use($request){
            Praktikum::insert([
                'ID_MAPEL' => $request->ID_MAPEL,
                'JUDUL_PRAKTIKUM' => $request->JUDUL_PRAKTIKUM
            ]);

            $id_praktikum = Praktikum::where([
                'ID_MAPEL' => $request->ID_MAPEL,
                'JUDUL_PRAKTIKUM' => $request->JUDUL_PRAKTIKUM
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
        });
        return redirect()->route('pengelola.praktikum.index')->with('created','Data berhasil dibuat');
    }
}
