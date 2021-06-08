@extends('layout.template')
@section('head')
<link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .js-example-basic-single{
        border: none !important;
    }
</style>
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
                            <a href="{{route('dinsos-dataupt')}}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
                        <div class="head-judul text-center">
                            <h3>Form Edit UPT</h3>
                            <hr>
                        </div>
                        <form action="" class="kegiatantambah" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nama_upt">Nama UPT <small class="text-danger">*</small></label>
                                                <input type="text" value="{{$upt->nama}}" name="nama_upt" id="nama_upt" class="form-control" placeholder="Cth: UPT Jawa Timur" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="maps">Maps</label>
                                                <input type="text" value="{{$upt->maps}}" name="maps" id="maps" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="wilayah">Wilayah <small class="text-danger">*</small></label>
                                                <select name="wilayah" required id="wilayahd" class="js-example-basic-single w-100 form-select">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jenisupt">Jenis Upt <small class="text-danger">*</small></label>
                                                <select name="jenisupt" required id="jenisupt" class="js-example-basic-single w-100 form-select">
                                                    @foreach ($jenisupt as $jj)
                                                        <option value="{{$jj->uuid}}" @if($upt->jenis_upt == $jj->uuid) selected="selected" @endif>{{ucwords($jj->nama)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_lengkap">Alamat Lengkap <small class="text-danger">*</small></label>
                                                <textarea name="alamat_lengkap" required id="alamat_lengkap" class="form-control" cols="30" rows="3" placeholder="Cth: Jl.Gayung Kebonsari No.56">{{$upt->alamat}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="alamat_lengkap">Deskripsi</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="3" placeholder="Deskripsi Upt">{{$upt->deskripsi}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="logo_upt">Logo UPT <small class="text-danger"></small></label>
                                                <input type="file" accept="image/*" class="dropify" name="logo_upt" id="logo_upt" data-default-file="" data-show-remove="false">
                                                <div class="warn">
                                                    <small class="text-danger">Kosongi jika logo tidak diubah. Jenis File yang diterima : .jpg dan .png saja</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-success">Edit</button>
                                                    <a style="margin-left: 5px;" href="{{route('dinsos-dataupt')}}" class="btn btn-danger">Batal</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
  <script src="{{asset('assets/js/dropify.js')}}"></script>
  <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
        $.ajax({
            url: "{{url('api/kabupaten')}}/35",
            method: "GET",
            success: function(result) {
                console.log(result)
              $('#wilayahd').find('option')
                .remove()
                .end()
                .append('<option value="" disabled>Pilih Kota/Kabupaten</option>');
              result.kabupaten.forEach(function(item) {
                //   console.log(item.kab_id)
                $('#wilayahd').append(`<option value="${item.kab_id}">${item.kab}</option>`);
              });
              document.getElementById('wilayahd').value = {{$upt->wilayah}};
            }
        });
    });
  </script>
@endsection
