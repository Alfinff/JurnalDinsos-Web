@extends('layout.template')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .js-example-basic-single{
            border: none !important;
        }
		.cards{
			border: 1px solid #eceff5;
			border-radius: 5px;
		}
		.profile-img {
			min-width: 170px;
			height: 170px;
			overflow: hidden;
			border-radius: 100px;
		}
		.profile-img img {
			width: 170px;
		}
		.profile-main {
			height: 100%;
		}
		.profile-main .username {
			font-size: 24px;
			font-weight: 800;
			padding-bottom: 10px;
			margin-bottom: 10px;
			position: relative;
			text-align: center
		}
		.profile-margin .job {
			text-align: center
		}
		.profile-margin .status {
			text-align: center
		}
		.profile-main .username::after {
			content: '';
			width: 40px;
			height: 3px;
			background-color: #cbd2dc;
			bottom: 0;
			position: absolute;
			left: 50%;
			transform: translate(-50%, 0);
			border-radius: 20px;
		}
		.profile-main .fas {
			font-size: 17px;
			color: #67a8fb;
			margin-right: 9px;
		}
		.edit-section {
			position: absolute;
			top: 0;
			right: 0;
		}
		.info-sub .icon-profile {
			width: 40px;
			height: 40px;
			background-color: #67a8ff;
			border-radius: 100%;
			color: white;
			margin-right: 10px;
		}
		.info-sub .icon-profile .fas {
			font-size: 20px;
		}
		.info-sub .info {
			opacity: .8;
		}
		.info-sub .title-info {
			width: 80px
		}
		.profile-margin {
			margin-top: 15px;
		}
		.content-profile {
			margin-top: 30px;
			padding-top: 15px;
			border-top: 2px dashed #e6eaef;
		}
		.overlay-photo {
			position: absolute;
			background: #2b2b2bbd;
			width: 170px;
			height: 170px;
			top: 0;
			color: white;
			font-size: 20px;
			cursor: pointer;
		}
		.overlay-photo .fas {
			font-size: 35px;
			margin-bottom: 8px;
		}
        .overlay-photo-upt {
			position: absolute;
			background: #2b2b2bbd;
			width: 170px;
			height: 170px;
			top: 0;
			color: white;
			font-size: 20px;
			cursor: pointer;
		}
		.overlay-photo-upt .fas {
			font-size: 35px;
			margin-bottom: 8px;
		}
		.photo-name {
			margin-top: 10px;
			padding: 4px 15px;
			background-color: #e7ebf1;
			font-size: 14px;
			border-radius: 50px;
			color: #7b7f84;
		}
		.photo-name.error {
			background-color: #ffebeb;
			color: #f94c4c;
		}
        .photo-name-upt {
			margin-top: 10px;
			padding: 4px 15px;
			background-color: #e7ebf1;
			font-size: 14px;
			border-radius: 50px;
			color: #7b7f84;
		}
		.photo-name-upt.error {
			background-color: #ffebeb;
			color: #f94c4c;
		}
	</style>
	<div class="col-lg-10 bg-col">
		<div class="row my-3">
			<div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipeform" value="editprofile">
				<div class="card">
					<div class="card-card">
						<div class="back mb-4">
                            @if(auth()->user()->rolenya->role == 'dinsos')
                                <a href="{{route('dinsos-home')}}" class="d-flex">
                            @elseif((auth()->user()->rolenya->role == 'upt') || (auth()->user()->rolenya->role == 'pegawai'))
							    <a href="{{route('upt-home')}}" class="d-flex">
                            @else
                                <a href="{{url()->previous()}}" class="d-flex">
                            @endif
								 <img src="{{asset('assets/images/back.png')}}" alt="">
								 <p>Kembali</p>
							</a>
					    </div>
						<div class="d-flex justify-content-between align-items-center mb-3">
								{{-- <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M13 8C13 5.79 11.21 4 9 4C6.79 4 5 5.79 5 8C5 10.21 6.79 12 9 12C11.21 12 13 10.21 13 8ZM11 8C11 9.1 10.1 10 9 10C7.9 10 7 9.1 7 8C7 6.9 7.9 6 9 6C10.1 6 11 6.9 11 8ZM1 18V20H17V18C17 15.34 11.67 14 9 14C6.33 14 1 15.34 1 18ZM3 18C3.2 17.29 6.3 16 9 16C11.69 16 14.78 17.28 15 18H3ZM20 15V12H23V10H20V7H18V10H15V12H18V15H20Z" fill="#0d6efd"></path>
								</svg> --}}
							<h5 style="margin: 0 0 0 5px;font-weight: 700"> Profil</h5>
							<button type="button" id="edit" class="btn btn-primary btn-sm d-block">Edit Profil</button>
							<button type="button" id="cancel" class="btn btn-danger btn-sm d-none">Batal</button>
						</div>
						<hr>
                        {{-- {{$user}} --}}
						<div class="cards">
							<div class="card-card">
								<div class="d-flex flex-column align-items-center position-relative">
									<div class="profile-img d-flex align-items-center justify-content-center position-relative">
										<label for="photo">
											@if((!isset($user->profile->photo)) || ($user->profile->photo==null))
												<img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
											@else
												<img src="{{Storage::disk('s3')->temporaryUrl($user->profile->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
											@endif
											<div class="overlay-photo d-none justify-content-center align-items-center flex-column">
												<i class="fas fa-camera"></i>
												<div>Ubah Foto</div>
											</div>
										</label>
									</div>
									<input type="file" name="photo" id="photo" class="d-none" id="photo" disabled>
									<div class="photo-name d-none">Foto belum dipilih.</div>
									<div class="profile-margin">
										<div class="profile-main d-flex align-items-center justify-content-md-start justify-content-center" id="profile">
											<div id="profile-top">
												<div class="username">{{ucwords($user->username)}}</div>
												<div class="job" style="opacity: .8;">{{ucwords($user->email)}}</div>
												<div class="status">
													{{-- <span class="badge rounded-pill {{ucwords($user->email_verified_at) == null ? "bg-danger" : "bg-success"}}">{{ucwords($user->email_verified_at) == null ? "Belum Diverikasi" : "Telah Diverifikasi"}}</span> --}}
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="content-profile">
									<div class="row">
										<div class="col-md-6 d-none">
											<div class="mb-3">
												<label for="username" class="form-label">Username</label>
												<input name="username" type="text" class="form-control" id="username" value="{{$user->username}}" disabled>
											 </div>
										</div>
										<div class="col-md-6 d-none">
											<div class="mb-3">
												<label for="email" class="form-label">Email</label>
												<input name="email" type="text" class="form-control" id="email" value="{{$user->email}}" disabled>
											 </div>
										</div>
                                        @if ($user->rolenya->role=='pegawai')
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                                    <select name="gender" class="form-select" id="jk" aria-label="Default select example" disabled>
                                                        <option disabled selected>Pilih Jenis Kelamin</option>
                                                        <option value="1" @if(isset($user->profile->gender)) @if($user->profile->gender == 1) selected="selected" @endif @endif>Laki-Laki</option>
                                                        <option value="2" @if(isset($user->profile->gender)) @if($user->profile->gender == 2) selected="selected" @endif @endif>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
										<div class="col-md-6">
											<div class="mb-3">
												<label for="telp" class="form-label">Nomor Telepon</label>
												<input name="phone" type="number" class="form-control" id="telp" @if(isset($user->profile->phone)) value="{{ucwords($user->profile->phone)}}" @endif disabled>
											 </div>
										</div>
										<div class="col-12">
											<div class="mb-3">
												<label for="alamt" class="form-label">Alamat</label>
												<textarea name="address" class="form-control" id="alamat" rows="3" disabled>@if(isset($user->profile->address)) {{ucwords($user->profile->address)}} @endif</textarea>
											 </div>
										</div>
									</div>
								</div>
								<center>
									<button type="submit" id="btnSubmit" class="btn btn-primary btn-sm d-none">Simpan</button>
								</center>
							</div>
						</div>
					</div>
				</div>
                </form>
			</div>
		</div>
        @if ($user->rolenya->role=='upt')
		<div class="row my-3">
			<div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tipeform" value="editupt">
				<div class="card">
					<div class="card-card">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h5 style="margin: 0 0 0 5px;font-weight: 700"> Data Upt</h5>
							<button type="button" id="editupt" class="btn btn-primary btn-sm d-block">Edit Data Upt</button>
							<button type="button" id="cancelupt" class="btn btn-danger btn-sm d-none">Batal</button>
						</div>
						<hr>
						<div class="cards">
							<div class="card-card">
								<div class="d-flex flex-column align-items-center position-relative">
									<div class="profile-img d-flex align-items-center justify-content-center position-relative">
										<label for="photoupt">
											@if((!isset($upt->foto)) || ($upt->foto == null))
												<img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
											@else
												<img src="{{Storage::disk('s3')->temporaryUrl($upt->foto, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
											@endif
											<div class="overlay-photo-upt d-none justify-content-center align-items-center flex-column">
												<i class="fas fa-camera"></i>
												<div>Ubah Foto</div>
											</div>
										</label>
									</div>
									<input type="file" name="photoupt" id="photoupt" class="d-none" disabled>
									<div class="photo-name-upt d-none">Foto belum dipilih.</div>
									<div class="profile-margin">
										<div class="profile-main d-flex align-items-center justify-content-md-start justify-content-center" id="profileupt">
											<div id="profile-top">
												<div class="username">{{ucwords($upt->nama)}}</div>
											</div>
										</div>
									</div>
								</div>
								<div class="content-profile">
									<div class="row">
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_upt">Nama UPT <small class="text-danger">*</small></label>
                                                <input type="text" value="{{$upt->nama}}" name="nama_upt" id="nama_upt" class="form-control" placeholder="Cth: UPT Jawa Timur" disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mapsupt">Maps</label>
                                                <input type="text" value="{{$upt->maps}}" name="mapsupt" id="mapsupt" class="form-control" placeholder="https://goo.gl/maps/vSpPY6uKnXpwqs9d6" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wilayah">Wilayah <small class="text-danger">*</small></label>
                                                <select name="wilayah" disabled required id="wilayahd" class="js-example-basic-single w-100 form-select">
                                                </select>
                                            </div>
                                        </div>
										<div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenisupt">Jenis Upt <small class="text-danger">*</small></label>
                                                <select name="jenisupt" disabled required id="jenisupt" class="js-example-basic-single w-100 form-select">
                                                    @foreach ($jenisupt as $jj)
                                                        <option value="{{$jj->uuid}}" @if($upt->jenis_upt == $jj->uuid) selected="selected" @endif>{{ucwords($jj->nama)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_lengkap">Alamat Lengkap <small class="text-danger">*</small></label>
                                                <textarea name="alamat_lengkap" disabled required id="alamat_lengkap" class="form-control" cols="30" rows="3" placeholder="Cth: Jl.Gayung Kebonsari No.56">{{$upt->alamat}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deskripsiupt">Deskripsi</label>
                                                <textarea name="deskripsiupt" disabled id="deskripsiupt" class="form-control" cols="30" rows="3">{{$upt->deskripsi}}</textarea>
                                            </div>
                                        </div>
									</div>
								</div>
                                <br>
								<center>
									<button type="submit" id="btnSubmitUpt" class="btn btn-primary btn-sm d-none">Simpan Data Upt</button>
								</center>
							</div>
						</div>
					</div>
				</div>
                </form>
			</div>
		</div>
        @endif
	</div>
@endsection
@section('jquery')
    <script src="{{asset('assets/js/dropify.js')}}"></script>
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

        $.ajax({
            url: "{{url('api/kabupaten')}}/35",
            method: "GET",
            success: function(result) {
                console.log(result)
              $('#wilayahd').find('option')
                .remove()
                .end()
                .append('<option value="" disabled>Pilih Kota/Kabupaten</option>');
              result.kabupaten.forEach(function(item) {
                //   console.log(item.kab_id)
                $('#wilayahd').append(`<option value="${item.kab_id}">${item.kab}</option>`);
              });
              document.getElementById('wilayahd').value = {{$upt->wilayah ?? '1'}};
            }
        });

		$('#photo').change(function(){
			var url = $(this).val();
			var filename = url.split('\\').pop();

			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (ext == "png" || ext == "jpeg" || ext == "jpg") {
				if (filename == '') {
					$(".photo-name").html("Foto belum dipilih.");
					$(".photo-name").removeClass("error");
				} else {
					$(".photo-name").html(filename);
					$(".photo-name").removeClass("error");
				}
			} else {
				$(".photo-name").html("File harus berformat .png / .jpeg / .jpg.");
				$(this).val('');
				$(".photo-name").addClass("error");
			}
		});

        $('#photoupt').change(function(){
			var url = $(this).val();
			var filename = url.split('\\').pop();

			var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
			if (ext == "png" || ext == "jpeg" || ext == "jpg") {
				if (filename == '') {
					$(".photo-name-upt").html("Foto belum dipilih.");
					$(".photo-name-upt").removeClass("error");
				} else {
					$(".photo-name-upt").html(filename);
					$(".photo-name-upt").removeClass("error");
				}
			} else {
				$(".photo-name-upt").html("File harus berformat .png / .jpeg / .jpg.");
				$(this).val('');
				$(".photo-name-upt").addClass("error");
			}
		});

		$("#edit").click(function() {
			$("#edit").removeClass("d-block").addClass("d-none");
			$(".photo-name").removeClass("d-none").addClass("d-block");
			$("#cancel").removeClass("d-none").addClass("d-block");
			$("#btnSubmit").removeClass("d-none").addClass("d-block");
			$(".overlay-photo").removeClass("d-none").addClass("d-flex");

			$("#photo").removeAttr('disabled');
			$("#jk").removeAttr('disabled');
			$("#telp").removeAttr('disabled');
			$("#alamat").removeAttr('disabled');
		});

		$("#cancel").click(function() {
			$("#cancel").removeClass("d-block").addClass("d-none");
			$(".photo-name").removeClass("d-block").addClass("d-none");
			$("#edit").removeClass("d-none").addClass("d-block");
			$("#btnSubmit").removeClass("d-block").addClass("d-none");
			$(".overlay-photo").removeClass("d-flex").addClass("d-none");

			$("#photo").attr('disabled','disabled');
			$("#jk").attr('disabled','disabled');
			$("#telp").attr('disabled','disabled');
			$("#alamat").attr('disabled','disabled');
		});

        $("#editupt").click(function() {
			$("#editupt").removeClass("d-block").addClass("d-none");
			$("#cancelupt").removeClass("d-none").addClass("d-block");
			$("#btnSubmitUpt").removeClass("d-none").addClass("d-block");
			$(".photo-name-upt").removeClass("d-none").addClass("d-block");
			$(".overlay-photo-upt").removeClass("d-none").addClass("d-flex");

			$("#photoupt").removeAttr('disabled');
			$("#nama_upt").removeAttr('disabled');
			$("#wilayahd").removeAttr('disabled');
			$("#alamat_lengkap").removeAttr('disabled');
            $("#jenisupt").removeAttr('disabled');
            $("#deskripsiupt").removeAttr('disabled');
            $("#mapsupt").removeAttr('disabled');
		});

		$("#cancelupt").click(function() {
			$("#cancelupt").removeClass("d-block").addClass("d-none");
			$("#editupt").removeClass("d-none").addClass("d-block");
			$("#btnSubmitUpt").removeClass("d-block").addClass("d-none");
			$(".photo-name-upt").removeClass("d-block").addClass("d-none");
			$(".overlay-photo-upt").removeClass("d-flex").addClass("d-none");

			$("#photoupt").attr('disabled','disabled');
			$("#nama_upt").attr('disabled','disabled');
			$("#wilayahd").attr('disabled','disabled');
			$("#alamat_lengkap").attr('disabled','disabled');
            $("#jenisupt").attr('disabled','disabled');
            $("#deskripsiupt").attr('disabled','disabled');
            $("#mapsupt").attr('disabled','disabled');
		});
	})
</script>
@endsection
