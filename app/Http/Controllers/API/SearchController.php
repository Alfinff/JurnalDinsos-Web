<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\KodeWilayah;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Helpers\Fungsi;

class SearchController extends Controller
{
    public function search(Request $request, $uuid=null)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
        ]);

        if ($validator->fails()) {
            $data['msg'] = $validator->errors();
            $data['success'] = false;
            return response()->json($data);
        } else {
            try {
                $nik = $request->nik;
                if($uuid!=null) {
                    $datapendaftaran = Pendaftaran::with('penanggungjawab', 'upt', 'jenisaduan', 'jeniskelamin', 'permasalahanya', 'pendampinya')->where('uuid', $uuid)->where('nik', 'like', '%'.$nik.'%')->where('soft_delete', 0)->orderBy('created_at', 'desc')->first();
                    if(((!$datapendaftaran) || (!$datapendaftaran->count()))) {
                        $d['msg'] = "Data Tidak Ditemukan";
                        $d['success'] = false;
                        return response()->json($d);
                    }
                    $wilayah = null;
                    $wilayah = KodeWilayah::where('kec_id', $datapendaftaran->kec_id)->first();

                    $data['data'] = $datapendaftaran;
                    if(isset($datapendaftaran->photo) && ($datapendaftaran->photo != null)) {
                        $data['data']['foto_kondisi'] = Storage::disk('s3')->temporaryUrl($datapendaftaran->photo, \Carbon\Carbon::now()->addMinutes(3600));
                    } else {
                        $data['data']['foto_kondisi'] = '';
                    }
                    if(isset($datapendaftaran->surat_pengantar) && ($datapendaftaran->surat_pengantar != null)) {
                        $data['data']['surat_pengantar'] = Storage::disk('s3')->temporaryUrl($datapendaftaran->surat_pengantar, \Carbon\Carbon::now()->addMinutes(3600));
                    } else {
                        $data['data']['surat_pengantar'] = '';
                    }
                    if($datapendaftaran->tindakan == 0) {
                        $data['data']['status'] = 'Tertunda';
                    } else if($datapendaftaran->tindakan == 1) {
                        $data['data']['status'] = 'Dihubungi';
                    } else if($datapendaftaran->tindakan == 2) {
                        $data['data']['status'] = 'Ditangani';
                    } else if($datapendaftaran->tindakan == 2) {
                        $data['data']['status'] = 'Selesai';
                    } else {
                        $data['data']['status'] = '';
                    }
                    $data['data']['prov_id'] = $wilayah->prov ?? '';
                    $data['data']['kab_id'] = $wilayah->kab ?? '';
                    $data['data']['kec_id'] = $wilayah->kec ?? '';

                    $data['msg'] = "Berhasil mendapatkan data";
                    $data['success'] = true;
                    return response()->json($data);
                }

                $datapendaftaran = Pendaftaran::where('nik', 'like', '%'.$nik.'%')->where('soft_delete', 0)->orderBy('created_at', 'desc')->get();
                if(((!$datapendaftaran) || (!$datapendaftaran->count()))) {
                    $d['msg'] = "Data Tidak Ditemukan";
                    $d['success'] = false;
                    return response()->json($d);
                }
                foreach($datapendaftaran as $pp => $val) {
                    $data['data'][$pp]['uuid'] = $val->uuid;
                    $data['data'][$pp]['nama'] = $val->nama_lengkap;
                    $data['data'][$pp]['nik'] = $val->nik;
                    if($val->tindakan == 0) {
                        $data['data'][$pp]['status'] = 'Tertunda';
                    } else if($val->tindakan == 1) {
                        $data['data'][$pp]['status'] = 'Dihubungi';
                    } else if($val->tindakan == 2) {
                        $data['data'][$pp]['status'] = 'Ditangani';
                    } else if($val->tindakan == 2) {
                        $data['data'][$pp]['status'] = 'Selesai';
                    } else {
                        $data['data'][$pp]['status'] = '';
                    }
                }
                $data['msg'] = "Berhasil mendapatkan data";
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
}
