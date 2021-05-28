<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\JenisAduan;

class JenisAduanController extends Controller
{
    public function index(Request $request, $uuid=null) {
        $jenisaduan = JenisAduan::with(['editornya'])->get();
        return view('dinsos.setting.jenisaduan', compact('jenisaduan'));
    }

    public function tambah(Request $request)
    {
        DB:: beginTransaction();
        try {
            $jenisaduan = new JenisAduan;
            $jenisaduan['uuid']     = Str::uuid();
            $jenisaduan['nama']     = $request->nama;
            $jenisaduan['editor']   = auth()->user()->uuid;
            $jenisaduan->save();

            DB:: commit();
            return redirect()->route('dinsos-setting-jenisaduan')->with(array(
                'message'    => 'Sukses Tambah Data Jenis Aduan',
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
        $jenisaduan = JenisAduan::where('uuid', $uuid)->first();
        if(!$jenisaduan) {
            return redirect()->route('dinsos-setting-jenisaduan')->with(array(
                'message'    => 'Data Jenis Aduan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $jenisaduan->delete();

            DB:: commit();
            return redirect()->route('dinsos-setting-jenisaduan')->with(array(
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
