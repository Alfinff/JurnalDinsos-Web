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

        $lakiperempuan = [];
        foreach(JenisKelamin::all() as $item) {
            $data = [];
            $data = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 AND upt_id = '$upt_id' AND k.uuid = '$item->uuid'");

            array_push($lakiperempuan, $data[0]);
        }

        $bulanygterisi = DB::select("SELECT MONTH(tanggal_masuk) as bulan FROM ms_pendaftaran WHERE soft_delete = 0 AND upt_id = '$upt_id' AND YEAR(tanggal_masuk) = '$tahunini' AND tindakan IN (0,1,2,3) GROUP BY MONTH(tanggal_masuk) ORDER BY MONTH(tanggal_masuk) ASC");

        $datanya = array();
        foreach($bulanygterisi as $id => $val) {
            $klienmas = null;
            $klienmas = Pendaftaran::whereRaw('tindakan != 3')->where('upt_id', auth()->user()->upt_id)->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get();
            $klienkel = null;
            $klienkel = Pendaftaran::where('tindakan', 3)->where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->whereYear('tanggal_masuk', $tahunini)->whereMonth('tanggal_masuk', $val->bulan)->get();

            $klienmasuk[$id]['bulan'] = $val->bulan;
            $klienmasuk[$id]['jumlah'] = $klienmas->count();

            $klienkeluar[$id]['bulan'] = $val->bulan;
            $klienkeluar[$id]['jumlah'] = $klienkel->count();

            $bulan[$val->bulan] = Fungsi::nama_bulan($val->bulan);
        }

        $pengeluaranupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE upt_id = '$upt_id' AND soft_delete = 0");
        $pengeluaranupt = Fungsi::rupiah($pengeluaranupt[0]->jumlah);

        $datajenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE upt_id = '$upt_id' AND soft_delete = 0 GROUP BY jenis_aduan");

        return view('upt.dashboard', compact('countklien', 'countupt', 'lakiperempuan', 'klienmasuk', 'klienkeluar', 'bulan', 'pengeluaranupt', 'datajenisaduan'));
    }
}
