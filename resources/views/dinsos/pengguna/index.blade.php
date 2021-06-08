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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10 bg-col" style="min-height: 100vh">
  <div class="row">
    <div class="col-md-12 my-3">
        <div class="card">
            <div class="card-card">
                <div class="head-judul text-center">
                    <h5><i class="fa fa-users text-primary"></i> Data Pengguna</h5>
                </div>
                {{-- <div class="d-flex justify-content-end">
                </div> --}}
            <form action="{{route('dinsos-filter-pengguna')}}" class="data-pengguna" method="post">
                {!! csrf_field() !!}
                <div class="row align-items-center position-relative my-4">
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
                    <div style="width: auto;position: absolute;right: 0;top: 0;">
                        <a href="{{route('dinsos-pengguna-tambah')}}" class="btn btn-primary">Tambah Pengguna</a>
                    </div>

                </div>
            </form>
            <hr>
          <table id="dinsos-Pengguna" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tipe</th>
                    <th>Upt</th>
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
<script>

</script>
@endsection
@section('jquery')
    <script>
        function more(){
            document.getElementById('dropdowns').classList.toggle('d-flex')
            console.log('aa')
        }

        $(function() {
            $('#dinsos-Pengguna').DataTable({
                processing: true,
                // serverSide: true,
                ajax: '{{URL::to('/dinsos/pengguna/data')}}',
                columns:[
                    {data:'username', name:'Nama'},
                    {data:'email', name:'Email'},
                    {data:'tipe', name:'Tipe'},
                    {data:'upt', name:'Upt'},
                    {data:'status', name:'Status'},
                    {data:'action', name:'Aksi'},
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
