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
use App\Models\Upt;
use App\Models\Role;
use App\Models\User;
use App\Models\UsersModule;

class KepegawaianController extends Controller
{

    public function pegawai() {
        return view('upt.kepegawaian.index');
    }

    public function dataPegawai() {
        $pegawai = Fungsi::getSemuaPegawai(auth()->user()->upt_id);
        return Datatables:: of($pegawai)
            ->addIndexColumn()
            ->editColumn('status', function ($data){
                if($data->aktif == 1) {
                    return '<p class="badge badge-primary">Aktif</p>';
                } else if($data->aktif == 0) {
                    return '<p class="badge badge-warning">Non-Aktif</p>';
                } else {

                }
            })
            ->addColumn('action', function($data){
                $actionBtn = '<div class="aksi-button">
                    <div class="relative">
                        <a   href = "'.route('upt-edit-pegawai', ['uuid' => $data->uuid]).'" class = "btn btn-primary">
                        <img src  = "'.asset('assets/images/edit.svg').'" alt                                          = "">
                        </a>
                        <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('upt-hapus-pegawai', ['uuid' => $data->uuid]).'" class                                           = "btn btn-danger">
                        <img src  = "'.asset('assets/images/delete_outline.svg').'" alt = "">
                        </a>
                    </div>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function tambah(Request $request) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.tambah');
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user   = User::where('email', $request->email)->first();
            if($user) {
                if($user->soft_delete == 0) {
                    return redirect()->route('upt-tambah-pegawai')->with(array(
                        'message'    => 'Email Telah Terdaftar',
                        'alert-type' => 'error'
                    ))->withInput();
                } else {
                    return redirect()->route('upt-tambah-pegawai')->with(array(
                        'message'    => 'Email Telah Terdaftar Didatabase',
                        'alert-type' => 'error'
                    ))->withInput();
                }
            }

            DB:: beginTransaction();
            try {
                $role = Role::where('role', 'pegawai')->first();

                $uuid = Str::uuid();
                $pengguna = new User;
                $pengguna['username'] = $request->username;
                $pengguna['email']    = $request->email;
                $pengguna['password'] = Hash::make($request->password);
                $pengguna['role']     = $role->id;
                $pengguna['upt_id']   = auth()->user()->upt_id;
                $pengguna['aktif']    = $request->status;
                $pengguna['uuid']     = $uuid;
                $pengguna->save();

                $pengguna_mod = new UsersModule;
                $pengguna_mod['uuid'] = Str::uuid();
                $pengguna_mod['users_id'] = $uuid;
                $pengguna_mod['master_kepegawaian'] = null !== ($request->master_kepegawaian) ? 1 : 0;
                $pengguna_mod['kegiatan'] = null !== ($request->kegiatan) ? 1 : 0;
                $pengguna_mod['penerima_bantuan'] = null !== ($request->penerima_bantuan) ? 1 : 0;
                $pengguna_mod['data_pendaftar'] = null !== ($request->data_pendaftar) ? 1 : 0;
                $pengguna_mod['data_upt'] = null !== ($request->data_upt) ? 1 : 0;
                $pengguna_mod['master_pengguna'] = null !== ($request->master_pengguna) ? 1 : 0;
                $pengguna_mod->save();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-pegawai')->with(array(
                    'message'    => 'Sukses Tambah Pegawai',
                    'alert-type' => 'success',
                ));
            } catch (\Throwable $th) {
                DB:: rollback();
                return redirect()->route('upt-tambah-pegawai')->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }

    public function edit(Request $request, $uuid) {
        $pengguna   = User::with(['module'])->where('uuid', $uuid)->first();
        if(!$pengguna) {
            return redirect()->route('upt-kepegawaian-pegawai')->with(array(
                'message'    => 'Data Pegawai Tidak Ditemukan',
                'alert-type' => 'error'
            ))->withInput();
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('upt.kepegawaian.edit', compact('pengguna'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user   = User::where('email', $request->email)->whereNotIn('uuid', [$uuid])->first();
            if($user) {
                if($user->soft_delete == 0) {
                    return redirect()->back()->with(array(
                        'message'    => 'Email Telah Digunakan Pengguna Lain',
                        'alert-type' => 'error'
                    ))->withInput();
                } else {
                    return redirect()->route('upt-tambah-pegawai')->with(array(
                        'message'    => 'Email Telah Terdaftar Didatabase',
                        'alert-type' => 'error'
                    ))->withInput();
                }
            }

            DB:: beginTransaction();
            try {
                $role = Role::where('role', 'pegawai')->first();

                $pengguna['username'] = $request->username;
                $pengguna['email']    = $request->email;
                if(isset($request->password) && ($request->password != NULL)) {
                    $pengguna['password'] = Hash::make($request->password);
                }
                $pengguna['role']     = $role->id;
                $pengguna['upt_id']   = auth()->user()->upt_id;
                $pengguna['aktif']    = $request->status;
                $pengguna->save();

                $hapus = UsersModule::where('users_id', $uuid)->delete();
                $pengguna_mod = new UsersModule;
                $pengguna_mod['uuid'] = Str::uuid();
                $pengguna_mod['users_id'] = $uuid;
                $pengguna_mod['master_kepegawaian'] = null !== ($request->master_kepegawaian) ? 1 : 0;
                $pengguna_mod['kegiatan'] = null !== ($request->kegiatan) ? 1 : 0;
                $pengguna_mod['penerima_bantuan'] = null !== ($request->penerima_bantuan) ? 1 : 0;
                $pengguna_mod['data_pendaftar'] = null !== ($request->data_pendaftar) ? 1 : 0;
                $pengguna_mod['data_upt'] = null !== ($request->data_upt) ? 1 : 0;
                $pengguna_mod['master_pengguna'] = null !== ($request->master_pengguna) ? 1 : 0;
                $pengguna_mod->save();

                DB:: commit();
                return redirect()->route('upt-kepegawaian-pegawai')->with(array(
                    'message'    => 'Sukses Tambah Pegawai',
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

    public function hapus(Request $request, $uuid) {
        $pengguna = User::where('uuid', $uuid)->first();
        if(!$pengguna) {
            return redirect()->route('upt-kepegawaian-pegawai')->with(array(
                'message'    => 'Data Pengguna Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pengguna['soft_delete'] = 1;
            $pengguna->update();

            DB:: commit();
            return redirect()->route('upt-kepegawaian-pegawai')->with(array(
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

    public function struktur() {
        $detail = Upt::where('uuid', auth()->user()->upt_id)->where('soft_delete', 0)->first();
        if(!$detail) {
            return redirect()->back()->with(array(
                'message'    => 'Data Tidak Ditemukan',
                'alert-type' => 'error',
                'style'      => 'hide'
            ));
        }

        $rsData = UnitKerja::where('upt_id', auth()->user()->upt_id)->where('soft_delete', 0)->OrderBy('kode_unit_kerja', 'asc')->get();
        $arrData = array();
        $child3 = array();
        $pimpinan = array();
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
            $pimpinan[$r->id_unit_kerja] = Pimpinan::with(['users','profile'])->where('id_unit_kerja', $r->id_unit_kerja)->first();
        }

        return view('upt.kepegawaian.struktur', compact('detail', 'arrData', 'child3', 'pimpinan'));
    }

}
