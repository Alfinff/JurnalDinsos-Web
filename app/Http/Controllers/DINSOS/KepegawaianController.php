<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Upt;
use App\Models\Pendaftaran;

class KepegawaianController extends Controller
{

    public function index(Request $request) {
        return view('dinsos.pegawai.pegawai');
    }

    public function pegawaiupt() {
        return view('dinsos.pegawaiupt.index');
    }

    public function pegawaiAktif() {
        return view('dinsos.pegawai.pegawaiAktif');
    }

    public function pendaftar() {
        return view('dinsos.DataUpt.pendaftar');
    }
    public function semua() {
        return view('dinsos.pegawai.semuapegawai');
    }
}
