<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Lindungi route yang hanya boleh diakses oleh admin (pemilik).
     * Jika belum login atau bukan admin → redirect ke /login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('login') || session('role') !== 'admin') {
            return redirect('/login')->with('gagal', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
