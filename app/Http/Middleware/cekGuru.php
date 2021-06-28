<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class cekGuru
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
        // cek apakah guru
        if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Guru") {
            return $next($request);
        }
        // selain guru
        elseif (Auth::check()) {
            return abort(403,'notPermitted');
        }
        // belum login
        elseif(!Auth::check()){
            return abort(403,'loggedOut');
        }
    }
}
