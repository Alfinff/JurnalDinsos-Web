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
                <a href="#" class="btn btn-success" style="padding: 5px 20px;" onclick="tambahdata()">
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
        $(function() {
            $('#upt-Unitkerja').DataTable({
                processing: true,
                ajax: '{{URL::to('/upt/kepegawaian/unitkerja/data')}}',
                columns:[
                    {data:'kode', name:'Kode Unit Kerja'},
                    {data:'jabatan', name:'Jabatan'},
                    {data:'action', name:'Aksi'},
                ],
                "columnDefs":[{
                    "defaultContent":"-",
                    "targets":"-all"
                }],
                "order":[]
            });
        });
    </script>
@endsection
