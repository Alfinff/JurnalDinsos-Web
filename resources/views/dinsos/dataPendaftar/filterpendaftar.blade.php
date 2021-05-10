@extends('layout.template')
@section('content')
<div class="col-lg-10 bg-col" style="min-height: 100vh">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="back">
                <a href="{{route('dinsos-pegawai-pendaftar')}}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Data Pendaftar {{$upt->nama}}</h3>
            </div>
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
                ajax: '{{URL::to('/dinsos/pendaftar/data/')}}'+'/{{$upt->uuid}}',
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
@endsection
