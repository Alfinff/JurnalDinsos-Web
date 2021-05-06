@extends('navigation')
@section('content')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Pendaftar</h3>
          </div>
          <form action="" class="data-pendaftar">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="daftarupt">Pilih UPT</label>
                  <select name="daftarupt" id="daftarupt" class="form-select">
                    <option value="" selected>Daftar UPT</option>
                    <option value="1">Daftar UPT</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="caripendaftar">Cari Pendaftar</label>
                  <input type="text" name="caripendaftar" id="caripendaftar" class="form-control" placeholder="Cari Pendaftar">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="awaldaftar">Tanggal Awal Daftar</label>
                  <input type="date" name="awaldaftar" id="awaldaftar" placeholder="Tanggal Awal Daftar" class="form-control">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="akhirdaftar">Tanggal Akhir Daftar</label>
                  <input type="date" name="akhirdaftar" id="akhirdaftar" placeholder="Tanggal Akhir Daftar" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-card">
          <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary">Eksport Excel</button>
          </div>
          <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Instansi</th>
              <th>Aksi</th>
            </tr>
            </thead>


            <tbody>
            <tr>
                <td>1 Maret 2021</td>
                <td>System Architect</td>
                <td>Kabid</td>
                <td>UPT BLK Surabaya</td>
                <td class="text-center">
                  <div class="d-flex justify-content-center">
                    <button class="btn btn-success" style="background-color: #12C58E;border-color: #12C58E;">Login</button>
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
@endsection