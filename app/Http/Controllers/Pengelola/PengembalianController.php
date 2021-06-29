<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlatBahan;
use App\Models\HistoriStok;
use Auth;
use DB;
use App\Models\DetailPengembalian;

class PengembalianController extends Controller
{
    public function index()
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        
        $peminjaman = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')->orderBy('ID_PEMINJAMAN','DESC')->get();

        $pengembalian = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->orderBy('ID_PEMINJAMAN','DESC')->get();

        return view('pengelola.pengembalian.index', compact('page_title', 'page_description','action','peminjaman','pengembalian'));
    }

    public function edit($id)
    {
        $page_title = 'Pengembalian Alat Bahan Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;
        
        $peminjaman = PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id)->first();

        return view('pengelola.pengembalian.edit', compact('page_title', 'page_description','action','peminjaman'));
    }

    public function update(Request $request,$id_peminjaman)
    {
        $id_praktikum = PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id_peminjaman)->value('ID_PRAKTIKUM');
        $data_stok = [];
        $data_stok_alat = [];
        $data_pengembalian = [];
        if($request->id_alat != null){
            $i=1;
            foreach($request->id_alat as $key){
                $data_stok_alat[] = [
                    'ID_TIPE' => 1,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_alat[$i],
                    'JUMLAH_KELUAR' => 0,
                    'JUMLAH_MASUK' => $request->jumlah_bagus[$i],
                    'KONDISI' => 1,
                    'KETERANGAN' => "Stok masuk setelah praktikum"
                ];
                $data_stok_alat[] = [
                    'ID_TIPE' => 1,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_alat[$i],
                    'JUMLAH_KELUAR' => 0,
                    'JUMLAH_MASUK' => $request->jumlah_rusak[$i],
                    'KONDISI' => 0,
                    'KETERANGAN' => $request->keterangan_rusak[$i]
                ];
                $i++;
            }
        }
        if($request->id_bahan != null){
            $i=1;
            foreach($request->id_bahan as $key){
                $data_stok[] = [
                    'ID_TIPE' => 2,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_bahan[$i],
                    'JUMLAH_KELUAR' => 0,
                    'JUMLAH_MASUK' => $request->jumlah_bahan[$i],
                    'KETERANGAN' => "Stok masuk sisa dari praktikum"
                ];
                $i++;
            }
        }
        if($request->id_bahan_kimia != null){
            $i=1;
            foreach($request->id_bahan_kimia as $key){
                $data_stok[] = [
                    'ID_TIPE' => 3,
                    'ID_TRANSAKSI' => $id_peminjaman,
                    'ID_ALAT_BAHAN' => $request->id_bahan_kimia[$i],
                    'JUMLAH_KELUAR' => 0,
                    'JUMLAH_MASUK' => $request->jumlah_bahan_kimia[$i],
                    'KETERANGAN' => "Stok masuk sisa dari praktikum"
                ];
                $i++;
            }
        }
        DB::transaction(function() use($data_stok,$data_stok_alat,$data_pengembalian,$id_peminjaman){
            HistoriStok::insert($data_stok);
            HistoriStok::insert($data_stok_alat);
            PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id_peminjaman)->update(["STATUS_PEMINJAMAN" => "SUDAH DIKEMBALIKAN"]);
        });
        
        return redirect()->route('pengelola.pengembalian.index')->with('created','Data berhasil disimpan');
    }
}
