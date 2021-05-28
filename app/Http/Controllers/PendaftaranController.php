<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Notifications\PendaftarNotification;
use App\Models\KodeWilayah;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\User;
use App\Models\JenisAduan;
use App\Models\JenisKelamin;
use App\Helpers\Fungsi;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class PendaftaranController extends Controller
{
    public function index() {
        $data['provinsi']    = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $data['kabupaten']   = KodeWilayah::where('prov_id', '35')->select(['kab_id', 'kab'])->distinct()->get();
        $data['kecamatan']   = KodeWilayah::select(['kec_id', 'kec'])->distinct()->get();
        $data['jenis_aduan'] = JenisAduan::orderBy('nama', 'asc')->get();
        $data['jenis_kelamin'] = JenisKelamin::orderBy('nama', 'asc')->get();
        $data['upt']         = Upt::orderBy('nama', 'asc')->get();
        return view('pendaftaran', $data);
    }

    public function daftar(Request $request) {
        DB:: beginTransaction();
        try {
            $noregis = Fungsi::generateNoRegis();
            $pendaftaran = new Pendaftaran;
            $pendaftaran->nomor_registrasi = $noregis;
            $pendaftaran->nama_lengkap     = $request->nama_lengkap;
            $pendaftaran->nik              = $request->nik;
            $pendaftaran->tempat_lahir     = $request->tempat_lahir;
            $pendaftaran->tanggal_lahir    = $request->tanggal_lahir;
            $pendaftaran->umur             = $request->umur;
            $pendaftaran->jenis_kelamin    = $request->jenis_kelamin;
            $pendaftaran->no_hp            = $request->no_hp;
            $pendaftaran->prov_id          = 35;
            $pendaftaran->kab_id           = $request->kab_id;
            $pendaftaran->kec_id           = $request->kec_id;
            $pendaftaran->alamat           = $request->alamat;
            $pendaftaran->jenis_aduan      = $request->jenis_aduan;
            $pendaftaran->upt_id           = $request->upt_id;
            $pendaftaran->nama_rekomendasi = $request->nama_rekomendasi;
            $pendaftaran->telp_rekomendasi = $request->telp_rekomendasi;
            $pendaftaran->created_at       = date('Y-m-d H:i:s');
            $pendaftaran->uuid             = Str::uuid();

            // $data_in['foto_kondisi']     = Str::uuid().".".
            //     $request->file("foto_kondisi")->extension();
            // $data_in['surat_pengantar'] = Str::uuid().".".
            //     $request->file("surat_pengantar")->extension();
            // Storage::put('public/pendaftaran/'.$data_in['foto_kondisi'],
            //     $request->file("foto_kondisi")->getContent());
            // Storage::put('public/pendaftaran/'.$data_in['surat_pengantar'],
            //     $request->file("surat_pengantar")->getContent());

            // upload to s3 foto kondisi & surat pengantar
            UploadImage::setPath('pendaftaran/foto_kondisi');
            UploadImage::setImage($request->file("foto_kondisi")->getContent());
            UploadImage::setExt($request->file("foto_kondisi")->extension());
            $path_foto_kondisi = UploadImage::uploadImage();

            UploadFile::setPath('pendaftaran/surat_pengantar');
            UploadFile::setFile($request->file("surat_pengantar")->getContent());
            UploadFile::setExt($request->file("surat_pengantar")->extension());
            $path_surat_pengantar = UploadFile::uploadFile();

            $pendaftaran->foto_kondisi = $path_foto_kondisi;
            $pendaftaran->surat_pengantar = $path_surat_pengantar;

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
            return redirect()->back()->with(array(
                'message'    => 'Sukses Mendaftar',
                'alert-type' => 'success',
                'style'      => 'hide'
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => $th->getMessage(),
                'alert-type' => 'error',
                'style'      => 'hide'
            ))->withInput();
        }
    }
}
