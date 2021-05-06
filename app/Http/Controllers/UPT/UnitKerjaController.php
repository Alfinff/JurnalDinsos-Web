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

class UnitKerjaController extends Controller
{

    public function index() {
        $rsData = UnitKerja::where('soft_delete', 0)->OrderBy('kode_unit_kerja', 'asc')->get();
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
        }

        return view('upt.kepegawaian.unitkerja.index', compact('arrData', 'child3'));
    }

    // public function dataUnitkerja() {
    //     $unit_kerja = Fungsi::getUnitKerja(auth()->user()->upt_id);
    //     return Datatables:: of($unit_kerja)
    //         ->setRowClass(function ($data) {
    //             if($data->id_level_unit == 1) {
    //                 return 'sub1';
    //             } else if($data->id_level_unit == 2) {
    //                 return 'sub2';
    //             } else if($data->id_level_unit == 3) {
    //                 return 'sub3';
    //             } else {

    //             }
    //         })
    //         ->editColumn('kode', function ($data){
    //             return '<p>'.$data->kode_unit_kerja.'</p>';
    //         })
    //         ->editColumn('jabatan', function ($data){
    //             return '<p>'.$data->nama_unit_kerja.'</p>';
    //         })
    //         ->addColumn('action', function($data){
    //             if(($data->id_level_unit) == 1 || ($data->id_level_unit == 2)) {
    //                 $actionBtn = '<div class="d-flex flex-wrap m-0">
    //                     <a href="'.route('upt-tambah-sub-unitkerja', ['idparent' => $data->id_unit_kerja]).'" class="btn btn-primary">
    //                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                             <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17 13H13V17H11V13H7V11H11V7H13V11H17V13Z" fill="white"/>
    //                         </svg>
    //                         Sub Unit
    //                     </a>';
    //             } else {

    //             }
    //             if($data->id_level_unit == 1) {
    //                 $actionBtn .= '
    //                     <a href="'.route('upt-edit-unitkerja', ['idunitkerja' => $data->id_unit_kerja]).'" class="btn btn-warning">
    //                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                             <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
    //                         </svg>
    //                         Edit
    //                     </a>';
    //             } else if($data->id_level_unit != 1) {
    //                 $actionBtn .= '
    //                     <a href="'.route('upt-edit-sub-unitkerja', ['idparent' => $data->id_unit_kerja]).'" class="btn btn-warning">
    //                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                             <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
    //                         </svg>
    //                         Edit
    //                     </a>';
    //             } else {

    //             }
    //             if($data->id_level_unit == 1) {
    //                 $actionBtn .= '
    //                     <a onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" class="btn btn-danger">
    //                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                             <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
    //                         </svg>
    //                         Hapus Unit Utama dan Sub
    //                     </a>
    //                 </div>';
    //             } else if($data->id_level_unit != 1) {
    //                 $actionBtn .= '
    //                     <a onclick="return confirm(`Anda Yakin Menghapus Data Sub Ini?`)" href="'.route('upt-hapus-unitkerja', ['idunitkerja' => $data->id_unit_kerja]).'" class="btn btn-danger">
    //                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                             <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
    //                         </svg>
    //                         Hapus
    //                     </a>';
    //             } else {

    //             }
    //             return $actionBtn;
    //         })
    //         ->rawColumns(['kode','jabatan','action'])
    //         ->make(true);
    // }

    public function tambah(Request $request) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.unitkerja.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $unit_kerja   = UnitKerja::where('kode_unit_kerja', $request->kode)->where('nama_unit_kerja', $request->jabatan)->where('soft_delete', 0)->where('upt_id', auth()->user()->upt_id)->where('id_level_unit', 1)->first();
            if($unit_kerja) {
                return redirect()->route('upt-tambah-unitkerja')->with(array(
                    'message'    => 'Kode Atau Jabatan Sudah Terdaftar Di Database',
                    'alert-type' => 'error'
                ))->withInput();
            }

            DB:: beginTransaction();
            try {
                $unit_kerja = New UnitKerja;
                $unit_kerja['id_unit_kerja']   = Str::uuid();
                $unit_kerja['nama_unit_kerja'] = $request->jabatan;
                $unit_kerja['kode_unit_kerja'] = $request->kode;
                $unit_kerja['soft_delete']     = 0;
                $unit_kerja['editor']          = auth()->user()->uuid;
                $unit_kerja['id_level_unit']   = 1;
                $unit_kerja['upt_id']          = auth()->user()->upt_id;
                $unit_kerja->save();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                    'message'    => 'Sukses Tambah Unit Kerja',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->route('upt-tambah-unitkerja')->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function edit(Request $request, $idunitkerja) {
        $unitkerja   = UnitKerja::where('id_unit_kerja', $idunitkerja)->first();
        if(!$unitkerja) {
            return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                'message'    => 'Data Unit Kerja Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.unitkerja.edit', compact('unitkerja'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $upt_id = auth()->user()->upt_id;
            $unit_kerja   = UnitKerja::where('kode_unit_kerja', $request->kode)->where('nama_unit_kerja', $request->jabatan)->where('soft_delete', 0)->where('upt_id', auth()->user()->upt_id)->where('id_level_unit', 1)->whereNotIn('id_unit_kerja', [$idunitkerja])->first();
            if($unit_kerja) {
                return redirect()->route('upt-edit-unitkerja', ['idunitkerja' => $idunitkerja])->with(array(
                    'message'    => 'Kode Atau Jabatan Sudah Terdaftar Di Database',
                    'alert-type' => 'error'
                ))->withInput();
            }

            DB:: beginTransaction();
            try {
                $unit_kerja   = UnitKerja::where('id_unit_kerja', $idunitkerja)->first();
                $unit_kerja['nama_unit_kerja'] = $request->jabatan;
                $unit_kerja['kode_unit_kerja'] = $request->kode;
                $unit_kerja['editor']          = auth()->user()->uuid;
                $unit_kerja['id_level_unit']   = 1;
                $unit_kerja['upt_id']          = auth()->user()->upt_id;
                $unit_kerja->update();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                    'message'    => 'Sukses Edit Unit Kerja',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->route('upt-edit-unitkerja', ['idunitkerja' => $idunitkerja])->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function tambahsub(Request $request, $idparent) {
        $unit_kerja   = UnitKerja::where('id_unit_kerja', $idparent)->first();
        if(!$unit_kerja) {
            return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                'message'    => 'Data Unit Kerja Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        $level = $unit_kerja->id_level_unit;

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.unitkerja.tambah_sub', compact('unit_kerja'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $unit_kerja   = UnitKerja::where('kode_unit_kerja', $request->kode)->where('nama_unit_kerja', $request->jabatan)->where('soft_delete', 0)->where('upt_id', auth()->user()->upt_id)->where('id_level_unit', (int)$level+1)->first();
            if($unit_kerja) {
                return redirect()->route('upt-tambah-sub-unitkerja', ['idparent' => $idparent])->with(array(
                    'message'    => 'Kode Atau Jabatan Sudah Terdaftar Di Database',
                    'alert-type' => 'error'
                ))->withInput();
            }

            DB:: beginTransaction();
            try {
                $unit_kerja = New UnitKerja;
                $unit_kerja['id_unit_kerja']   = Str::uuid();
                $unit_kerja['nama_unit_kerja'] = $request->jabatan;
                $unit_kerja['kode_unit_kerja'] = $request->kode;
                $unit_kerja['soft_delete']     = 0;
                $unit_kerja['editor']          = auth()->user()->uuid;
                $unit_kerja['id_induk']        = $idparent;
                $unit_kerja['id_level_unit']   = (int)$level+1;
                $unit_kerja['upt_id']          = auth()->user()->upt_id;
                $unit_kerja->save();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                    'message'    => 'Sukses Tambah Sub Unit Kerja',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->route('upt-tambah-sub-unitkerja', ['idparent' => $idparent])->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function editsub(Request $request, $idunitkerja) {
        $unit_kerja   = UnitKerja::where('id_unit_kerja', $idunitkerja)->first();
        if(!$unit_kerja) {
            return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                'message'    => 'Data Unit Kerja Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }
        $induk = UnitKerja::where('id_unit_kerja', $unit_kerja->id_induk)->first();
        $level = $unit_kerja->id_level_unit;

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.unitkerja.edit_sub', compact('unit_kerja','induk'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $unit_kerja   = UnitKerja::where('kode_unit_kerja', $request->kode)->where('nama_unit_kerja', $request->jabatan)->where('soft_delete', 0)->where('upt_id', auth()->user()->upt_id)->where('id_level_unit', $level)->whereNotIn('id_unit_kerja', [$idunitkerja])->first();
            if($unit_kerja) {
                return redirect()->route('upt-edit-sub-unitkerja', ['idunitkerja' => $idunitkerja])->with(array(
                    'message'    => 'Kode Atau Jabatan Sudah Terdaftar Di Database',
                    'alert-type' => 'error'
                ))->withInput();
            }

            DB:: beginTransaction();
            try {
                $unit_kerja   = UnitKerja::where('id_unit_kerja', $idunitkerja)->first();
                $unit_kerja['nama_unit_kerja'] = $request->jabatan;
                $unit_kerja['kode_unit_kerja'] = $request->kode;
                $unit_kerja['editor']          = auth()->user()->uuid;
                $unit_kerja['upt_id']          = auth()->user()->upt_id;
                $unit_kerja->save();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                    'message'    => 'Sukses Edit Sub Unit Kerja',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->route('upt-edit-sub-unitkerja', ['idunitkerja' => $idunitkerja])->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function hapus(Request $request, $idunitkerja) {
        $unitkerja = UnitKerja::where('id_unit_kerja', $idunitkerja)->first();
        if(!$unitkerja) {
            return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                'message'    => 'Data Unit Kerja Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $unitkerja = UnitKerja::where('id_unit_kerja', $idunitkerja)->orWhere('id_induk', $idunitkerja)->update(['soft_delete' => 1]);

            DB:: commit();
            return redirect()->route('upt-kepegawaian-unitkerja')->with(array(
                'message'    => 'Sukses Menghapus Unit Kerja',
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
