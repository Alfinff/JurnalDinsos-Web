<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upt;
use Illuminate\Support\Facades\DB;

class UPTController extends Controller
{
    public function get_upt(Request $request, $nama) {
        // $data['upt'] = Upt::where('nama', 'like', $nama)
        //     ->orWhere('alamat', 'like', $nama )
        //     ->distinct()
        //     ->get();
        $data['upt'] = DB::select("select * from upt where alamat like '%mojo%'");
        $data['msg'] = "Berhasil mendapatkan upt";
        $data['success'] = true;
        return response()->json($data);
    }

}
