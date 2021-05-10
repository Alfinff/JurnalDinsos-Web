<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Notifications\PendaftarNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\KodeWilayah;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Models\Permasalahan;
use App\Helpers\Fungsi;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class PendaftarController extends Controller
{
    public function tertunda() {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        return view('upt.pendaftar.tertunda', compact('users'));
    }

    public function dataTertunda() {
        $pendaftar = Fungsi::getPendaftarTertunda(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->editColumn('jenis_aduan', function ($data){
                foreach(JenisAduan::all() as $j) {
                    if($data->jenis_aduan == $j->uuid){
                        return $j->nama;
                    }
                }
            })
            ->addColumn('action', function($dataTertunda){
                $actionBtn = '
                <a class = "btn btn-warning" href    = "'.route('upt-pendaftar-tertunda-detail', ['uuid' => $dataTertunda->uuid]).'"><img src="'.asset('assets/images/edit.svg').'"></a>
                <a class = "btn btn-primary" onclick = "pilih_pj('.$dataTertunda->id.')" ><i class="fa fa-phone"></i></a>';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);;
    }

    public function dataTertundaDetailEdit(Request $request, $uuid) {
        $provinsi    = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan = JenisAduan::get();
        $upt         = Upt::get();
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->back()->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.pendaftar.detailTertunda', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                            $pendaftar          = Pendaftaran::where('uuid', $uuid)->first();
                $pendaftar['nama_lengkap']     = $request->nama_lengkap;
                $pendaftar['nik']              = $request->nik;
                $pendaftar['tempat_lahir']     = $request->tempat_lahir;
                $pendaftar['tanggal_lahir']    = $request->tanggal_lahir;
                $pendaftar['umur']             = $request->umur;
                $pendaftar['jenis_kelamin']    = $request->jenis_kelamin;
                $pendaftar['no_hp']            = $request->no_hp;
                $pendaftar['prov_id']          = 35;
                $pendaftar['kab_id']           = $request->kab_id;
                $pendaftar['kec_id']           = $request->kec_id;
                $pendaftar['alamat']           = $request->alamat;
                $pendaftar['jenis_aduan']      = $request->jenis_aduan;
                $pendaftar['upt_id']           = auth()->user()->upt_id;
                $pendaftar['nama_rekomendasi'] = $request->nama_rekomendasi;
                $pendaftar['telp_rekomendasi'] = $request->telp_rekomendasi;

                if(file_exists($_FILES['foto_kondisi']['tmp_name']) || is_uploaded_file($_FILES['foto_kondisi']['tmp_name'])) {
                    // $pendaftar['foto_kondisi'] = Str::uuid().".".$request->file("foto_kondisi")->extension();
                    // Storage:: put('public/pendaftaran/'.$pendaftar['foto_kondisi'], $request->file("foto_kondisi")->getContent());

                    UploadImage::setPath('pendaftaran/foto_kondisi');
                    UploadImage::setImage($request->file("foto_kondisi")->getContent());
                    UploadImage::setExt($request->file("foto_kondisi")->extension());
                    $path_foto_kondisi = UploadImage::uploadImage();
                    $pendaftar['foto_kondisi'] = $path_foto_kondisi;
                }
                if(file_exists($_FILES['surat_pengantar']['tmp_name']) || is_uploaded_file($_FILES['surat_pengantar']['tmp_name'])) {
                    // $pendaftar['surat_pengantar'] = Str::uuid().".".$request->file("surat_pengantar")->extension();
                    // Storage:: put('public/pendaftaran/'.$pendaftar['surat_pengantar'], $request->file("surat_pengantar")->getContent());

                    UploadFile::setPath('pendaftaran/surat_pengantar');
                    UploadFile::setFile($request->file("surat_pengantar")->getContent());
                    UploadFile::setExt($request->file("surat_pengantar")->extension());
                    $path_surat_pengantar = UploadFile::uploadFile();
                    $pendaftar['surat_pengantar'] = $path_surat_pengantar;
                }
                $pendaftar->update();

                DB:: commit();
                return redirect()->back()->with(array(
                    'message'    => 'Sukses Edit Data',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                return $th;
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function hubungi(Request $request) {
        DB:: beginTransaction();
        try {
            $pendaftar = Pendaftaran::where('id', $request->idpendaftar)->first();
            if(!$pendaftar) {
                return redirect()->back()->with(array(
                    'message'    => 'Data Pendaftar Tidak Ditemukan',
                    'alert-type' => 'error'
                ));
            }

            $pendaftar->update([
                'tindakan' => 1,
                'pj_id'    => $request->idpenanggungjawab,
            ]);

            // buat notifikasi
            $to      = User::where('upt_id', auth()->user()->upt_id)->get();
            $judul   = 'Pendaftar Dihubungi';
            $pesan   = 'Ada pendaftar yang di hubungi oleh ' . ucwords(auth()->user()->username) . '. Silahkan di Cek!';
            $url    = '/upt/pendaftar/dihubungi';
            foreach($to as $t) {
                $t->notify(new PendaftarNotification($judul, $pesan, $url));
            }

            DB:: commit();
            return redirect()->back()->with(array(
                'message'    => 'Status Telah Dihubungi',
                'alert-type' => 'success'
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ))->withInput();
        }
    }

    public function dihubungi(Request $request) {
        return view('upt.pendaftar.dihubungi');
    }

    public function dataDihubungi() {
        $pendaftar = Fungsi::getPendaftarDihubungi(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->editColumn('jenis_aduan', function ($data){
                foreach(JenisAduan::all() as $j) {
                    if($data->jenis_aduan == $j->uuid){
                        return $j->nama;
                    }
                }
            })
            ->addColumn('action', function($dataTertunda){
                $actionBtn = '<a class="btn btn-primary" href="'.route('upt-pendaftar-tertunda-tangani', ['uuid' => $dataTertunda->uuid]).'">Tangani</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);;
    }

    public function tanganiPendaftar(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi    = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan = JenisAduan::get();
        $permasalahan = Permasalahan::get();
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->back()->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.pendaftar.ditanganiForm', compact('pendaftar', 'provinsi', 'jenis_aduan', 'permasalahan', 'users'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                           $pendaftar          = Pendaftaran::where('uuid', $uuid)->first();
                $pendaftar['tindakan']         = 2;
                $pendaftar['nama_lengkap']     = $request->nama_lengkap;
                $pendaftar['nik']              = $request->nik;
                $pendaftar['tempat_lahir']     = $request->tempat_lahir;
                $pendaftar['tanggal_lahir']    = $request->tanggal_lahir;
                $pendaftar['umur']             = $request->umur;
                $pendaftar['jenis_kelamin']    = $request->jenis_kelamin;
                $pendaftar['no_hp']            = $request->no_hp;
                $pendaftar['prov_id']          = 35;
                $pendaftar['kab_id']           = $request->kab_id;
                $pendaftar['kec_id']           = $request->kec_id;
                $pendaftar['alamat']           = $request->alamat;
                $pendaftar['jenis_aduan']      = $request->jenis_aduan;
                $pendaftar['upt_id']           = auth()->user()->upt_id;
                $pendaftar['nama_rekomendasi'] = $request->nama_rekomendasi;
                $pendaftar['telp_rekomendasi'] = $request->telp_rekomendasi;
                $pendaftar['pendamping']       = $request->pendamping;
                $pendaftar['nomor_registrasi'] = $request->nomor_registrasi;
                $pendaftar['tanggal_masuk']    = date('Y-m-d', strtotime($request->tanggal_masuk));
                $pendaftar['tanggal_keluar']   = date('Y-m-d', strtotime($request->tanggal_keluar));
                $pendaftar['permasalahan']     = $request->permasalahan;
                if(file_exists($_FILES['foto_kondisi']['tmp_name']) || is_uploaded_file($_FILES['foto_kondisi']['tmp_name'])) {
                    UploadImage::setPath('pendaftaran/foto_kondisi');
                    UploadImage::setImage($request->file("foto_kondisi")->getContent());
                    UploadImage::setExt($request->file("foto_kondisi")->extension());
                    $path_foto_kondisi = UploadImage::uploadImage();
                    $pendaftar['foto_kondisi'] = $path_foto_kondisi;
                }
                if(file_exists($_FILES['surat_pengantar']['tmp_name']) || is_uploaded_file($_FILES['surat_pengantar']['tmp_name'])) {
                    UploadFile::setPath('pendaftaran/surat_pengantar');
                    UploadFile::setFile($request->file("surat_pengantar")->getContent());
                    UploadFile::setExt($request->file("surat_pengantar")->extension());
                    $path_surat_pengantar = UploadFile::uploadFile();
                    $pendaftar['surat_pengantar'] = $path_surat_pengantar;
                }
                $pendaftar->update();

                // buat notifikasi
                $to      = User::where('upt_id', auth()->user()->upt_id)->get();
                $judul   = 'Pendaftar Ditangani';
                $pesan   = 'Ada pendaftar yang di tangani oleh ' . ucwords(auth()->user()->username) . '. Silahkan di Cek!';
                $url    = '/upt/penerima';
                foreach($to as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $url));
                }

                DB:: commit();
                return redirect()->route('upt-pendaftar-dihubungi')->with(array(
                    'message'    => 'Sukses Menangani Data',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

}
