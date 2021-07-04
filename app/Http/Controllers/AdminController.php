<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laboratorium;
use App\Models\User;
use App\Models\PeminjamanAlatBahan;
use App\Models\Praktikum;
use App\Models\TahunAkademik;

class AdminController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $action = 'dashboard_1';

        $total_lab = Laboratorium::count('ID_LABORATORIUM');
        $total_user = User::count('ID_USER');
        $total_user_online = User::where('ONLINE',1)->count('ID_USER');
        $total_prak = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->count('ID_PEMINJAMAN');

        // Ambil semua praktikum dalam semester.
        $jadwal = PeminjamanAlatBahan::select('peminjaman_alat_bahan.ID_PRAKTIKUM')->get()->toArray();

        // Jumlah praktikum belum dijadwalkan dalam semester.
        $menunggu_penjadwalan = Praktikum::whereNotIn('ID_PRAKTIKUM',$jadwal)->count('ID_PRAKTIKUM');

        // Ambil seluruh praktikum terjadwal
        $praktikum = PeminjamanAlatBahan::all();

        // Ambil 5 praktikum terjadwal
        $praktikum_menunggu = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','MENUNGGU KONFIRMASI')->orderBy('TANGGAL_PEMINJAMAN','ASC')
        ->limit(10)->get();

        // Ambil 5 praktikum selesai
        $praktikum_selesai = PeminjamanAlatBahan::where('STATUS_PEMINJAMAN','SUDAH DIKEMBALIKAN')->orderBy('ID_PEMINJAMAN','DESC')
        ->limit(10)->get();

        return view('admin.dashboard', compact('page_title','action', 'total_lab', 'total_user','total_prak','total_user_online','menunggu_penjadwalan','praktikum','praktikum_menunggu','praktikum_selesai'));
    }

    public function seluruhJadwal()
    {
        $data = [];
        $peminjaman = PeminjamanAlatBahan::all();
        
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
}
