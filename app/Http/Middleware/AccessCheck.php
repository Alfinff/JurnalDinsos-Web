<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;

class AccessCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $allowedRole)
    {
        $role = Role::find(auth()->user()->role);

        $allow = explode('&', $allowedRole);
        foreach($allow as $a => $val) {
            if(auth()->user()->module->{$val} == 1) {
                return $next($request);
            }
        }

        if($role->role == 'dinsos') {
            return redirect()->route('dinsos-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses Modul Ini!',
                'alert-type' => 'error'
            ));
        } elseif($role->role == 'upt') {
            return redirect()->route('upt-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses Modul Ini!',
                'alert-type' => 'error'
            ));
        } elseif($role->role == 'pegawai') {
            return redirect()->route('pegawai-home')->with(array(
                'message'    => 'Anda Tidak Punya Akses Modul Ini!',
                'alert-type' => 'error'
            ));
        } else {
            auth()->logout();
            return redirect()->route('index')->with(array(
                'message'    => 'Anda Tidak Punya Akses Modul Ini!',
                'alert-type' => 'error',
                'style'      => 'hide'
            ));
        }
    }
}
