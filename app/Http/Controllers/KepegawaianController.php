<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepegawaianController extends Controller
{
    public function struktur() {
        return view('upt.kepegawaian.struktur');
    }

    public function pimpinan() {
        return view('upt.kepegawaian.pimpinan');
    }
}
