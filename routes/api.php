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
    // web api kode wilayah
    Route::get('provinsi', 'KodeWilayahController@get_provinsi');
    Route::get('kabupaten/{prov_id}', 'KodeWilayahController@get_kabupaten');
    Route::get('kecamatan/{kab_id}', 'KodeWilayahController@get_kecamatan');
    Route::get('kelurahan/{kec_id}', 'KodeWilayahController@get_kelurahan');
    Route::post('/login', 'LoginController@login');
    Route::get('/checktoken', 'LoginController@checkToken')->middleware('protect-api');

    // API Pendaftaran
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

    // Kegiatan UPT
    Route::prefix('kegiatan')->group(function() {
        Route::get('/', 'KegiatanController@kegiatan');
        Route::get('/detail/{id}', 'KegiatanController@kegiatan');
        Route::get('/perupt/{upt_id}', 'KegiatanController@perupt');
    });

    // Berita
    Route::prefix('berita')->group(function() {
        Route::get('/', 'BeritaController@berita');
        Route::get('terbaru/', 'BeritaController@terbaru');
        Route::get('/detail/{id}', 'BeritaController@berita');
    });

    Route::get('/visimisi', 'VisiMisiController@get');
    Route::get('/video/{uuid?}', 'VideoController@get');

    Route::post('/search/{uuid?}', 'SearchController@search');

    Route::prefix('chart')->group(function() {
        // Dashboard / Chart Dinsos
        Route::prefix('dinsos')->middleware('checktokenapi:dinsos')->group(function() {
            Route::get('/jenisaduan/{upt_id?}', 'ChartController@jenisaduan');
            Route::get('/jumlahklien', 'ChartController@jumlahklien');
            Route::get('/jumlahupt', 'ChartController@jumlahupt');
            Route::get('/chartjeniskelamin/{upt_id?}', 'ChartController@chartjeniskelamin');
            Route::get('/pengeluaranupt', 'ChartController@pengeluaranupt');
            Route::get('/jumlahjenisaduan', 'ChartController@jumlahjenisaduan');
            Route::get('/chartklienmasuk', 'ChartController@chartklienmasuk');
            Route::get('/kepegawaian', 'KepegawaianController@getPegawaiSemua');
        });

        // UPT
        Route::prefix('upt')->middleware('checktokenapi:upt_pegawai')->group(function() {
            Route::get('/jumlahklien', 'ChartUptController@jumlahklien');
            Route::get('/jumlahupt', 'ChartUptController@jumlahupt');
            Route::get('/chartjeniskelamin', 'ChartUptController@chartjeniskelamin');
            Route::get('/pengeluaranupt', 'ChartUptController@pengeluaranupt');
            Route::get('/jumlahjenisaduan', 'ChartUptController@jumlahjenisaduan');
            Route::get('/chartklienmasuk', 'ChartUptController@chartklienmasuk');
            Route::get('/kepegawaian/{upt_id}', 'KepegawaianController@getPegawaiUpt');
        });
    });
});

