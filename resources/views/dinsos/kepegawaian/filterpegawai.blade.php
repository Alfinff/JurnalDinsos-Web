@extends('layout.template')
@section('head')
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="back">
                <a href="{{route('dinsos-pegawai')}}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Data Pegawai {{$upt->nama}}</h3>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    @foreach ($pegawai as $p)

        <div class="col-md-4 my-3">
            <div class="card">
                <div class="card-card">
                    <div class="photouser">
                        @if(!isset($p->profile->photo))
                            <img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                        @else
                            <img src="{{route('images-getter', ['module' => 'profile', 'filename' => $p->profile->photo])}}" alt="">
                        @endif
                    </div>
                    <div class="data-pegawai">
                        <h3>Nama : </h3>
                        <p>{{ucwords($p->username)}}</p>
                    </div>
                    <hr>
                    <div class="data-pegawai">
                        <h3>Jabatan : </h3>
                        <p></p>
                    </div>
                    <hr>
                    <div class="data-pegawai">
                        <h3>Instansi : </h3>
                        <p>@if(isset($p->upt->nama)){{$p->upt->nama}}@endif</p>
                    </div>
                    <hr>
                    {{-- <div class="d-flex mt-5 button-card" >
                        <button class="btn btn-success" >Login</button>
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach
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
