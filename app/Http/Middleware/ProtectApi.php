<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;

class ProtectApi
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
        try {
            if ($request->header('Authorization')) {
                $decode = JWT::decode($request->header('Authorization'), env('JWT_SECRET_KEY'), ['HS256']);

                if ($decode) {
                    return $next($request);
                }
            }
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Unauthorized',
                'success' => false,
            ], 401);
        }
    }
}
