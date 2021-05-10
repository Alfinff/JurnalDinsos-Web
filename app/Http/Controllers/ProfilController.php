<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\UsersProfile;
use App\Helpers\UploadImage;
use App\Helpers\UploadFile;

class ProfilController extends Controller
{
    public function index(Request $request, $uuid) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = User::with(['profile'])->where('id', auth()->user()->id)->first();
            return view('profil', compact('user'));
        } else if($_SERVER['REQUEST_METHOD'] == 'POST') {
            DB::beginTransaction();
            try {
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
                    // $profile->photo   =  Str::uuid().".".$request->file("photo")->extension();
                    // Storage::put('public/profile/'.$profile->photo, $request->file("photo")->getContent());

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
