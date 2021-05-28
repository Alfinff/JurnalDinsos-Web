<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    public function berita(Request $request, $id=null) {
        try {
            if($id!=null) {
                $berita = Berita::with(['editorberita'])->where('id', $id)->where('soft_delete', 0)->distinct()->first();
                $berita['images'] = Storage::disk('s3')->temporaryUrl($berita['images'] ?? '', \Carbon\Carbon::now()->addMinutes(3600));
                $data['data'] = $berita;
            } else {
                $berita = Berita::with(['editorberita'])->distinct()->where('soft_delete', 0)->orderBy('created_at', 'asc')->get();
                foreach($berita as $b => $val) {
                    $data['data'][$b]['id'] = $val['id'];
                    $data['data'][$b]['title'] = $val['title'];
                    $data['data'][$b]['content'] = $val['content'];
                    $data['data'][$b]['created_at'] = $val['created_at'];
                    $data['data'][$b]['updated_at'] = $val['updated_at'];
                    $data['data'][$b]['editor'] = $val['editor'];
                    $data['data'][$b]['images'] = Storage::disk('s3')->temporaryUrl($val['images'] ?? '', \Carbon\Carbon::now()->addMinutes(3600));
                    $data['data'][$b]['soft_delete'] = $val['soft_delete'];
                    $data['data'][$b]['editorberita'] = $val['editorberita'];
                }
            }

            if(((!$berita) || (!$berita->count()))) {
                $d['msg'] = "Data Berita Tidak Ada / Kosong";
                $d['success'] = false;
                return response()->json($d);
            }

            $data['msg'] = "Berhasil mendapatkan Berita";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function terbaru(Request $request)
    {
        try {
            $beritaterbaru = Berita::where('soft_delete', 0)->orderBy('created_at', 'desc')->limit(3)->get();
            if(((!$beritaterbaru) || (!$beritaterbaru->count()))) {
                $d['msg'] = "Data Berita Tidak Ada / Kosong";
                $d['success'] = false;
                return response()->json($d);
            }

            foreach($beritaterbaru as $b => $val) {
                $data['data'][$b]['id'] = $val['id'];
                $data['data'][$b]['title'] = $val['title'];
                $data['data'][$b]['content'] = $val['content'];
                $data['data'][$b]['created_at'] = $val['created_at'];
                $data['data'][$b]['updated_at'] = $val['updated_at'];
                $data['data'][$b]['editor'] = $val['editor'];
                $data['data'][$b]['images'] = Storage::disk('s3')->temporaryUrl($val['images'] ?? '', \Carbon\Carbon::now()->addMinutes(3600));
                $data['data'][$b]['soft_delete'] = $val['soft_delete'];
                $data['data'][$b]['editorberita'] = $val['editorberita'];
            }

            $data['msg'] = "Berhasil mendapatkan Berita";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }
}
