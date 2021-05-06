<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

                                $credential  = $request->only(['email', 'password']);
                    $credential['aktif'] = 1;
                    $credential['soft_delete'] = 0;
        if(Auth::attempt($credential)){
            $role = Role::find(auth()->user()->role);
            $notification = array(
                'message'    => 'Selamat Datang '.ucwords(auth()->user()->username),
                'alert-type' => 'info'
            );

            if ($role->role == 'dinsos') {
                return redirect()->route('dinsos-home')->with($notification);
            } elseif (($role->role == 'upt') || ($role->role == 'pegawai')) {
                return redirect()->route('upt-home')->with($notification);
            // } elseif ($role->role == 'pegawai') {
            //     return redirect()->route('pegawai-home')->with($notification);
            } else {
                return redirect()->route('index')->with(array(
                    'message'    => 'Username Dan Password yang anda masukkan salah',
                    'alert-type' => 'error'
                ))->withInput();
            }
        } else {
            return redirect()->route('index')->with(array(
                'message'    => 'Username Dan Password yang anda masukkan salah',
                'alert-type' => 'error'
            ))->withInput();
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with(array(
            'message'    => 'Sukses Logout',
            'alert-type' => 'success',
            'style'      => 'hide'
        ));
    }
}
