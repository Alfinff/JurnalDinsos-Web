<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('kegiatan', 'KegiatanController@get_kegiatan');
    Route::get('kegiatan/{id}', 'KegiatanController@get_kegiatan');
});


Route::namespace('App\Http\Controllers\API')->group(function() {
    Route::get('provinsi', 'KodeWilayahController@get_provinsi');
    Route::get('kabupaten/{prov_id}', 'KodeWilayahController@get_kabupaten');
    Route::get('kecamatan/{kab_id}', 'KodeWilayahController@get_kecamatan');
    Route::get('kelurahan/{kec_id}', 'KodeWilayahController@get_kelurahan');
    Route::get('upt/{nama}', 'UPTController@get_upt');

    Route::get('pengaduan/ditangani/{id}', 'PengaduanController@ditangani');
    Route::get('pengaduan/dihubungi/{id}', 'PengaduanController@dihubungi');
    Route::get('pengaduan/hapus/{id}', 'PengaduanController@hapus');
});

