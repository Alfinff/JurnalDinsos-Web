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
                        <div class="head-judul text-center">
                            <h3>Daftar UPT</h3>
                        </div>
                        <form action="{{route('dinsos-filter-dataupt')}}" class="data-pegawai" method="post">
                            {!! csrf_field() !!}
                            <div class="row justify-content-between align-items-start">
                                <div class="col-md-12">
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
                            </div>
                            <div style="width: auto; margin-left: 10px;" class="mt-3">
                                <button class="btn btn-primary" style="">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row list-card">

            @foreach($upt as $u)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-card">
                            <div class="photocard">
                                <img src="{{asset('assets/images/dataupt2.png')}}" alt="">
                            </div>
                            <div class="judulcards">
                                <h3>{{ucwords($u->nama)}}</h3>
                            </div>
                            <div class="row justify-content-between">
                                <div class="location col-md-6">
                                    <i class="fa fa-map-marker"></i>
                                    <p>{{ucwords($u->alamat)}}</p>
                                </div>
                                <div class="count-people col-md-6">
                                    <i class="fa fa-user"></i>
                                    <p>{{count($u->pendaftaran)}} Orang</p>
                                </div>
                            </div>
                            <div class="d-flex mt-4 button-cards">
                                <a href="{{route('dinsos-dataupt-detail', ['uuid' => $u->uuid])}}" class="btn btn-success" >Lihat Detail</a>
                            </div>
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
