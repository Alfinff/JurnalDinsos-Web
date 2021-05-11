<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Models\Berita;
use Auth;
use DB;

class IndexController extends Controller
{
    public function index() {
    	return view('landing');
    }

    public function upt() {
        return view('uptLanding');
    }

    public function tentang() {
    	return view('tentang');
    }

    public function berita() {
        $beritaterbaru = Berita::where('soft_delete', 0)->orderBy('created_at', 'desc')->limit(3)->get();
        $semuaberita = Berita::where('soft_delete', 0)->get();
        return view('berita', compact('semuaberita', 'beritaterbaru'));
    }

    public function detailberita($id) {
        $berita = Berita::where('id', $id)->first();
        return view('detail_berita', compact('berita'));
    }

    public function detailupt() {
        return view('detailProfilUpt');
    }

    public function home() {
        return view('home');
    }
}
