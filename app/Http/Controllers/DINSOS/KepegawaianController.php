<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Upt;
use App\Models\Pendaftaran;
use App\Models\User;

class KepegawaianController extends Controller
{

    public function index(Request $request) {
        $upt = Upt::orderBy('nama', 'asc')->get();
        $pegawai = User::with(['upt','profile', 'title'])->where('soft_delete', 0)->get();
        return view('dinsos.kepegawaian.index', compact('pegawai', 'upt'));
    }

    public function filter(Request $request)
    {
        $idupt = $request->upt;
        $upt = Upt::where('uuid', $idupt)->first();
        $pegawai = User::with(['upt','profile'])->where('upt_id', $idupt)->where('soft_delete', 0)->get();

        if(!$upt) {
            return redirect()->route('dinsos-pegawai')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.kepegawaian.filterpegawai', compact('pegawai', 'upt'));
    }

    public function struktur() {
        return view('dinsos.kepegawaian.semuapegawai');
    }

    public function pegawaiAktif() {
        return view('dinsos.kepegawaian.pegawaiAktif');
    }

    public function pendaftar() {
        return view('dinsos.dataUpt.pendaftar');
    }
}
