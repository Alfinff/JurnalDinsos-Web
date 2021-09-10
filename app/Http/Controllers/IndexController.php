<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Role;
use App\Models\Berita;
use App\Models\Upt;
use App\Models\UnitKerja;
use App\Models\Pimpinan;
use App\Models\Pendaftaran;
use App\Models\VisiMisi;
use App\Models\Video;
use App\Models\Kegiatan;
use App\Models\KegiatanTipe;
use App\Helpers\Fungsi;
use Auth;
use DB;

class IndexController extends Controller
{
    public function index() {
        $beritaterbaru = Berita::with(['editorberita'])->where('soft_delete', 0)->orderBy('created_at', 'desc')->limit(3)->get();
        $video = Video::with('editornya')->where('soft_delete', 0)->limit(2)->get();
    	return view('landing', compact('beritaterbaru', 'video'));
    }

    public function upt(Request $request, $uuid=null) {
        if($uuid!=null) {
            $detail = Upt::with(['jenis','namawilayah'])->where('uuid', $uuid)->where('soft_delete', 0)->first();
            if(!$detail) {
                return redirect()->route('halaman-upt')->with(array(
                    'message'    => 'Data UPT Tidak Ditemukan',
                    'alert-type' => 'error',
                    'style'      => 'hide'
                ));
            }
            $rsData = UnitKerja::where('upt_id', $uuid)->where('soft_delete', 0)->OrderBy('kode_unit_kerja', 'asc')->get();
            $arrData = array();
            $child3 = array();
            $pimpinan = array();
            foreach ($rsData as $rs => $r) {
                if ($r->id_level_unit == 1) {
                    $arrData[$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                    $arrData[$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
                }
                if ($r->id_level_unit == 2) {
                    $arrData[$r->id_induk]['level2'][$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                    $arrData[$r->id_induk]['level2'][$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
                }
                if ($r->id_level_unit == 3) {
                    $child3[$r->id_induk][$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                    $child3[$r->id_induk][$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
                }
                $pimpinan[$r->id_unit_kerja] = Pimpinan::with(['users','profile'])->where('id_unit_kerja', $r->id_unit_kerja)->first();
            }
            $count = Pendaftaran::where('upt_id', $uuid)->where('soft_delete', 0)->get()->count();

            $kegiatanUpt = array();
            $kegiatanUpt = Fungsi::getKegiatan($uuid);

            return view('detailProfilUpt', compact('detail', 'arrData', 'child3', 'pimpinan','count','kegiatanUpt'));
        } else {
            $upt = Upt::with(['namawilayah'])->get();
            return view('uptLanding', compact('upt'));
        }
    }

    public function uptDetailKegiatan(Request $request, $uuid, $idkegiatan) {
        $semuakegiatan   = Kegiatan::with('tipe')->where('upt_id', $uuid)->where('soft_delete', 0)->orderBy('created_at', 'desc')->limit(5)->get();
        $detail   = Kegiatan::with('tipe')->where('id', $idkegiatan)->first();
        $kegiatanTipe   = KegiatanTipe::all();
        if(!$detail) {
            return redirect()->route('upt-kegiatan')->with(array(
                'message'    => 'Data Kegiatan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        return view('detailKegiatan', compact('semuakegiatan', 'detail', 'kegiatanTipe'));
    }

    public function tentang() {
        $visimisi = VisiMisi::first();
    	return view('tentang', compact('visimisi'));
    }

    public function lupapass() {
    	return view('lupaPass');
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

    public function home() {
        return view('home');
    }
}
