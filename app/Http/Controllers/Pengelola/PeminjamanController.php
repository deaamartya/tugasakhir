<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\PeminjamanAlatBahan;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\BahanKimia;
use App\Models\Laboratorium;
use App\Models\AlatBahanPraktikum;

class PeminjamanController extends Controller
{
    public function index()
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';

        $id_lab = 1;
        
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();

        return view('pengelola.peminjaman.index', compact('page_title', 'page_description','action','peminjaman'));
    }

    public function konfirmasi($id)
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'uc_select2';

        $id_lab = 1;
        
        $peminjaman = PeminjamanAlatBahan::find($id);

        $alat_bahan_except = AlatBahanPraktikum::where('ID_PRAKTIKUM', '=', $peminjaman->ID_PRAKTIKUM)->select('ID_ALAT_BAHAN')->get()->toArray();

        $alat = Alat::select('m.*','alat.*','l.*','k.*')
        ->join('merk_tipe_alat as m','m.ID_MERK_TIPE','alat.ID_MERK_TIPE')
        ->join('lemari as l','l.ID_LEMARI','alat.ID_LEMARI')
        ->join('katalog_alat as k','k.ID_KATALOG_ALAT','alat.ID_KATALOG_ALAT')
        ->where('l.ID_LABORATORIUM',$id_lab)
        ->whereNotIn('alat.ID_ALAT', $alat_bahan_except)
        ->get();

        $bahan = Bahan::select('l.*','bahan.*')->join('lemari as l','l.ID_LEMARI','bahan.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->whereNotIn('bahan.ID_BAHAN', $alat_bahan_except)->get();

        $bahan_kimia = BahanKimia::select('k.*','bahan_kimia.*')->join('katalog_bahan as k','k.ID_KATALOG_BAHAN','bahan_kimia.ID_KATALOG_BAHAN')->where('k.ID_LABORATORIUM',$id_lab)->whereNotIn('bahan_kimia.ID_BAHAN_KIMIA', $alat_bahan_except)->get();

        $lab = Laboratorium::find($id_lab);

        return view('pengelola.peminjaman.edit', compact('page_title', 'page_description','action','peminjaman','alat','bahan_kimia','bahan','lab'));
    }

    public function store(Request $request)
    {
        
    }


}
