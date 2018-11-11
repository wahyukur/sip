<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // cek api token pada user
        // jika tidak terdaftar, maka kembalikan pesan error
        // jika berhasil, maka lanjutkan

        if(User::where('api_token', $request->api_token)->count() <= 0){
            return response()->json([
                'message' => 'API token tidak terdaftar'
            ]);
        }

        return $next($request);
    }
}
