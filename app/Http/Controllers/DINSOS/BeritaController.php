<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Berita;
use App\Helpers\Fungsi;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class BeritaController extends Controller
{
    public function index() {
        return view('dinsos.berita.index');
    }

    public function dataBerita() {
        $berita = Fungsi::getBerita();
        return Datatables::of($berita)
            ->editColumn('title', function ($data){
                return ucwords($data->title);
            })
            ->editColumn('editor', function ($data){
                return ucwords($data->editorberita->username);
            })
            ->editColumn('created_at', function ($data){
                return Fungsi::hari_indo($data->created_at);
            })
            ->addColumn('action', function($data) {
                $actionBtn = '
                    <div class="d-flex w-100 justify-content-around">
                        <a href="'.route('detailberita', ['id' => $data->id]).'" target="new" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        <a href="'.route('dinsos-berita-edit', ['id' => $data->id]).'" class="btn btn-success"><i class="fa fa-edit"></i></a>
                        <a onclick="return confirm(`Hapus Berita Ini?`)" href="'.route('dinsos-berita-hapus', ['id' => $data->id]).'" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                    </div>';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);;
    }

    public function tambah(Request $request) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.berita.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $berita              = new Berita;
                $berita->id          = Str::uuid();
                $berita->title       = $request->input('title');
                $berita->content     = $request->input('content');
                $berita->editor      = auth()->user()->uuid;
                $berita->soft_delete = 0;

                // Upload photo
                if(file_exists($_FILES['images']['tmp_name']) || is_uploaded_file($_FILES['images']['tmp_name'])) {
                    UploadImage::setPath('berita');
                    UploadImage::setImage($request->file("images")->getContent());
                    UploadImage::setExt($request->file("images")->extension());
                    $path_berita = UploadImage::uploadImage();
                    $berita->images = $path_berita;
                }

                $berita->save();

                DB:: commit();
                return redirect()->route('dinsos-berita')->with(array(
                    'message'    => 'Sukses Tambah Berita',
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

    public function edit(Request $request, $id) {
        $berita   = Berita::where('id', $id)->first();
        if(!$berita) {
            return redirect()->route('dinsos-berita')->with(array(
                'message'    => 'Data Berita Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.berita.edit', compact('berita'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $berita              = Berita::find($id);
                $berita->title       = $request->input('title');
                $berita->content     = $request->input('content');
                $berita->editor      = auth()->user()->uuid;

                // Upload photo
                if(file_exists($_FILES['images']['tmp_name']) || is_uploaded_file($_FILES['images']['tmp_name'])) {
                    UploadImage::setPath('berita');
                    UploadImage::setImage($request->file("images")->getContent());
                    UploadImage::setExt($request->file("images")->extension());
                    $path_berita = UploadImage::uploadImage();
                    $berita->images = $path_berita;
                }

                $berita->save();

                DB:: commit();
                return redirect()->route('dinsos-berita')->with(array(
                    'message'    => 'Sukses Edit Berita',
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

    public function hapus($id) {
        $berita = Berita::where('id', $id)->first();
        if(!$berita) {
            return redirect()->route('dinsos-berita')->with(array(
                'message'    => 'Data Berita Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        $berita['soft_delete'] = 1;
        $berita->update();

        return redirect()->route('dinsos-berita')->with(array(
            'message'    => 'Data Berita Berhasil Dihapus',
            'alert-type' => 'success'
        ));
    }
}
