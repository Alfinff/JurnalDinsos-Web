<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UPTController extends Controller
{
    public function index(Request $request) {
        return view('upt.dashboard');
    }

    public function kegiatan() {
        $where = array(
            'idupt' => Session::get('id'),
        );
        $data = array(
            'kegiatan' => Kegiatan::where($where)->get()
        );
        return view('upt.kegiatan.index', $data);
    }

    public function lihatKegiatan($id) {
        $data = array(
            'kegiatan' => Kegiatan::find($id)
        );
        return view('upt.lihat_kegiatan', $data);
    }

}
