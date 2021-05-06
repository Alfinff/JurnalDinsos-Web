<?php

namespace App\Http\Controllers\DINSOS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\Fungsi;
use App\Models\User;
use App\Models\UsersModule;
use App\Models\Role;
use App\Models\Upt;

class PenggunaController extends Controller
{
    public function index() {
        return view('dinsos.pengguna.index');
    }

    public function dataPengguna() {
        $pengguna = User::with(['upt', 'role'])->where('soft_delete', 0)->orderBy('username', 'asc')->get();
        return    Datatables:: of($pengguna)
            ->editColumn('status', function ($data){
                if($data->aktif == 1) {
                    return '<a class="btn btn-success">Aktif</a>';
                } else if($data->aktif == 0) {
                    return '<a class="btn btn-warning">Non-Aktif</a>';
                } else {

                }
            })
            ->editColumn('tipe', function ($data){
                foreach(Role::all() as $r) {
                    if($data->role == $r->id){
                        return $r->role;
                    }
                }
            })
            ->editColumn('upt', function ($data){
                return $data->upt->nama ?? '-';
            })
            ->addColumn('action', function($dataPengguna){
                if($dataPengguna->uuid == auth()->user()->uuid) {
                    return '';
                } else {
                    $actionBtn = '<div class="aksi-button">
                        <div class = "relative">
                            <a   href  = "'.route('dinsos-pengguna-edit', ['uuid' => $dataPengguna->uuid]).'" class = "btn btn-primary">
                                <img src   = "'.asset('assets/images/edit.svg').'" alt                                  = "">
                            </a>
                            <a  onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href = "'.route('dinsos-pengguna-hapus', ['uuid' => $dataPengguna->uuid]).'" class = "btn btn-danger">
                            <img src  = "'.asset('assets/images/delete_outline.svg').'" alt                         = "">
                            </a>
                        </div>';
                    return $actionBtn;
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function tambah(Request $request) {
        $upt  = Upt::orderBy('nama', 'asc')->get();
        $role = Role::orderBy('role', 'asc')->get();
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.pengguna.tambahPengguna', compact('upt', 'role'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user   = User::where('email', $request->email)->first();
            if($user) {
                if($user->soft_delete == 0) {
                    return redirect()->route('dinsos-pengguna-tambah')->with(array(
                        'message'    => 'Email Telah Terdaftar',
                        'alert-type' => 'error'
                    ))->withInput();
                } else {
                    return redirect()->route('dinsos-pengguna-tambah')->with(array(
                        'message'    => 'Email Telah Terdaftar Didatabase',
                        'alert-type' => 'error'
                    ))->withInput();
                }
            }

            DB:: beginTransaction();
            try {
                $uuid = Str::uuid();
                $pengguna = new User;
                $pengguna['username'] = $request->username;
                $pengguna['email']    = $request->email;
                $pengguna['password'] = Hash::make($request->password);
                $pengguna['role']     = $request->role;
                $pengguna['upt_id']   = $request->upt_id;
                $pengguna['aktif']    = $request->aktif;
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
                return redirect()->route('dinsos-pengguna')->with(array(
                    'message'    => 'Sukses Tambah Pengguna',
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

    public function edit(Request $request, $uuid) {
        $upt  = Upt::orderBy('nama', 'asc')->get();
        $role = Role::orderBy('role', 'asc')->get();
        $pengguna   = User::with(['module'])->where('uuid', $uuid)->first();
        if(!$pengguna) {
            return redirect()->route('dinsos-pengguna')->with(array(
                'message'    => 'Data Pengguna Tidak Ditemukan',
                'alert-type' => 'error'
            ))->withInput();
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            return view('dinsos.pengguna.editPengguna', compact('pengguna', 'upt', 'role'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB:: beginTransaction();
            try {
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
                $pengguna['username'] = $request->username;
                $pengguna['email']    = $request->email;
                $pengguna['role']     = $request->role;
                if(isset($request->password) && ($request->password != NULL)) {
                    $pengguna['password'] = Hash::make($request->password);
                }
                if(isset($request->upt_id) && ($request->upt_id != NULL)) {
                    $pengguna['upt_id']   = $request->upt_id;
                }
                $pengguna['aktif']    = $request->aktif;
                $pengguna->update();

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
                return redirect()->route('dinsos-pengguna')->with(array(
                    'message'    => 'Sukses Edit Pengguna',
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

    public function hapus($uuid) {
        $pengguna = User::where('uuid', $uuid)->first();
        if(!$pengguna) {
            return redirect()->route('dinsos-pengguna')->with(array(
                'message'    => 'Data Pengguna Tidak Ditemukan',
                'alert-type' => 'error'
            ));
        }

        DB:: beginTransaction();
        try {
            $pengguna['soft_delete'] = 1;
            $pengguna->update();
            UsersModule::where('users_id', $uuid)->delete();

            DB:: commit();
            return redirect()->route('dinsos-pengguna')->with(array(
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
