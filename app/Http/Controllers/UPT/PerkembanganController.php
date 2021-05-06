<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftaranPerkembangan;
use App\Helpers\Fungsi;

class PerkembanganController extends Controller
{
    public function index(Request $request, $uuid) {
        $arrData = array();
        $idjs    = 0;
        $tahun   = DB::select("SELECT DISTINCT(YEAR(created_at)) AS tahun FROM ms_pendaftaran_perkembangan WHERE pendaftar_id = '$uuid' AND soft_delete = 0 ORDER BY YEAR(created_at) DESC");
        foreach($tahun as $t) {
            $bulan = DB::select("SELECT DISTINCT(MONTH(created_at)) AS bulan FROM ms_pendaftaran_perkembangan WHERE pendaftar_id = '$uuid' AND YEAR(created_at) = '".$t->tahun."' AND soft_delete = 0 ORDER BY MONTH(created_at) DESC");
            foreach($bulan as $b) {
                $perkembangan = DB::select("SELECT * FROM ms_pendaftaran_perkembangan WHERE pendaftar_id = '$uuid' AND MONTH(created_at) = '".$b->bulan."' AND soft_delete = 0 ORDER BY created_at DESC");
                $nama_bulan = Fungsi::nama_bulan($b->bulan);
                $isiData = array();
                $i       = 0;
                foreach($perkembangan as $isi) {
                    $isiData[$i]['id']           = $isi->id;
                    $isiData[$i]['created_at']   = $isi->created_at;
                    $isiData[$i]['pendaftar_id'] = $isi->pendaftar_id;
                    $isiData[$i]['keterangan']   = $isi->keterangan;
                    $isiData[$i]['dokumentasi']  = $isi->dokumentasi;
                    $isiData[$i]['perkembangan'] = $isi->perkembangan;
                    $isiData[$i]['soft_delete']  = $isi->soft_delete;
                    $isiData[$i]['title']        = Fungsi::tanggal_indo($isi->created_at);
                    $isiData[$i]['idjs']         = $idjs++;
                    $i++;
                    $arrData[$t->tahun][$nama_bulan] = $isiData;
                }
            }
        }

        $bulan_sekarang = Fungsi::bulan_indo(date('d-m-Y'));

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.penerimaManfaat.perkembangan', compact('arrData', 'bulan_sekarang'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $dataBaru                  = new PendaftaranPerkembangan;
                $dataBaru['id']            = Str::uuid();
                $dataBaru['pendaftar_id']  = $uuid;
                $dataBaru['keterangan']    = $request->input('keterangan');
                $dataBaru['perkembangan']  = $request->input('perkembangan');
                $dataBaru['soft_delete']   = 0;
                if(file_exists($_FILES['dokumentasi']['tmp_name']) || is_uploaded_file($_FILES['dokumentasi']['tmp_name'])) {
                    $dataBaru['dokumentasi']   =  Str::uuid().".".$request->file("dokumentasi")->extension();
                    Storage::put('public/dokumentasi/'.$dataBaru['dokumentasi'], $request->file("dokumentasi")->getContent());
                }
                $dataBaru->save();

                DB:: commit();
                return redirect()->route('upt-penerima-perkembangan', ['uuid' => $uuid])->with(array(
                    'message'    => 'Sukses Tambah Perkembangan',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

}

