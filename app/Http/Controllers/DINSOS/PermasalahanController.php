<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Permasalahan;

class PermasalahanController extends Controller
{
    public function index(Request $request, $uuid=null) {
        $permasalahan = Permasalahan::with(['editornya'])->get();
        return view('dinsos.setting.permasalahan', compact('permasalahan'));
    }

    public function tambah(Request $request)
    {
        DB:: beginTransaction();
        try {
            $permasalahan = new Permasalahan;
            $permasalahan['uuid']     = Str::uuid();
            $permasalahan['nama']     = $request->nama;
            $permasalahan['editor']   = auth()->user()->uuid;
            $permasalahan->save();

            DB:: commit();
            return redirect()->route('dinsos-setting-permasalahan')->with(array(
                'message'    => 'Sukses Tambah Data Permasalahan',
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
        $permasalahan = Permasalahan::where('uuid', $uuid)->first();
        if(!$permasalahan) {
            return redirect()->route('dinsos-setting-permasalahan')->with(array(
                'message'    => 'Data Permasalahan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $permasalahan->delete();

            DB:: commit();
            return redirect()->route('dinsos-setting-permasalahan')->with(array(
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
