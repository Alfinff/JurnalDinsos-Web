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
                        <div class="head-judul text-center">
                            <h5><svg width="24" class="mr-1" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path class="iconside" d="M17 15H19V17H17V15ZM17 11H19V13H17V11ZM17 7H19V9H17V7ZM13.74 7L15 7.84V7H13.74Z" fill="#0d6efd"/>
                                <path class="iconside" d="M10 3V4.51L12 5.84V5H21V19H17V21H23V3H10Z" fill="#0d6efd"/>
                                <path class="iconside" d="M8.17 5.7002L15 10.2502V21.0002H1V10.4802L8.17 5.7002ZM10 19.0002H13V11.1602L8.17 8.0902L3 11.3802V19.0002H6V13.0002H10V19.0002Z" fill="#0d6efd"/>
                            </svg> Daftar UPT</h5>
                        </div>
                        <form action="{{route('dinsos-filter-dataupt')}}" class="data-pegawai" method="post">
                            {!! csrf_field() !!}
                            <div class="d-flex justify-content-between mt-4">
                                <div class="d-flex justify-content-start">
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
                                </div>
                                <div class="d-flex align-items-end">
                                    <a href="{{route('dinsos-dataupt-tambah')}}" class="btn btn-primary" style="">+ Tambah</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row list-card">
            @foreach($upt as $u)
                <div class="col-md-4 my-3">
                    <div class="card upt-card">
                        <div class="card-card position-relative">
                            <div class="dropdown">
                                <div class="dropdown-menu-toggle d-flex justify-content-center align-items-center" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                </div>
                                <div class="dropdown-menu" id="testes" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="{{route('dinsos-dataupt-edit', ['uuid' => $u->uuid])}}">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" onclick="return confirm('Hapus Data Upt Ini?')" href="{{route('dinsos-dataupt-hapus', ['uuid' => $u->uuid])}}">Hapus</a>
                                </div>
                            </div>
                            <div class="photocard">
                                @if($u->foto!=null)
                                    <img src="{{Storage::disk('s3')->temporaryUrl($u->foto ?? '' == null, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="{{$u->nama}}">
                                @else
                                    <img src="{{asset('assets/images/umahupt.png')}}" alt="">
                                    {{-- <img src="{{asset('assets/images/dataupt2.png')}}" alt=""> --}}
                                @endif
                            </div>
                            <div class="judulcards">
                                <h3>{{ucwords($u->nama)}}</h3>
                            </div>
                            <div class="row justify-content-between">
                                <div class="location col-md-7">
                                    <i class="fa fa-map-marker"></i>
                                    <p style="text-transform:capitalize">{{strtolower($u->namawilayah->kab)}}</p>
                                </div>
                                <div class="count-people col-md-5">
                                    <i class="fa fa-user"></i>
                                    <p>{{count($u->pendaftaran)}} Orang</p>
                                </div>
                            </div>
                            <div class="d-flex button-cards mt-5">
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

            $(".dropdown-menu-toggle").click(function () {
                if ($(this).hasClass('open')) {
                    $(this).removeClass("open");
                    $(".show").removeClass("show");
                } else {
                    $(".show").removeClass("show");
                    $(this).next(".dropdown-menu").addClass("show");
                    $(this).addClass("open");
                }
            });

        });
    </script>
@endsection
