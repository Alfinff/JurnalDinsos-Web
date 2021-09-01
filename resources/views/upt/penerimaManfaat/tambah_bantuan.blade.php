@extends('layout.template')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
<style>
	.imgbukti {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	#datatable td{
		text-align:start;
    vertical-align: middle;
	}
	.tambah-manfaat label{
		font-weight: 700;
    font-size: 14px;
    color: rgba(40, 40, 40, 1);
    margin-bottom: 10px;
	}
	.tambah-manfaat .form-group{
		margin: 0 0 20px 0;
	}
    .img-fluid{
        height: 150px;
    }
</style>
<div class="col-lg-10 bg-col">
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
            <div class="back">
                <a href="{{route('upt-penerima-manfaat')}}" class="d-flex">
                    <img src="https://jurnal-dinsos.primakom.co.id//assets/images/back.png" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
              <h3>Tambah Manfaat</h3>
            </div>
            <form action="" class="tambah-manfaat" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="manfaat">Bantuan <small class="text-danger">*</small></label>
                            <input type="text" name="manfaat" value="{{old('manfaat')}}" id="manfaat" placeholder="Masukkan Bantuan" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pemberian <small class="text-danger">*</small></label>
                            <input type="date" name="tanggal" id="tanggal" value="{{old('tanggal')}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group file-area">
                                <label for="foto_bukti">Masukkan Foto Bukti <small class="text-danger">*</small></label>
                                <input type="file" id="foto_bukti" name="foto_bukti" data-show-remove="false" class="dropify" data-default-file="{{old('foto_bukti')}}" accept="image/*" required />
                                <div class="warn">
                                    <small class="text-danger">Jenis File yang diterima : .jpg dan .png saja</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">

                            <button class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
            <a id="download" target="_blank" href="{{route('upt-download-data-manfaat', ['uuid' => $uuid])}}" class="btn btn-warning" >Download Data Manfaat</a>
            <hr>
            <table id="upt-tambah-bantuan" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <colgroup>
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 20%;">
                    <col span="1" style="width: 15%;">
                </colgroup>
                <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                    <tr>
                        <th>Bukti</th>
                        <th>Manfaat</th>
                        <th>Tanggal Pemberian</th>
                        <th>Aksi</th>
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
<script src="{{asset('assets/js/dropify.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    })
</script>
<script>
    $(function() {
        $('#upt-tambah-bantuan').DataTable({
            processing: true,
            ajax: '{{URL::to('/upt/penerima/bantuan/data/')}}'+'/{{$uuid}}',
            columns:[
                {data:'fotobukti', name:'Bukti', orderable:true, searchable:true},
                {data:'bantuan', name:'Bantuan', orderable:true, searchable:true},
                {data:'tanggal_beri', name:'Tanggal Pemberian', orderable:true, searchable:true},
                {data:'action', name:'Aksi', orderable:true},
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
