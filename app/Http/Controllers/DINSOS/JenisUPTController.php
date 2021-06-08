<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\Helpers\Fungsi;
use App\Models\JenisUpt;

class JenisUPTController extends Controller
{
    public function index() {
        $jenisupt = JenisUpt::with('editornya')->where('soft_delete', 0)->get();
        return view('dinsos.jenisUpt.index', compact('jenisupt'));
    }

    public function tambah(Request $request) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.jenisUpt.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $jenisupt = new JenisUpt;
                $jenisupt->uuid        = Str::uuid();
                $jenisupt->nama        = $request->nama;
                $jenisupt->keterangan  = $request->keterangan;
                $jenisupt->editor      = auth()->user()->uuid;
                $jenisupt->soft_delete = 0;
                $jenisupt->save();

                DB:: commit();
                return redirect()->route('dinsos-jenisupt')->with(array(
                    'message'    => 'Sukses Tambah Data Jenis Upt',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                // $th->getMessage()
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => $th->getMessage(),
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function edit(Request $request, $uuid) {
        $jenisupt   = JenisUpt::where('uuid', $uuid)->first();
        if(!$jenisupt) {
            return redirect()->route('dinsos-jenisupt')->with(array(
                'message'    => 'Data Jenis Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.jenisUpt.edit', compact('jenisupt'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
                $jenisupt->nama        = $request->nama;
                $jenisupt->keterangan  = $request->keterangan;
                $jenisupt->update();

                DB:: commit();
                return redirect()->route('dinsos-jenisupt')->with(array(
                    'message'    => 'Sukses Edit Data Jenis Upt',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                // $th->getMessage()
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => "Terdapat Kesalahan",
                    'alert-type' => 'error'
                ));
            }
        }
    }

    public function hapus($uuid) {
        $upt   = JenisUpt::where('uuid', $uuid)->first();
        if(!$upt) {
            return redirect()->route('dinsos-dataupt')->with(array(
                'message'    => 'Data Jenis Upt Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $upt['soft_delete'] = 1;
            $upt->update();

            DB:: commit();
            return redirect()->route('dinsos-jenisupt')->with(array(
                'message'    => 'Sukses Menghapus Data',
                'alert-type' => 'success',
            ));
        } catch (\Throwable $th) {
            DB:: rollback();
            return redirect()->back()->with(array(
                'message'    => 'Terdapat Kesalahan',
                'alert-type' => 'error'
            ));
        }
    }
}
