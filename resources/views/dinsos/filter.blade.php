@extends('layout.template')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10" style="background-color: #fbfbfb;">
  <div class="mx-2">
    <div class="row my-3">
      <div class="col-md-12 mb-4">
        <div class="card">
          <div class="card-card">
            <div class="back">
                <a href="{{route('dinsos-home')}}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h5><i class="fa fa-users text-primary"></i> Jenis Aduan {{ucwords($dataupt->nama)}}</h5>
            </div>
            <form action="" class="data-pengguna" method="post">
                {!! csrf_field() !!}
                <div class="row align-items-center position-relative my-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="daftarupt">Pilih UPT</label> <br>
                            <select class="js-example-basic-single w-100 form-control" name="upt" id="daftarupt">
                                <option value="" selected disabled>Daftar UPT</option>
                                @foreach ($upt as $u)
                                    <option value="{{$u->uuid}}">{{$u->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="width: auto; margin-left: 10px;" class="mt-3">
                        <button class="btn btn-primary" style="">Filter</button>
                    </div>
                </div>
            </form>
            <hr>
            <table class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                    <tr>
                        <th>Jenis Aduan</th>
                        <th>Jenis Kelamin</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datajenisaduantable as $dd => $val)
                        <tr>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->jeniskelamin}}</td>
                            <td>{{$val->jumlah}} orang</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('jquery')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
