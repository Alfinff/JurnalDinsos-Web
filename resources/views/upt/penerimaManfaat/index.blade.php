@extends('layout.template')
@section('content')
<style>
    .btn{
        padding: 5px 10px;
    }
    .aksi-button a{
        width: 46px;
    }
    table.dataTable>thead .sorting:before, table.dataTable>thead .sorting:after, table.dataTable>thead .sorting_asc:before, table.dataTable>thead .sorting_asc:after, table.dataTable>thead .sorting_desc:before, table.dataTable>thead .sorting_desc:after, table.dataTable>thead .sorting_asc_disabled:before, table.dataTable>thead .sorting_asc_disabled:after, table.dataTable>thead .sorting_desc_disabled:before, table.dataTable>thead .sorting_desc_disabled:after{
        bottom: 1rem !important;
    }
    tr th{
        text-align: center;
        padding: 1rem .5rem !important;
        font-style: 14px !important;
        font-weight: 700 !important;
        color: #282828 !important;
    }
    .table .thead-dark th{
        color: #fff;
        background-color: #435177;
        border-color: #51628f;
    }
</style>
<div class="col-md-10 bg-col">
  <div class="row">
    {{-- <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Penerima Bantuan</h3>
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
    </div> --}}
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="d-flex justify-content-between mb-3">
                <div class="head-juduls">
                    <h5><i class="fa fa-users text-primary"></i> Data Penerima Manfaat</h5>
                </div>
            </div>
            <hr>
          <table id="upt-Penerima-Bantuan" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Masuk</th>
                    <th>TTL</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
              <div class="d-flex justify-content-between mb-3">
                  <div class="head-juduls">
                      <h5><i class="fa fa-history text-primary"></i> Data History Penerima Manfaat</h5>
                  </div>
              </div>
              <hr>
            <table id="upt-History-Penerima-Bantuan" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                  <tr>
                      <th>Nama</th>
                      <th>Tanggal Masuk</th>
                      <th>TTL</th>
                      <th>Alamat</th>
                      <th>Status</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
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
@if(\Session::has('msg'))
    alert("{!! \Session::get('msg') !!}");
@endif

</script>
@endsection
@section('jquery')
    <script>
        $(function() {
            $('#upt-Penerima-Bantuan').DataTable({
                processing: true,
                // serverSide: true,
                ajax: '{{URL::to('/upt/penerima/data')}}',
                columns:[
                    {data:'nama_lengkap', name:'Nama'},
                    {data:'tanggal_masuk', name:'Tanggal Masuk'},
                    {data:'ttl', name:'TTL'},
                    {data:'alamat', name:'Alamat'},
                    {data:'tindakanstatus', name:'Status'},
                    {data:'action', name:'Aksi'},
                ],
                "columnDefs":[{
                    "defaultContent":"-",
                    "targets":"-all"
                }],
                "order":[]
            });
        });

        $(function() {
            $('#upt-History-Penerima-Bantuan').DataTable({
                processing: true,
                // serverSide: true,
                ajax: '{{URL::to('/upt/penerima/selesai/data')}}',
                columns:[
                    {data:'nama_lengkap', name:'Nama'},
                    {data:'tanggal_masuk', name:'Tanggal Masuk'},
                    {data:'ttl', name:'TTL'},
                    {data:'alamat', name:'Alamat'},
                    {data:'tindakanstatus', name:'Status'},
                    {data:'action', name:'Aksi'},
                ],
                "columnDefs":[{
                    "defaultContent":"-",
                    "targets":"-all"
                }],
                "order":[]
            });
        });
        function more(a){
            const test = document.getElementsByClassName('tes')
            if (document.getElementById('dropdowns'+a).classList.contains('d-flex')) {
                document.getElementById('dropdowns'+a).classList.remove('d-flex')
            } else {
                for (i=0; i < test.length; i++) {
                    document.getElementsByClassName('tes')[i].classList.remove('d-flex')
                }
                document.getElementById('dropdowns'+a).classList.toggle('d-flex')
            }
        }
        $(document).ready(function() {
            $('#datatable').DataTable()
        })
    </script>

@endsection
