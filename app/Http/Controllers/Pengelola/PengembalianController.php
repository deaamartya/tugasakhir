<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlatBahan;
use App\Models\HistoriStok;
use Auth;
use DB;
use App\Models\KerusakanAlat;

class PengembalianController extends Controller
{
    public function index()
    {
        $page_title = 'Data Pengembalian Praktikum';
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
        $id_kelas = PeminjamanAlatBahan::where('ID_PEMINJAMAN','=',$id_peminjaman)->value('ID_KELAS');
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
                    'KETERANGAN' => "Stok rusak setelah praktikum"
                ];
                if($request->jumlah_rusak[$i] != 0){
                    KerusakanAlat::insert([
                        'ID_KELAS' => $id_kelas,
                        'ID_ALAT' => $request->id_alat[$i],
                        'KETERANGAN_RUSAK' => $request->keterangan_rusak[$i]." merusak sebanyak ".$request->jumlah_rusak[$i]."pcs",
                        'STATUS' => 0,
                        'ID_PEMINJAMAN' => $id_peminjaman,
                        'created_at' => now()
                    ]);
                }
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

    public function updateStock(Request $request)
    {
        $request->validate([
            'ID_KERUSAKAN' => 'required',
            'JUMLAH_BAGUS_MASUK' => 'required',
            'JUMLAH_KELUAR_RUSAK' => 'required',
        ]);

        $data_kerusakan = KerusakanAlat::where('ID_KERUSAKAN','=',$request->ID_KERUSAKAN)->first();
        $jumlah_rusak = HistoriStok::where([
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'KONDISI' => 0,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
        ])->value('JUMLAH_MASUK');
        $jumlah_dikembalikan = HistoriStok::where([
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'KONDISI' => 0,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
        ])->where('JUMLAH_KELUAR','>',0)->sum('JUMLAH_KELUAR');
        $sisa = intval($jumlah_rusak) - intval($jumlah_dikembalikan);
        if($request->JUMLAH_BAGUS_MASUK >= $sisa){
            KerusakanAlat::where('ID_KERUSAKAN','=',$request->ID_KERUSAKAN)->update([
                'STATUS' => 1
            ]);
        }
        HistoriStok::insert([
            'ID_TIPE' => 1,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'JUMLAH_KELUAR' => 0,
            'JUMLAH_MASUK' => $request->JUMLAH_BAGUS_MASUK,
            'KONDISI' => 1,
            'KETERANGAN' => "Penggantian alat rusak"
        ]);
        HistoriStok::insert([
            'ID_TIPE' => 1,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'JUMLAH_KELUAR' => $request->JUMLAH_KELUAR_RUSAK,
            'JUMLAH_MASUK' => 0,
            'KONDISI' => 0,
            'KETERANGAN' => "Penggantian alat rusak"
        ]);
        return redirect()->route('pengelola.pengembalian.index')->with('created','Data berhasil disimpan');
    }

    public function getInfoKerusakan($id) {
        $data_kerusakan = KerusakanAlat::where('ID_KERUSAKAN','=',$id)->first();
        $jumlah_rusak = HistoriStok::where([
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'KONDISI' => 0,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
        ])->value('JUMLAH_MASUK');
        $jumlah_dikembalikan = HistoriStok::where([
            'ID_ALAT_BAHAN' => $data_kerusakan->ID_ALAT,
            'KONDISI' => 0,
            'ID_TRANSAKSI' => $data_kerusakan->ID_PEMINJAMAN,
        ])->where('JUMLAH_KELUAR','>',0)->sum('JUMLAH_KELUAR');
        $sisa = intval($jumlah_rusak) - intval($jumlah_dikembalikan);
        return response()->json(["sisa" => $sisa, "data" => $data_kerusakan]);
    }
}
