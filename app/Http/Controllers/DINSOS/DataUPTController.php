<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Fungsi;
use App\Models\Role;
use App\Models\Upt;

class DataUPTController extends Controller
{
    public function index() {
        $upt = Upt::with('pendaftaran')->where('soft_delete', 0)->get();
        return view('dinsos.dataUpt.index', compact('upt'));
    }

    public function filter(Request $request)
    {
        $idupt = $request->upt;
        $upt = Upt::where('uuid', $idupt)->first();

        if(!$upt) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataUpt.filterupt', compact('upt'));
    }

    public function detail($uuid) {
        $data       = Upt::with('pendaftaran')->where('uuid', $uuid)->first();
        if(!$data) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data UPT Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        return view('dinsos.dataUpt.detail', compact('uuid'));
    }

    public function dataKlien($uuid) {
        $dataKlien = Fungsi::getPendaftarPenerimaManfaat($uuid);
        return    Datatables:: of($dataKlien)
            ->editColumn('tanggal_masuk', function ($data){
                return Fungsi::tanggal_indo($data->tanggal_masuk ?? '-');
            })
            ->editColumn('nama_lengkap', function ($data){
                return ucwords($data->nama_lengkap ?? '-');
            })
            ->editColumn('ttl', function ($data){
                return ucwords($data->tempat_lahir) .', '.date('d/m/Y', strtotime($data->tanggal_masuk));
            })
            ->editColumn('tindakan', function ($data){
                if($data->tindakan == 0) {
                    return '<p class="badge badge-danger">Tertunda</p>';
                } elseif($data->tindakan == 1) {
                    return '<p class="badge badge-info">Dihubungi</p>';
                } elseif($data->tindakan == 2) {
                    return '<p class="badge badge-primary">Ditangani</p>';
                } else {
                    return '-';
                }
            })
            ->rawColumns(['tindakan'])
            ->make(true);
    }
}
