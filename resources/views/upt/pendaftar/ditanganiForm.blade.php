@extends('layout.template')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
{{-- {{dd($pendaftar)}} --}}
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
                            <a href="{{ url()->previous() }}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
                        <div class="head-judul text-center">
                            <h3>Form Penerima Manfaat</h3>
                            <hr>
                        </div>
                        <form action="" class="kegiatantambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nomorregistrasi">Nomor Registrasi <small class="text-danger">*</small></label>
                                                <input type="text" name="nomor_registrasi" id="nomorregistrasi" value="{{$pendaftar->nomor_registrasi}}" class="form-control" placeholder="Masukkan Nomor Registrasi" required >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_lengkap" id="nama" value="{{$pendaftar->nama_lengkap}}" class="form-control" placeholder="Nama Lengkap" required >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nik">NIK <small class="text-danger">*</small></label>
                                                <input type="text" minlength="16" class="form-control" maxlength="16" pattern="[0-9]{0,16}" value="{{(int)$pendaftar->nik}}" name="nik" id="nik" onkeypress='validate(event)' placeholder="NIK" required >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempatlahir">Tempat Lahir <small class="text-danger">*</small></label>
                                                <input type="text" value="{{$pendaftar->tempat_lahir}}" name="tempat_lahir" id="tempatlahir" placeholder="Tempat Lahir Pasien"
                                                class="form-control" required >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggallahir">Tanggal Lahir <small class="text-danger">*</small></label>
                                                <input type="date" value="{{date('Y-m-d', strtotime($pendaftar->tanggal_lahir))}}" name="tanggal_lahir" id="setTodaysDate" class="form-control" required >
                                                <script>
                                                    setTodaysDate.max = new Date().toISOString().split("T")[0];
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="umur">Umur <small class="text-danger">*</small></label>
                                                <input type="number" value="{{$pendaftar->umur}}" name="umur" id="umur" placeholder="Masukkan Umur" class="form-control"
                                                required >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jeniskelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                                                <select name="jenis_kelamin" id="jeniskelamin" class="form-select" required >
                                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="L" @if($pendaftar->jenis_kelamin == "L") selected @endif>Laki Laki</option>
                                                <option value="P" @if($pendaftar->jenis_kelamin == "P") selected @endif>Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex flex-column">
                                              <label for="handphone">No. Handphone <small class="text-danger">*</small></label>
                                              <input type="text" onkeypress='validate(event)' pattern="[0][0-9]{9,}" value="{{$pendaftar->no_hp}}" title="Harus Diawali Angka 0 dan Minimum 9 angka" name="no_hp" id="handphone" class="form-control"
                                              placeholder="Masukkan Nomor Handphone" required >
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
                                                <select name="kab_id" id="kabupaten" class="form-select" required >
                                                    <option value="" selected>Pilih Kota/Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan <small class="text-danger">*</small></label>
                                                <select name="kec_id" id="kecamatan" class="form-select" required >
                                                    <option value="" selected>Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamatlengkap">Alamat Lengkap <small class="text-danger">*</small></label>
                                                <textarea name="alamat" id="alamatlengkap" cols="30" rows="4" class="form-control" placeholder="Masukkan Alamat Lengkap" required >{{$pendaftar->alamat}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalmasuk">Tanggal Masuk <small class="text-danger">*</small></label>
                                                <input type="date" name="tanggal_masuk" id="tanggalmasuk" class="form-control" required value="{{date('Y-m-d', strtotime($pendaftar->tanggal_masuk))}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalkeluar">Tanggal Keluar <small class="text-danger">*</small></label>
                                                <input type="date" name="tanggal_keluar" id="tanggalkeluar" class="form-control" required value="{{date('Y-m-d', strtotime($pendaftar->tanggal_masuk))}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="permasalahan">Permasalahan <small class="text-danger">*</small></label>
                                                <select name="permasalahan" id="permasalahan" class="form-select" required>
                                                    <option value="" selected disabled>Pilih Permasalahan</option>
                                                    @foreach ($permasalahan as $item)
                                                        <option value="{{$item->uuid}}" @if($pendaftar->permasalahan == $item->uuid) selected @endif>{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group file-area">
                                                <div class="d-flex flex-row-reverse justify-content-between">
                                                    <a href="{{Storage::disk('s3')->temporaryUrl($pendaftar->foto_kondisi, \Carbon\Carbon::now()->addMinutes(3600))}}" data-fancybox="images" data-caption="">
                                                        Lihat
                                                    </a>
                                                    <label for="foto_kondisi">Foto Kondisi <small class="text-danger">*</small></label>
                                                </div>
                                                <input type="file" id="foto_kondisi" name="foto_kondisi" data-show-remove="false" class="dropify" data-default-file="{{Storage::disk('s3')->temporaryUrl($pendaftar->foto_kondisi, \Carbon\Carbon::now()->addMinutes(3600))}}" />
                                                <div class="warn">
                                                    <small class="text-danger">Jenis File yang diterima : .jpg dan .png Max File 5mb</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group file-area">
                                                <div class="d-flex flex-row-reverse justify-content-between">
                                                    <a href="{{Storage::disk('s3')->temporaryUrl($pendaftar->surat_pengantar, \Carbon\Carbon::now()->addMinutes(3600))}}" target="_blank">Lihat</a>
                                                    <label for="surat_pengantar">Surat Pengantar <small class="text-danger">*</small></label>
                                                </div>
                                                <div style="position: relative">
                                                    <input type="file" name="surat_pengantar" value="{{Storage::disk('s3')->temporaryUrl($pendaftar->surat_pengantar, \Carbon\Carbon::now()->addMinutes(3600))}}" accept="application/pdf" id="surat_pengantar" multiple="multiple"/>
                                                    <div class="file-dummy">
                                                        <div class="success">Great.</div>
                                                        <div class="default">
                                                            <i class="fas fa-file-pdf" style="color: #1A73E8;font-size: 30px;margin: 10px 0;"></i>
                                                            {{-- <img src="{{asset('assets/images/photo.png')}}" alt=""> --}}
                                                            <p>Unggah Disini</p>
                                                            <p class="text-muted" id="alert-images2">{{$pendaftar->surat_pengantar}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="warn">
                                                    <small class="text-danger">Jenis File yang diterima : .pdf Max File 5mb</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rekomendasi">Rekomendasi Pendaftar <small class="text-danger">*</small></label>
                                                <input type="text" name="nama_rekomendasi" id="rekomendasi" class="form-control" value="{{$pendaftar->nama_rekomendasi}}" placeholder="Masukkan Nama Perekomendasian" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex flex-column">
                                                <label for="telepon">Telepon <small class="text-danger">*</small></label>
                                                <input type="text" pattern="[0][0-9]{9,}" name="telp_rekomendasi" title="Harus Diawali Angka 0 dan Minimum 9 angka" onkeypress='validate(event)' value="{{$pendaftar->telp_rekomendasi}}" [ng2TelInputOptions]="{initialCountry: 'eg'}" id="telepon" class="form-control" placeholder="Masukkan Nomor Telepon" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pendamping">Petugas Pendamping <small class="text-danger">*</small></label>
                                                <select name="pendamping" id="jenisaduan" class="form-select" required>
                                                    <option value="" selected disabled>Pilih Pendamping</option>
                                                    @foreach ($users as $u)
                                                        <option value="{{$u->uuid}}" @if($pendaftar->pendamping == $u->uuid) selected @endif>{{ucwords($u->username)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="d-flex justify-content-center actionnya">
                                        <button class="btn btn-success" type="submit" style="width: auto;">Simpan</button>
                                        <a href="{{route('upt-pendaftar-dihubungi')}}" class="btn btn-danger">Batal</a>
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
    $('#surat_pengantar').on('change', function() {
        document.getElementById('alert-images2').innerHTML = document.getElementById('surat_pengantar').files[0].name
    })
    $(document).ready(function() {
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
</script>

@endsection
