@extends('layout.template')
@section('content')
<style>
    tr th {
        width: calc(100% / 6);
        max-width: calc(100% / 6);
    }
    tr td{
        width: calc(100% / 6);
        max-width: calc(100% / 6);
    }
    #datatable{
        width: 100%;
    }
    #datatable th{
        width: 300px !important;
        max-width: 300px !important;
    }
    #datatable td{
        width: 300px;
        /* max-width: 15% !important; */
    }
</style>
<div class="col-md-10 bg-col">
  <div class="row">
    {{-- <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Pendaftar</h3>
          </div>
          <form action="" class="data-pendaftar">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cariklien">Cari Pendaftar</label>
                  <input type="text" name="cariklien" id="cariklien" class="form-control" placeholder="Cari Pendaftar">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> --}}
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="d-flex justify-content-end mb-3">
            <a href="{{route('tambah-klien')}}" class="btn btn-primary">Tambah</a>
          </div>
          <div style="overflow-y: auto">
            <table id="datatable" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <colgroup>
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
                <col span="1" style="width: 15%;">
              </colgroup>             
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
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
  function dropdowns() {
    document.getElementById("dropdownMenuButton").classList.toggle("show");
  }
</script>

<script>
  function openModalTambah() {
    document.getElementById('modalTambah').style.display = 'block';
  }
  function closeModalEdit() {
    document.getElementById('modalTambah').style.display = 'none';
  }
  @if(\Session::has('msg'))
    alert("{!! \Session::get('msg') !!}");
  @endif

</script>

@endsection
@section('jquery')
  <script>
    $(document).ready(function() {
      $('#datatable').DataTable({
        order: [],
        "columnDefs": [
          { "width": "20%", "targets": 0 }
        ]
      });
    })
  </script>

@endsection
