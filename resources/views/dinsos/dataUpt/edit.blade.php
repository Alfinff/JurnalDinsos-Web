@extends('layout.template')
@section('head')
<link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
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
                                                <label for="wilayah">Wilayah <small class="text-danger">*</small></label>
                                                <select name="wilayah" required id="wilayahd" class="form-select">
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
                                                <label for="logo_upt">Logo UPT <small class="text-danger"></small></label>
                                                <input type="file" accept="image/*" class="dropify" name="logo_upt" id="logo_upt" data-default-file="{{Storage::disk('s3')->temporaryUrl($upt->logo ?? '' == null, \Carbon\Carbon::now()->addMinutes(3600))}}" data-show-remove="false">
                                                <div class="warn">
                                                    <small class="text-danger">Kosongi jika logo tidak diubah. Jenis File yang diterima : .jpg dan .png saja</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-success">Edit</button>
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
            {{-- {{dd($upt)}} --}}
        </div>
    </div>
@endsection
@section('jquery')
  <script src="{{asset('assets/js/dropify.js')}}"></script>
  <script>
    $(document).ready(function() {
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
