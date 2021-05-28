<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Helpers\Fungsi;

class ChartController extends Controller
{

    function __construct() {
        $this->tahunini = date('Y');
		$this->tahunkemarin = (int)$this->tahunini-1;
        $this->countklien = Pendaftaran::where('soft_delete', 0)->count();
    }

    public function jumlahklien() {
        try {
            $data['data'] = Pendaftaran::where('soft_delete', 0)->count();
            $data['msg'] = "Jumlah Klien";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function jumlahupt() {
        try {
            $data['data'] = Upt::where('soft_delete', 0)->count();
            $data['msg'] = "Jumlah Upt";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function chartjeniskelamin() {
        try {
            $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 GROUP BY p.jenis_kelamin");
            $data['data'] = $lakiperempuan;
            $data['msg'] = "Jumlah Laki & Perempuan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function pengeluaranupt() {
        try {
            $pengeluaransemuaupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE soft_delete = 0");
            $pengeluaransemuaupt = Fungsi::rupiah($pengeluaransemuaupt[0]->jumlah);
            $data['data'] = $pengeluaransemuaupt;
            $data['msg'] = "Jumlah Pengeluran Semua Upt";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function jumlahjenisaduan() {
        try {
            $jenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE soft_delete = 0 GROUP BY jenis_aduan");
            foreach($jenisaduan as $jj => $val) {
                $datajenisaduan[$jj]['nama'] = $val->nama;
                $datajenisaduan[$jj]['jumlah'] = $val->jumlah;
                // $datajenisaduan[$jj]['persen'] = round(($val->jumlah / $this->countklien) * 100, 2);
            }
            $data['data'] = $datajenisaduan;
            $data['msg'] = "Data Jenis Aduan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function chartklienmasuk() {
        try {
            $clienttahunini = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

            $data['data'] = $clienttahunini;
            $data['msg'] = "Data Klien Masuk";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }
}
