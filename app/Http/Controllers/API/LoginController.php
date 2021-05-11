<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use App\Models\Role;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $data['msg'] = $validator->errors();
            $data['success'] = false;
            return response()->json($data);
        } else {
            try {
                $credential  = $request->only(['email', 'password']);
                $credential['soft_delete'] = 0;
                if(Auth::attempt($credential)){
                    if(auth()->user()->aktif != 1) {
                        $data['msg'] = 'Data Pengguna Tidak Aktif';
                        $data['success'] = false;
                        return response()->json($data);
                    }

                    $payload = [
                        'pengguna' => auth()->user()->uuid,
                        'exp' => time() + (3600 * 24),
                        'ttl' => time() + (3600 * 24)
                    ];

                    $data['accessToken'] = JWT::encode($payload, $_ENV['JWT_SECRET_KEY']);
                    $data['expiry'] = date(DATE_ISO8601, $payload['exp']);
                    $data['msg'] = 'Berhasil Login';
                    $data['success'] = true;
                    return response()->json($data);
                } else {
                    $data['msg'] = 'Username Atau Password yang anda masukkan salah';
                    $data['success'] = false;
                    return response()->json($data);
                }
            } catch (\Throwable $th) {
                // $th->getMessage()
                $data['msg'] = 'Terdapat Kesalahan';
                $data['success'] = false;
                return response()->json($data);
            }
        }
    }

    public function checkToken(Request $request)
    {
        try {
            if ($request->header('Authorization')) {
                $decode = JWT::decode($request->header('Authorization'), env('JWT_SECRET_KEY'), ['HS256']);
                $users = User::with(['upt', 'role'])->where('uuid', $decode->pengguna)->where('soft_delete', 0)->first();

                if(((!$users) || (!$users->count()))) {
                    $data['msg'] = 'Data Tidak Ada / Kosong';
                    $data['success'] = false;
                    return response()->json($data);
                }

                $data['data'] = $users;
                $data['msg'] = 'Data Pengguna';
                $data['success'] = true;
                return response()->json($data);
            }
        } catch (\Throwable $th) {
            $data['msg'] = 'Terdapat Kesalahan';
            $data['success'] = false;
            return response()->json($data);
        }
    }
}
