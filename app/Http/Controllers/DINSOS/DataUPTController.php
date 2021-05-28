<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Fungsi;
use App\Models\Role;
use App\Models\Upt;
use App\Helpers\UploadImage;

class DataUPTController extends Controller
{
    public function index() {
        $upt = Upt::with('pendaftaran', 'namawilayah')->where('soft_delete', 0)->get();
        return view('dinsos.dataUpt.index', compact('upt'));
    }

    public function filter(Request $request)
    {
        $idupt = $request->upt;
        $upt = Upt::with(['namawilayah'])->where('uuid', $idupt)->first();

        if(!$upt) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataUpt.filterupt', compact('upt'));
    }

    public function detail($uuid) {
        $data       = Upt::with('pendaftaran')->where('uuid', $uuid)->first();
        if(!$data) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data UPT Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataUpt.detail', compact('uuid'));
    }

    public function dataKlien($uuid) {
        $dataKlien = Fungsi::getPendaftarPenerimaManfaat($uuid);
        return    Datatables:: of($dataKlien)
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::tanggal_indo($data->tanggal_masuk ?? '-');
            })
            ->editColumn('nama_lengkap', function ($data){
                return ucwords($data->nama_lengkap ?? '-');
            })
            ->editColumn('ttl', function ($data){
                return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk));
            })
            ->editColumn('tindakan', function ($data){
                if($data->tindakan == 0) {
                    return '<p class="badge badge-danger">Tertunda</p>';
                } elseif($data->tindakan == 1) {
                    return '<p class="badge badge-info">Dihubungi</p>';
                } elseif($data->tindakan == 2) {
                    return '<p class="badge badge-primary">Ditangani</p>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['tindakan'])
            ->make(true);
    }

    public function tambah(Request $request) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.dataUpt.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $upt = new Upt;
                $upt['nama'] = $request->nama_upt;
                $upt['alamat']    = $request->alamat_lengkap;
                $upt['wilayah']   = $request->wilayah;
                $upt['soft_delete']    = 0;
                $upt['uuid']     = Str::uuid();
                if(file_exists($_FILES['logo_upt']['tmp_name']) || is_uploaded_file($_FILES['logo_upt']['tmp_name'])) {
                    UploadImage::setPath('upt');
                    UploadImage::setImage($request->file("logo_upt")->getContent());
                    UploadImage::setExt($request->file("logo_upt")->extension());
                    $path_foto = UploadImage::uploadImage();
                    $upt['foto'] = $path_foto;
                }
                $upt->save();

                DB:: commit();
                return redirect()->route('dinsos-dataupt')->with(array(
                    'message'    => 'Sukses Tambah Data Upt',
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

    public function edit(Request $request, $uuid) {
        $upt   = Upt::where('uuid', $uuid)->first();
        if(!$upt) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.dataUpt.edit', compact('upt'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $upt->nama = $request->nama_upt;
                $upt->alamat    = $request->alamat_lengkap;
                $upt->wilayah   = $request->wilayah;
                if(file_exists($_FILES['logo_upt']['tmp_name']) || is_uploaded_file($_FILES['logo_upt']['tmp_name'])) {
                    UploadImage::setPath('upt');
                    UploadImage::setImage($request->file("logo_upt")->getContent());
                    UploadImage::setExt($request->file("logo_upt")->extension());
                    $path_foto = UploadImage::uploadImage();
                    $upt->foto = $path_foto;
                }
                $upt->update();

                DB:: commit();
                return redirect()->route('dinsos-dataupt')->with(array(
                    'message'    => 'Sukses Edit Data Upt',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                // $th->getMessage()
                return redirect()->back()->with(array(
                    'message'    => $th->getMessage(),
                    'alert-type' => 'error'
                ));
            }
        }
    }

    public function hapus($uuid) {
        $upt   = Upt::where('uuid', $uuid)->first();
        if(!$upt) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $upt['soft_delete'] = 1;
            $upt->update();

            DB:: commit();
            return redirect()->route('dinsos-dataupt')->with(array(
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
}
