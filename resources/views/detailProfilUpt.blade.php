@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>

@endsection

@section('content')
<style>
    .card{
        box-shadow: 0px 4px 28px rgb(140 140 140 / 20%) !important;
    }
    .img-nya{
        width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 100%;
        object-fit: cover;
        padding: 0;
    }
    .img-nya img{
        object-fit: cover;
        width: 100%;
        height: 100%;
    }
    h5.username{
        font-family: 'myFirstFont';
        font-size: 16px;
        text-align: center;
        height: 19px;
        margin: 10px 0 0 0;
    }
</style>
<header>
    <div class="d-flex">
        <div class="info-header-2 text-center">
            <img src="{{asset('assets/images/uptdetail.png')}}" height="400" alt="">
        </div>
    </div>
</header>
<a href="{{route('halaman-upt')}}" class="btn btn-outline-primary btn-sm" style="box-shadow: unset !important;top: 30px;left: 30px;position: relative">
    <i class="fa fa-chevron-left" style="margin-right: 5px;" aria-hidden="true"></i> Kembali
</a>

<section>
    <div class="subhead">
        <p>Deskripsi</p>
    </div>
    <div class="head">
        <h3>{{ucwords($detail->nama)}}</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                {{-- <div class="d-flex"> --}}
                    <p><i class="fa fa-map-marker"></i> {{$detail->alamat}}</p>
                    <p><i class="fa fa-user"></i> {{$count}} Orang</p>
                {{-- </div> --}}
            </div>
            <div class="col-md-6">
                {{-- <div class="d-flex"> --}}
                    <p><i class="fa fa-list-alt"></i> {{$detail->nama}}</p>
                    <a target="new" href="{{$detail->maps}}"><i class="fa fa-location-arrow"></i> Lihat Lokasi</a>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p style="text-align: center;">{{$detail->deskripsi}}</p>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="subhead">
        <p>Struktur</p>
    </div>
    <div class="head">
        <h3>Struktur Organisasi</h3>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center my-3">
            @if(is_array($arrData))
                @foreach($arrData as $idInduk => $dtInduk)
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-card">
                                <div class="row justify-content-center">
                                    @if(!isset($pimpinan[$idInduk]->profile->foto))
                                        <img class="img-nya" src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                                    @else
                                        <img class="img-nya" src="{{Storage::disk('s3')->temporaryUrl($pimpinan[$idInduk]->profile->foto, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                                    @endif
                                </div>
                                @if($pimpinan[$idInduk] != null)
                                    <h5 class="username">
                                        {{ucwords($pimpinan[$idInduk]->users->username)}}
                                    </h5>
                                @else
                                    <h5 class="username"></h5>
                                @endif
                                <div class="judulcard-upt">
                                    <p class="text-muted text-center mt-3 mb-0">@if(isset($dtInduk['nama_unit_kerja'])){{$dtInduk['nama_unit_kerja']}}@endif</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row d-flex justify-content-center my-3">
            @if(isset($dtInduk['level2']))
                @if(is_array($dtInduk['level2']))
                    @foreach ($dtInduk['level2'] as $id_unit => $dtUnit)
                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-card">
                                    <div class="row justify-content-center">
                                        @if(!isset($pimpinan[$id_unit]->profile->foto))
                                            <img class="img-nya" src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                                        @else
                                            <img class="img-nya" src="{{Storage::disk('s3')->temporaryUrl($pimpinan[$id_unit]->profile->foto, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                                        @endif
                                    </div>

                                    @if($pimpinan[$id_unit] != null)
                                        <h5 class="username">
                                            {{ucwords($pimpinan[$id_unit]->users->username)}}
                                        </h5>
                                    @else
                                        <h5 class="username"></h5>
                                    @endif
                                    <div class="judulcard-upt">
                                        <p class="text-muted text-center mt-3 mb-0">{{$dtUnit['nama_unit_kerja']}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endif
        </div>

        <div class="row d-flex justify-content-center my-3">
            @if(isset($id_unit) && isset($child3[$id_unit]))
                @foreach($child3[$id_unit] as $idx => $dtx)
                    <div class="col-md-4">
                        <div class="card" >
                            <div class="card-card">
                                <div class="row justify-content-center">
                                    @if(!isset($pimpinan[$idx]->profile->foto))
                                        <img class="img-nya" src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                                    @else
                                        <img class="img-nya" src="{{Storage::disk('s3')->temporaryUrl($pimpinan[$idx]->profile->foto, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                                    @endif
                                </div>

                                @if($pimpinan[$idx] != null)
                                    <h5 class="username">
                                        {{ucwords($pimpinan[$idx]->users->username)}}
                                    </h5>
                                @else
                                    <h5 class="username"></h5>
                                @endif
                                <div class="judulcard-upt">
                                    <p class="text-muted text-center mt-3 mb-0">{{$dtx['nama_unit_kerja']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @php
        $arrData = array();
        $child3 = array();
    @endphp

</section>
@endsection
