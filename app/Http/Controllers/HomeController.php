<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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

        } else {
            return redirect()->route('pengelola.dashboard');
        }
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user()->ID_USER;
        $passuser = User::find($user)->value('password');
        if(bcrypt($request->old_password) == $passuser){
            User::find($user)->update([
                'password' => bcrypt($request->new_password)
            ]);
        }
        return redirect('/');
    }
}
