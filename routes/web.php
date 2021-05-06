<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ->middleware(['accessCheck:master_kepegawaian'])
Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('/', 'IndexController@index')->name('index');

    // login & logout routes
    Route::post('/postLogin', 'AuthController@login')->name('postLogin');
    Route::get('logout', 'AuthController@logout')->name('logout');

    // landing page routes
    Route::prefix('halaman')->group(function() {
        Route::get('/upt', 'IndexController@upt')->name('halaman-upt');
        Route::get('/profil', 'IndexController@profil')->name('profil');
        Route::get('/berita', 'IndexController@berita')->name('halaman-berita');
        Route::get('/berita/{id}', 'IndexController@detail')->name('detailberita');
        Route::get('/tentang', 'IndexController@tentang')->name('tentang');

        Route::get('/pendaftaran', 'PendaftaranController@index')->name('pendaftaran');
        Route::post('/pendaftaran', 'PendaftaranController@daftar');
    });

    // butuh login auth
    Route::get('/images/{module?}/{filename?}', ['as' => 'images-getter', 'uses' => 'WarehouseController@getter'])->middleware('auth');
    Route::post('/notifmarkasread', 'NotifikasiController@MarkAsRead')->middleware('auth');
    Route::match(['GET', 'POST'], '/profil/{uuid}', 'ProfilController@index')->name('profil-home')->middleware('auth');

    // dinsos routes
    Route::prefix('dinsos')->middleware(['auth','checkrole:dinsos'])->group(function() {
        Route::get('/', 'DINSOS\DashboardController@index')->name('dinsos-home');

        Route::prefix('pegawai')->middleware('accesscheck:master_kepegawaian')->group(function() {
            Route::get('/', 'DINSOS\KepegawaianController@index')->name('dinsos-pegawai');
            Route::get('/aktif', 'DINSOS\KepegawaianController@pegawaiAktif')->name('dinsos-pegawai-aktif');
            Route::get('/semua', 'DINSOS\KepegawaianController@semua')->name('dinsos-pegawai-semua');
            Route::get('/pegawai-upt', 'DINSOS\KepegawaianController@pegawaiupt')->name('pegawai-upt');
        });

        Route::prefix('kegiatan')->middleware('accesscheck:kegiatan')->group(function() {
            Route::get('/', 'DINSOS\KegiatanUPTController@index')->name('dinsos-kegiatan');
            Route::get('/lihat/{id}', 'DINSOS\KegiatanUPTController@lihatKegiatan')->name('dinsos-lihat-kegiatan');
        });

        Route::prefix('dataupt')->middleware('accesscheck:data_upt')->group(function() {
            Route::get('/', 'DINSOS\DataUPTController@index')->name('dinsos-dataupt');
            Route::get('/data/{uuid}', 'DINSOS\DataUPTController@dataKlien');
            Route::get('/detail/{uuid}', 'DINSOS\DataUPTController@detail')->name('dinsos-dataupt-detail');
        });

        Route::prefix('pendaftar')->middleware('accesscheck:data_pendaftar')->group(function() {
            Route::get('/', 'DINSOS\DataPendaftarController@index')->name('dinsos-pegawai-pendaftar');
            Route::get('/data', 'DINSOS\DataPendaftarController@dataPendaftar');
            Route::get('/daftarbantuan/{uuid}/{uptid}', 'DINSOS\DataPendaftarController@daftarBantuan')->name('dinsos-pendaftar-selesai-bantuan');
            Route::get('/databantuan/{uuid}/{uptid}', 'DINSOS\DataPendaftarController@dataBantuan');
            Route::get('/detail/{uuid}', 'DINSOS\DataPendaftarController@detail')->name('dinsos-pegawai-pendaftar-detail');
        });

        Route::prefix('pengguna')->middleware('accesscheck:master_pengguna')->group(function() {
            Route::get('/', 'DINSOS\PenggunaController@index')->name('dinsos-pengguna');
            Route::get('/data', 'DINSOS\PenggunaController@dataPengguna');
            Route::get('/hapus/{uuid}', 'DINSOS\PenggunaController@hapus')->name('dinsos-pengguna-hapus');
            Route::match(['GET', 'POST'], '/tambah', 'DINSOS\PenggunaController@tambah')->name('dinsos-pengguna-tambah');
            Route::match(['GET', 'POST'], '/edit/{uuid}', 'DINSOS\PenggunaController@edit')->name('dinsos-pengguna-edit');
        });
    });

    // upt routes
    Route::prefix('upt')->middleware(['auth', 'checkrole:dinsos&upt&pegawai'])->group(function() {
        Route::get('/', 'UPT\DashboardController@index')->name('upt-home');
        Route::get('/pegawai', 'UPT\PEGAWAI\DashboardController@index')->name('pegawai-home');

        Route::prefix('kepegawaian')->middleware('accesscheck:master_kepegawaian')->group(function() {
            Route::prefix('unitkerja')->group(function() {
                Route::get('/', 'UPT\UnitKerjaController@index')->name('upt-kepegawaian-unitkerja');
                // Route::get('/data', 'UPT\UnitKerjaController@dataUnitkerja');
                Route::get('/hapus/{idunitkerja}', 'UPT\UnitKerjaController@hapus')->name('upt-hapus-unitkerja');
                Route::match(['GET', 'POST'], '/tambah', 'UPT\UnitKerjaController@tambah')->name('upt-tambah-unitkerja');
                Route::match(['GET', 'POST'], '/edit/{idunitkerja}', 'UPT\UnitKerjaController@edit')->name('upt-edit-unitkerja');
                Route::match(['GET', 'POST'], '/tambahsub/{idparent}', 'UPT\UnitKerjaController@tambahsub')->name('upt-tambah-sub-unitkerja');
                Route::match(['GET', 'POST'], '/editsub/{idunitkerja}', 'UPT\UnitKerjaController@editsub')->name('upt-edit-sub-unitkerja');
            });

            Route::prefix('pegawai')->group(function() {
                Route::get('/', 'UPT\KepegawaianController@pegawai')->name('upt-kepegawaian-pegawai');
                Route::get('/data', 'UPT\KepegawaianController@dataPegawai');
                Route::get('/hapus/{uuid}', 'UPT\KepegawaianController@hapus')->name('upt-hapus-pegawai');
                Route::match(['GET', 'POST'], '/tambah', 'UPT\KepegawaianController@tambah')->name('upt-tambah-pegawai');
                Route::match(['GET', 'POST'], '/edit/{uuid}', 'UPT\KepegawaianController@edit')->name('upt-edit-pegawai');
            });
        });

        Route::prefix('kegiatan')->middleware('accesscheck:kegiatan')->group(function() {
            Route::get('/', 'UPT\KegiatanController@index')->name('upt-kegiatan');
            Route::get('/data', 'UPT\KegiatanController@dataKegiatan');
            Route::get('/lihat/{id}', 'UPT\KegiatanController@lihatKegiatan')->name('upt-lihat-kegiatan');
            Route::get('/hapus/{id}', 'UPT\KegiatanController@hapus_kegiatan')->name('upt-delete-kegiatan');
            Route::match(['GET', 'POST'], '/tambah', 'UPT\KegiatanController@tambah_kegiatan')->name('upt-tambah-kegiatan');
            Route::match(['GET', 'POST'], '/edit/{id}', 'UPT\KegiatanController@edit_kegiatan')->name('upt-edit-kegiatan');
        });

        Route::prefix('penerima')->middleware('accesscheck:penerima_bantuan')->group(function() {
            Route::get('/', 'UPT\PenerimaManfaatController@index')->name('upt-penerima-manfaat');
            Route::get('/data', 'UPT\PenerimaManfaatController@dataPenerima');
            Route::get('/hapus/{uuid}', 'UPT\PenerimaManfaatController@hapus')->name('upt-penerima-manfaat-delete');
            Route::match(['GET', 'POST'], '/detailedit/{uuid}', 'UPT\PenerimaManfaatController@dataPenerimaDetailEdit')->name('edit-penerima-manfaat-detail');

            Route::prefix('selesai')->group(function() {
                Route::get('/data', 'UPT\PenerimaManfaatController@dataSelesai');
                Route::get('/daftarbantuan/{uuid}', 'UPT\PenerimaManfaatController@daftarBantuan')->name('upt-penerima-manfaat-selesai-bantuan');
                Route::get('/aksi/{uuid}', 'UPT\PenerimaManfaatController@aksiSelesai')->name('upt-penerima-manfaat-selesai');
            });

            Route::prefix('perkembangan')->group(function() {
                Route::get('/hapus/{uuid}', 'UPT\PenerimaManfaatController@hapusBantuan')->name('upt-penerima-hapus-bantuan');
                Route::match(['GET', 'POST'], '/semua/{uuid}', 'UPT\PerkembanganController@index')->name('upt-penerima-perkembangan');
                Route::match(['GET', 'POST'], '/edit/{uuid}', 'UPT\PenerimaManfaatController@editBantuan')->name('upt-penerima-edit-bantuan');
            });

            Route::prefix('bantuan')->group(function() {
                Route::get('/data/{uuid}', 'UPT\PenerimaManfaatController@dataBantuan');
                Route::get('/hapus/{uuid}', 'UPT\PenerimaManfaatController@hapusBantuan')->name('upt-penerima-hapus-bantuan');
                Route::match(['GET', 'POST'], '/tambah/{uuid}', 'UPT\PenerimaManfaatController@tambahBantuan')->name('upt-penerima-tambah-bantuan');
                Route::match(['GET', 'POST'], '/edit/{uuid}', 'UPT\PenerimaManfaatController@editBantuan')->name('upt-penerima-edit-bantuan');
            });
        });

        Route::prefix('pendaftar')->middleware('accesscheck:data_pendaftar')->group(function() {
            Route::prefix('tertunda')->group(function() {
                Route::get('/', 'UPT\PendaftarController@tertunda')->name('upt-pendaftar-tertunda');
                Route::get('/data', 'UPT\PendaftarController@dataTertunda');
                Route::post('/hubungi', 'UPT\PendaftarController@hubungi')->name('upt-pendaftar-tertunda-hubungi');
                Route::match(['GET', 'POST'], '/detailedit/{uuid}', 'UPT\PendaftarController@dataTertundaDetailEdit')->name('upt-pendaftar-tertunda-detail');
            });
            Route::prefix('dihubungi')->group(function() {
                Route::get('/', 'UPT\PendaftarController@dihubungi')->name('upt-pendaftar-dihubungi');
                Route::get('/data', 'UPT\PendaftarController@dataDihubungi');
                Route::match(['GET', 'POST'], '/tangani/{uuid}', 'UPT\PendaftarController@tanganiPendaftar')->name('upt-pendaftar-tertunda-tangani');
            });
        });
    });
});


URL::forceScheme('https');
