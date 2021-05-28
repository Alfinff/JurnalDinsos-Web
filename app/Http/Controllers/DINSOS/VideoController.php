<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Video;

class VideoController extends Controller
{
    public function index(Request $request, $uuid=null) {
        $video = Video::with(['editornya'])->where('soft_delete', 0)->get();
        return view('dinsos.setting.video', compact('video'));
    }

    public function tambah(Request $request)
    {
        DB:: beginTransaction();
        try {
            $word = "https://www.youtube.com/embed/";
            if(strpos($request->link, $word) !== false) {
                $video = new Video;
                $video['uuid']     = Str::uuid();
                $video['link']     = $request->link;
                $video['editor']   = auth()->user()->uuid;
                $video->save();

                DB:: commit();
                return redirect()->route('dinsos-setting-video')->with(array(
                    'message'    => 'Sukses Tambah Data Video',
                    'alert-type' => 'success',
                ));
            } else {
                return redirect()->back()->with(array(
                    'message'    => 'Link Harus Embed',
                    'alert-type' => 'error'
                ))->withInput();
            }
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ))->withInput();
        }
    }

    public function hapus($uuid)
    {
        $video = Video::where('uuid', $uuid)->first();
        if(!$video) {
            return redirect()->route('dinsos-setting-video')->with(array(
                'message'    => 'Data Video Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $hapus = Video::where('uuid', $uuid)->update(['soft_delete' => 1]);

            DB:: commit();
            return redirect()->route('dinsos-setting-video')->with(array(
                'message'    => 'Sukses Menghapus Video',
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
