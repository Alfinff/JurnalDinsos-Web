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
    .upt-card .dropdown {
        display: block;
        position: absolute;
        top: 30px;
        left: 30px;
        z-index: 10;
        padding: 0;
        width: 45px;
        height: 45px;
        background: unset;
    }
    .upt-card .dropdown .dropdown-menu-toggle {
        width: 45px;
        height: 45px;
        opacity: .3;
        box-shadow: 0px 4px 6px 1px rgb(74 74 74 / 28%);
        background: #ffffff;
        border-radius: 30px;
        transition: all .2s;
    }
    .upt-card:hover .dropdown .dropdown-menu-toggle {
        opacity: 1;
        transition: all .2s;
    }
    @media (max-width: 768px) {
        .upt-card .dropdown .dropdown-menu-toggle {
            opacity: 1;
        }
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
                    <div class="card upt-card">
                        <div class="card-card position-relative">
                            <div class="dropdown">
                                <div class="dropdown-menu-toggle d-flex justify-content-center align-items-center" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                </div>
                                <div class="dropdown-menu" id="testes" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="{{route('dinsos-dataupt-edit', ['uuid' => $upt->uuid])}}">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" onclick="return confirm('Hapus Data Upt Ini?')" href="{{route('dinsos-dataupt-hapus', ['uuid' => $upt->uuid])}}">Hapus</a>
                                </div>
                            </div>
                            <div class="photocard">
                                @if($upt->foto!=null)
                                    <img src="{{Storage::disk('s3')->temporaryUrl($upt->foto ?? '' == null, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="{{$upt->nama}}">
                                @else
                                    <img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                                    {{-- <img src="{{asset('assets/images/dataupt2.png')}}" alt=""> --}}
                                @endif
                            </div>
                            <div class="judulcards">
                                <h3>{{ucwords($upt->nama)}}</h3>
                            </div>
                            <div class="row justify-content-between">
                                <div class="location col-md-6">
                                    <i class="fa fa-map-marker"></i>
                                    <p>{{ucwords($upt->namawilayah->kab)}}</p>
                                </div>
                                <div class="count-people col-md-6">
                                    <i class="fa fa-user"></i>
                                    <p>{{count($upt->pendaftaran)}} Orang</p>
                                </div>
                            </div>
                            <div class="d-flex button-cards mt-5">
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
            $('.dropdown-menu-toggle').dropdown();
        });
    </script>
@endsection
