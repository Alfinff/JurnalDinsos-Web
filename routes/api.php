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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('App\Http\Controllers\API')->group(function() {
    Route::get('provinsi', 'KodeWilayahController@get_provinsi');
    Route::get('kabupaten/{prov_id}', 'KodeWilayahController@get_kabupaten');
    Route::get('kecamatan/{kab_id}', 'KodeWilayahController@get_kecamatan');
    Route::get('kelurahan/{kec_id}', 'KodeWilayahController@get_kelurahan');

    Route::prefix('wilayah')->group(function() {
        Route::get('provinsi', 'KodeWilayahController@get_provinsi');
        Route::get('kabupaten/{prov_id}', 'KodeWilayahController@get_kabupaten');
        Route::get('kecamatan/{kab_id}', 'KodeWilayahController@get_kecamatan');
        Route::get('kelurahan/{kec_id}', 'KodeWilayahController@get_kelurahan');
    });

    Route::prefix('upt')->group(function() {
        Route::get('/{uuid?}', 'UPTController@get_upt');
    });

    Route::prefix('data')->group(function() {
        Route::get('/jeniskelamin', 'DataController@jeniskelamin');
        Route::get('/jenisaduan', 'DataController@jenisaduan');
    });

    Route::post('/daftar', 'PendaftaranController@daftar');
    Route::post('/login', 'LoginController@login');
    Route::get('/checktoken', 'LoginController@checkToken')->middleware('protect-api');

});

