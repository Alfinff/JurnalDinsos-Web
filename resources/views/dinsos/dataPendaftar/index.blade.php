@extends('layout.template')
@section('content')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10 bg-col" style="min-height: 100vh">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="head-judul text-center">
              <h5><i class="fa fa-user text-primary"></i> Data Pengguna</h5>
            </div>
            <form action="{{route('dinsos-filter-pendaftar')}}" class="data-pendaftar" method="post">
                {!! csrf_field() !!}
                <div class="row align-items-end my-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="daftarupt">Pilih UPT</label> <br>
                            <select class="js-example-basic-single w-100 form-control" name="upt" id="daftarupt">
                                <option value="" selected disabled>Daftar UPT</option>
                                @foreach ($upt as $u)
                                    <option value="{{$u->uuid}}">{{$u->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="width: auto; margin-left: 10px;" class="mt-3">
                        <button class="btn btn-primary" style="">Filter</button>
                    </div>
                    <div style="position: relative">
                        <div style="position: absolute;right: 0;top: 0">
                            <a id="export_excel_1" class="btn btn-warning" onclick="exportexcelpenerimamanfaat();">Export Excel</a>
                        </div>
                    </div>
                </div>
                <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
                <script>
                function exportexcelpenerimamanfaat() {
                    url = "{{URL::to('dinsos/pendaftar/dataExport')}}";
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
                    url = "{{URL::to('dinsos/pendaftar/dataExport')}}/"+id;
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
            </form>
            <hr>
          <div class="d-flex justify-content-end mb-3">
          </div>
          <table id="dinsos-Data-Pendaftar" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
              <th>Nama Lengkap</th>
              <th>Jenis Aduan</th>
              <th>NIK</th>
              <th>UPT</th>
              <th>Telepon</th>
              <th>Status</th>
              <th>Tindakan</th>
            </tr>
            </thead>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('jquery')
    <script>
            $(function() {
                $('#dinsos-Data-Pendaftar').DataTable({
                    processing: true,
                    ajax: '{{URL::to('/dinsos/pendaftar/data')}}',
                    columns:[
                        {data:'nama_lengkap', name:'Nama Lengkap'},
                        {data:'jenisaduan', name:'Jenis Aduan'},
                        {data:'nik', name:'NIK'},
                        {data:'upt', name:'Nama UPT'},
                        {data:'no_hp', name:'Telepon'},
                        {data:'status', name:'Status'},
                        {data:'tindakan', name:'Tindakan'},
                    ],
                    "columnDefs":[{
                        "defaultContent":"-",
                        "targets":"_all"
                    }],
                    "order":[]
                });
            });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
