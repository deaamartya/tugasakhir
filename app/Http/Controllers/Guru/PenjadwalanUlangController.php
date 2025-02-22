<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeminjamanAlatBahan;
use App\Models\Laboratorium;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use DB;
use App\Models\PerubahanJadwalPeminjaman;
use App\Notifications\RequestPenjadwalanUlang;
use App\Models\User;
use App\Models\TipeUser;
use Notification;
use Auth;

class PenjadwalanUlangController extends Controller
{
    public function index()
    {
        $page_title = 'Data Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'app_calender';
        $id_lab = 1;
        $guru = Auth::user()->ID_USER;
        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();

        $lab = strrchr(Laboratorium::find($id_lab)->value('NAMA_LABORATORIUM'),' ');
        $lab = str_replace(" ","",$lab);

        $matapelajaran = MataPelajaran::select('mata_pelajaran.*')->where('NAMA_MAPEL','LIKE',"%".$lab."%")->get();

        $kelas = Kelas::join('mata_pelajaran as m','m.ID_MAPEL','=','kelas.ID_MAPEL')->where('m.NAMA_MAPEL','LIKE',"%".$lab."%")->get();

        $lab = Laboratorium::find($id_lab);

        $jadwalulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->join('praktikum as pr','pr.ID_PRAKTIKUM','p.ID_PRAKTIKUM')->join('kelas as k','k.ID_KELAS','p.ID_KELAS')->join('jenis_kelas as j','j.ID_JENIS_KELAS','k.ID_JENIS_KELAS')->where('perubahan_jadwal_peminjaman.ID_USER','=',$guru)->get();

        return view('guru.jadwal-ulang.index', compact('page_title', 'page_description','action','praktikum','kelas','matapelajaran','lab','jadwalulang'));
    }

    public function show($id)
    {
        $page_title = 'Data Penjadwalan Ulang';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'uc_select2';

        $peminjaman = PeminjamanAlatBahan::find($id);
        
        $id_lab = Auth::user()->ID_LABORATORIUM;

        $praktikum = PeminjamanAlatBahan::join('ruang_laboratorium as r','r.ID_RUANG_LABORATORIUM','peminjaman_alat_bahan.ID_RUANG_LABORATORIUM')->where('r.ID_LABORATORIUM','=',$id_lab)->orderBy('ID_PEMINJAMAN','DESC')->get();

        return view('guru.jadwal-ulang.create', compact('page_title', 'page_description','action','peminjaman','praktikum'));
    }

    public function store(Request $request)
    {
        $nama_tipe = "Pengelola Lab ".Auth::user()->laboratorium->lab();
        $id_tipe = TipeUser::where('NAMA_TIPE_USER','LIKE',"%".$nama_tipe."%")->value('ID_TIPE_USER');
        $pengelola = User::where('ID_LABORATORIUM','=',Auth::user()->ID_LABORATORIUM)
        ->where('ID_TIPE_USER','=',$id_tipe)->get();
        $id_guru = Auth::user()->ID_USER;
        DB::transaction(function() use($request,$id_guru,$pengelola){
            PerubahanJadwalPeminjaman::insert([
                'ID_PEMINJAMAN' => $request->ID_PEMINJAMAN,
                'ID_USER' => $id_guru,
                'TANGGAL_BARU' => $request->TANGGAL_BARU_submit,
                'JAM_MULAI_BARU' => $request->JAM_MULAI_BARU,
                'JAM_SELESAI_BARU' => $request->JAM_SELESAI_BARU,
                'PESAN' => $request->PESAN,
                'STATUS_PERUBAHAN' => 0,
            ]);
            Notification::send($pengelola, new RequestPenjadwalanUlang($request->ID_PEMINJAMAN));
            // Notification::send($pengelola,new PushNotifPengelola);
        });
        return redirect()->route('guru.penjadwalan-ulang.index')->with('created','Data berhasil dibuat');
    }
}
