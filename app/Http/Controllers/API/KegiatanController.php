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
                $kegiatan = Kegiatan::with(['tipe'])->where('id', $id)->first();;
                if(((!$kegiatan) || (!$kegiatan->count()))) {
                    $d['msg'] = "Data Kegiatan Tidak Ada / Kosong";
                    $d['success'] = false;
                    return response()->json($d);
                }
                // if(isset($kegiatan->photo) && ($kegiatan->photo != null)) {
                //     $kegiatan['photo'] = Storage::disk('s3')->temporaryUrl($kegiatan->photo, \Carbon\Carbon::now()->addMinutes(3600));
                // } else {
                //     $kegiatan['photo'] = '';
                // }
                // if(isset($kegiatan->video) && ($kegiatan->video != null)) {
                //     $kegiatan['video'] = Storage::disk('s3')->temporaryUrl($kegiatan->video, \Carbon\Carbon::now()->addMinutes(3600));
                // } else {
                //     $kegiatan['video'] = '';
                // }
                // $kegiatan['budget'] = (string)$kegiatan['budget'];
                // $kegiatan['number_of_p'] = (string)$kegiatan['number_of_p'];

                $data['data'] = $kegiatan;
                $data['data']['id'] = $kegiatan->id ?? '';
                $data['data']['start_date'] = $kegiatan->start_date ?? '';
                $data['data']['end_date'] = $kegiatan->end_date ?? '';
                $data['data']['title'] = $kegiatan->title ?? '';
                $data['data']['budget'] = (string)$kegiatan->budget ?? '';
                $data['data']['description'] = $kegiatan->description ?? '';
                if(isset($kegiatan->photo) && ($kegiatan->photo != null)) {
                    $data['data']['photo'] = Storage::disk('s3')->temporaryUrl($kegiatan->photo ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $data['data']['photo'] = '';
                }
                if(isset($kegiatan->video) && ($kegiatan->video != null)) {
                    $data['data']['video'] = Storage::disk('s3')->temporaryUrl($kegiatan->video ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $data['data']['video'] = '';
                }
                $data['data']['number_of_p'] = (string)$kegiatan->number_of_p ?? '';
                $data['data']['upt_id'] = $kegiatan->upt_id ?? '';
                $data['data']['updated_at'] = $kegiatan->updated_at ?? '';
                $data['data']['created_at'] = $kegiatan->created_at ?? '';
                $data['data']['soft_delete'] = $kegiatan->soft_delete ?? '';
                $data['data']['type'] = $kegiatan->type ?? '';
                $data['data']['tipe'] = $kegiatan->tipe ?? '';
                $data['data']['filedokumen'] = $kegiatan->filedokumen ?? '';
            } else {
                $kegiatan = Kegiatan::with(['tipe'])->distinct()->get();
                $data['data'] = $kegiatan;
                foreach($kegiatan as $b => $val) {
                    $data['data'][$b]['id'] = $val['id'] ?? '';
                    $data['data'][$b]['start_date'] = $val['start_date'] ?? '';
                    $data['data'][$b]['end_date'] = $val['end_date'] ?? '';
                    $data['data'][$b]['title'] = $val['title'] ?? '';
                    $data['data'][$b]['budget'] = (string)$val['budget'] ?? '';
                    $data['data'][$b]['description'] = $val['description'] ?? '';
                    if(isset($val['photo']) && ($val['photo'] != null)) {
                        $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                    } else {
                        $data['data'][$b]['photo'] = '';
                    }
                    if(isset($val['video']) && ($val['video'] != null)) {
                        $data['data'][$b]['video'] = Storage::disk('s3')->temporaryUrl($val['video'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                    } else {
                        $data['data'][$b]['video'] = '';
                    }
                    $data['data'][$b]['number_of_p'] = (string)$val['number_of_p'] ?? '';
                    $data['data'][$b]['upt_id'] = $val['upt_id'] ?? '';
                    $data['data'][$b]['updated_at'] = $val['updated_at'] ?? '';
                    $data['data'][$b]['created_at'] = $val['created_at'] ?? '';
                    $data['data'][$b]['soft_delete'] = $val['soft_delete'] ?? '';
                    $data['data'][$b]['type'] = $val['type'] ?? '';
                    $data['data'][$b]['tipe'] = $val['tipe'] ?? '';
                    $data['data'][$b]['filedokumen'] = $val['filedokumen'] ?? '';
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
            // $th->getMessage()
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
                $data['data'][$b]['budget'] = (string)$val['budget'] ?? '';
                $data['data'][$b]['description'] = $val['description'] ?? '';
                // $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                if(isset($val['photo']) && ($val['photo'] != null)) {
                    $data['data'][$b]['photo'] = Storage::disk('s3')->temporaryUrl($val['photo'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $data['data'][$b]['photo'] = '';
                }
                if(isset($val['video']) && ($val['video'] != null)) {
                    $data['data'][$b]['video'] = Storage::disk('s3')->temporaryUrl($val['video'] ?? null, \Carbon\Carbon::now()->addMinutes(3600));
                } else {
                    $data['data'][$b]['video'] = '';
                }
                $data['data'][$b]['number_of_p'] = (string)$val['number_of_p'] ?? '';
                $data['data'][$b]['upt_id'] = $val['upt_id'] ?? '';
                $data['data'][$b]['updated_at'] = $val['updated_at'] ?? '';
                $data['data'][$b]['created_at'] = $val['created_at'] ?? '';
                $data['data'][$b]['soft_delete'] = $val['soft_delete'] ?? '';
                $data['data'][$b]['tipe'] = $val['tipe'] ?? '';
                $data['data'][$b]['type'] = $val['type'] ?? '';
                $data['data'][$b]['video'] = $val['video'] ?? '';
                $data['data'][$b]['filedokumen'] = $val['filedokumen'] ?? '';
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
