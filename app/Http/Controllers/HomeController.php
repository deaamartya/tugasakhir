<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Hash;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->tipe_user->NAMA_TIPE_USER == "Guru") {
            return redirect()->route('guru.dashboard');

        } else if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Admin") {
            return redirect()->route('admin.dashboard');

        } else if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Kepala Laboratorium") {
            return redirect()->route('kepalalab.dashboard');
        } else if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Waka Sarpras") {
            return redirect()->route('sarpras.dashboard');
        } else {
            return redirect()->route('pengelola.dashboard');
        }
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user()->ID_USER;
        $passuser = User::find($user)->value('password');
        if(Hash::check($request->old_password,$passuser)){
            User::find($user)->update([
                'password' => bcrypt($request->new_password)
            ]);
        }
        else {
            throw ValidationException::withMessages(["old_password" =>"Password lama salah"]);
        }
        return redirect('/');
    }

    public function gantiPasswordView(Request $request)
    {
        $page_title = 'Ganti Password';
        $page_description = 'Ganti Password';
        $action = 'dashboard_1';
        return view('auth.changepassword', compact('page_title', 'page_description','action'));
    }
}
