<?php

namespace App\Http\Controllers\UPT\PEGAWAI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Helpers\Fungsi;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $upt_id = auth()->user()->upt_id;
        $tahunini = date('Y');
        $tahunkemarin = $tahunini-1;
        $countklien = Pendaftaran::where('upt_id', $upt_id)->count();
        $countupt = Upt::count();
        $jmllaki = Pendaftaran::where('upt_id', $upt_id)->where('jenis_kelamin', 'L')->count();
        $jmlperempuan = Pendaftaran::where('upt_id', $upt_id)->where('jenis_kelamin', 'P')->count();
        $lakilaki = round(($jmllaki / $countklien) * 100, 2);
        $perempuan = round(($jmlperempuan / $countklien) * 100, 2);

        $klienmasuk_tahunini = DB::select("SELECT count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' AND upt_id = '$upt_id' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

        $bulan_tahunini = DB::select("SELECT MONTH(created_at) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$tahunini' AND upt_id = '$upt_id' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");
        foreach($bulan_tahunini as $b => $val) {
            $bulan_tahunini[$b] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaranupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE upt_id = '$upt_id'");
        $pengeluaranupt = Fungsi::rupiah($pengeluaranupt[0]->jumlah);

        return view('upt.pegawai.dashboard', compact('countklien', 'countupt', 'lakilaki', 'perempuan', 'klienmasuk_tahunini', 'bulan_tahunini', 'pengeluaranupt'));
    }
}
