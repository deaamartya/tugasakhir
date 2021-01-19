<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\Lemari;
use App\Models\TahunAkademik;
use App\Models\Alat;
use App\Models\HistoriStok;
use DB;

class CetakController extends Controller
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
                    $histori_bagus = HistoriStok::where('KONDISI',1)->where('ID_ALAT_BAHAN',$request->ID_ALAT)->whereBetween('TIMESTAMP', [$tgl_ganjil_start, $tgl_ganjil_end])->get();
                    $histori_rusak = HistoriStok::where('KONDISI',0)->where('ID_ALAT_BAHAN',$request->ID_ALAT)->whereBetween('TIMESTAMP', [$tgl_ganjil_start, $tgl_ganjil_end])->get();
                }
                else{
                    $histori_bagus = HistoriStok::where('KONDISI',1)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_genap_start, $tgl_genap_end])->get();
                    $histori_rusak = HistoriStok::where('KONDISI','=',0)->where('ID_ALAT_BAHAN',$request->ID_ALAT)
                    ->whereBetween(DB::raw('DATE(TIMESTAMP)'), [$tgl_genap_start, $tgl_genap_end])->get();
                    // print_r($tgl_genap_start);
                    // print_r($tgl_genap_end);
                    // print_r($histori_bagus);
                    // echo "<pre>";
                    // print_r($histori_rusak);
                    // echo "</pre>";
                }

                $alat = Alat::find($request->ID_ALAT);

                $pdf = PDF::loadView('pengelola.cetak-kartu-pdf',compact('tahunakademik','alat','histori_bagus','histori_rusak'))->setPaper('a4', 'landscape');
                return $pdf->stream('Kartu Stok '.$alat->katalog_alat->NAMA_ALAT);
                // return view('pengelola.cetak-kartu-pdf',compact('tahunakademik','alat','histori'));
            case 'GET':
                $page_title = 'Cetak Kartu Stok';
                $page_description = 'Menampilkan kartu stok';
                $action = 'uc_select2';

                $id_lab = 1;

                $tahunakademik = TahunAkademik::get();
                $alat = Alat::select('*')->join('lemari as l','l.ID_LEMARI','alat.ID_LEMARI')->where('l.ID_LABORATORIUM',$id_lab)->get();

                return view('pengelola.cetak-kartu', compact('page_title', 'page_description','action','tahunakademik','alat'));
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
                $pdf = PDF::loadView('pengelola.cetak-lemari-pdf',compact('lemari'));
                return $pdf->stream('Katalog Lemari '.$lemari->NAMA_LEMARI);
                // return view('pengelola.cetak-lemari-pdf',compact('lemari'));

            case 'GET':
                $page_title = 'Cetak Katalog Lemari';
                $page_description = 'Menampilkan seluruh katalog lemari';
                $action = 'uc_select2';

                $id_lab = 1;
                $lemari = Lemari::where('ID_LABORATORIUM',$id_lab)->get();

                return view('pengelola.cetak-lemari', compact('page_title', 'page_description','action','lemari'));

            default:
                break;
        }
    }

    public function barangRusak()
    {
        
    }
}
