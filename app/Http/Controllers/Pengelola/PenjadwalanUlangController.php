<?php

namespace App\Http\Controllers\Pengelola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerubahanJadwalPeminjaman;
use DB;
use App\Models\PeminjamanAlatBahan;
use App\Models\User;
use Notification;
use App\Notifications\SuccessPenjadwalanUlang;
use Auth;

class PenjadwalanUlangController extends Controller
{
    public function index()
    {
        $page_title = 'Penjadwalan Ulang Praktikum';
        $page_description = 'Menampilkan seluruh data penjadwalan ulang';
        $action = 'app_calender';

        $id_lab = Auth::user()->ID_LABORATORIUM;

        $jadwalulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->join('praktikum as pr','pr.ID_PRAKTIKUM','p.ID_PRAKTIKUM')->join('kelas as k','k.ID_KELAS','pr.ID_KELAS')->join('jenis_kelas as j','j.ID_JENIS_KELAS','k.ID_JENIS_KELAS')->where('pr.ID_LABORATORIUM',$id_lab)->get();

        return view('pengelola.jadwal-ulang.index', compact('page_title', 'page_description','action','jadwalulang'));
    }

    public function edit($id)
    {
        $page_title = 'Ubah Jadwal Praktikum';
        $page_description = 'Menampilkan seluruh data praktikum';
        $action = 'uc_select2';

        $id_lab = Auth::user()->ID_LABORATORIUM;

        $praktikum = PeminjamanAlatBahan::join('praktikum as p','p.ID_PRAKTIKUM','peminjaman_alat_bahan.ID_PRAKTIKUM')
        ->join('laboratorium as l','l.ID_LABORATORIUM','p.ID_LABORATORIUM')
        ->where('l.ID_LABORATORIUM','=',$id_lab)
        ->get();

        $jadwalulang = PerubahanJadwalPeminjaman::join('peminjaman_alat_bahan as p','p.ID_PEMINJAMAN','perubahan_jadwal_peminjaman.ID_PEMINJAMAN')->where('ID_PERUBAHAN_JADWAL',$id)->first();

        return view('pengelola.jadwal-ulang.edit', compact('page_title', 'page_description','action','jadwalulang','praktikum'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'TANGGAL_PEMINJAMAN' => 'required',
            'JAM_MULAI' => 'required',
            'JAM_SELESAI' => 'required'
        ]);
        
        PeminjamanAlatBahan::find($id)->update([
            'TANGGAL_PEMINJAMAN' => $request->TANGGAL_PEMINJAMAN_submit,
            'JAM_MULAI' => $request->JAM_MULAI,
            'JAM_SELESAI' => $request->JAM_SELESAI
        ]);

        $perubahan = PerubahanJadwalPeminjaman::where('ID_PEMINJAMAN',$id)->first();

        $user = User::find($perubahan->ID_USER);

        $perubahan->update([
            'STATUS_PERUBAHAN' => 1,
        ]);

        Notification::send($user, new SuccessPenjadwalanUlang($id));
        return redirect()->route('pengelola.penjadwalan-ulang.index')->with('updated','Data berhasil diubah');
    }
}
