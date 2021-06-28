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
        // cek apakah admin
        if (Auth::user()->tipe_user->NAMA_TIPE_USER == "Admin") {
            return $next($request);
        }
        // selain admin
        elseif (Auth::check()) {
            return abort(403,'notPermitted');
        }
        // belum login
        elseif(!Auth::check()){
            return abort(403,'loggedOut');
        }
    }
}
