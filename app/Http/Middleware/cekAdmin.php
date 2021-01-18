<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class cekAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //guru
        if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Guru") {
            return redirect()->route('guru.dashboard');
        }
        //admin
        elseif (Auth::user()->tipe_user->NAMA_TIPE_USER == "Admin") {
            return $next($request);
        }
        //pengelola
        elseif (Auth::user()->tipe_user->NAMA_TIPE_USER == "Pengelola Lab Fisika" || Auth::user()->tipe_user->NAMA_TIPE_USER == "Pengelola Lab Kimia" || Auth::user()->tipe_user->NAMA_TIPE_USER == "Pengelola Lab Biologi") {
            return redirect()->route('pengelola.dashboard');
        }
    }
}
