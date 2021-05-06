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
                            <h3>Form Tambah Pegawai</h3>
                            <hr>
                        </div>
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" name="username" id="nama" class="form-control" placeholder="Masukkan Nama" required value="{{old('username')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" required name="password" id="password" class="form-control" placeholder="Cth: password anda">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select" id="status" required>
                                            <option value="" selected disabled>Pilih Status</option>
                                            <option value="1" @if (null !== old('status')) @if(old('status') == 1) selected="selected" @endif @endif>Aktif</option>
                                            <option value="0" @if (null !== old('status')) @if(old('status') == 0) selected="selected" @endif @endif>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="akses_modul">
                                    <div class="form-group">
                                        <label for="akses_modul">Akses Modul</label>
                                    </div>
                                    <div class="d-flex justify-content-between flex-wrap">
                                        <div class="form-check col-md-6" id="kegiatan_top">
                                            <input class="form-check-input" type="checkbox" value="1" id="kegiatan" name="kegiatan" @if (null !== old('kegiatan')) @if(old('kegiatan')) checked @endif @endif>
                                            <label class="form-check-label" for="kegiatan">
                                                Kegiatan
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6" id="penerima_bantuan_top">
                                            <input class="form-check-input" type="checkbox" value="1" id="penerima_bantuan" name="penerima_bantuan" @if (null !== old('penerima_bantuan')) @if(old('penerima_bantuan')) checked @endif @endif>
                                            <label class="form-check-label" for="penerima_bantuan">
                                                Penerima Bantuan
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6 d-none" id="data_upt_top">
                                            <input class="form-check-input" type="checkbox" value="1" id="data_upt" name="data_upt" @if (null !== old('data_upt')) @if(old('data_upt')) checked @endif @endif>
                                            <label class="form-check-label" for="data_upt">
                                                Data Upt
                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input" type="checkbox" value="1" id="data_pendaftar" name="data_pendaftar" @if (null !== old('data_pendaftar')) @if(old('data_pendaftar')) checked @endif @endif>
                                            <label class="form-check-label" for="data_pendaftar">
                                                Data Pendaftar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary mx-3">Tambah</button>
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
