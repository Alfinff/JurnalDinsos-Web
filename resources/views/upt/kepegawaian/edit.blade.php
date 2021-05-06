@extends('layout.template')
@section('content')
<style>
    .head-juduls{
        padding: 20px 20px 0 20px;
    }

    .form-group{
        margin-bottom: 1.75rem;
    }
    .form-group label{
        padding: calc(0.65rem + 1px);
    }
    .form-control{
        border-radius: 5px;
    }
</style>
    <div class="col-md-10 bg-col">
        <div class="row my-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
                            <a href="{{ route('upt-kepegawaian-pegawai') }}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
                        <div class="head-judul text-center">
                            <h3>Form Edit Pegawai</h3>
                            <hr>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="username" id="nama" class="form-control" placeholder="Masukkan Nama" required value="{{$pengguna->username}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required value="{{$pengguna->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Cth: password anda">
                                        <div class="warn">
                                            <small class="text-danger">Kosongi jika tidak diubah</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select" id="status" required>
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="1" @if($pengguna->aktif == 1) selected="selected" @endif>Aktif</option>
                                            <option value="0" @if($pengguna->aktif == 0) selected="selected" @endif>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="akses_modul">
										<div class="form-group">
											<label for="akses_modul">Akses Modul</label>
										</div>
										<div class="d-flex justify-content-between flex-wrap">
											<div class="form-check col-md-6" id="kegiatan_top">
												<input class="form-check-input" type="checkbox" value="1" id="kegiatanupt" name="kegiatan" @if (isset($pengguna->module->kegiatan) &&  ($pengguna->module->kegiatan == 1)) checked @endif>
												<label class="form-check-label" for="kegiatanupt">
													Kegiatan
												</label>
											</div>
											<div class="form-check col-md-6" id="penerima_bantuan_top">
												<input class="form-check-input" type="checkbox" value="1" id="penerima_bantuan" name="penerima_bantuan" @if (isset($pengguna->module->penerima_bantuan) &&  ($pengguna->module->penerima_bantuan == 1)) checked @endif>
												<label class="form-check-label" for="penerima_bantuan">
													Penerima Bantuan
												</label>
											</div>
											<div class="form-check col-md-6">
												<input class="form-check-input" type="checkbox" value="1" id="data_pendaftar" name="data_pendaftar" @if (isset($pengguna->module->data_pendaftar) &&  ($pengguna->module->data_pendaftar == 1)) checked @endif>
												<label class="form-check-label" for="data_pendaftar">
													Data Pendaftar
												</label>
											</div>
										</div>
									</div>
                                <div class="col-md-12 my-3">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary mx-3">Edit</button>
                                        <a href="{{route('upt-kepegawaian-pegawai')}}" class="btn btn-warning">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
