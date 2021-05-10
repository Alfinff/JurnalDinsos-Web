<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Kegiatan;
use App\Models\KegiatanTipe;
use App\Models\Upt;

class KegiatanUPTController extends Controller
{

    public function index() {
        $upt = Upt::orderBy('nama', 'asc')->get();
        $kegiatan = Kegiatan::where('soft_delete', 0)->get();
        return view('dinsos.kegiatanUpt.index', compact('kegiatan', 'upt'));
    }

    public function filter(Request $request)
    {
        $idupt = $request->upt;
        $upt = Upt::where('uuid', $idupt)->first();
        $kegiatan = Kegiatan::where('upt_id', $idupt)->where('soft_delete', 0)->get();

        if(!$upt) {
            return redirect()->route('dinsos-kegiatan')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.kegiatanUpt.filterkegiatan', compact('kegiatan', 'upt'));
    }

    public function lihatKegiatan($id) {
        $kegiatanTipe   = KegiatanTipe::all();
        $kegiatan       = Kegiatan::with('tipe')->where('id', $id)->first();
        if(!$kegiatan) {
            return redirect()->route('dinsos-kegiatan')->with(array(
                'message'    => 'Data Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('dinsos.kegiatanUpt.lihat_kegiatan', compact('kegiatan', 'kegiatanTipe'));
    }

}
