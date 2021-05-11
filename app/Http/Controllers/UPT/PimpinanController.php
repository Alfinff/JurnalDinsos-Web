<?php

namespace App\Http\Controllers\UPT;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Helpers\Fungsi;
use App\Models\UnitKerja;
use App\Models\Pimpinan;

class PimpinanController extends Controller
{
    public function index() {
        $pegawai = Fungsi::getPegawai(auth()->user()->upt_id);
        $rsData = UnitKerja::where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->OrderBy('kode_unit_kerja', 'asc')->get();
        $arrData = array();
        $child3 = array();
        foreach ($rsData as $rs => $r) {
            if ($r->id_level_unit == 1) {
                $arrData[$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                $arrData[$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
            }
            if ($r->id_level_unit == 2) {
                $arrData[$r->id_induk]['level2'][$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                $arrData[$r->id_induk]['level2'][$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
            }
            if ($r->id_level_unit == 3) {
                $child3[$r->id_induk][$r->id_unit_kerja]['nama_unit_kerja'] = $r->nama_unit_kerja;
                $child3[$r->id_induk][$r->id_unit_kerja]['kode_unit_kerja'] = $r->kode_unit_kerja;
            }
            $pimpinan[$r->id_unit_kerja] = Pimpinan::with(['users'])->where('id_unit_kerja', $r->id_unit_kerja)->first();
        }

        return view('upt.kepegawaian.pimpinan.index', compact('arrData', 'child3', 'pegawai', 'pimpinan'));
    }

    public function setPimpinan(Request $request)
    {
        $id_unit = $request->input('id_unit');
        $unitkerja = UnitKerja::where('id_unit_kerja', $id_unit)->first();
        $pegawai = Fungsi::getPegawai(auth()->user()->upt_id);

        return view('upt.kepegawaian.pimpinan.setpimpinan', compact('unitkerja', 'pegawai', 'id_unit'));
    }

    public function updatePimpinan(Request $request)
    {
        $id_unit_kerja = $request->input('id_unit_kerja');
        $users_id = $request->input('users_id');
        $kode_unit_kerja = $request->input('kode_unit_kerja');
        if ($users_id) {
            $cek = Pimpinan::where('id_unit_kerja', $id_unit_kerja)->first();
            if ($cek) {
                $update = Pimpinan::where('id_unit_kerja', $id_unit_kerja)->update(['users_id' => $users_id]);
            } else {
                $simpan = new Pimpinan;
                $simpan->id_unit_kerja = $id_unit_kerja;
                $simpan->users_id = $users_id;
                $simpan->editor = auth()->user()->uuid;
                $simpan->upt_id = auth()->user()->upt_id;
                $simpan->save();
            }
            echo '<script type="text/javascript">toastr.success("Data Berhasil disimpan.")</script>';
            echo "<script>
                setTimeout(function () {
                   location.reload();
                }, 1000);
                </script>";
        } else {
            echo '<script type="text/javascript">toastr.error("Tidak ada data yang disimpan.")</script>';
        }
    }

    public function hapusPimpinan($id_unit_kerja)
    {
        $pimpinan = Pimpinan::where('id_unit_kerja', $id_unit_kerja)->first();
        if(!$pimpinan) {
            return redirect()->route('upt-pimpinan')->with(array(
                'message'    => 'Data Pimpinan Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pimpinan->delete();

            DB:: commit();
            return redirect()->route('upt-pimpinan')->with(array(
                'message'    => 'Data Pimpinan Berhasil Dihapus',
                'alert-type' => 'success'
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
