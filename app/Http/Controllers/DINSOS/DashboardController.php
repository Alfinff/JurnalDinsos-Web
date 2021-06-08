<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Helpers\Fungsi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $tahunini = date('Y');
        $tahunkemarin = $tahunini-1;
        $countklien = Pendaftaran::where('soft_delete', 0)->count();
        $countupt = Upt::where('soft_delete', 0)->count();
        $upt = Upt::where('soft_delete', 0)->get();

        $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 GROUP BY p.jenis_kelamin");

        $bulanygterisi = DB::select("SELECT MONTH(tanggal_masuk) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan IN (0,1,2,3) GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        $datanya = array();
        foreach($bulanygterisi as $id => $val) {
            $klienmas = null;
            $klienmas = Pendaftaran::whereRaw('tindakan != 3')->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get();
            $klienkel = null;
            $klienkel = Pendaftaran::where('tindakan', 3)->where('soft_delete', 0)->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get();

            $klienmasuk[$id]['bulan'] = $val->bulan;
            $klienmasuk[$id]['jumlah'] = $klienmas->count();

            $klienkeluar[$id]['bulan'] = $val->bulan;
            $klienkeluar[$id]['jumlah'] = $klienkel->count();

            $bulan[$val->bulan] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaransemuaupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE soft_delete = 0");
        $pengeluaransemuaupt = Fungsi::rupiah($pengeluaransemuaupt[0]->jumlah);

        $datajenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE soft_delete = 0 GROUP BY jenis_aduan");

        $datajenisaduantable = DB::select("SELECT j.nama AS nama, kel.nama AS jeniskelamin, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan JOIN ms_jenis_kelamin kel ON p.jenis_kelamin = kel.uuid WHERE p.soft_delete = 0 AND kel.soft_delete = 0 GROUP BY p.jenis_aduan, kel.nama");

        return view('dinsos.dashboard', compact('countklien', 'countupt', 'lakiperempuan', 'pengeluaransemuaupt', 'datajenisaduan', 'upt', 'datajenisaduantable', 'klienkeluar', 'klienmasuk', 'bulan'));
    }

    public function filter(Request $request) {
        $upt = Upt::where('soft_delete', 0)->get();
        $dataupt = Upt::where('uuid', $request->upt)->where('soft_delete', 0)->first();
        if(!$dataupt) {
            return redirect()->route('dinsos-home')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        $datajenisaduantable = DB::select("SELECT j.nama AS nama, kel.nama AS jeniskelamin, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan JOIN ms_jenis_kelamin kel ON p.jenis_kelamin = kel.uuid WHERE p.soft_delete = 0 AND kel.soft_delete = 0 GROUP BY p.jenis_aduan, kel.nama");

        return view('dinsos.filter', compact('upt', 'datajenisaduantable', 'dataupt'));
    }

    public function tes(Request $request)
    {
        $tahunini = date('Y');
        $tahunkemarin = $tahunini-1;
        $countklien = Pendaftaran::where('soft_delete', 0)->count();
        $countupt = Upt::where('soft_delete', 0)->count();
        $upt = Upt::where('soft_delete', 0)->get();
        // $jmllaki = Pendaftaran::where('jenis_kelamin', 'L')->where('soft_delete', 0)->count();
        // $jmlperempuan = Pendaftaran::where('jenis_kelamin', 'P')->where('soft_delete', 0)->count();
        // $lakilaki = round(($jmllaki / $countklien) * 100, 2);
        // $perempuan = round(($jmlperempuan / $countklien) * 100, 2);
        // $lakilaki = $jmllaki;
        // $perempuan = $jmlperempuan;
        $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 GROUP BY p.jenis_kelamin");

        $bulanygterisi = DB::select("SELECT MONTH(tanggal_masuk) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan IN (0,1,2,3) GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        $datanya = array();
        foreach($bulanygterisi as $id => $val) {
            $klienmasuk[$id]['bulan'] = $val->bulan;
            $klienmasuk[$id]['jumlah'] = (int)Pendaftaran::whereRaw('tindakan != 3')->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get()->count();

            $klienkeluar[$id]['bulan'] = $val->bulan;
            $klienkeluar[$id]['jumlah'] = (int)Pendaftaran::where('tindakan', 3)->where('soft_delete', 0)->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get()->count();

            $bulan[$id] = Fungsi::nama_bulan($val->bulan);
        }

        $klienmasuk_tahunini = DB::select("SELECT count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan != 3 GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        $klienkeluar_tahunini = DB::select("SELECT count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan = 3 GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        $bulan_tahunini = DB::select("SELECT MONTH(tanggal_masuk) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan IN (0,1,2,3) GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        foreach($bulan_tahunini as $b => $val) {
            $bulan_tahunini[$b] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaransemuaupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE soft_delete = 0");
        $pengeluaransemuaupt = Fungsi::rupiah($pengeluaransemuaupt[0]->jumlah);

        $datajenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE soft_delete = 0 GROUP BY jenis_aduan");
        // $datajenisaduan = array();
        // foreach($jenisaduan as $jj => $vv) {
        //     $datajenisaduan[$jj]['nama'] = $vv->nama;
        //     $datajenisaduan[$jj]['jumlah'] = (int)round(($vv->jumlah / $countklien) * 100, 2);
        // }

        $datajenisaduantable = DB::select("SELECT j.nama AS nama, kel.nama AS jeniskelamin, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan JOIN ms_jenis_kelamin kel ON p.jenis_kelamin = kel.uuid WHERE p.soft_delete = 0 AND kel.soft_delete = 0 GROUP BY p.jenis_aduan, kel.nama");

        return view('dinsos.dashboard', compact('countklien', 'countupt', 'lakiperempuan', 'pengeluaransemuaupt', 'datajenisaduan', 'upt', 'datajenisaduantable', 'klienkeluar', 'klienmasuk', 'bulan'));
    }
}
