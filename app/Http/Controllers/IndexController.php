<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\Role;
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
        return view('berita');
    }

    public function home() {
        return view('home');
    }
}
