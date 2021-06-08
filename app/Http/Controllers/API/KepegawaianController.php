<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Helpers\Fungsi;

class KepegawaianController extends Controller
{
    public function getPegawaiSemua(Request $request)
    {
        try {
            $data['data']['semuapegawai'] = User::count();
            $data['data']['pegawaiaktif'] = User::where('aktif', 1)->count();

            $data['msg'] = "Data Semua Kepegawaian";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage()
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function getPegawaiUpt(Request $request, $upt_id)
    {
        try {
            $data['data']['semuapegawai'] = User::where('upt_id', $upt_id)->count();
            $data['data']['pegawaiaktif'] = User::where('aktif', 1)->where('upt_id', $upt_id)->count();

            $data['msg'] = "Data Kepegawaian Upt";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage()
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }
}
