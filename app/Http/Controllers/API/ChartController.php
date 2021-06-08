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
        $this->countupt = Upt::count();
    }

    public function jenisaduan(Request $request, $upt_id=null)
    {
        try {
            if($upt_id!=null) {
                // $datajenisaduan = DB::select("SELECT j.nama, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan WHERE p.upt_id = '$upt_id' AND soft_delete = 0 GROUP BY j.jenis_aduan");
                $jenisaduan = jenisAduan::all();
                foreach($jenisaduan as $pp => $val) {
                    $data['data'][$pp]['nama'] = $val->nama ?? '';
                    $data['data'][$pp]['jumlah']['lakilaki'] = Pendaftaran::where('upt_id', $upt_id)->whereHas('jeniskelamin', function($query){
                        $query->where('nama', 'like', '%'.'laki'.'%');
                        $query->orWhere('nama', 'like', '%'.'pria'.'%');
                    })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['jumlah']['perempuan'] = Pendaftaran::where('upt_id', $upt_id)->whereHas('jeniskelamin', function($query){
                        $query->where('nama', 'like', '%'.'perempuan'.'%');
                        $query->orWhere('nama', 'like', '%'.'wanita'.'%');
                    })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['jumlah']['semua'] = Pendaftaran::where('upt_id', $upt_id)->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['persen']['lakilaki'] = round(($data['data'][$pp]['jumlah']['lakilaki'] / $this->countklien) * 100, 2);
                    $data['data'][$pp]['persen']['perempuan'] = round(($data['data'][$pp]['jumlah']['perempuan'] / $this->countklien) * 100, 2);
                    $data['data'][$pp]['persen']['semua'] = round(($data['data'][$pp]['jumlah']['semua'] / $this->countklien) * 100, 2);
                    // if((!$data['data']) || ($data['data']->count())) {
                    //     $data['data'] = [];
                    // }
                    $data['totalpenerima'] = Pendaftaran::where('upt_id', $upt_id)->where('soft_delete', 0)->count();
                }
            } else {
                $jenisaduan = jenisAduan::all();
                foreach($jenisaduan as $pp => $val) {
                    $data['data'][$pp]['nama'] = $val->nama ?? '';
                    $data['data'][$pp]['jumlah']['lakilaki'] = Pendaftaran::whereHas('jeniskelamin', function($query){
                        $query->where('nama', 'like', '%'.'laki'.'%');
                        $query->orWhere('nama', 'like', '%'.'pria'.'%');
                    })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['jumlah']['perempuan'] = Pendaftaran::whereHas('jeniskelamin', function($query){
                        $query->where('nama', 'like', '%'.'perempuan'.'%');
                        $query->orWhere('nama', 'like', '%'.'wanita'.'%');
                    })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['jumlah']['semua'] = Pendaftaran::where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                    $data['data'][$pp]['persen']['lakilaki'] = round(($data['data'][$pp]['jumlah']['lakilaki'] / $this->countklien) * 100, 2);
                    $data['data'][$pp]['persen']['perempuan'] = round(($data['data'][$pp]['jumlah']['perempuan'] / $this->countklien) * 100, 2);
                    $data['data'][$pp]['persen']['semua'] = round(($data['data'][$pp]['jumlah']['semua'] / $this->countklien) * 100, 2);
                }
                $data['totalpenerima'] = Pendaftaran::where('soft_delete', 0)->count();
            }

            $data['totalupt'] = $this->countupt;
            $data['msg'] = "Data Jenis Aduan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage()
            $d['msg'] = 'Terdapat Kesalahan';
            $d['success'] = false;
            return response()->json($d);
        }
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

    public function chartjeniskelamin($upt_id=null) {
        try {
            $lakiperempuan = '';
            if($upt_id!=null) {
                $upt = Upt::where('uuid', $upt_id)->first();
                if(((!$upt) || (!$upt->count()))) {
                    $d['msg'] = "Data Upt Tidak Ada / Kosong";
                    $d['success'] = false;
                    return response()->json($d);
                }
                $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 AND upt_id = '$upt_id' GROUP BY p.jenis_kelamin");
            } else {
                $lakiperempuan = DB::select("SELECT k.nama, COUNT(p.jenis_kelamin) as jumlah FROM ms_pendaftaran p JOIN ms_jenis_kelamin k ON k.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 GROUP BY p.jenis_kelamin");
            }
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
            $jenisaduan = array();
            // $jenisaduan = DB::select("SELECT j.nama, kk.nama as jeniskelamin, COUNT(*) AS jumlah FROM ms_pendaftaran p JOIN ms_jenis_aduan j ON j.uuid = p.jenis_aduan JOIN ms_jenis_kelamin kk ON kk.uuid = p.jenis_kelamin WHERE p.soft_delete = 0 GROUP BY jenis_aduan, kk.nama");
            // $datajenisaduan = array();
            // foreach($jenisaduan as $jj => $val) {
        //         $datajenisaduan[$jj]['nama'] = $val->nama;
        //         $datajenisaduan[$jj]['jeniskelamin'] = $val->jeniskelamin;
        //         $datajenisaduan[$jj]['jumlah'] = $val->jumlah;
            // }
            $jenisaduan = jenisAduan::all();
            foreach($jenisaduan as $pp => $val) {
                $data['data'][$pp]['nama'] = $val->nama ?? '';
                $data['data'][$pp]['jumlah']['lakilaki'] = Pendaftaran::whereHas('jeniskelamin', function($query){
                    $query->where('nama', 'like', '%'.'laki'.'%');
                    $query->orWhere('nama', 'like', '%'.'pria'.'%');
                })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                $data['data'][$pp]['jumlah']['perempuan'] = Pendaftaran::whereHas('jeniskelamin', function($query){
                    $query->where('nama', 'like', '%'.'perempuan'.'%');
                    $query->orWhere('nama', 'like', '%'.'wanita'.'%');
                })->where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
                $data['data'][$pp]['jumlah']['semua'] = Pendaftaran::where('jenis_aduan', $val->uuid)->where('soft_delete', 0)->count();
            }
            $data['msg'] = "Data Jenis Aduan";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage();
            // $d['msg'] = "Terdapat Kesalahan";
            $d['msg'] = $th->getMessage();
            $d['success'] = false;
            return response()->json($d);
        }
    }

    public function chartklienmasuk() {
        try {
            $clienttahunini = array();
            $bulan = date('m');

            if($bulan < 7) {
                for($i=1; $i<=6; $i++)
                {
                    $datainput = array();
                    $datanya = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan != 3 GROUP BY MONTH(created_at)");
                    $datanyakeluar = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan = 3 GROUP BY MONTH(created_at)");
                    $datainput['bulan'] = $i;
                    $datainput['jumlah'] = $datanya[0]->jumlah ?? 0;
                    $datainput['jumlahkeluar'] = $datanyakeluar[0]->jumlah ?? 0;
                    array_push($clienttahunini, $datainput);
                }
            } else if($bulan > 6) {
                for($i=7; $i<=12; $i++)
                {
                    $datainput = array();
                    $datanya = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM
                    ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan !=3 GROUP BY MONTH(created_at)");
                    $datanyakeluar = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' AND MONTH(created_at) = '$i' AND tindakan = 3 GROUP BY MONTH(created_at)");
                    $datainput['bulan'] = $i;
                    $datainput['jumlah'] = $datanya[0]->jumlah ?? 0;
                    $datainput['jumlahkeluar'] = $datanyakeluar[0]->jumlah ?? 0;
                    array_push($clienttahunini, $datainput);
                }
            }

            // $clienttahunini = DB::select("SELECT MONTH(created_at) as bulan, count(*) as jumlah FROM ms_pendaftaran WHERE soft_delete = 0 AND YEAR(created_at) = '$this->tahunini' GROUP BY MONTH(created_at) ORDER BY MONTH(created_at) ASC");

            $data['data'] = $clienttahunini;
            $data['msg'] = "Data Klien Masuk";
            $data['success'] = true;
            return response()->json($data);
        } catch (\Throwable $th) {
            // $th->getMessage()
            $d['msg'] = $th->getMessage();
            $d['success'] = false;
            return response()->json($d);
        }
    }
}
