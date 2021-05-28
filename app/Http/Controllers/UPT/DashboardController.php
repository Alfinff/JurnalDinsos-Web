<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\JenisKelamin;
use App\Helpers\Fungsi;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $upt_id = auth()->user()->upt_id;
        $tahunini = date('Y');
        $tahunkemarin = $tahunini-1;
        $countklien = Pendaftaran::where('upt_id', $upt_id)->where('soft_delete', 0)->count();
        $countupt = Upt::where('soft_delete', 0)->count();
        // $jmllaki = Pendaftaran::where('upt_id', $upt_id)->where('jenis_kelamin', 'L')->where('soft_delete', 0)->count();
        // $jmlperempuan = Pendaftaran::where('upt_id', $upt_id)->where('jenis_kelamin', 'P')->where('soft_delete', 0)->count();
        // $lakilaki = round(($jmllaki / $countklien) * 100, 2);
        // $perempuan = round(($jmlperempuan / $countklien) * 100, 2);
        // $lakilaki = $jmllaki;
        // $perempuan = $jmlperempuan;

        $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 AND upt_id = '$upt_id' GROUP BY p.jenis_kelamin");

        $klienmasuk_tahunini = DB::select("SELECT count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' AND upt_id = '$upt_id' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

        $bulan_tahunini = DB::select("SELECT MONTH(created_at) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' AND upt_id = '$upt_id' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");
        foreach($bulan_tahunini as $b => $val) {
            $bulan_tahunini[$b] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaranupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE upt_id = '$upt_id' AND soft_delete = 0");
        $pengeluaranupt = Fungsi::rupiah($pengeluaranupt[0]->jumlah);

        $datajenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE upt_id = '$upt_id' AND soft_delete = 0 GROUP BY jenis_aduan");
        // $datajenisaduan = array();
        // foreach($jenisaduan as $jj => $vv) {
        //     $datajenisaduan[$jj]['nama'] = $vv->nama;
        //     $datajenisaduan[$jj]['jumlah'] = (int)round(($vv->jumlah / $countklien) * 100, 2);
        // }

        return view('upt.dashboard', compact('countklien', 'countupt', 'lakiperempuan', 'klienmasuk_tahunini', 'bulan_tahunini', 'pengeluaranupt', 'datajenisaduan'));
    }
}
