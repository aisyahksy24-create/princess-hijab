<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPegawai
{
    /**
     * Lindungi route yang hanya boleh diakses oleh pegawai yang sudah login.
     * Jika belum login → redirect ke /login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('login')) {
            return redirect('/login')->with('gagal', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
