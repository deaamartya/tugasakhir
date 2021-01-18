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
        if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Guru") {
            return redirect()->route('guru.dashboard');

        } else if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Admin") {
            return redirect()->route('admin.dashboard');

        } else {
            return redirect()->route('pengelola.dashboard');
        }
    }
}
