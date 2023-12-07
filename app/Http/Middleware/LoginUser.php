<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $fullname = $request->session()->get('fullname');


        if ($token && $id && $fullname) {
            return $next($request);
        }

        // $request->session()->flush();

        return redirect('/login');
    }
}
