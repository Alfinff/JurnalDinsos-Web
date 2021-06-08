<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Upt;
use App\Models\JenisUpt;
use App\Models\UsersProfile;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class ProfilController extends Controller
{
    public function index(Request $request, $uuid) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = User::with(['rolenya','profile'])->where('id', auth()->user()->id)->first();
            $upt = Upt::where('uuid', auth()->user()->upt_id)->where('soft_delete', 0)->first();
            $jenisupt = JenisUpt::where('soft_delete', 0)->get();
            return view('profil', compact('user','upt','jenisupt'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB::beginTransaction();
            try {
                if($request->tipeform == 'editprofile') {
                    $profile = UsersProfile::where('users_id', $uuid)->first();
                    if(!$profile) {
                        $profile = New UsersProfile;
                        $profile->id = Str::uuid();
                        $profile->users_id = $uuid;
                    }
                    $profile->phone = $request->phone;
                    $profile->address = $request->address;
                    $profile->gender = $request->gender;
                    if(file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name'])) {
                        UploadImage::setPath('profil');
                        UploadImage::setImage($request->file("photo")->getContent());
                        UploadImage::setExt($request->file("photo")->extension());
                        $path_profile = UploadImage::uploadImage();
                        $profile->photo = $path_profile;
                    }

                    $profile->save();

                    DB:: commit();
                    return redirect()->route('profil-home', ['uuid' => $uuid])->with(array(
                        'message'    => 'Sukses Edit Profil',
                        'alert-type' => 'success',
                    ));
                } else if($request->tipeform == 'editupt') {
                    $upt = Upt::where('uuid', auth()->user()->upt_id)->where('soft_delete', 0)->first();
                    if(!$upt) {
                        return redirect()->route('upt-home')->with(array(
                            'message'    => 'Data Upt Tidak Ditemukan',
                            'alert-type' => 'error',
                        ));
                    }
                    $upt->nama = $request->nama_upt;
                    $upt->wilayah = $request->wilayah;
                    $upt->alamat = $request->alamat_lengkap;
                    $upt->jenis_upt = $request->jenisupt;
                    $upt->deskripsi   = $request->deskripsiupt;
                    $upt->maps   = $request->mapsupt;

                    if(file_exists($_FILES['photoupt']['tmp_name']) || is_uploaded_file($_FILES['photoupt']['tmp_name'])) {
                        UploadImage::setPath('upt');
                        UploadImage::setImage($request->file("photoupt")->getContent());
                        UploadImage::setExt($request->file("photoupt")->extension());
                        $path_foto_upt = UploadImage::uploadImage();
                        $upt->foto = $path_foto_upt;
                    }

                    $upt->save();

                    DB:: commit();
                    return redirect()->route('profil-home', ['uuid' => $uuid])->with(array(
                        'message'    => 'Sukses Edit Data Upt',
                        'alert-type' => 'success',
                    ));
                }
            } catch (\Throwable $th) {
                // $th->getMessage()
                DB:: rollback();
                return redirect()->back()->with(array(
                    'message'    => 'Terdapat Kesalahan',
                    'alert-type' => 'error'
                ))->withInput();
            }
        }
    }
}
