@extends('layout.template')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
                            <a href="{{ route('upt-pendaftar-tertunda') }}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
                        <div class="head-judul text-center">
                            <h3>Detail </h3>
                            <hr>
                        </div>
                        <form action="" class="kegiatantambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_lengkap" id="nama" value="{{$pendaftar->nama_lengkap}}" class="form-control" placeholder="Nama Lengkap" required >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nik">NIK <small class="text-danger">*</small></label>
                                                <input type="text" minlength="16" class="form-control" maxlength="16" pattern="{0-9}{0,16}" value="{{$pendaftar->nik}}" name="nik" id="nik" onkeypress='validate(event)' placeholder="NIK" title="Minimum 16 angka" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempatlahir">Tempat Lahir <small class="text-danger">*</small></label>
                                                <input type="text" value="{{$pendaftar->tempat_lahir}}" name="tempat_lahir" id="tempatlahir" placeholder="Tempat Lahir Pasien"
                                                class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggallahir">Tanggal Lahir <small class="text-danger">*</small></label>
                                                <input type="date" value="{{date('Y-m-d', strtotime($pendaftar->tanggal_lahir))}}" name="tanggal_lahir" id="setTodaysDate" class="form-control" required>
                                                <script>
                                                    setTodaysDate.max = new Date().toISOString().split("T")[0];
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="umur">Umur <small class="text-danger">*</small></label>
                                                <input type="number" value="{{$pendaftar->umur}}" name="umur" id="umur" placeholder="Masukkan Umur" class="form-control"
                                                required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jeniskelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                                                <select name="jenis_kelamin" id="jeniskelamin" class="form-select" required>
                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                @foreach($jenis_kelamin as $jk)
                                                    <option value="{{$jk->uuid}}" @if($pendaftar->jenis_kelamin == $jk->uuid) selected @endif>{{$jk->nama}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex flex-column">
                                              <label for="handphone">No. Handphone <small class="text-danger">*</small></label>
                                              <input type="text" title="Harus Diawali Angka 0 dan Minimum 9 angka" pattern="[0][0-9]\d{8,}" value="{{$pendaftar->no_hp}}" name="no_hp" id="handphone" class="form-control" onkeypress='validate(event)'
                                              placeholder="Masukkan Nomor Handphone" required>
                                              {{-- <script>
                                                const phone = document.querySelector('#handphone')
                                                const phoneinput = window.intlTelInput(phone, {
                                                  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                                })
                                              </script> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi <small class="text-danger">*</small></label>
                                                <select name="prov_id" id="provinsi" class="form-select" disabled required>
                                                    <option value="" selected>Pilih Provinsi</option>
                                                    @foreach($provinsi as $p)
                                                        <option value="{{$p->prov_id}}" @if($p->prov_id == '35') selected @endif>{{$p->prov}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kabupaten">Kota / Kabupaten <small class="text-danger">*</small></label>
                                                <select name="kab_id" id="kabupaten" class="form-select" required>
                                                    <option value="" selected>Pilih Kota/Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <small class="text-danger">*</small></label>
                                                <select name="kec_id" id="kecamatan" class="form-select" required>
                                                    <option value="" selected>Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamatlengkap">Alamat Lengkap <small class="text-danger">*</small></label>
                                                <textarea name="alamat" id="alamatlengkap" cols="30" rows="4" class="form-control" placeholder="Masukkan Alamat Lengkap" required>{{$pendaftar->alamat}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenisaduan">Jenis Aduan <small class="text-danger">*</small></label>
                                                <select name="jenis_aduan" id="jenisaduan" class="form-select" required>
                                                    <option value="" selected disabled>Pilih Jenis Aduan</option>
                                                    @foreach ($jenis_aduan as $j)
                                                        <option value="{{$j->uuid}}" @if($pendaftar->jenis_aduan == $j->uuid) selected @endif>{{$j->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row-reverse justify-content-between">
                                                <a href="{{Storage::disk('s3')->temporaryUrl($pendaftar->foto_kondisi, \Carbon\Carbon::now()->addMinutes(3600))}}" data-fancybox="images" data-caption="">
                                                    Lihat
                                                </a>
                                                <label for="fotokondisi">Foto Kondisi <small class="text-danger">*</small></label>
                                            </div>
                                            <input type="file" id="fotokondisi" name="foto_kondisi" data-show-remove="false" class="dropify" data-default-file="{{Storage::disk('s3')->temporaryUrl($pendaftar->foto_kondisi, \Carbon\Carbon::now()->addMinutes(3600))}}" />
                                            <div class="warn">
                                                <small class="text-danger">Jenis File yang diterima : .png .jpg Max file 5mb</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group file-area">
                                                <div class="d-flex flex-row-reverse justify-content-between">
                                                    <a href="{{Storage::disk('s3')->temporaryUrl($pendaftar->foto_kondisi, \Carbon\Carbon::now()->addMinutes(3600))}}" target="_blank">Lihat</a>
                                                    <label for="suratpengantar">Surat Pengantar <small class="text-danger">*</small></label>
                                                </div>
                                                <div style="position: relative">
                                                    <input type="file" name="surat_pengantar" value="{{route('images-getter', ['module' => 'pendaftaran', 'filename' => $pendaftar->surat_pengantar])}}" accept="application/pdf" id="images2" multiple="multiple"/>
                                                    <div class="file-dummy">
                                                        <div class="success">Great, your files are selected. Keep on.</div>
                                                        <div class="default">
                                                            <i class="fas fa-file-pdf" style="color: #1A73E8;font-size: 30px;margin: 10px 0;"></i>
                                                            {{-- <img src="{{asset('assets/images/photo.png')}}" alt=""> --}}
                                                            <p>Unggah Disini</p><p class="text-muted" id="alert-images2">{{$pendaftar->surat_pengantar}}</p></div>
                                                    </div>
                                                </div>
                                                <div class="warn">
                                                    <small class="text-danger">Jenis File yang diterima : .pdf Max file 5mb</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rekomendasi">Rekomendasi Pendaftar <small class="text-danger">*</small></label>
                                                <input required type="text" name="nama_rekomendasi" id="rekomendasi" class="form-control" value="{{$pendaftar->nama_rekomendasi}}" placeholder="Masukkan Nama Perekomendasian">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex flex-column">
                                                <label for="telepom">Telepon <small class="text-danger">*</small></label>
                                                <input required type="text" pattern="[0][0-9]\d{8,}" onkeypress='validate(event)' title="Harus Diawali Angka 0 dan Minimum 9 angka" name="telp_rekomendasi" value="{{$pendaftar->telp_rekomendasi}}" [ng2TelInputOptions]="{initialCountry: 'eg'}" id="telepon" class="form-control" placeholder="Masukkan Nomor Telepon">
                                            </div>
                                            {{-- <script>
                                                const telephone = document.querySelector('#telepon')
                                                const phoneinputs = window.intlTelInput(telephone, {
                                                    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/   intl-tel-input/17.0.8/js/utils.js",
                                                })
                                            </script> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-success mx-3">Edit</button>
                                        <a href="{{route('upt-pendaftar-tertunda')}}" class="btn btn-danger">Batal</a>
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

<script src="{{asset('assets/js/dropify.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });

    })
</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{url('api/kabupaten')}}/35",
            method: "GET",
            success: function(result) {
                $('#kabupaten').find('option')
                    .remove()
                    .end()
                    .append('<option value="">Pilih Kota/Kabupaten</option>');
                $('#kecamatan').find('option')
                    .remove()
                    .end()
                    .append('<option value="">Pilih Kecamatan</option>');
                result.kabupaten.forEach(function(item) {
                    $('#kabupaten').append(`<option value="${item.kab_id}">${item.kab}</option>`);
                });
                document.getElementById('kabupaten').value = {{$pendaftar->kab_id}};
                if(document.getElementById('kabupaten').value) {
                    $.ajax({
                        url: "{{url('api/kecamatan')}}/"+document.getElementById('kabupaten').value,
                        method: "GET",
                        success: function(results) {
                            $('#kecamatan').find('option')
                            .remove()
                            .end()
                            console.log(results)
                            results.kecamatan.forEach(function(items) {
                                $('#kecamatan').append(`<option value="${items.kec_id}">${items.kec}</option>`);
                            });
                            document.getElementById('kecamatan').value = {{$pendaftar->kec_id}}
                        }
                    });
                }
            }
        });

    })
    $('#kabupaten').on('change', function() {
        $.ajax({
            url: "{{url('api/kecamatan')}}/"+this.value,
            method: "GET",
            success: function(result) {
                $('#kecamatan').find('option')
                .remove()
                .end()
                // console.log(result)
                    .append('<option value="" selected>Pilih Kecamatan</option>');
                result.kecamatan.forEach(function(item) {
                    $('#kecamatan').append(`<option value="${item.kec_id}">${item.kec}</option>`);
                });
            }
        });
    });
    $('#images2').on('change', function() {
        document.getElementById('alert-images2').innerHTML = document.getElementById('images2').files[0].name
    })

</script>
@endsection
