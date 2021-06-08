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
                <a href="{{ route('upt-kegiatan') }}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Form Tambah Kegiatan</h3>
            <hr>
            </div>
          <form action="" class="kegiatantambah" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="namaupt">Nama UPT</label>
                      <input type="text" name="upt_name" id="namaupt" class="form-control" disabled value="{{auth()->user()->upt->nama }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalmulai">Tanggal Mulai <small class="text-danger">*</small></label>
                      <input type="date" name="start_date" id="tanggalmulai" value="{{old('start_date')}}" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalselesai">Tanggal Selesai <small class="text-danger">*</small></label>
                      <input type="date" name="end_date" id="tanggalselesai" value="{{old('end_date')}}" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="judul">Judul <small class="text-danger">*</small></label>
                      <input type="text" name="title" id="judul" class="form-control" value="{{old('title')}}" placeholder="Cth: Judul Kegiatan" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jeniskegiatan">Jenis Kegiatan <small class="text-danger"></small></label>
                      <select name="type" id="jeniskegiatan" class="form-select" >
                        <option value="" selected disabled>Pilih Kegiatan</option>
                        @foreach($kegiatanTipe as $type)
                          <option value="{{$type->id}}" @if(old('type') == $type->id) selected @endif>{{ucwords($type->nama)}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jumlahpeserta">Jumlah Peserta <small class="text-danger"></small></label>
                      <input type="number" name="number_of_p" min="0" value="{{old('number_of_p')}}" id="jumlahpeserta" class="form-control" placeholder="Cth: 12" >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="budget">Budget <small class="text-danger"></small></label>
                      <input type="number" min="0" name="budget" id="budget" value="{{old('budget')}}" placeholder="Cth: 1000000"
                      class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group file-area">
                      <label for="document">File Dokumen <small class="text-danger"></small></label>
                      <input type="file" id="document" name="filedokumen" data-show-remove="false" class="dropify" data-default-file="{{old('filedokumen')}}" accept=""/>
                      <div class="warn">
                        <small class="text-danger">Jenis File yang diterima : .pdf dan word</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="deskripsikegiatan">Deskripsi Kegiatan</label>
                    <textarea name="description" id="deskripsikegiatan" cols="30" rows="4" class="form-control" placeholder="Cth: Deskripsi">{{old('description')}}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group file-area">
                    <label for="dokumentasi">Dokumentasi Kegiatan <small class="text-danger"></small></label>
                    <input type="file" id="fotokondisi" name="dokumentasi" data-show-remove="false" class="dropify" data-default-file="{{old('dokumentasi')}}" accept="image/*" />
                    <div class="warn">
                      <small class="text-danger">Jenis File yang diterima : .jpg dan .png saja</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="video">Video</label>
                        <input type="file" name="video" id="video" class="form-control" value="{{old('video')}}" accept=".mp4">
                        <small style="color: red;">Video harus .mp4, maksimal 20mb</small>
                    </div>
                </div>
                <script>
                    var uploadField = document.getElementById("video");

                    uploadField.onchange = function() {
                        if(this.files[0].size > 20000000){
                            alert("Video Terlalu Besar!");
                            this.value = "";
                        };
                    };
                </script>
              </div>
              <div class="col-md-12 mt-5">
                <center>
                    <button class="btn btn-primary">Upload</button>
                    <a href="{{route('upt-kegiatan')}}" class="btn btn-danger">Kembali</a>
                </center>
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
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    });
  </script>
@endsection
