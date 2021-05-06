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
          </div>
          <form action="" class="kegiatantambah">
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
                      <label for="nomorregistrasi">Nomor Registrasi</label>
                      <input type="text" name="nomorregistrasi" id="nomorregistrasi" class="form-control" placeholder="Nomor Registrasi">  
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
                      <input type="date" name="tanggallahir" id="tanggallahir" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <select name="provinsi" id="provinsi" class="form-control">
                      <option value="">Pilih Provinsi</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kabupaten">Kota / Kabupaten</label>
                    <select name="kabupaten" id="kabupaten" class="form-control">
                      <option value="">Pilih Kabupaten</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <select name="kecamatan" id="kecamatan" class="form-control">
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
                  <button class="btn btn-danger">Batal</button>    
                </center>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection