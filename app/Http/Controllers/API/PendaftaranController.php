<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Notifications\PendaftarNotification;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class PendaftaranController extends Controller
{
    public function daftar(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'nik' => 'required|numeric|digits:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'umur' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|numeric',
            'prov_id' => 'required|numeric',
            'kab_id' => 'required|numeric',
            'kec_id' => 'required|numeric',
            'alamat' => 'required',
            'jenis_aduan' => 'required',
            'upt_id' => 'required',
            'nama_rekomendasi' => 'required',
            'telp_rekomendasi' => 'required',
            'foto_kondisi' => 'required',
            'surat_pengantar' => 'required',
        ]);

        if ($validator->fails()) {
            $data['msg'] = $validator->errors();
            $data['success'] = false;
            return response()->json($data);
        } else {
            DB:: beginTransaction();
            try {
                $data_in['nama_lengkap']     = $request->nama_lengkap;
                $data_in['nik']              = $request->nik;
                $data_in['tempat_lahir']     = $request->tempat_lahir;
                $data_in['tanggal_lahir']    = date('Y-m-d', strtotime($request->tanggal_lahir));
                $data_in['umur']             = $request->umur;
                $data_in['jenis_kelamin']    = $request->jenis_kelamin;
                $data_in['no_hp']            = $request->no_hp;
                $data_in['prov_id']          = 35;
                $data_in['kab_id']           = $request->kab_id;
                $data_in['kec_id']           = $request->kec_id;
                $data_in['alamat']           = $request->alamat;
                $data_in['jenis_aduan']      = $request->jenis_aduan;
                $data_in['upt_id']           = $request->upt_id;
                $data_in['nama_rekomendasi'] = $request->nama_rekomendasi;
                $data_in['telp_rekomendasi'] = $request->telp_rekomendasi;
                $data_in['created_at']       = date('Y-m-d H:i:s');
                $data_in['uuid']             = Str::uuid();

                // upload to s3 foto kondisi & surat pengantar
                // UploadFile::setPath('pendaftaran/surat_pengantar');
                // UploadFile::setFile(base64_decode($request->surat_pengantar));
                // UploadFile::setExt($request->file("surat_pengantar")->extension());
                // $path_surat_pengantar = UploadFile::uploadFile();

                $explode = explode(',', $request->foto_kondisi);
                $fotokondisi = base64_decode($explode[1]);
                $file = $fotokondisi;
                $ext = explode('/', mime_content_type($request->foto_kondisi))[1];
                $path = 'pendaftaran/foto_kondisi';
                $path_foto_kondisi = $path . '/' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 30) . '.' . $ext;
                Storage::disk('custom-s3')->put($path_foto_kondisi, $file, [
                    'visibility' => 'public',
                ]);

                $explode = explode(',', $request->surat_pengantar);
                $suratpengantar = base64_decode($explode[1]);
                $file = $suratpengantar;
                $ext = explode('/', mime_content_type($request->surat_pengantar))[1];
                $path = 'pendaftaran/surat_pengantar';
                $path_surat_pengantar = $path . '/' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 30) . '.' . $ext;
                Storage::disk('custom-s3')->put($path_surat_pengantar, $file, [
                    'visibility' => 'public',
                ]);

                $data_in['foto_kondisi'] = $path_foto_kondisi;
                $data_in['surat_pengantar'] = $path_surat_pengantar;

                $pendaftaran = new Pendaftaran;
                $pendaftaran->fill($data_in);
                $pendaftaran->save();

                // buat notifikasi upt
                $to    = User::where('upt_id', $request->upt_id)->get();
                $judul = 'Pendaftar Baru!';
                $pesan = 'Ada pendaftar yang baru dengan nama ' . ucwords($request->nama_lengkap) . '. Silahkan di Cek!';
                $url   = '/upt/pendaftar/tertunda';
                foreach($to as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $url));
                }

                // buat notifikasi dinsos
                $toDinsos    = User::whereHas('role', function ($q) {
                            $q->where('role', 'dinsos');
                        })->get();
                $urlDinsos   = '/dinsos/pendaftar';
                foreach($toDinsos as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $urlDinsos));
                }

                DB:: commit();
                $data['msg'] = "Berhasil Mendaftar";
                $data['success'] = true;
                return response()->json($data);
            } catch (\Throwable $th) {
                DB:: rollback();
                $data['msg'] = 'Terdapat Kesalahan';
                // $th->getMessage()
                $data['success'] = false;
                return response()->json($data);
            }
        }
    }
}
