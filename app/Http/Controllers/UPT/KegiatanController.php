<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Notifications\PendaftarNotification;
use App\Helpers\Fungsi;
use App\Models\Kegiatan;
use App\Models\KegiatanTipe;
use App\Models\User;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class KegiatanController extends Controller
{

    public function index() {
        return view('upt.kegiatan.index');
    }

    public function dataKegiatan() {
        $kegiatan = Fungsi::getKegiatan(auth()->user()->upt_id);
        return Datatables::of($kegiatan)
            ->editColumn('title', function ($data){
                return ucwords($data->title);
            })
            ->editColumn('start_date', function ($data){
                return Fungsi:: hari_indo($data->start_date);
            })
            ->editColumn('end_date', function ($data){
                return Fungsi:: hari_indo($data->end_date);
            })
            ->editColumn('budget', function ($data){

                return Fungsi:: rupiah($data->budget);
            })
            ->addColumn('action', function($dataKegiatan) {
                $actionBtn = '
                    <a href  = "'.route('upt-lihat-kegiatan', ['id' => $dataKegiatan->id]).'" class = "btn btn-primary m-1">
                    <i class = "fa fa-eye" style                                                    = "color: #fff" title = "Lihat"></i>
                    </a>
                    <a href  = "'.route('upt-edit-kegiatan', ['id' => $dataKegiatan->id]).'" class = "btn btn-warning m-1">
                    <i class = "fa fa-edit" style                                                    = "color: #fff;" title    = "Edit"></i>
                    </a>
                    <a href  = "'.route('upt-delete-kegiatan', ['id' => $dataKegiatan->id]).'" class = "btn btn-danger m-1" onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)">
                    <i class = "fa fa-trash" style                                                   = "color: #fff;" title = "Delete"></i>
                    </a>';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);;
    }

    public function lihatKegiatan($id) {
        $kegiatan   = Kegiatan::with('tipe')->where('id', $id)->first();
        $kegiatanTipe   = KegiatanTipe::all();
        if(!$kegiatan) {
            return redirect()->route('upt-kegiatan')->with(array(
                'message'    => 'Data Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('upt.kegiatan.lihat_kegiatan', compact('kegiatan', 'kegiatanTipe'));
    }

    public function tambah_kegiatan(Request $request) {
        $kegiatanTipe   = KegiatanTipe::all();
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kegiatan.tambah', compact('kegiatanTipe'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $kegiatan              = new Kegiatan;
                $kegiatan->id          = Str::uuid();
                $kegiatan->title       = $request->input('title');
                $kegiatan->start_date  = $request->input('start_date');
                $kegiatan->end_date    = $request->input('end_date');
                $kegiatan->type        = $request->input('type');
                $kegiatan->number_of_p = $request->input('number_of_p');
                $kegiatan->upt_id      = auth()->user()->upt->uuid ?? '';
                $kegiatan->budget      = $request->input('budget');
                $kegiatan->soft_delete = 0;
                $kegiatan->description = $request->input('description');

                // Upload photo
                if(file_exists($_FILES['dokumentasi']['tmp_name']) || is_uploaded_file($_FILES['dokumentasi']['tmp_name'])) {
                    // $data_in['photo'] = Str:: uuid().".".$request->file("dokumentasi")->extension();
                    // Storage::put('public/kegiatan/'.$data_in['photo'],$request->file("dokumentasi")->getContent());
                    // $kegiatan->photo = $data_in['photo'];
                    UploadImage::setPath('kegiatan');
                    UploadImage::setImage($request->file("dokumentasi")->getContent());
                    UploadImage::setExt($request->file("dokumentasi")->extension());
                    $path_kegiatan = UploadImage::uploadImage();
                    $kegiatan->photo = $path_kegiatan;
                }

                $kegiatan->save();

                // buat notifikasi
                $to      = User::where('upt_id', auth()->user()->upt_id)->get();
                $judul   = 'Kegiatan Baru';
                $pesan   = 'Ada Kegiatan Baru yang ditambah oleh ' . ucwords(auth()->user()->username) . '. Silahkan di Cek!';
                $url    = '/upt/kegiatan';
                foreach($to as $t) {
                    $t->notify(new PendaftarNotification($judul, $pesan, $url));
                }

                DB:: commit();
                return redirect()->route('upt-kegiatan')->with(array(
                    'message'    => 'Sukses Tambah Kegiatan',
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

    public function edit_kegiatan(Request $request, $id) {
        $kegiatan   = Kegiatan::where('id', $id)->first();
        $kegiatanTipe   = KegiatanTipe::all();
        if(!$kegiatan) {
            return redirect()->route('upt-kegiatan')->with(array(
                'message'    => 'Data Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kegiatan.edit', compact('kegiatan', 'kegiatanTipe'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $kegiatan              = Kegiatan::find($id);
                $kegiatan->title       = $request->input('title');
                $kegiatan->start_date  = $request->input('start_date');
                $kegiatan->end_date    = $request->input('end_date');
                $kegiatan->type        = $request->input('type');
                $kegiatan->number_of_p = $request->input('number_of_p');
                $kegiatan->upt_id      = auth()->user()->upt->uuid ?? '';
                $kegiatan->budget      = $request->input('budget');
                $kegiatan->description = $request->input('description');

                // Upload photo
                if(file_exists($_FILES['dokumentasi']['tmp_name']) || is_uploaded_file($_FILES['dokumentasi']['tmp_name'])) {
                    UploadImage::setPath('dokumentasi');
                    UploadImage::setImage($request->file("dokumentasi")->getContent());
                    UploadImage::setExt($request->file("dokumentasi")->extension());
                    $path_kegiatan = UploadImage::uploadImage();
                    $kegiatan->photo = $path_kegiatan;
                }

                $kegiatan->save();

                DB:: commit();
                return redirect()->route('upt-kegiatan')->with(array(
                    'message'    => 'Sukses Edit Kegiatan',
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

    public function hapus_kegiatan($id) {
        $kegiatan = Kegiatan::where('id', $id)->first();
        if(!$kegiatan) {
            return redirect()->route('upt-kegiatan')->with(array(
                'message'    => 'Data Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        $kegiatan['soft_delete'] = 1;
        $kegiatan->update();

        return redirect()->route('upt-kegiatan')->with(array(
            'message'    => 'Data Kegiatan Dihapus',
            'alert-type' => 'success'
        ));
    }

}
