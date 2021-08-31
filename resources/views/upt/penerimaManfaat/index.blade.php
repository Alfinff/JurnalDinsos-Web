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
<div class="col-lg-10 bg-col">
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
            <button id="export_excel_1" class="btn btn-warning" onclick="exportexcelpenerimamanfaat();">Export Excel</button>
                <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
                <script>
                function exportexcelpenerimamanfaat() {
                    url = "{{route('upt-exportdatapenerima')}}";
                    var req = new XMLHttpRequest();
                    req.open("GET", url, true);

                    req.onload = function(e) {
                        var wb = XLSX.utils.book_new();
                        var data = JSON.parse(req.response);
                        var ws = XLSX.utils.json_to_sheet(data);
                        XLSX.utils.book_append_sheet(wb, ws, "Penerima Manfaat");
                        XLSX.writeFile(wb, "PenerimaManfaat.xlsx");
                    }

                    req.send();
                }
                function exportexcelpenerimamanfaatindividu(id) {
                    url = "{{URL::to('upt/penerima/dataExport')}}/"+id;
                    var req = new XMLHttpRequest();
                    req.open("GET", url, true);

                    req.onload = function(e) {
                        var wb = XLSX.utils.book_new();
                        var data = JSON.parse(req.response);
                        var ws = XLSX.utils.json_to_sheet(data);
                        XLSX.utils.book_append_sheet(wb, ws, "Penerima Manfaat");
                        XLSX.writeFile(wb, "PenerimaManfaatIndividu.xlsx");
                    }

                    req.send();
                }
            </script>
            <div class="m-5" style="width: auto;position: absolute;right: 5px;top: 5px;">
                <a href="{{route('upt-pendaftar-tambah')}}" class="btn btn-primary">Tambah Data</a>
            </div>
            <hr>
            <div class="row col-md-5 align-items-center position-relative my-4">
                Import Data Excel
                <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control" required>
                    <br>
                    <button class="btn btn-success">Import</button>
                    <a href="{{URL::to('/format_import_excel.xlsx')}}" class="btn btn-primary">Download Format</a>
                </form>
            </div>
            <table id="upt-Penerima-Bantuan" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Masuk</th>
                        <th>TTL</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th width="180px">Aksi</th>
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
                      <th width="180px">Aksi</th>
                  </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="set_selesai" tabindex="-1" role="dialog" aria-labelledby="set_selesai" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-alt text-primary"></i> Upload Foto Kondisi Terakhir</h5>
                <button type="button" class="close bg-none" style="background: none;border: none;" onclick="closedd()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" role="form" action="{{route('upt-penerima-manfaat-selesai')}}" method="post" enctype="multipart/form-data" id="formsetselesai">
                    {!! csrf_field() !!}
                    <div id="formSetSelesai">

                    </div>
                    <div id="balik"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning font-weight-bold" id="btnselesaisimpan">Simpan</button>
                </form>
                <button type="button" onclick="closedd()" class="btn btn-primary font-weight-bold" data-dismiss="modal">Close</button>
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
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        $(function() {
            $('#upt-Penerima-Bantuan').DataTable({
                processing: true,
                // serverSide: true,
                searching: true,
                ajax: '{{URL::to('/upt/penerima/data')}}',
                columns:[
                    {data:'nama_lengkap', name:'Nama', orderable: true, searchable: true},
                    {data:'tanggal_masuk', name:'Tanggal Masuk', orderable: true, searchable: true},
                    {data:'ttl', name:'TTL', orderable: true, searchable: true},
                    {data:'alamat', name:'Alamat', orderable: true, searchable: true},
                    {data:'tindakanstatus', name:'Status', orderable: true, searchable: true},
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
        function setselesai(iddata)
        {
            set_selesai.style.display = 'block'
            set_selesai.style.opacity = 1
            var request = $.ajax ({
                url : "{{route('upt-penerima-manfaat-set-selesai')}}",
                data:"iddata="+iddata,
                type : "get",
                dataType: "html"
            });
            $('#formSetSelesai').html('Sedang Melakukan Proses Pencarian Data...');
            request.done(function(output) {
                if(output==0) {
                    btnselesaisimpan.style.display = 'none';
                    $('#formSetSelesai').html('Data Kosong');
                } else {
                    $('#formSetSelesai').html(output);
                }
            });
        }
        function closedd() {
            set_selesai.style.display = 'none';
            set_selesai.style.opacity = 0;
        }
        $(document).ready(function() {
            $('#datatable').DataTable()
        });
    </script>

@endsection
