<?php

namespace App\Http\Controllers\KepalaLab;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Lemari;
use App\Models\TahunAkademik;
use App\Models\Alat;
use App\Models\Laboratorium;
use App\Models\HistoriStok;
use DB;
use Auth;

class LaporanController extends Controller
{
    public function kartuStok(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $request->validate([
                    "ID_TAHUN_AKADEMIK" => 'required|exists:App\Models\TahunAkademik,ID_TAHUN_AKADEMIK',
                    'ID_ALAT' => 'required|exists:App\Models\Alat,ID_ALAT'
                ]);

                $tahunakademik = TahunAkademik::find($request->ID_TAHUN_AKADEMIK);
                $tahun_1 = substr($tahunakademik->TAHUN_AKADEMIK,0,4);
                $tahun_2 = substr($tahunakademik->TAHUN_AKADEMIK,5,4);
                $waktu = substr($tahunakademik->TAHUN_AKADEMIK,10,6);

                $tgl_ganjil_start = date('Y-m-d',strtotime($tahun_1."-07-01"));
                $tgl_ganjil_end = date('Y-m-d',strtotime($tahun_1."-12-31"));
                $tgl_genap_start = date('Y-m-d',strtotime($tahun_2."-01-01"));
                $tgl_genap_end = date('Y-m-d',strtotime($tahun_2."-06-30"));

                if($waktu == "Gasal"){
                    $histori_bagus = HistoriStok::where('KONDISI',1)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_ganjil_start, $tgl_ganjil_end])->get();
                    $histori_rusak = HistoriStok::where('KONDISI','=',0)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_ganjil_start, $tgl_ganjil_end])->get();
                }
                else{
                    $histori_bagus = HistoriStok::where('KONDISI',1)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_genap_start, $tgl_genap_end])->get();
                    $histori_rusak = HistoriStok::where('KONDISI','=',0)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_genap_start, $tgl_genap_end])->get();
                }

                $alat = Alat::find($request->ID_ALAT);
                $lab = Laboratorium::find($alat->lemari->laboratorium->ID_LABORATORIUM);
                $pdf = PDF::loadView('kepalalab.cetak-kartu-pdf',compact('tahunakademik','alat','histori_bagus','histori_rusak','lab'))->setPaper('a4', 'landscape');
                return $pdf->stream('Kartu Stok '.$alat->katalog_alat->NAMA_ALAT);
                // return view('pengelola.cetak-kartu-pdf',compact('tahunakademik','alat','histori'));
            case 'GET':
                $page_title = 'Cetak Kartu Stok';
                $page_description = 'Menampilkan kartu stok';
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
                $alat = Alat::all();

                return view('kepalalab.cetak-kartu', compact('page_title', 'page_description','action','tahunakademik','alat','tahun_akademik'));
            default:
                break;
        }
    }

    public function katalogLemari(Request $request)
    {
        switch ($request->method()) {
            case 'POST':
                $request->validate([
                    "ID_LEMARI" => 'required|exists:App\Models\Lemari,ID_LEMARI'
                ]);
                $lemari = Lemari::find($request->ID_LEMARI);
                $lab = Laboratorium::find($lemari->laboratorium->ID_LABORATORIUM);
                $pdf = PDF::loadView('kepalalab.cetak-lemari-pdf',compact('lemari','lab'));
                return $pdf->stream('Katalog Lemari '.$lemari->NAMA_LEMARI);
                // return view('pengelola.cetak-lemari-pdf',compact('lemari'));

            case 'GET':
                $page_title = 'Cetak Katalog Lemari';
                $page_description = 'Menampilkan seluruh katalog lemari';
                $action = 'uc_select2';

                $id_lab = Auth::user()->ID_LABORATORIUM;
                $lemari = Lemari::get();
                return view('kepalalab.cetak-lemari', compact('page_title', 'page_description','action','lemari'));

            default:
                break;
        }
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
                $pdf = PDF::loadView('kepalalab.cetak-rusak-pdf',compact('tahunakademik','histori_rusak','lab'));
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

                return view('kepalalab.cetak-rusak', compact('page_title', 'page_description','action','tahunakademik','tahun_akademik','lab'));
            default:
                break;
        }
    }
}
