<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Models\Pendaftaran;
use App\Models\PendaftaranBantuan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\KodeWilayah;
use App\Models\JenisAduan;
use App\Models\JenisKelamin;
use App\Models\Permasalahan;
use App\Models\Upt;
use App\Models\User;
use App\Helpers\Fungsi;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class PenerimaManfaatController extends Controller
{

    public function index() {
        return view('upt.penerimaManfaat.index');
    }

    public function dataPenerima() {
        $pendaftar = Fungsi::getPendaftarPenerimaManfaat(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->addColumn('tindakanstatus', function ($data){
                if($data->tindakan == 3) {
                    return '<p class="badge badge-primary">Done</p>';
                } elseif(($data->tindakan == 0) || ($data->tindakan == 1) || ($data->tindakan == 2)) {
                    return '<p class="badge badge-info">On Process</p>';
                } else {
                    return '-';
                }
            })
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::hari_indo($data->tanggal_masuk);
            })
            ->editColumn('ttl', function ($data){
                return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk));
            })
            ->addColumn('action', function($dataPenerima){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a href  = "#" class                = "mx-1 btn btn-success" style = "width: 46px" onclick = "more('.$dataPenerima->id.')">
                        <i class = "fa fa-ellipsis-v" style = "color: #fff;" title    = "More"></i>
                        </a>
                        <div class="dropdown tes" id="dropdowns'.$dataPenerima->id.'">
                            <a onclick="return confirm(`Anda Yakin Mengubah Status Data Ini?`)" href="'.route('upt-penerima-manfaat-selesai', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-info text-white"><i class = "fa fa-check"></i></a>
                            <a href="'.route('upt-penerima-perkembangan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-primary"><i class = "fa fa-history"></i></a>
                            <a href="'.route('upt-penerima-tambah-bantuan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-secondary"><i class = "fa fa-hand-holding-medical"></i></a>
                        </div>
                        </div>
                        <a   href = "'.route('edit-penerima-manfaat-detail', ['uuid' => $dataPenerima->uuid]).'" class = "mx-1 btn btn-primary">
                        <img src  = "'.asset('assets/images/edit.svg').'" alt                                          = "">
                        </a>
                        <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('upt-penerima-manfaat-delete', ['uuid' => $dataPenerima->uuid]).'" class                                           = "mx-1 btn btn-danger">
                        <img src  = "'.asset('assets/images/delete_outline.svg').'" alt = "">
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['tindakanstatus', 'action'])
            ->make(true);
    }

    public function dataSelesai() {
        $pendaftar = Fungsi::getHistoryPendaftarPenerimaManfaat(auth()->user()->upt_id);
        return Datatables:: of($pendaftar)
            ->addColumn('tindakanstatus', function ($data){
                if($data->tindakan == 3) {
                    return '<p class="badge badge-primary">Done</p>';
                } elseif(($data->tindakan == 0) || ($data->tindakan == 1) || ($data->tindakan == 2)) {
                    return '<p class="badge badge-info">On Process</p>';
                } else {
                    return '-';
                }
            })
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::hari_indo($data->tanggal_masuk);
            })
            ->editColumn('ttl', function ($data){
                return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk));
            })
            ->addColumn('action', function($dataPenerima){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a href="'.route('upt-penerima-manfaat-selesai-bantuan', ['uuid' => $dataPenerima->uuid]).'" class="btn btn-secondary"><i class = "fa fa-hand-holding-medical"></i></a>
                        <a   href = "'.route('edit-penerima-manfaat-detail', ['uuid' => $dataPenerima->uuid]).'" class = "mx-1 btn btn-primary"><i class = "fa fa-eye"></i>
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['tindakanstatus', 'action'])
            ->make(true);
    }

    public function daftarBantuan(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::get();
        $pendaftar    = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('upt.penerimaManfaat.selesaibantuan', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users', 'uuid'));
    }

    public function dataPenerimaDetailEdit(Request $request, $uuid) {
        $users = Fungsi::getPegawai(auth()->user()->upt_id);
        $provinsi     = KodeWilayah::select(['prov_id', 'prov'])->distinct()->get();
        $jenis_aduan  = JenisAduan::get();
        $jenis_kelamin  = JenisKelamin::get();
        $upt          = Upt::get();
        $permasalahan = Permasalahan::get();
        $pendaftar    = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.edit', compact('pendaftar', 'provinsi', 'upt', 'jenis_aduan', 'jenis_kelamin', 'permasalahan', 'users'));
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

                DB:: commit();
                return redirect()->route('upt-penerima-manfaat')->with(array(
                    'message'    => 'Sukses Edit Data',
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

    public function aksiSelesai(Request $request, $uuid) {
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pendaftar['tindakan'] = 3;
            $pendaftar->update();

            DB:: commit();
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Berhasil Menyelesaikan',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }

    public function hapus(Request $request, $uuid) {
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pendaftar['soft_delete'] = 1;
            $pendaftar->update();

            DB:: commit();
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Sukses Menghapus Data',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }

    public function tambahBantuan(Request $request, $uuid) {
        $pendaftar   = Pendaftaran::where('uuid', $uuid)->first();
        if(!$pendaftar) {
            return redirect()->route('upt-penerima-manfaat')->with(array(
                'message'    => 'Data Pendaftar Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.tambah_bantuan', compact('uuid'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $bantuan                = new PendaftaranBantuan;
                $bantuan->id            = Str::uuid();
                $bantuan->tanggal_beri  = $request->input('tanggal');
                $bantuan->bantuan       = $request->input('manfaat');
                $bantuan->upt_id        = auth()->user()->upt->uuid ?? '';
                $bantuan->soft_delete   = 0;
                $bantuan->pendaftar_id  = $uuid;

                // Upload photo
                if(file_exists($_FILES['foto_bukti']['tmp_name']) || is_uploaded_file($_FILES['foto_bukti']['tmp_name'])) {
                    // $data_in['foto_bukti'] = Str:: uuid().".".$request->file("foto_bukti")->extension();
                    // Storage::put('public/bukti/'.$data_in['foto_bukti'],$request->file("foto_bukti")->getContent());
                    // $bantuan->bukti = $data_in['foto_bukti'];

                    UploadImage::setPath('foto_bukti');
                    UploadImage::setImage($request->file("foto_bukti")->getContent());
                    UploadImage::setExt($request->file("foto_bukti")->extension());
                    $path_foto_bukti = UploadImage::uploadImage();
                    $bantuan->bukti = $path_foto_bukti;
                }

                $bantuan->save();

                DB:: commit();
                return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $uuid])->with(array(
                    'message'    => 'Sukses Menambah Bantuan',
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

    public function dataBantuan($uuid) {
        $bantuan = Fungsi::getPendaftarBantuan($uuid, auth()->user()->upt_id);
        return Datatables:: of($bantuan)
            ->addColumn('fotobukti', function ($data){
                $foto = '<a data-fancybox="images" href="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"><img class="img-fluid" src="'.Storage::disk('s3')->temporaryUrl($data->bukti, Carbon::now()->addMinutes(3600)).'"></a>';
                return $foto;
            })
            ->editColumn('tanggal_beri', function ($data){
                return Fungsi::hari_indo($data->tanggal_beri);
            })
            ->addColumn('action', function($dataPenerima){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a   href = "'.route('upt-penerima-edit-bantuan', ['uuid' => $dataPenerima->id]).'" class = "btn btn-primary">
                        <img src  = "'.asset('assets/images/edit.svg').'" alt                                          = "">
                        </a>
                        <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('upt-penerima-hapus-bantuan', ['uuid' => $dataPenerima->id]).'" class                                           = "btn btn-danger">
                        <img src  = "'.asset('assets/images/delete_outline.svg').'" alt = "">
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'fotobukti'])
            ->make(true);
    }

    public function editBantuan(Request $request, $id) {
        $bantuan   = PendaftaranBantuan::where('id', $id)->first();
        if(!$bantuan) {
            return redirect()->back()->with(array(
                'message'    => 'Data Bantuan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.edit_bantuan', compact('bantuan'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $bantuan                = PendaftaranBantuan::where('id', $id)->first();
                $bantuan->tanggal_beri  = $request->input('tanggal');
                $bantuan->bantuan       = $request->input('manfaat');
                $bantuan->upt_id        = auth()->user()->upt->uuid ?? '';
                $bantuan->soft_delete   = 0;
                $bantuan->pendaftar_id  = $bantuan->pendaftar_id;

                // Upload photo
                if(file_exists($_FILES['foto_bukti']['tmp_name']) || is_uploaded_file($_FILES['foto_bukti']['tmp_name'])) {
                    UploadImage::setPath('foto_bukti');
                    UploadImage::setImage($request->file("foto_bukti")->getContent());
                    UploadImage::setExt($request->file("foto_bukti")->extension());
                    $path_foto_bukti = UploadImage::uploadImage();
                    $bantuan->bukti = $path_foto_bukti;
                }

                $bantuan->save();

                DB:: commit();
                return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $bantuan->pendaftar_id])->with(array(
                    'message'    => 'Sukses Edit Bantuan',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ));
            }
        }
    }

    public function hapusBantuan(Request $request, $id) {
        $bantuan   = PendaftaranBantuan::where('id', $id)->first();
        if(!$bantuan) {
            return redirect()->back()->with(array(
                'message'    => 'Data Bantuan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $bantuan['soft_delete'] = 1;
            $bantuan->update();

            DB:: commit();
            return redirect()->route('upt-penerima-tambah-bantuan', ['uuid' => $bantuan->pendaftar_id])->with(array(
                'message'    => 'Sukses Menghapus Bantuan',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }

}
