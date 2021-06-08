<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use App\Models\Pendaftaran;
use App\Models\Upt;
use App\Models\JenisAduan;
use App\Helpers\Fungsi;

class ChartUptController extends Controller
{
    function __construct(Request $request) {
        $this->tahunini = date('Y');
		$this->tahunkemarin = (int)$this->tahunini-1;
        try {
            $decode = JWT::decode($request->header('Authorization'), env('JWT_SECRET_KEY'), ['HS256']);
            $this->upt_id = $decode->pengguna->upt_id;
        } catch (\Throwable $th) {
            // $th->getMessage();
            return response()->json([
                'success' => false,
                'message' => 'Add Header Authorization',
            ], Response::HTTP_OK);
        }
    }

    public function jumlahklien() {
        try {
            $data['data'] = Pendaftaran::where('upt_id', $this->upt_id)->where('soft_delete', 0)->count();
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
        $upt_id = $this->upt_id;
        try {
            $lakiperempuan = array();
            $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.upt_id = '$upt_id' AND p.soft_delete = 0 GROUP BY p.jenis_kelamin");
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
        $upt_id = $this->upt_id;
        try {
            $pengeluaranupt = array();
            $pengeluaranupt = DB::select("SELECT SUM(budget) as jumlah FROM ms_kegiatan WHERE upt_id = '$upt_id' AND soft_delete = 0");
            $pengeluaranupt = Fungsi::rupiah($pengeluaranupt[0]->jumlah);
            $data['data'] = $pengeluaranupt;
            $data['msg'] = "Jumlah Pengeluran Upt";
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
        $upt_id = $this->upt_id;
        try {
            $countklien = Pendaftaran::where('upt_id', $upt_id)->where('soft_delete', 0)->count();
            $jenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE p.upt_id = '$upt_id' AND soft_delete = 0 GROUP BY jenis_aduan");
            $datajenisaduan = array();
            foreach($jenisaduan as $jj => $val) {
                $datajenisaduan[$jj]['nama'] = $val->nama ?? '';
                $datajenisaduan[$jj]['jumlah'] = $val->jumlah;
                $datajenisaduan[$jj]['persen'] = round(($val->jumlah / $countklien) * 100, 2);
            }
            $data['data'] = $datajenisaduan;
            $data['msg'] = "Data Jenis Aduan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage()
            $d['msg'] = "Terdapat Kesalahan";
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function chartklienmasuk() {
        $upt_id = $this->upt_id;
        try {
            $clienttahunini = array();
            // $clienttahunini = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE upt_id = '$upt_id' AND soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");
            $bulan = date('m');

            if($bulan < 7) {
                for($i=1; $i<=6; $i++)
                {
                    $datanya = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND upt_id = '$upt_id' AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan != 3 GROUP BY MONTH(created_at)");
                    $datanyakeluar = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND upt_id = '$upt_id' AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan = 3 GROUP BY MONTH(created_at)");
                    $datainput['bulan'] = $i;
                    $datainput['jumlah'] = $datanya[0]->jumlah ?? 0;
                    $datainput['jumlahkeluar'] = $datanyamasuk[0]->jumlah ?? 0;
                    array_push($clienttahunini, $datainput);
                }
            } else if($bulan > 6) {
                for($i=7; $i<=12; $i++)
                {
                    $datanya     = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND upt_id = '$upt_id' AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' GROUP BY MONTH(created_at)");
                    $datanyakeluar = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND upt_id = '$upt_id' AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan = 3 GROUP BY MONTH(created_at)");
                    $datainput['bulan'] = $i;
                    $datainput['jumlah'] = $datanya[0]->jumlah ?? 0;
                    $datainput['jumlahkeluar'] = $datanyakeluar[0]->jumlah ?? 0;
                    array_push($clienttahunini, $datainput);
                }
            }

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
