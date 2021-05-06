@extends('layout.template')
@section('content')
<style>
    .modals-edit{
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .card{
        width: 100%;
    }
    .title-modal h4{
        font-size: 19px;
        font-weight: 700;
        color: #282828;
    }
    .title-modal i {
        cursor: pointer;
    }
    .form-group{
        margin: 0 0 1rem 0;
    }
    .form-group label{
        font-weight: 700;
        font-size: 14px;
        line-height: 16.71px;
        color: rgba(40, 40, 40, 1);
    }
    tr th{
      background-color: #007BFF !important;
      color: white;
    }
    .sub1 td{
        background-color: #F6ACAC ;
        color: #3F4254;
    }
    .sub2 td{
        background-color: #B2F7DC !important;
        color: #3F4254;
    }
    table .btn{
        padding: 3px 10px;
        font-size: 14px;
    }

    .sub1 a{
        margin: 0 15px 0 0;
    }
    .sub2 a{
        margin: 0 15px 0 0;
    }
    .sub3 a{
        margin: 0 15px 0 0;
    }
    .sub1 b{
        margin: 0;
    }
    .sub2 b{
        margin: 0 0px 0 40px;
    }
    .sub3 b{
        margin: 0 0 0 80px;
    }
</style>
<div class="modals-login" id="modal-edit">
    <div class="penampung-modals">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between title-modal">
                    <h4>Edit Kepegawaian</h4>
                    <i class="fa fa-times" onclick="closed()"></i>
                </div>
                <hr>
                <form action="">
                    <div class="row my-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="Dian Agusta Asmarani" disabled placeholder="Nama">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan" value="Kepala" disabled>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-end pt-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-success">Simpan</button>
                                <button class="btn btn-danger" onclick="closed()">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modals-login" id="modal-kepegawaian">
    <div class="penampung-modals">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between title-modal">
                    <h4>Tambah Kepegawaian</h4>
                    <i class="fa fa-times" onclick="closed()"></i>
                </div>
                <hr>
                <form action="">
                    <div class="row my-5">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Masukkan Jabatan" >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-end pt-4">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-success">Simpan</button>
                                <button class="btn btn-danger" onclick="closed()">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card" style="overflow-x:auto">
            <div class="d-flex justify-content-between pb-3 align-items-center">
                <div class="head-juduls">
                    <h5><i class="fa fa-users text-primary"></i> Unit Kerja</h5>
                </div>
                <a href="{{route('upt-tambah-unitkerja')}}" class="btn btn-success" style="padding: 5px 20px;">
                    Tambah Data
                </a>
            </div>
            <hr>
            <table id="upt-Unitkerja" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <colgroup>
                    <col span="1" style="width: 23%;">
                    <col span="1" style="width: 23%;">
                    <col span="1" style="width: 54%;">
                 </colgroup>
                <thead>
                    <tr>
                        <th >Kode</th>
                        <th >Jabatan</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrData as $idInduk => $dtInduk)
                        <tr class="sub1">
                            <td><b>@if(isset($dtInduk['kode_unit_kerja'])){{$dtInduk['kode_unit_kerja']}}@endif</b></td>
                            <td><b>@if(isset($dtInduk['nama_unit_kerja'])){{$dtInduk['nama_unit_kerja']}}@endif</b></td>
                            <td>
                                <div class="d-flex flex-wrap m-0">
                                    <a href="{{route('upt-tambah-sub-unitkerja', ['idparent' => $idInduk])}}" class="btn btn-primary">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17 13H13V17H11V13H7V11H11V7H13V11H17V13Z" fill="white"/>
                                        </svg>
                                        Sub Unit
                                    </a>
                                    <a href="{{route('upt-edit-unitkerja', ['idunitkerja' => $idInduk])}}" class="btn btn-warning">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <a onclick="return confirm(`Anda Yakin Menghapus Data Ini?`)" href="{{route('upt-hapus-unitkerja', ['idunitkerja' => $idInduk])}}" class="btn btn-danger">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                        </svg>
                                        Hapus Unit Utama dan Sub
                                    </a>
                                </div>
                            </td>
                        </tr>

                        @if(isset($dtInduk['level2']))
                            @if(is_array($dtInduk['level2']))
                                @foreach ($dtInduk['level2'] as $id_unit => $dtUnit)
                                    <tr class="sub2">
                                        <td><b>{{$dtUnit['kode_unit_kerja']}}</b></td>
                                        <td><b>{{$dtUnit['nama_unit_kerja']}}</b></td>
                                        <td>
                                            <div class="d-flex flex-wrap m-0">
                                                <a href="{{route('upt-tambah-sub-unitkerja', ['idparent' => $id_unit])}}" class="btn btn-primary">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17 13H13V17H11V13H7V11H11V7H13V11H17V13Z" fill="white"/>
                                                    </svg>
                                                    Sub Unit
                                                </a>
                                                <a href="{{route('upt-edit-sub-unitkerja', ['idunitkerja' => $id_unit])}}" class="btn btn-warning">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a onclick="return confirm(`Anda Yakin Menghapus Data Sub Ini?`)" href="{{route('upt-hapus-unitkerja', ['idunitkerja' => $id_unit])}}" class="btn btn-danger">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                                    </svg>
                                                    Hapus
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    @if(isset($child3[$id_unit]))
                                        @foreach($child3[$id_unit] as $idx => $dtx)
                                        <tr class="sub3">
                                            <td><b>{{$dtx['kode_unit_kerja']}}</b></td>
                                            <td><b>{{$dtx['nama_unit_kerja']}}</b></td>
                                            <td>
                                                <a href="{{route('upt-edit-sub-unitkerja', ['idunitkerja' => $idx])}}" class="btn btn-warning">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a onclick="return confirm(`Anda Yakin Menghapus Data Sub Ini?`)" href="{{route('upt-hapus-unitkerja', ['idunitkerja' => $idx])}}" class="btn btn-danger">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                                    </svg>
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                @endforeach
                            @endif
                        @endif
                    @endforeach
                    @php
                        $arrData = array();
                        $child3 = array();
                    @endphp
                </tbody>
            </table>
        </div>
      </div>
  </div>
</div>
<script>
    const modal = document.getElementById('modal-edit')
    const tambah = document.getElementById('modal-kepegawaian')
    function closed() {
        modal.style.display = 'none'
        tambah.style.display = 'none'
    }
    function openEdit() {
        modal.style.display = 'flex'
    }
    function tambahdata() {
        tambah.style.display = 'flex'
    }
</script>
@endsection
@section('jquery')
    <script>
        // $(function() {
        //     $('#upt-Unitkerja').DataTable({
        //         processing: true,
        //         ajax: '{{URL::to('/upt/kepegawaian/unitkerja/data')}}',
        //         columns:[
        //             {data:'kode', name:'Kode Unit Kerja'},
        //             {data:'jabatan', name:'Jabatan'},
        //             {data:'action', name:'Aksi'},
        //         ],
        //         "columnDefs":[{
        //             "defaultContent":"-",
        //             "targets":"-all"
        //         }],
        //         "order":[]
        //     });
        // });
    </script>
@endsection
