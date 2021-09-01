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
    td a{
        width: 58px;
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
<div class="col-lg-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="d-flex justify-content-between mb-3">
            <div class="head-juduls">
                <h5><i class="fa fa-users text-primary"></i> Data Yang Tertunda</h5>
            </div>
          </div>
          <hr>
          <div style="overflow-y: auto">
              <table id="upt-Pendaftar-Tertunda" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                {{-- <colgroup>
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 15%;">
                    <col span="1" style="width: 10%;">
                    <col span="1" style="width: 20%;">
                 </colgroup> --}}
                <thead>
                <tr>
                    <th>No. Registrasi</th>
                    <th style="width: 175px">Nama Lengkap</th>
                    <th>Jenis Aduan</th>
                    <th>NIK</th>
                    <th style="width: 175px">Alamat</th>
                    <th>Telepon</th>
                    <th width="60px">Aksi</th>
                </tr>
                </thead>
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="modalTambah">
    <div class="overlay-modal"></div>
    <div class="row align-items-center justify-content-center h-100 w-100">
        <div class="col-md-5">
            <div class="card">
                <div class="card-card">
                    <div class="head-judul2">
                        <h3>Penanggung Jawab</h3>
                        <button onclick="closeModalEdit()" class="btn btn-light shadow-sm" style="box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;"><i class="fa fa-times"></i></button>
                    </div>
                    <hr>
                    <form action="{{route('upt-pendaftar-tertunda-hubungi')}}" class="kegiatantambah" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="penanggungjawab">Penanggung Jawab</label>
                                        <input type="hidden" name="idpendaftar" id="pendaftar">
                                        <select name="idpenanggungjawab" id="penanggungjawab" required class="form-select">
                                            <option value="" selected disabled>Pilih Penanggung Jawab</option>
                                            @foreach($users as $u)
                                                <option value="{{$u->uuid}}" >{{ucwords($u->username)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <center>
                                    <button class="btn btn-success" type="submit" style="background-color: #12C58E;border-color: #12C58E;">Tambah</button>
                                    <a class="btn btn-danger" onclick="closeModalEdit()">Batal</a>
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
        $(function() {
            $('#upt-Pendaftar-Tertunda').DataTable({
                processing: true,
                ajax: '{{URL::to('/upt/pendaftar/tertunda/data')}}',
                columns:[
                    {data:'no_reg', name:'No. Registrasi', orderable:true, searchable:true},
                    {data:'nama_lengkap', name:'Nama Lengkap', orderable:true, searchable:true},
                    {data:'jenis_aduan', name:'Jenis Aduan', orderable:true, searchable:true},
                    {data:'nik', name:'NIK',orderable:true, searchable:true},
                    {data:'alamat', name:'Alamat', orderable:true, searchable:true},
                    {data:'telp_rekomendasi', name:'Telepon', orderable:true},
                    {data:'action', name:'Aksi', orderable:true},
                ],
                "columnDefs":[{
                    "defaultContent":"-",
                    "targets":"-all"
                }],
                "order":[]
            });
        });
        $(document).ready(function() {
            $('#datatable').DataTable({
                order: [],
                "columnDefs": [
                    { "width": "20%", "targets": 0 }
                ]
            });

            $('.pilih_tindakan').change(function() {
                var tindakan = this.value.split("-");
                $.ajax({
                    url: "{{url('api/pengaduan').'/'}}"+tindakan[1]+'/'+tindakan[0],
                    method: "GET",
                    success: function(result) {
                        console.log(result);
                    }
                });
            });
        })
    </script>
    <script>
        function pilih_pj(a) {
            document.getElementById('pendaftar').value = a;
            document.getElementById('modalTambah').style.display = 'flex';
        }
    </script>

@endsection
