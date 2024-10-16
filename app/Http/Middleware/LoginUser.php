<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('token');
        $id = $request->session()->get('id_user');
        $idTingkatan = $request->session()->get('id_tingkatan');
        $role = $request->session()->get('role');
        $fullname = $request->session()->get('fullname');

        if ($token && $id && $fullname && $role == "admin") {
            return $next($request);
        } else if ($token && $idTingkatan && $fullname && $role == "user") {
            return $next($request);
        }


        return redirect('/login');
    }
}
