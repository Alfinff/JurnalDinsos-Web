<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upt;
use Illuminate\Support\Facades\DB;

class UPTController extends Controller
{
    public function get_upt(Request $request, $uuid=null) {
        if($uuid!=null) {
            $data['data'] = Upt::where('uuid', $uuid)->distinct()->get();
        } else {
            $data['data'] = Upt::distinct()->get();
        }
        if(((!$data['data']) || (!$data['data']->count()))) {
            $d['msg'] = "Data Upt Tidak Ada / Kosong";
            $d['success'] = false;
            return response()->json($d);
        }
        $data['msg'] = "Berhasil mendapatkan upt";
        $data['success'] = true;
        return response()->json($data);
    }

}
