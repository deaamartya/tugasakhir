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
use App\Models\HistoriStok;
use Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $page_title = 'Peminjaman Alat Bahan';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')->orderBy('TANGGAL_PEMINJAMAN','ASC')->get();
        
        $history_peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('STATUS_PEMINJAMAN','!=','MENUNGGU KONFIRMASI')->orderBy('TANGGAL_PEMINJAMAN','ASC')->get();

        return view('pengelola.peminjaman.index', compact('page_title', 'page_description','action','peminjaman','history_peminjaman'));
    }

    public function konfirmasi($id)
    {
        $page_title = 'Konfirmasi Peminjaman';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        
        $peminjaman = PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id)->first();

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

    public function update(Request $request,$id_peminjaman)
    {
        $id_praktikum = PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id_peminjaman)->value('ID_PRAKTIKUM');
        $data_stok = [];
        $data_stok_alat = [];
        $data_detail = [];
        $data_stok_alat_rusak = [];
        if($request->total_alat > 0){
            $i=1;
            foreach($request->id_alat as $key){
                $data_stok_alat[] = [
                    'ID_TIPE' => 1,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_alat[$i],
                    'JUMLAH_KELUAR' => $request->jumlah_alat[$i],
                    'JUMLAH_MASUK' => 0,
                    'KONDISI' => 1,
                    'KETERANGAN' => "Stok keluar untuk praktikum"
                ];
                $i++;
            }
        }
        if($request->total_bahan > 0){
            $i=1;
            foreach($request->id_bahan as $key){
                $data_stok[] = [
                    'ID_TIPE' => 2,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_bahan[$i],
                    'JUMLAH_KELUAR' => $request->jumlah_bahan[$i],
                    'JUMLAH_MASUK' => 0,
                    'KETERANGAN' => "Stok keluar untuk praktikum"
                ];
                $i++;
            }
        }
        if($request->total_bahan_kimia > 0){
            $i=1;
            foreach($request->id_bahan_kimia as $key){
                $data_stok[] = [
                    'ID_TIPE' => 3,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_bahan_kimia[$i],
                    'JUMLAH_KELUAR' => $request->jumlah_bahan_kimia[$i],
                    'JUMLAH_MASUK' => 0,
                    'KETERANGAN' => "Stok keluar untuk praktikum"
                ];
                $i++;
            }
        }

        DB::transaction(function() use($data_stok,$data_stok_alat,$data_detail,$id_peminjaman,$data_stok_alat_rusak){
            HistoriStok::insert($data_stok);
            HistoriStok::insert($data_stok_alat);
            HistoriStok::insert($data_stok_alat_rusak);
            PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id_peminjaman)->update(["STATUS_PEMINJAMAN" => "SUDAH DIKONFIRMASI"]);
        });
        
        return redirect()->route('pengelola.peminjaman.index')->with('created','Data berhasil disimpan');
    }


}
