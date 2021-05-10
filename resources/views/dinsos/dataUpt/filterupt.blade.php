@extends('layout.template')
@section('head')
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .js-example-basic-single{
        border: none !important;
    }
</style>
    <div class="col-lg-10">
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
                            <h3>UPT {{$upt->nama}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row list-card">

                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-card">
                            <div class="photocard">
                                <img src="{{asset('assets/images/dataupt2.png')}}" alt="">
                            </div>
                            <div class="judulcards">
                                <h3>{{ucwords($upt->nama)}}</h3>
                            </div>
                            <div class="row justify-content-between">
                                <div class="location col-md-6">
                                    <i class="fa fa-map-marker"></i>
                                    <p>{{ucwords($upt->alamat)}}</p>
                                </div>
                                <div class="count-people col-md-6">
                                    <i class="fa fa-user"></i>
                                    <p>{{count($upt->pendaftaran)}} Orang</p>
                                </div>
                            </div>
                            <div class="d-flex mt-4 button-cards">
                                <a href="{{route('dinsos-dataupt-detail', ['uuid' => $upt->uuid])}}" class="btn btn-success" >Lihat Detail</a>
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
