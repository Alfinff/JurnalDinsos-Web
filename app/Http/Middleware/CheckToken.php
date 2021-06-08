<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $auth_role)
    {
        try {
            if ($request->hasHeader('Authorization') && ($request->hasHeader('Authorization')!=null)) {
                $decode = JWT::decode($request->header('Authorization'), env('JWT_SECRET_KEY'), ['HS256']);

                if ($decode) {
                    $roles = explode('_', $auth_role);
                    $x = 0;
                    foreach ($roles as $r) {
                        if ($decode->pengguna->role->role == $r) {
                            $x = 1;
                        }
                    }

                    if ($x == 1) {
                        return $next($request);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Access Not Allowed',
                        ], Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Add Header Authorization',
                ], Response::HTTP_OK);
            }
        } catch (\Throwable $th) {
            // $th->getMessage()
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_OK);
        }
    }
}
