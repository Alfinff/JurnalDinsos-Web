<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VisiMisi;

class SettingController extends Controller
{

    public function visimisi(Request $request) {
        $visimisi = VisiMisi::first();
        return view('dinsos.setting.visimisi.index', compact('visimisi'));
    }

    public function editvisimisi(Request $request, $uuid) {
        $visimisi   = VisiMisi::where('uuid', $uuid)->first();
        if(!$visimisi) {
            return redirect()->route('dinsos-setting-visimisi')->with(array(
                'message'    => 'Data Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.setting.visimisi.edit', compact('visimisi'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $visimisi['deskripsi'] = $request->deskripsi;
                $visimisi->save();

                DB:: commit();
                return redirect()->route('dinsos-setting-visimisi')->with(array(
                    'message'    => 'Sukses Edit Visi Misi',
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
