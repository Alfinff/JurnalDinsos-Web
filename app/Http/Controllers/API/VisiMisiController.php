<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function get()
    {
        $data['data'] = VisiMisi::with(['editornya'])->first();
        if(((!$data['data']) || (!$data['data']->count()))) {
            $d['msg'] = "Data Visi Misi Tidak Ada / Kosong";
            $d['success'] = false;
            return response()->json($d);
        }

        $data['msg'] = "Berhasil mendapatkan visimisi";
        $data['success'] = true;
        return response()->json($data);
    }
}
