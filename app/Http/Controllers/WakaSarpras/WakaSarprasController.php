<?php

namespace App\Http\Controllers\WakaSarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\BahanKimia;
use App\Models\Bahan;
use App\Models\Praktikum;
use App\Models\PeminjamanAlatBahan;
use App\Models\HistoriStok;
use App\Models\TahunAkademik;
use App\Models\Laboratorium;
use PDF;
use Auth;
use DB;
use App\Models\PerubahanJadwalPeminjaman;

class WakaSarprasController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        $alat_lab = Alat::all();
        $total_alat_bagus = 0;
        $total_alat_rusak = 0;

        foreach($alat_lab as $t){
            $total_alat_bagus = $total_alat_bagus + $t->stok_bagus();
            $total_alat_rusak = $total_alat_rusak + $t->stok_rusak();
        }

        $bahan_lab = Bahan::all();
        $total_bahan = 0;
        foreach($bahan_lab as $t){
            $total_bahan = $total_bahan + $t->stok();
        }

        $bahan_kimia_lab = BahanKimia::all();
        $total_bahan_kimia = 0;

        foreach($bahan_kimia_lab as $t){
            $total_bahan_kimia = $total_bahan_kimia + $t->stok();
        }

        $tahun = date('Y');
        if(date('m') >= 7 ){
            $tgl_awal_semester = $tahun.'-07-01';
            $tgl_akhir_semester = $tahun.'-12-31';
        }
        else {
            $tgl_awal_semester = $tahun.'-01-01';
            $tgl_akhir_semester = $tahun.'-05-31';
        }
        $tgl_awal_tahun = $tahun.'-01-01';
        $tgl_akhir_tahun = $tahun.'-12-31';

        $id_ta = Auth::user()->id_tahun_akademik();

        $beban_lab_semester = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_semester, $tgl_akhir_semester])->count('ID_PEMINJAMAN');

        $beban_lab_tahun = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_tahun, $tgl_akhir_tahun])->count('ID_PEMINJAMAN');

        return view('wakasarpras.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia','beban_lab_semester','beban_lab_tahun'));
    }

    public function alat(){
        $page_title = 'Data Alat';
        $page_description = 'Menampilkan seluruh data alat';
        $action = 'table_datatable_basic';
        $alat = Alat::get();
        return view('wakasarpras.alat', compact('page_title','page_description','action','alat'));
    }

    public function bahan_kimia(){
        $page_title = 'Data Bahan Kimia';
        $page_description = 'Menampilkan seluruh data bahan kimia';
        $action = 'table_datatable_basic';
        $bahan_kimia = BahanKimia::all();
        return view('wakasarpras.bahan-kimia', compact('page_title', 'page_description','action','bahan_kimia'));
    }

    public function bahan(){
        $page_title = 'Data Bahan';
        $page_description = 'Menampilkan seluruh data bahan';
        $action = 'table_datatable_basic';
        $bahan = Bahan::all();
        return view('wakasarpras.bahan', compact('page_title', 'page_description','action','bahan'));
    }

    public function alatRusak(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $request->validate([
                    "ID_TAHUN_AKADEMIK" => 'required|exists:App\Models\TahunAkademik,ID_TAHUN_AKADEMIK',
                ]);

                $tahunakademik = TahunAkademik::find($request->ID_TAHUN_AKADEMIK);
                $tahun_1 = substr($tahunakademik->TAHUN_AKADEMIK,0,4);
                $tahun_2 = substr($tahunakademik->TAHUN_AKADEMIK,5,4);
                $waktu = substr($tahunakademik->TAHUN_AKADEMIK,10,6);

                $tgl_ganjil_start = date('Y-m-d',strtotime($tahun_1."-07-01"));
                $tgl_ganjil_end = date('Y-m-d',strtotime($tahun_1."-12-31"));
                $tgl_genap_start = date('Y-m-d',strtotime($tahun_2."-01-01"));
                $tgl_genap_end = date('Y-m-d',strtotime($tahun_2."-06-30"));
                $id_lab = $request->ID_LABORATORIUM;

                if($waktu == "Gasal"){
                    $histori_rusak = HistoriStok::join('alat as a','a.ID_ALAT','histori_stok.ID_ALAT_BAHAN')
                    ->join('katalog_alat as ka','ka.ID_KATALOG_ALAT','a.ID_KATALOG_ALAT')
                    ->join('lemari as l','l.ID_LEMARI','=','a.ID_LEMARI')
                    ->where('l.ID_LABORATORIUM',$id_lab)
                    ->where('ID_TIPE',1)
                    ->where('KONDISI','=',0)
                    ->where('JUMLAH_MASUK','>',0)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_ganjil_start, $tgl_ganjil_end])->get();
                }
                else{
                    $histori_rusak = HistoriStok::join('alat as a','a.ID_ALAT','histori_stok.ID_ALAT_BAHAN')
                    ->join('katalog_alat as ka','ka.ID_KATALOG_ALAT','a.ID_KATALOG_ALAT')
                    ->join('lemari as l','l.ID_LEMARI','=','a.ID_LEMARI')
                    ->where('l.ID_LABORATORIUM',$id_lab)
                    ->where('ID_TIPE',1)
                    ->where('KONDISI','=',0)
                    ->where('JUMLAH_MASUK','>',0)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_genap_start, $tgl_genap_end])->get();
                }

                $lab = Laboratorium::find($id_lab);
                $pdf = PDF::loadView('wakasarpras.cetak-rusak-pdf',compact('tahunakademik','histori_rusak','lab'));
                return $pdf->stream('Daftar Alat Rusak');
                // return view('pengelola.cetak-kartu-pdf',compact('tahunakademik','alat','histori'));
            case 'GET':
                $page_title = 'Cetak Kartu Daftar Alat Rusak';
                $page_description = 'Menampilkan pilihan tahun akademik';
                $action = 'uc_select2';

                $tahun = intval(date('Y'));
                $tahunp1 = $tahun+1;
                $tahunm1 = $tahun-1;
                if(date('m') >= 7 ){
                    $tahun_akademik = $tahun.'/'.$tahunp1.' Gasal';
                }
                else {
                    $tahun_akademik = $tahunm1.'/'.$tahun.' Genap';
                }

                $tahun_akademik = TahunAkademik::where('TAHUN_AKADEMIK',$tahun_akademik)->first();

                $tahunakademik = TahunAkademik::get();
                $lab = Laboratorium::all();

                return view('wakasarpras.cetak-rusak', compact('page_title', 'page_description','action','tahunakademik','tahun_akademik','lab'));
            default:
                break;
        }
    }
}
