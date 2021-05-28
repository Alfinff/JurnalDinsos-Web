<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Video;

class VideoController extends Controller
{
    public function get(Request $request, $uuid=null)
    {
        if($uuid!=null) {
            $data['data'] = Video::with(['editornya'])->where('uuid', $uuid)->where('soft_delete', 0)->first();
        } else {
            $data['data'] = Video::with(['editornya'])->where('soft_delete', 0)->get();
        }

        if(((!$data['data']) || (!$data['data']->count()))) {
            $d['msg'] = "Data Video Tidak Ada / Kosong";
            $d['success'] = false;
            return response()->json($d);
        }

        $data['msg'] = "Berhasil mendapatkan video";
        $data['success'] = true;
        return response()->json($data);
    }
}
