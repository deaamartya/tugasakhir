<?php

namespace App\Http\Controllers\KepalaLab;

use App\Http\Controllers\Controller;
use App\Models\RuangLaboratorium;
use App\Models\Lemari;
use App\Models\KatalogAlat;
use App\Models\KategoriAlat;
use App\Models\MerkTipeAlat;
use App\Models\Alat;
use App\Models\KatalogBahan;
use App\Models\BahanKimia;
use App\Models\Bahan;
use App\Models\Praktikum;
use App\Models\PeminjamanAlatBahan;
use App\Models\HistoriStok;
use App\Models\TahunAkademik;
use Auth;
use DB;
use App\Models\PerubahanJadwalPeminjaman;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';

        $alat_lab = Alat::get();
        $total_alat_bagus = 0;
        $total_alat_rusak = 0;

        foreach($alat_lab as $t){
            $total_alat_bagus = $total_alat_bagus + $t->stok_bagus();
            $total_alat_rusak = $total_alat_rusak + $t->stok_rusak();
        }

        $bahan_lab = Bahan::get();
        $total_bahan = 0;
        foreach($bahan_lab as $t){
            $total_bahan = $total_bahan + $t->stok();
        }

        $bahan_kimia_lab = BahanKimia::get();
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

        $jadwal_ulang = PerubahanJadwalPeminjaman::where('STATUS_PERUBAHAN',0)->count('ID_PERUBAHAN_JADWAL');

        $total_peminjaman = PeminjamanAlatBahan::whereBetween(DB::raw('DATE(TANGGAL_PEMINJAMAN)'), [$tgl_awal_tahun, $tgl_akhir_tahun])->count('ID_PEMINJAMAN');

        // Jumlah praktikum yang selesai dalam semester.
        $dikembalikan = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->count('ID_PEMINJAMAN');

        // Jumlah praktikum yang sudah dijadwalkan dalam semester.
        $sedang_pinjam = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')
        ->count('ID_PEMINJAMAN');

        // Ambil semua praktikum lab dalam semester.
        $jadwal = PeminjamanAlatBahan::select('peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('kelas as k','k.ID_KELAS','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->get()->toArray();

        // Ambil seluruh praktikum terjadwal
        $praktikum = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->get();

        // Ambil 3 praktikum terjadwal
        $praktikum_menunggu = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')
        ->limit(5)->get();

        // Ambil 3 praktikum selesai
        $praktikum_selesai = PeminjamanAlatBahan::join('kelas as k','k.ID_KELAS','=','peminjaman_alat_bahan.ID_KELAS')
        ->where('k.ID_TAHUN_AKADEMIK',$id_ta)
        ->where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')
        ->orderBy('ID_PEMINJAMAN','DESC')
        ->limit(5)->get();

        $menunggu_penjadwalan = 0;

        return view('kepalalab.dashboard', compact('page_title', 'page_description','action','total_alat_bagus','total_alat_rusak','total_bahan','total_bahan_kimia','sedang_pinjam','dikembalikan','menunggu_penjadwalan','total_peminjaman','beban_lab_semester','beban_lab_tahun','jadwal_ulang','dikembalikan','sedang_pinjam','praktikum','praktikum_menunggu','praktikum_selesai'));
    }

    public function seluruhJadwal()
    {   
        $data = [];
        $id_lab = Auth::user()->ID_LABORATORIUM;
        $peminjaman = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','=','peminjaman_alat_bahan.ID_PRAKTIKUM')->get();
        
        $i = 0;
        foreach($peminjaman as $p)
        {
            $obj = new \StdClass();
            $kelas = $p->kelas->jenis_kelas->NAMA_JENIS_KELAS;
            $obj->title = $p->praktikum->JUDUL_PRAKTIKUM." ".$kelas;

            $jammulai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_MULAI;
            $jamselesai = $p->TANGGAL_PEMINJAMAN." ".$p->JAM_SELESAI;

            $date_start = date_create_from_format('Y-m-d H:i', $jammulai);
            $date_end = date_create_from_format('Y-m-d H:i', $jamselesai);

            $obj->start = date_format($date_start, 'Y-m-d H:i');
            $obj->end = date_format($date_end, 'Y-m-d H:i');

            if(strpos($kelas, 'X MIPA') !== false)
            {
                $obj->className = "bg-primary p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XI MIPA') !== false)
            {
                $obj->className = "bg-success p-1 border-0 mb-1 rounded-2 m-1";
            }
            elseif(strpos($kelas, 'XII MIPA') !== false)
            {
                $obj->className = "bg-danger p-1 border-0 mb-1 rounded-2 m-1";
            }

            $obj->id_peminjaman = $p->ID_PEMINJAMAN;

            $data[$i] = $obj;
            $i++;
        }

        return $data;
    }

    public function ruang_lab()
    {
        $page_title = 'Data Ruang Laboratorium';
        $page_description = 'Menampilkan seluruh data ruang laboratorium';
        $action = 'table_datatable_basic';
        $ruang_lab = RuangLaboratorium::all();
        return view('kepalalab.ruang-lab', compact('page_title', 'page_description','action','ruang_lab'));
    }

    public function lemari(){
        $page_title = 'Data Lemari';
        $page_description = 'Menampilkan seluruh data lemari';
        $action = 'table_datatable_basic';
        $lemari = Lemari::all();
        return view('kepalalab.lemari', compact('page_title', 'page_description','action','lemari'));
    }

    public function katalog_alat(){
        $page_title = 'Data Katalog Alat';
        $page_description = 'Menampilkan seluruh data katalog alat';
        $action = 'table_datatable_basic';
        $katalog_alat = KatalogAlat::all();
        return view('kepalalab.katalog-alat', compact('page_title', 'page_description','action','katalog_alat'));
    }

    public function kategori_alat(){
        $page_title = 'Data Kategori Alat';
        $page_description = 'Menampilkan seluruh data kategori alat';
        $action = 'table_datatable_basic';
        $kategori = KategoriAlat::all();
        return view('kepalalab.kategori-alat', compact('page_title', 'page_description','action','kategori'));
    }

    public function tipe(){
        $page_title = 'Data Merk/Type Alat';
        $page_description = 'Menampilkan seluruh data merk/type alat';
        $action = 'table_datatable_basic';
        $merktipe = MerkTipeAlat::all();
        return view('kepalalab.tipe', compact('page_title', 'page_description','action','merktipe'));
    }

    public function alat(){
        $page_title = 'Data Alat';
        $page_description = 'Menampilkan seluruh data alat';
        $action = 'table_datatable_basic';
        $alat = Alat::get();
        return view('kepalalab.alat', compact('page_title','page_description','action','alat'));
    }

    public function katalog_bahan(){
        $page_title = 'Data Katalog Bahan';
        $page_description = 'Menampilkan seluruh data katalog bahan';
        $action = 'table_datatable_basic';
        $katalog_bahan = KatalogBahan::all();
        return view('kepalalab.katalog-bahan', compact('page_title', 'page_description','action','katalog_bahan'));
    }

    public function bahan_kimia(){
        $page_title = 'Data Bahan Kimia';
        $page_description = 'Menampilkan seluruh data bahan kimia';
        $action = 'table_datatable_basic';
        $bahan_kimia = BahanKimia::all();
        return view('kepalalab.bahan-kimia', compact('page_title', 'page_description','action','bahan_kimia'));
    }

    public function bahan(){
        $page_title = 'Data Bahan';
        $page_description = 'Menampilkan seluruh data bahan';
        $action = 'table_datatable_basic';
        $bahan = Bahan::all();
        return view('kepalalab.bahan', compact('page_title', 'page_description','action','bahan'));
    }

    public function praktikum(){
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'table_datatable_basic';
        $praktikum = Praktikum::all();
        return view('kepalalab.praktikum.index', compact('page_title', 'page_description','action','praktikum'));
    }

    public function jadwal_praktikum(){
        $page_title = 'Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';

        $praktikum = PeminjamanAlatBahan::orderBy('ID_PEMINJAMAN','DESC')->get();
        return view('kepalalab.jadwal-praktikum.index', compact('page_title', 'page_description','action','praktikum'));
    }

    public function penjadwalan_ulang(){
        $page_title = 'Penjadwalan Ulang Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'app_calender';

        $jadwalulang = PerubahanJadwalPeminjaman::get();

        return view('kepalalab.jadwal-ulang.index', compact('page_title', 'page_description','action','jadwalulang'));
    }
    
    public function peminjaman(){
        $page_title = 'Peminjaman Alat Bahan';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';
        
        $peminjaman = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')->orderBy('TANGGAL_PEMINJAMAN','ASC')->get();
        
        $history_peminjaman = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','!=','MENUNGGU KONFIRMASI')->orderBy('TANGGAL_PEMINJAMAN','ASC')->get();

        return view('kepalalab.peminjaman.index', compact('page_title', 'page_description','action','peminjaman','history_peminjaman'));
    }

    public function pengembalian(){
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'table_datatable_basic';
        
        $peminjaman = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKONFIRMASI')->orderBy('ID_PEMINJAMAN','DESC')->get();

        $pengembalian = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->orderBy('ID_PEMINJAMAN','DESC')->get();

        return view('kepalalab.pengembalian.index', compact('page_title', 'page_description','action','peminjaman','pengembalian'));
    }
}
