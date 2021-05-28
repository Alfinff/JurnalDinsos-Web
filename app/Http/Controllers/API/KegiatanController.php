<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Kegiatan;
use App\Models\Upt;

class KegiatanController extends Controller
{
    public function kegiatan(Request $request, $id=null) {
        try {
            if($id!=null) {
                $kegiatan = Kegiatan::with(['tipe'])->where('id', $id)->distinct()->first();
                if($kegiatan->photo != null) {
                    $kegiatan['photo'] = Storage::disk('s3')->temporaryUrl($kegiatan->photo ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $kegiatan['photo'] = '';
                }
                $data['data'] = $kegiatan;
            } else {
                $kegiatan = Kegiatan::with(['tipe'])->distinct()->get();
                $data['data'] = $kegiatan;
                foreach($kegiatan as $b => $val) {
                    $data['data'][$b]['id'] = $val['id'] ?? '';
                    $data['data'][$b]['start_date'] = $val['start_date'] ?? '';
                    $data['data'][$b]['end_date'] = $val['end_date'] ?? '';
                    $data['data'][$b]['title'] = $val['title'] ?? '';
                    $data['data'][$b]['budget'] = $val['budget'] ?? '';
                    $data['data'][$b]['description'] = $val['description'] ?? '';
                    if($val['photo'] != null) {
                        $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                    } else {
                        $data['data'][$b]['photo'] = '';
                    }
                    $data['data'][$b]['number_of_p'] = $val['number_of_p'] ?? '';
                    $data['data'][$b]['upt_id'] = $val['upt_id'] ?? '';
                    $data['data'][$b]['updated_at'] = $val['updated_at'] ?? '';
                    $data['data'][$b]['created_at'] = $val['created_at'] ?? '';
                    $data['data'][$b]['soft_delete'] = $val['soft_delete'] ?? '';
                    $data['data'][$b]['tipe'] = $val['tipe'] ?? '';
                }
            }

            if(((!$kegiatan) || (!$kegiatan->count()))) {
                $d['msg'] = "Data Kegiatan Tidak Ada / Kosong";
                $d['success'] = false;
                return response()->json($d);
            }

            $data['msg'] = "Berhasil mendapatkan Kegiatan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function perupt(Request $request, $upt_id) {
        try {
            $upt = Upt::where('uuid', $upt_id)->first();
            if(!$upt) {
                $d['msg'] = "Data Upt Tidak Ada / Kosong";
                $d['success'] = false;
                return response()->json($d);
            }

            $kegiatan = Kegiatan::with(['tipe'])->where('upt_id', $upt_id)->distinct()->get();
            if(((!$kegiatan) || (!$kegiatan->count()))) {
                $d['msg'] = "Data Kegiatan Tidak Ada / Kosong";
                $d['success'] = false;
                return response()->json($d);
            }

            $data['data'] = $kegiatan;
            foreach($kegiatan as $b => $val) {
                $data['data'][$b]['id'] = $val['id'] ?? '';
                $data['data'][$b]['start_date'] = $val['start_date'] ?? '';
                $data['data'][$b]['end_date'] = $val['end_date'] ?? '';
                $data['data'][$b]['title'] = $val['title'] ?? '';
                $data['data'][$b]['budget'] = $val['budget'] ?? '';
                $data['data'][$b]['description'] = $val['description'] ?? '';
                // $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                if($val['photo'] != null) {
                    $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $data['data'][$b]['photo'] = '';
                }
                $data['data'][$b]['number_of_p'] = $val['number_of_p'] ?? '';
                $data['data'][$b]['upt_id'] = $val['upt_id'] ?? '';
                $data['data'][$b]['updated_at'] = $val['updated_at'] ?? '';
                $data['data'][$b]['created_at'] = $val['created_at'] ?? '';
                $data['data'][$b]['soft_delete'] = $val['soft_delete'] ?? '';
                $data['data'][$b]['tipe'] = $val['tipe'];
            }

            $data['msg'] = "Berhasil mendapatkan Kegiatan";
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
