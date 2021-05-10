<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class WarehouseController extends Controller
{
    public function getter($module = null, $filename = null)
    {
        if ($module == 'pendaftaran') {
            $url = storage_path('app/public/pendaftaran/'.$filename);
        } else if ($module == 'kegiatan') {
            $url = storage_path('app/public/kegiatan/'.$filename);
        } else if ($module == 'bukti') {
            $url = storage_path('app/public/bukti/'.$filename);
        } else if ($module == 'dokumentasi') {
            $url = storage_path('app/public/dokumentasi/'.$filename);
        } else if ($module == 'profile') {
            $url = storage_path('app/public/profile/'.$filename);
        }

            $type = File::mimeType($url);
        $realFile = File::get($url);

        $response = Response::stream(function() use($realFile) {
            echo $realFile;
          }, 200, ["Content-Type"=> $type]);
        return $response;
    }

}
