<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KodeWilayah;
use Illuminate\Http\Request;

class KodeWilayahController extends Controller
{
    public function get_provinsi(Request $request) {
        $data['provinsi'] = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $data['msg'] = "Berhasil mendapatkan provinsi";
        $data['success'] = true;
        return response()->json($data);
    }

    public function get_kabupaten(Request $request, $prov_id) {
        $where = array(
            'prov_id' => $prov_id
        );
        $data['kabupaten'] = KodeWilayah::select(['kab_id', 'kab'])
            ->where($where)
            ->distinct()
            ->get();
        $data['msg'] = "Berhasil mendapatkan kabupaten";
        $data['success'] = true;
        return response()->json($data);
    }

    public function get_kecamatan(Request $request, $kab_id) {
        $where = array(
            'kab_id' => $kab_id
        );

        $data['kecamatan'] = KodeWilayah::select(['kec_id', 'kec'])
            ->where($where)
            ->distinct()
            ->get();

        $data['msg'] = "Berhasil mendapatkan kecamatan";
        $data['success'] = true;
        return response()->json($data);
    }

    public function get_kelurahan(Request $request, $kec_id) {
        $where = array(
            'kec_id' => $kec_id
        );
        $data['kelurahan'] = KodeWilayah::select(['kel_id', 'kel', 'koordinat'])
            ->where($where)
            ->distinct()
            ->get();
        $data['msg'] = "Berhasil mendapatkan kelurahan";
        $data['success'] = true;
        return response()->json($data);
    }
}
