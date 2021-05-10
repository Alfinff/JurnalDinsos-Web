<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Helpers\Fungsi;

class DashboardController extends Controller
{
    public function index() {
        $tahunini = date('Y');
        $tahunkemarin = $tahunini-1;
        $countklien = Pendaftaran::where('soft_delete', 0)->count();
        $countupt = Upt::where('soft_delete', 0)->count();
        $jmllaki = Pendaftaran::where('jenis_kelamin', 'L')->where('soft_delete', 0)->count();
        $jmlperempuan = Pendaftaran::where('jenis_kelamin', 'P')->where('soft_delete', 0)->count();
        // $lakilaki = round(($jmllaki / $countklien) * 100, 2);
        // $perempuan = round(($jmlperempuan / $countklien) * 100, 2);
        $lakilaki = $jmllaki;
        $perempuan = $jmlperempuan;

        $klienmasuk_tahunini = DB::select("SELECT count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

        $bulan_tahunini = DB::select("SELECT MONTH(created_at) as bulan FROM ms_pendaftaran_perkembangan WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");
        foreach($bulan_tahunini as $b => $val) {
            $bulan_tahunini[$b] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaransemuaupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE soft_delete = 0");
        $pengeluaransemuaupt = Fungsi::rupiah($pengeluaransemuaupt[0]->jumlah);

        $jenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE soft_delete = 0 GROUP BY jenis_aduan");
        $jumlahdatajenisaduan = array();
        foreach($jenisaduan as $jj => $vv) {
            $datajenisaduan[$jj]['nama'] = $vv->nama;
            $datajenisaduan[$jj]['jumlah'] = (int)round(($vv->jumlah / $countklien) * 100, 2);
        }

        return view('dinsos.dashboard', compact('countklien', 'countupt', 'lakilaki', 'perempuan', 'klienmasuk_tahunini', 'bulan_tahunini', 'pengeluaransemuaupt', 'datajenisaduan'));
    }
}
