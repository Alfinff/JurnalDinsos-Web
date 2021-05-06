@extends('layout.template')
@section('content')
<style>
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
        <div class="col-md-12 my-3">
            <div class="card">
                <div class="card-card">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="head-juduls">
                            <h5><i class="fa fa-users text-primary"></i> Data Kegiatan</h5>
                        </div>
                        <a href="{{route('upt-tambah-kegiatan')}}" class="btn btn-primary"><b>+ </b> Tambah</a>
                    </div>
                    <hr>
                    <div style="overflow-x: auto">
                        <table id="upt-Kegiatan" class="table table-bordered dt-responsive table dataTable no-footer" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <colgroup>
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 15%;">
                                <col span="1" style="width: 20%;">
                             </colgroup>
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Budget</th>
                                    <th>Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <script>
                        $(function() {
                            $('#upt-Kegiatan').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: '{{URL::to('/upt/kegiatan/data')}}',
                                columns:[
                                    {data:'title', name:'Judul'},
                                    {data:'start_date', name:'Tanggal Mulai'},
                                    {data:'end_date', name:'Tanggal Selesai'},
                                    {data:'budget', name:'Budget'},
                                    {data:'number_of_p', name:'Peserta'},
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
                </div>
            </div>
        </div>
    <div class="modal" id="modalEdit">
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
                        <form action="" class="kegiatantambah" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="namaupt1">Nama UPT</label>
                                                <input type="text" name="namaupt1" id="namaupt1" class="form-control" disabled value="UPT BAGUS">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalmulai1">Tanggal Mulai</label>
                                                <input type="date" name="tanggalmulai1" id="editStartDate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalselesai1">Tanggal Selesai</label>
                                                <input type="date" name="tanggalselesai1" id="editEndDate" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jeniskegiatan1">Jenis Kegiatan</label>
                                                <input type="text" name="jeniskegiatan1" id="editType" class="form-control" placeholder="cth: Upacara Bendera">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlahpeserta1">Jumlah Peserta</label>
                                                <input type="number" name="jumlahpeserta1" id="editNumber" class="form-control" placeholder="Masukkan Jumlah Peserta">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="budget1">Budget</label>
                                                <input type="text" name="budget1" id="editBudget" placeholder="Masukkan Nominal Uang" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsikegiatan1">Deskripsi Kegiatan</label>
                                            <textarea name="deskripsikegiatan1" id="editDescription" cols="30" rows="4"
                                                                                                                  class="form-control" placeholder="Masukkan Deskripsi Kegiatan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group file-area">
                                            <label for="dokumentasi1">Dokumentasi Kegiatan</label>
                                            <input type="file" name="dokumentasi1" id="dokumentasi1" required>
                                            <div class="file-dummy">
                                                <div class="success">Great, your files are selected. Keep on.</div>
                                                <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p></div>
                                            </div>
                                            <div class="warn">
                                                <p class="text-muted">Jenis File yang diterima : .jpg dan .png saja</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <center>
                                        <button class="btn btn-success col-md-3" style="background-color: #12C58E;border-color: #12C58E;">Upload</button>
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
        function closeModalEdit() {
            document.getElementById('modalEdit').style.display = 'none';
        }

function openModalEdit() {
    $.ajax({
        url: "{{url('api/kegiatan')}}/".id,
        success: function(result) {
            console.log("abc");
            $('#editStartDate').val(result.start_date);
            $('#editEndDate').val(result.end_date);
            $('#editType').val(result.type);
            $('#editBudget').val(result.budget);
            $('#editDescription').val(result.description);
            $('#editNumber').val(result.number_of_p);
            document.getElementById('modalEdit').style.display = 'block';
            }
    });
}
    </script>
  </div>
@endsection
@section('jquery')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable()
    })
</script>
@endsection
