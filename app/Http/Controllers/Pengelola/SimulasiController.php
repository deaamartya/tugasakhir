<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Praktikum;
use App\Models\KatalogAlat;
use App\Models\Bahan;
use App\Models\BahanKimia;
use App\Models\Laboratorium;
use App\Models\Alat;
use Auth;

class SimulasiController extends Controller
{
    public function index()
    {
        $page_title = 'Simulasi Praktikum';
        $page_description = 'Menampilkan seluruh simulasi praktikum';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        $praktikum = Praktikum::where('ID_LABORATORIUM',$id_lab)->get();
        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);

        $alat = KatalogAlat::select('*')->join('kategori_alat as l','l.ID_KATEGORI_ALAT','katalog_alat.ID_KATEGORI_ALAT')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan = Bahan::select('l.*','bahan.*')->join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->get();

        $bahan_kimia = BahanKimia::select('k.*','bahan_kimia.*')->join('katalog_bahan as k','k.ID_KATALOG_BAHAN','bahan_kimia.ID_KATALOG_BAHAN')->where('k.ID_LABORATORIUM',$id_lab)->get();

        $lab = Laboratorium::find($id_lab);

        return view('pengelola.simulasi', compact('page_title', 'page_description','action','bahan','alat','bahan_kimia','lab','praktikum'));
    }

    public function store(Request $request)
    {
        $hasil = true;
        $data = $request->data;
        if($request->data->id_katalog_alat != null){
            $i = 1;
            foreach($data->id_katalog_alat as $key){
                $stok_alat = Alat::where('ID_KATALOG_ALAT',$data->id_katalog_alat[$i])->SUM('JUMLAH_BAGUS');
                if($stok_alat < $data->jumlah_alat[$i]){
                    $hasil = false;
                }
                $i++;
            }   
        }
        if($request->data->id_bahan != null){
            $i = 1;
            foreach($data->id_bahan as $key){
                $tok_bahan = Bahan::where('ID_BAHAN',$data->id_bahan[$i])->SUM('JUMLAH');
                if($stok_alat < $data->jumlah_bahan[$i]){
                    $hasil = false;
                }
                $i++;
            }
        }
        if($request->data->id_bahan != null){
            $i = 1;
            foreach($data->id_bahan as $key){
                $tok_bahan = Bahan_Kimia::where('ID_BAHAN_KIMIA',$data->id_bahan_kimia[$i])->SUM('JUMLAH_BAHAN_KIMIA');
                if($stok_alat < $data->jumlah_bahan_kimia[$i]){
                    $hasil = false;
                }
                $i++;
            }
        }
        return $hasil;
    }

    public function getStokAlat(Request $request)
    {
        $id_katalog_alat = $request->id;
        $stok = Alat::where('ID_KATALOG_ALAT','=',$id_katalog_alat)->sum('JUMLAH_BAGUS');
        return response()->json($stok);
    }

    public function getStokBahan(Request $request)
    {
        $id_bahan = $request->id;
        $stok = Bahan::where('ID_BAHAN','=',$id_bahan)->sum('JUMLAH');
        return response()->json($stok);
    }

    public function getStokBahanKimia(Request $request)
    {
        $id_bahan_kimia = $request->id;
        $stok = BahanKimia::where('ID_BAHAN_KIMIA','=',$id_bahan_kimia)->sum('JUMLAH_BAHAN_KIMIA');
        return response()->json($stok);
    }
}
