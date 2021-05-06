<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataKlienController extends Controller
{
    
    public function index() {
        return view('upt.dataklien.index');
    }

    public function tambah_klien(Request $request, $id = NULL) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.dataklien.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            dd($request);
        }
    }
}
