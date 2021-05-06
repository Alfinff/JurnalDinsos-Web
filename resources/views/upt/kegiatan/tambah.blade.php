@extends('layout.template')
@section('head')
  <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
<div class="col-md-10 bg-col">
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
                      <label for="tanggalmulai">Tanggal Mulai</label>
                      <input type="date" name="start_date" id="tanggalmulai" value="{{old('start_date')}}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalselesai">Tanggal Selesai</label>
                      <input type="date" name="end_date" id="tanggalselesai" value="{{old('end_date')}}" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="judul">Judul</label>
                      <input type="text" name="title" id="judul" class="form-control" value="{{old('title')}}" placeholder="Cth: Judul Kegiatan">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jeniskegiatan">Jenis Kegiatan</label>
                      <select name="type" id="jeniskegiatan" class="form-select">
                        <option value="" selected disabled>Pilih Kegiatan</option>
                        @foreach($kegiatanTipe as $type)
                          <option value="{{$type->id}}" @if(old('type') == $type->id) selected @endif>{{$type->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jumlahpeserta">Jumlah Peserta</label>
                      <input type="number" name="number_of_p" min="0" value="{{old('number_of_p')}}" id="jumlahpeserta" class="form-control" placeholder="Cth: 12" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="budget">Budget</label>
                      <input type="text" name="budget" id="budget" value="{{old('budget')}}" placeholder="Cth: 1000000"
                      class="form-control" required>
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
                    <label for="dokumentasi">Dokumentasi Kegiatan</label>
                    <input type="file" id="fotokondisi" name="dokumentasi" data-show-remove="false" class="dropify" data-default-file="{{old('dokumentasi')}}" accept="image/*" />
                    <div class="warn">
                      <small class="text-danger">Jenis File yang diterima : .jpg dan .png saja</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-5">
                <center>
                    <button class="btn btn-success" style="background-color: #12C58E;border-color: #12C58E;">Upload</button>
                    <a href="{{route('upt-kegiatan')}}" class="btn btn-primary">Kembali</a>
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
