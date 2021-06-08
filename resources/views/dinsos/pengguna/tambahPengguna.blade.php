@extends('layout.template')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .js-example-basic-single{
        border: none !important;
    }
</style>
	<div class="col-lg-10 bg-col" style="min-height: 100vh">
		<div class="row my-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-card">
                        <div class="back">
                            <a href="{{route('dinsos-pengguna')}}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
						<div class="d-flex justify-content-center mb-3">
							<div class="d-flex head-juduls">
								<svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13 8C13 5.79 11.21 4 9 4C6.79 4 5 5.79 5 8C5 10.21 6.79 12 9 12C11.21 12 13 10.21 13 8ZM11 8C11 9.1 10.1 10 9 10C7.9 10 7 9.1 7 8C7 6.9 7.9 6 9 6C10.1 6 11 6.9 11 8ZM1 18V20H17V18C17 15.34 11.67 14 9 14C6.33 14 1 15.34 1 18ZM3 18C3.2 17.29 6.3 16 9 16C11.69 16 14.78 17.28 15 18H3ZM20 15V12H23V10H20V7H18V10H15V12H18V15H20Z" fill="#0d6efd"></path>
								</svg>
								<h5 style="margin: 0 0 0 5px"> Tambah Pengguna</h5>
							</div>
						</div>
						<hr>
						<form action="" class="kegiatantambah" method="post">
                            @csrf
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="username">Nama</label>
											<input type="text" required name="username" id="nama" class="form-control" placeholder="Cth: Nama" value="{{old('username')}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" required name="email" id="email" class="form-control" placeholder="Cth: Email@email.com" value="{{old('email')}}">
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
									<div class="col-md-6">
										<div class="form-group">
											<label for="role">Tipe</label>
											<select name="role" id="tipe" required onchange="tipes()" class="form-select">
												<option value="" selected disabled>Pilih Tipe</option>
                                                @foreach ($role as $r)
                                                    <option value="{{$r->id}}"  @if (null !== old('role')) @if(old('role') == $r->id) selected="selected" @endif @endif>{{ucwords($r->role)}}</option>
                                                @endforeach
											</select>
										</div>
									</div>
									<div class="col-md-6 d-none" id="akses_modul">
										<div class="form-group">
											<label for="akses_modul">Akses Modul</label>
										</div>
										<div class="d-flex justify-content-between flex-wrap">
											<div class="form-check col-md-6 d-none"  id="master_kepegawaian_top">
												<input class="form-check-input" type="checkbox" value="1" id="master_kepegawaian" name="master_kepegawaian" @if (null !== old('master_kepegawaian')) @if(old('master_kepegawaian')) checked @endif @endif>
												<label class="form-check-label" for="master_kepegawaian">
													Master Kepegawaian
												</label>
											</div>
											<div class="form-check col-md-6 d-none" id="kegiatan_top">
												<input class="form-check-input" type="checkbox" value="1" id="kegiatan" name="kegiatan" @if (null !== old('kegiatan')) @if(old('kegiatan')) checked @endif @endif>
												<label class="form-check-label" for="kegiatan">
													Kegiatan
												</label>
											</div>
											<div class="form-check col-md-6 d-none" id="penerima_bantuan_top">
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
											<div class="form-check col-md-6 d-none" id="data_pendaftar_top">
												<input class="form-check-input" type="checkbox" value="1" id="data_pendaftar" name="data_pendaftar" @if (null !== old('data_pendaftar')) @if(old('data_pendaftar')) checked @endif @endif>
												<label class="form-check-label" for="data_pendaftar">
													Data Pendaftar
												</label>
											</div>
											<div class="form-check col-md-6 d-none" id="master_pengguna_top">
												<input class="form-check-input" type="checkbox" value="1" id="master_pengguna" name="master_pengguna" @if (null !== old('master_pengguna')) @if(old('master_pengguna')) checked @endif @endif>
												<label class="form-check-label" for="master_pengguna">
													Master Pengguna
												</label>
											</div>
										</div>
									</div>
									<div class="col-md-6 d-none" id="pilihan_upt_top">
                                        <div class="form-group">
                                                <label for="upt_id">Nama UPT</label><br>
                                                <select name="upt_id" id="upt_id" class="js-example-basic-single w-100 form-control">
                                                    <option value="" selected disabled>Pilih UPT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                                    @foreach ($upt as $u)
                                                        <option value="{{$u->uuid}}" @if (null !== old('upt_id')) @if(old('upt_id') == $u->uuid) selected="selected" @endif @endif>{{$u->nama}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
									</div>
									<div class="col-md-12 my-4">
										<div class="d-flex justify-content-center">
											<button class="btn btn-success">Tambah</button>
                                            <a style="margin-left: 5px;" href="{{route('dinsos-pengguna')}}" class="btn btn-danger">Batal</a>
										</div>
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
@section('jquery')
	<script>
        $('.js-example-basic-single').select2();
        $(document).ready(function () {
			if(document.getElementById('tipe').value) {
				document.getElementById('akses_modul').classList.remove('d-none')
				if(document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Upt') {
                    upt_id.required = true
                    document.getElementById('master_kepegawaian_top').classList.remove('d-none')
                    document.getElementById('kegiatan_top').classList.remove('d-none')
                    document.getElementById('penerima_bantuan_top').classList.remove('d-none')
                    document.getElementById('data_pendaftar_top').classList.remove('d-none')
                    document.getElementById('pilihan_upt_top').classList.remove('d-none')

                    document.getElementById('data_upt_top').classList.add('d-none')
                    document.getElementById('master_pengguna_top').classList.add('d-none')
                }
                if(document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Pegawai') {
                    upt_id.required = true
                    document.getElementById('kegiatan_top').classList.remove('d-none')
                    document.getElementById('penerima_bantuan_top').classList.remove('d-none')
                    document.getElementById('data_pendaftar_top').classList.remove('d-none')
                    document.getElementById('pilihan_upt_top').classList.remove('d-none')

                    document.getElementById('data_upt_top').classList.add('d-none')
                    document.getElementById('master_pengguna_top').classList.add('d-none')
                    document.getElementById('master_kepegawaian_top').classList.add('d-none')
                }
                if (document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Dinsos') {
                    upt_id.required = false
                    document.getElementById('master_kepegawaian_top').classList.remove('d-none')
                    document.getElementById('kegiatan_top').classList.remove('d-none')
                    document.getElementById('data_upt_top').classList.remove('d-none')
                    document.getElementById('data_pendaftar_top').classList.remove('d-none')
                    document.getElementById('master_pengguna_top').classList.remove('d-none')

                    document.getElementById('pilihan_upt_top').classList.add('d-none')
                    document.getElementById('penerima_bantuan_top').classList.add('d-none')
                }
			}
        })
		function tipes() {
			akses_modul.classList.remove('d-none')
			if(document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Upt') {
				upt_id.required = true
                document.getElementById('master_kepegawaian_top').classList.remove('d-none')
                document.getElementById('kegiatan_top').classList.remove('d-none')
				document.getElementById('penerima_bantuan_top').classList.remove('d-none')
                document.getElementById('data_pendaftar_top').classList.remove('d-none')
				document.getElementById('pilihan_upt_top').classList.remove('d-none')

				document.getElementById('data_upt_top').classList.add('d-none')
				document.getElementById('master_pengguna_top').classList.add('d-none')
			}
            if(document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Pegawai') {
                upt_id.required = true
				document.getElementById('kegiatan_top').classList.remove('d-none')
				document.getElementById('penerima_bantuan_top').classList.remove('d-none')
                document.getElementById('data_pendaftar_top').classList.remove('d-none')
				document.getElementById('pilihan_upt_top').classList.remove('d-none')

				document.getElementById('data_upt_top').classList.add('d-none')
				document.getElementById('master_pengguna_top').classList.add('d-none')
                document.getElementById('master_kepegawaian_top').classList.add('d-none')
            }
			if (document.getElementById('tipe').options[document.getElementById('tipe').selectedIndex].text === 'Dinsos') {
				upt_id.required = false
                document.getElementById('master_kepegawaian_top').classList.remove('d-none')
                document.getElementById('kegiatan_top').classList.remove('d-none')
				document.getElementById('data_upt_top').classList.remove('d-none')
                document.getElementById('data_pendaftar_top').classList.remove('d-none')
				document.getElementById('master_pengguna_top').classList.remove('d-none')

				document.getElementById('pilihan_upt_top').classList.add('d-none')
				document.getElementById('penerima_bantuan_top').classList.add('d-none')
			}
		}
	</script>
@endsection
