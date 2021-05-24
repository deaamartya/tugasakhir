<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\PeminjamanAlatBahan;

class NotificationController extends Controller
{
    public function guru($id)
    {
        $notification = DB::table('notifications')->where('id','=',$id)->first();
        DB::table('notifications')->where('id','=',$id)->update(['read_at' => now()]);
        return redirect()->route('guru.praktikum.index');
    }

    public function pengelola($id)
    {
        $notification = DB::table('notifications')->where('id','=',$id)->first();
        $data = json_decode($notification->data);
        $id_jadwal = PeminjamanAlatBahan::find($data->ID_PEMINJAMAN);
        DB::table('notifications')->where('id','=',$id)->update(['read_at' => now()]);
        return redirect()->route('pengelola.penjadwalan-ulang.edit',$id_jadwal->perubahan_jadwal_peminjamen->ID_PERUBAHAN_JADWAL);
    }

    public function index()
    {
        $page_title = 'Email Inbox';
        $page_description = 'Some description for the page';
		
		$action = 'email_inbox';
        $notifications = Auth::user()->notifications()->paginate(15);
        $unread = Auth::user()->unreadNotifications()->paginate(15);

        // dd($unread);

        return view('notifications',compact('page_title','page_description','action','notifications','unread'));
    }
}
