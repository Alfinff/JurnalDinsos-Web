{{--
@extends('navigationUPT')
@section('content')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul2">
            <h3>Form Tambah Klien</h3>
            <hr>
          </div>a
          <form action="" class="kegiatantambah" method="POST">
              @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" name="nama" id="nama" class="form-control" value="Nama Klien">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalmasuk">Tanggal Masuk</label>
                      <input type="date" name="tanggal_masuk" id="tanggalmasuk" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalkeluar">Tanggal Keluar</label>
                      <input type="date" name="tanggal_keluar" id="tanggalkeluar" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nomorregistrasi">Nomor Registrasi</label>
                      <input type="text" name="nomor_registrasi" id="nomorregistrasi" class="form-control" placeholder="Nomor Registrasi">  
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tempatlahir">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" id="tempatlahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggallahir">Tanggal Lahir</label>
                      <input type="date" name="tanggal_lahir" id="tanggallahir" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select name="prov_id" id="provinsi" class="form-control">
                      <option value="">Pilih Provinsi</option>
                      @foreach($provinsi as $p)
                          <option value="{{$p->prov_id}}">{{$p->prov}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kabupaten">Kota / Kabupaten</label>
                    <select name="kab_id" id="kabupaten" class="form-control">
                      <option value="">Pilih Kabupaten</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kec_id" id="kecamatan" class="form-control">
                      <option value="">Kecamatan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" placeholder="Alamat"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-5">
                <center>
                  <button class="btn btn-success " style="background-color: #12C58E;border-color: #12C58E;">Tambah</button>
                  <a href="{{route('upt-klien')}}" class="btn btn-danger">Batal</a>    
                </center>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{url('api/provinsi')}}",
            method: "GET",
            success: function(result) {
                console.log(result);
            }
        });

        // Apabila provinsi diganti maka list kabupaten berganti
        $('#provinsi').on('change', function() {
            $.ajax({
                url: "{{url('api/kabupaten')}}/"+this.value,
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
                }
            });
        });

        $('#kabupaten').on('change', function() {
            $.ajax({
                url: "{{url('api/kecamatan')}}/"+this.value,
                method: "GET",
                success: function(result) {
                    $('#kecamatan').find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Kecamatan</option>');
                    result.kecamatan.forEach(function(item) {
                        $('#kecamatan').append(`<option value="${item.kec_id}">${item.kec}</option>`);
                    });
                }
            });
        });
    });
@if(\Session::has('msg'))
    alert("{!! \Session::get('msg') !!}");
@endif
</script>
@endsection
  --}}
  @extends('layout.template')
@section('content')
    <div class="col-md-10 bg-col">
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
                        <form action="" class="kegiatantambah">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nomorregistrasi">Nomor Registrasi</label>
                                                <input type="text" name="nomorregistrasi" id="nomorregistrasi" class="form-control" placeholder="Masukkan Nomor Registrasi" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nik">Nik</label>
                                                <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tempatlahir">Tempat Lahir</label>
                                                <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggallahir">Tanggal Lahir</label>
                                                <input type="date" name="tanggallahir" id="tanggallahir" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="umur">Umur</label>
                                                <input type="number" name="umur" id="umur" class="form-control" placeholder="Masukkan Umur">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jeniskelamin">Jenis Kelamin</label>
                                                <select name="jeniskelamin" id="jeniskelamin" class="form-select">
                                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="provinsi">Provinsi</label>
                                                <select name="provinsi" id="provinsi" class="form-select">
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    @foreach($provinsi as $p)
                                                        <option value="{{$p->prov_id}}">{{$p->prov}}</option>
                                                    @endforeach
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kota">Kota/Kabupaten</label>
                                                <select name="kota" id="kabupaten" class="form-select">
                                                    <option value="" selected disabled>Pilih Kota/Kabupaten</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="kecamatan">Kecamatan</label>
                                                <select name="kecamatan" id="kecamatan" class="form-select">
                                                    <option value="" selected disabled>Pilih Kecamatan</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="alamat">Alamat Lengkap</label>
                                                <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="4" placeholder="Masukkan Alamat Lengkap"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalmasuk">Tanggal Masuk</label>
                                                <input type="date" name="tanggalmasuk" id="tanggalmasuk" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalkeluar">Tanggal Keluar</label>
                                                <input type="date" name="tanggalkeluar" id="tanggalkeluar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="permasalahan">Permasalahan</label>
                                                <select name="permasalahan" id="permasalahan" class="form-select">
                                                    <option value="" selected disabled>Pilih Permasalahan</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group file-area">
                                                <label for="fotokondisi">Foto Kondisi</label>
                                                <input type="file" name="fotokondisi" id="fotokondisi" multiple="multiple"/>
                                                <div class="file-dummy">
                                                    <div class="success">Great.</div>
                                                    <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p></div>
                                                </div>
                                                <div class="warn">
                                                    <p class="text-muted">Jenis File yang diterima : .jpg dan .png saja</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group file-area">
                                                <label for="suratpengantar">Surat Pengantar</label>
                                                <input type="file" name="suratpengantar" id="suratpengantar" multiple="multiple"/>
                                                <div class="file-dummy">
                                                    <div class="success">Great.</div>
                                                    <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p></div>
                                                </div>
                                                <div class="warn">
                                                    <p class="text-muted">Jenis File yang diterima : .pdf</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="rekomendasi">Rekomendasi Pendaftar</label>
                                                <input type="text" name="rekomendasi" id="rekomendasi" class="form-control" placeholder="Masukkan Nama Perekomendasi">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="pendamping">Petugas pendamping</label>
                                                <select name="pendamping" id="pendamping" class="form-select">
                                                    <option value="" selected disabled>Pilih Nama Pendamping</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="jenispengaduan">Jenis Pengaduan</label>
                                                <input type="text" name="jenispengaduan" id="jenispengaduan" class="form-control" placeholder="Masukkan Jenis Pengaduan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <div class="d-flex justify-content-center actionnya">
                                        <button class="btn btn-success" type="submit">Tambah</button>
                                        <a href="{{route('upt-penerima-manfaat')}}" class="btn btn-danger">Batal</a>
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
    $(document).ready(function() {
        $.ajax({
            url: "{{url('api/provinsi')}}",
            method: "GET",
            success: function(result) {
                console.log(result);
            }
        });

        // Apabila provinsi diganti maka list kabupaten berganti
        $('#provinsi').on('change', function() {
            $.ajax({
                url: "{{url('api/kabupaten')}}/"+this.value,
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
                }
            });
        });

        $('#kabupaten').on('change', function() {
            $.ajax({
                url: "{{url('api/kecamatan')}}/"+this.value,
                method: "GET",
                success: function(result) {
                    $('#kecamatan').find('option')
                        .remove()
                        .end()
                        .append('<option value="">Pilih Kecamatan</option>');
                    result.kecamatan.forEach(function(item) {
                        $('#kecamatan').append(`<option value="${item.kec_id}">${item.kec}</option>`);
                    });
                }
            });
        });
    });
@if(\Session::has('msg'))
    alert("{!! \Session::get('msg') !!}");
@endif
</script>

@endsection