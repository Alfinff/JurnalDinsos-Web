@extends('layout.template')
@section('content')
<style>
    tr th{
        width: calc(100% / 6);
        border: 1px solid #ddd;
    }
    tr td{
        border: 1px solid #ddd;
    }
</style>
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Karyawan</h3>
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
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="akhiraktif">Tanggal Terakhir Aktif</label>
                  <input type="date" name="akhiraktif" id="akhiraktif" placeholder="Tanggal Terakhir Aktif" class="form-control">
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
            <button class="btn btn-success">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2ZM15.8 20H14L12 16.6L10 20H8.2L11.1 15.5L8.2 11H10L12 14.4L14 11H15.8L12.9 15.5L15.8 20ZM13 9V3.5L18.5 9H13Z" fill="white"/>
              </svg>
              Eksport Excel
            </button>
          </div>
          <table id="datatable" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
              <th>Nama</th>
              <th>No Reg</th>
              <th>TTL</th>
              <th>Daerah Asal</th>
              <th>UPT</th>
              <th>Jabatan</th>
            </tr>
            </thead>


            <tbody>
            <tr>
                <td>DIMAS PANJI</td>
                <td>381</td>
                <td>Surabaya, 12 September 2015</td>
                <td>Kediri</td>
                <td>UPT BLITAR</td>
                <td>
                    Kepala
                  <!-- <div class="d-flex justify-content-start">
                    <button class="btn btn-primary" >Login</button>
                  </div> -->
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