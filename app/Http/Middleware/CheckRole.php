<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next, $auth_role)
    {
        $role = Role::find(auth()->user()->role);
        $roles = explode('&', $auth_role);
        $x = 0;
        foreach ($roles as $r) {
            if ($role->role == $r) {
                $x = 1;
            }
        }
        if ($x == 1) {
            return $next($request);
        }

        if($role->role == 'dinsos') {
            return redirect()->route('dinsos-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses!',
                'alert-type' => 'error'
            ));
        } elseif($role->role == 'upt') {
            return redirect()->route('upt-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses!',
                'alert-type' => 'error'
            ));
        } elseif($role->role == 'pegawai') {
            return redirect()->route('pegawai-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses!',
                'alert-type' => 'error'
            ));
        } else {
            auth()->logout();
            return redirect()->route('index')->with(array(
                'message'    => 'Anda Tidak Punya Akses!',
                'alert-type' => 'error',
                'style'      => 'hide'
            ));
        }
    }
}
