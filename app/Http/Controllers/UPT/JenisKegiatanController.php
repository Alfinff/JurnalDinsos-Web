<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\KegiatanTipe;

class JenisKegiatanController extends Controller
{
    public function index(Request $request, $uuid=null) {
        $jeniskegiatan = KegiatanTipe::with(['editornya'])->where('upt_id', auth()->user()->upt_id)->get();
        return view('upt.setting.jeniskegiatan', compact('jeniskegiatan'));
    }

    public function tambah(Request $request)
    {
        DB:: beginTransaction();
        try {
            $jeniskegiatan = new KegiatanTipe;
            $jeniskegiatan['uuid']     = Str::uuid();
            $jeniskegiatan['nama']     = $request->nama;
            $jeniskegiatan['editor']   = auth()->user()->uuid;
            $jeniskegiatan['upt_id']   = auth()->user()->upt_id;
            $jeniskegiatan->save();

            DB:: commit();
            return redirect()->route('upt-setting-jeniskegiatan')->with(array(
                'message'    => 'Sukses Tambah Data Jenis Kegiatan',
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

    public function edit(Request $request, $uuid)
    {
        $jeniskegiatan = KegiatanTipe::where('uuid', $uuid)->first();
        if(!$jeniskegiatan) {
            return redirect()->route('upt-setting-jeniskegiatan')->with(array(
                'message'    => 'Data Jenis Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $jeniskegiatan->nama     = $request->nama;
            $jeniskegiatan->editor   = auth()->user()->uuid;
            $jeniskegiatan->upt_id   = auth()->user()->upt_id;
            $jeniskegiatan->save();

            DB:: commit();
            return redirect()->route('upt-setting-jeniskegiatan')->with(array(
                'message'    => 'Sukses Edit Jenis Kegiatan',
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

    public function hapus($uuid)
    {
        $jeniskegiatan = KegiatanTipe::where('uuid', $uuid)->first();
        if(!$jeniskegiatan) {
            return redirect()->route('upt-setting-jeniskegiatan')->with(array(
                'message'    => 'Data Jenis Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $jeniskegiatan->delete();

            DB:: commit();
            return redirect()->route('upt-setting-jeniskegiatan')->with(array(
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
