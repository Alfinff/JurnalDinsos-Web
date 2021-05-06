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

class PendaftaranController extends Controller
{
    public function index() {
        $data['provinsi']    = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $data['kabupaten']   = KodeWilayah::where('prov_id', '35')->select(['kab_id', 'kab'])->distinct()->get();
        $data['kecamatan']   = KodeWilayah::select(['kec_id', 'kec'])->distinct()->get();
        $data['jenis_aduan'] = JenisAduan::get();
        $data['upt']         = Upt::get();
        return view('pendaftaran', $data);
    }

    public function daftar(Request $request) {
        DB:: beginTransaction();
        try {
            $data_in['nama_lengkap']     = $request->nama_lengkap;
            $data_in['nik']              = $request->nik;
            $data_in['tempat_lahir']     = $request->tempat_lahir;
            $data_in['tanggal_lahir']    = $request->tanggal_lahir;
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
            $data_in['foto_kondisi']     = Str::uuid().".".
                $request->file("foto_kondisi")->extension();
            $data_in['surat_pengantar'] = Str::uuid().".".
                $request->file("surat_pengantar")->extension();
            $pendaftaran = new Pendaftaran;
            Storage::put('public/pendaftaran/'.$data_in['foto_kondisi'],
                $request->file("foto_kondisi")->getContent());
            Storage::put('public/pendaftaran/'.$data_in['surat_pengantar'],
                $request->file("surat_pengantar")->getContent());
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
            return redirect()->back()->with(array(
                'message'    => 'Sukses Mendaftar',
                'alert-type' => 'success',
                'style'      => 'hide'
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error',
                'style'      => 'hide'
            ))->withInput();
        }
    }
}
