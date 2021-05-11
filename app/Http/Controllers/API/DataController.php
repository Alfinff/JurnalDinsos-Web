<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JenisAduan;
use App\Models\JenisKelamin;

class DataController extends Controller
{
    public function jenisaduan(Request $request, $uuid=null) {
        if($uuid!=null) {
            $data['data'] = JenisAduan::where('uuid', $uuid)->distinct()->get();
        } else {
            $data['data'] = JenisAduan::distinct()->get();
        }
        $data['msg'] = "Berhasil mendapatkan Jenis Aduan";
        $data['success'] = true;
        return response()->json($data);
    }

    public function jeniskelamin(Request $request, $uuid=null) {
        if($uuid!=null) {
            $data['data'] = JenisKelamin::where('uuid', $uuid)->distinct()->get();
        } else {
            $data['data'] = JenisKelamin::distinct()->get();
        }
        $data['msg'] = "Berhasil mendapatkan Jenis Kelamin";
        $data['success'] = true;
        return response()->json($data);
    }
}
