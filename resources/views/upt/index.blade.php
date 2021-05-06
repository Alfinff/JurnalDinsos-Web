@extends('layout.template')
@section('content')
<style>
  .kegiatantambah .col-md-6, .kegiatantambah .col-md-12 {
    margin-bottom: 15px;
  }
  .kegiatantambah label{
    font-weight: 700;
    font-size: 14px;
    color: rgba(40, 40, 40, 1);
    margin-bottom: 10px;
  }
  .kegiatantambah input::placeholder, .kegiatantambah textarea{
    color: rgba(195, 195, 195, 1);
    font-weight: 400;
    font-size: 14px;
  }
  .overlay-modal{
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #ddd;
    opacity: .6;
    position: absolute;
  }
  .head-judul2{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Klien</h3>
          </div>
          <form action="" class="data-pendaftar">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cariklien">Cari Klien</label>
                  <input type="text" name="cariklien" id="cariklien" class="form-control" placeholder="Cari Klien">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="tanggalmasuk">Tanggal Masuk</label>
                  <input type="date" name="tanggalmasuk" id="tanggalmasuk" placeholder="Tanggal Masuk" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" onclick="openModalTambah()">Tambah</button>
          </div>
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
              <th>Tanggal Masuk</th>
              <th>Nama</th>
              <th>TTL</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
            </thead>


            <tbody>
            <tr>
                <td>29 Des 2020</td>
                <td>Supilan</td>
                <td>Blitar, 23 Feb 1948</td>
                <td>Ds.Sumber Kec. Sanankulon  Kab.Blitar</td>
                <td>
                  <div class="aksi-button">
                    <a href="#">
                      <i class="fa fa-edit" style="color: #9ba7ca;" title="Edit"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-trash" style="color: #ef4d56;" title="Delete"></i>
                    </a>
                  </div>
                </td>
            </tr>
            <tr>
                <td>29 Des 2020</td>
                <td>Supilan</td>
                <td>Blitar, 23 Feb 1948</td>
                <td>Ds.Sumber Kec. Sanankulon  Kab.Blitar</td>
                <td>
                  <div class="aksi-button">
                    <a href="#">
                      <i class="fa fa-edit" style="color: #9ba7ca;" title="Edit"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-trash" style="color: #ef4d56;" title="Delete"></i>
                    </a>
                  </div>
                </td>
            </tr>
            <tr>
                <td>29 Des 2020</td>
                <td>Supilan</td>
                <td>Blitar, 23 Feb 1948</td>
                <td>Ds.Sumber Kec. Sanankulon  Kab.Blitar</td>
                <td>
                  <div class="aksi-button">
                    <a href="#">
                      <i class="fa fa-edit" style="color: #9ba7ca;" title="Edit"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-trash" style="color: #ef4d56;" title="Delete"></i>
                    </a>
                  </div>
                </td>
            </tr>
            <tr>
                <td>29 Des 2020</td>
                <td>Supilan</td>
                <td>Blitar, 23 Feb 1948</td>
                <td>Ds.Sumber Kec. Sanankulon  Kab.Blitar</td>
                <td>
                  <div class="aksi-button">
                    <a href="#">
                      <i class="fa fa-edit" style="color: #9ba7ca;" title="Edit"></i>
                    </a>
                    <a href="#">
                      <i class="fa fa-trash" style="color: #ef4d56;" title="Delete"></i>
                    </a>
                  </div>
                </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modalTambah">
  <div class="overlay-modal"></div>
  <div class="row align-items-center justify-content-center h-100">
    <div class="col-md-9">
      <div class="card">
        <div class="card-card">
          <div class="head-judul2">
            <h3>Form Kegiatan</h3>
            <button onclick="closeModalEdit()" class="btn"><i class="fa fa-times"></i></button>
          </div>
          <hr>
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
<script>
  $(document).ready(function() {
    $('#datatable').DataTable()
  })
</script>
<script>
  function openModalTambah() {
    document.getElementById('modalTambah').style.display = 'block';
  }
  function closeModalEdit() {
    document.getElementById('modalTambah').style.display = 'none';
  }
</script>
@endsection
