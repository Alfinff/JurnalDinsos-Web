@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

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
<style>
    .penampungs{
        position: relative;
        width: 100%;
        height: auto;
        background: whitesmoke;
        padding: 55px 30px 20px 30px;
    }
    .judultop h4{
        color: #212529;
        font-weight: bolder;
        font-size: 45px;
        font-family: 'SecondFont';
    }

    .imgcontent{
        width: 100%;
        height: 193px;
        /* height: 193px; */
        object-fit: cover;
        transition: all 1s;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .imgcontent:hover{
        transform: scale(1.2);
    }
    .penampungimg{
        width: 100%;
        height: 193px;
        overflow: hidden;
    }
    .btncarousel{
        position: absolute;
        display: flex;
        justify-content: space-between;
        width: calc(100% - 60px);
        cursor: pointer;
        top: 55%;
    }
    .btncarousel span{
        background: white;
        width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 45px;
        border-radius: 50%;
        border: 1px solid #ccc;
        font-weight: bolder;
        font-size: 25px;
    }
    .news{
        box-sizing: border-box;
        padding: 35px 0 0 0;
        margin: 0 0 35px 0;
        width: 100%;
        height: auto;
        /* overflow: hidden; */
        background: whitesmoke;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
    .cards{
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.122);
        border-radius: 10px;
        height:auto;
        width: 300px;
        margin:20px 10px;
        background: white;
    }
    .icons{
        display: flex;
    }
    .icons div{
        margin: 0 20px 0 0;
    }
    .imgfb {
        transition: all .3s;
        cursor: pointer;
        width: 30px;
        height: 30px;
        background: url("https://i.ibb.co/12xGNk8/icon-facebook-disabled.png") center center no-repeat;
        background-size: cover;
    }
    .imgfb:hover {
        background: url("https://i.ibb.co/Fnr97ds/icon-facebook-hover.png") center no-repeat;
        background-size: cover;
    }
    .imgyt {
        transition: all .3s;
        cursor: pointer;
        width: 30px;
        height: 30px;
        background: url("https://i.ibb.co/51cP6vc/icon-play-button-disabled.png") center center no-repeat;
        background-size: cover;
    }
    .imgyt:hover {
        background: url("https://i.ibb.co/RQHkTLN/icon-play-button-hover.png") center no-repeat;
        background-size: cover;
    }
    .imgtt {
        transition: all .3s;
        cursor: pointer;
        width: 30px;
        height: 30px;
        background: url("https://i.ibb.co/0GFhjwY/icon-twitter-disabled.png") center center no-repeat;
        background-size: cover;
    }
    .imgtt:hover {
        background: url("https://i.ibb.co/mCq8Qd3/icon-twitter-hover.png") center no-repeat;
        background-size: cover;
    }
    .imgig {
        transition: all .3s;
        cursor: pointer;
        width: 30px;
        height: 30px;
        background: url("https://i.ibb.co/kmN1MrZ/icon-instagram-disable.png") center center no-repeat;
        background-size: cover;
    }
    .imgig:hover {
        background: url("https://i.ibb.co/HCdr82j/icon-instagram-hover.png") center no-repeat;
        background-size: cover;
    }
    .icons img{
        width: 28px;
        height: 28px;
        margin: 0 20px 0 0;
    }
    .tanggal{
        font-size: 14px;
        margin: 0;
        font-family: 'SecondFont';
    }
    .juduldalam{
        color: #435177;
        font-size: 23px;
        width: 100%;
        height: auto;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        font-family: 'myFirstFont';
        /* font-weight: semibol; */
    }
    .juduldalam:hover{
        color: #3498db !important;
    }
    .sinopsiscard{
        /* box-sizing: /; */
        width: 260px;
        height: 63px;
        overflow: hidden;
        font-size: 14px;
        font-family: 'SecondFont';
        margin: 15px 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .dalemcards{
        padding: 12px 20px 20px 20px;
        width: 100%;
    }
    .dalemcards a{
        text-decoration: none;
    }
    @media screen and (min-width: 1700px){
        .cards{
            width: 380px !important;
        }
        .juduldalam{
            width: 340px;
        }
        .sinopsiscard{
            width: 340px;
        }
        /* Upcoming Event */
        .cardss{
            width: 370px !important;
        }
        .test{
            width: 370px !important;
        }
        .divimg{
            width: 500px !important;
        }
    }

    /* Upcoming */

    @media only screen and (min-width: 1400px) {
        .cards{
            margin: 10px 25px !important;
        }
        .cardss{
            margin: 10px 25px !important;
        }
    }
    @media only screen and (max-width: 1300px) {
        .cyka{
            padding: 0 50px !important;
        }
        .cardss{
            margin: 10px 25px !important;
        }
        .cards{
            margin: 20px 30px !important;
        }
    }
    @media screen and (min-width: 1700px) {
        .cardss{
            margin: 10px 25px !important;
        }
        .cyka{
            padding: 0 100px !important;
        }
        .cards{
            margin: 20px 35px !important;
        }
    }
    @media only screen and (max-width: 600px) {
        .cyka{
            padding: 0 20px !important;
        }
        .test{
            width: auto !important;
        }
        .cardss{
            width: 100% !important;
            margin: 10px 0 !important;
        }
        .cards{
            width: 100% !important;
            margin: 10px 0 !important;
        }
        .page-socmed{
            padding: 3rem 0px 0px 0px !important;
        }
        .socmed{
            background: white !important;
            padding: 0 0px 20px 20px !important;
            box-shadow: none !important;
        }
        .lineart{
            position: relative !important;
            left: -10% !important;
        }
    }
    .cyka{
        padding: 0;
    }
    .cardss{
      margin: 10px 15px;
      flex-wrap: wrap;
      background: white;
      width: 300px;
      height: auto;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
      border-radius: 10px;
    }
    .test{
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      width: 300px;
      height: 200px;
      overflow: hidden;
    }
    .divimg{
      display: flex;
      align-items: flex-end;
      justify-content: center;
      width: 400px;
      height: 200px;
      border-bottom-left-radius: 50%;
      border-bottom-right-radius: 50%;
      margin-left: -50px;
      overflow: hidden;
    }
    .divimg img{
      margin-top: 50px;
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    .divbtn{
      width: 100%;
      display: flex;
      justify-content: center;
      margin-top: -20px;
    }
    .divbtn button{
      cursor: pointer;
      width: 150px;
      color: white;
      font-weight: bold;
      font-family: sans-serif;
      word-spacing: 2px;
      border: none;
      border-radius: 5px;
      padding: 10px 0;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
      outline: none;
    }
    .info1 button{
        background: #FB999A;
    }
    .info1 button:hover{
        background: #ff7b7d;
    }
    .info2 button{
        background: #D393E6;
    }
    .info2 button:hover{
        background: #bb55da;
    }
    .info3 button{
        background: #669FFF;
    }
    .info3 button:hover{
        background: #3379f3;
    }
    .divisi{
      width: 100%;
      padding: 0 10px;
      text-align: center;
    }
    .judulcard h3{
      margin: 19px 0;
      color: #222222;
      font-size: 20px;
      height: 46px;
      overflow:hidden;
      display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    }
    .letak{
      margin: 14px 0;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .letak p{
      padding: 0 0px 0 10px;
      color: #999;
    }
    .letak p{
      font-size: 14px;
      color: #777;
    }
    .tanggals{
      margin: 14px 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .tanggals p{
      padding: 0 0px 0 10px;
      color: #777;
      font-size: 14px;
    }
    .information{
      border-bottom-left-radius: 10px;
      border-bottom-right-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 0px 0 15px;
      border-top: 1px solid #c9f8ff;
      background: #F0FDFF;
    }
    .information p{
      color: #555555;
      font-weight: bold;
      cursor: pointer;
    }
    .ewew{
      width: 65px;
      height: 65px;
      cursor: pointer;
      padding: 20px;
      border-left: 1px solid #c9f8ff;
      color: #6bdef0;
    }
    .ewew:hover{
      background: #6bdef0;
      color: #c9f8ff;
    }
    p{
        margin: 0;
    }
    .ellipsis {
    width:300px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    }

    /*  */
    .carousel{
        width: 100%;
    }
    .flickity-button{
      background: #EFEFEF !important;
    }
    .paggone .col-md-12{
        display: none;
    }

    /* Socmed */
    .page-socmed{
      padding: 3rem;
    }
    .socmed{
      background: #F5F5F5;
      height: 100%;
      padding: 0 20px 20px 20px;
      border-radius: 10px;
      overflow: hidden;
    }
    .embedsocial-hashtag{
      height: 500px;
      overflow-y: auto;
    }
    .title{
      padding: 20px 0 50px;
    }
    .lineart{
      width: 50%;
      height: 3px;
      background: #518AD8;
    }
    .modal-dialog{
        /* margin: 50px 20px; */
    }
    @media (min-width: 576px){
        .modal-dialog {
            max-width: 480px;
            /* margin: 50px auto; */
        }
    }
    .owl-carousel {
        /* max-width: 80%; */
    }
    .owl-carousel .owl-item {
        padding: 0 30px;
    }
    .owl-theme .owl-controls .owl-page {
        display: inline-block;
    }
    .modal-dialog .owl-dots {
        margin-top: 30px !important;
        display: none;
    }
    .modal-dialog .owl-dots::after {
        margin-top: 30px !important;
    }
    .modal-dialog .owl-dots button {
        opacity: .75;
    }
    .modal-dialog .owl-dots button:active {
        border: unset !important;
    }
    .modal-dialog .owl-dots button:focus {
        border: unset !important;
    }
    .modal-dialog .owl-dot span {
        width: 18px !important;
        height: 18px !important;
        background-color: white !important;
        transition: width .4s;
        margin: 5px 15px !important;
    }
    .modal-dialog .owl-dot.active span {
        width: 90px !important;
        background-color: #f77418 !important;
        transition: width .4s;
    }
    .modal-dialog .btn-close-modal {
        position: absolute;
        top: -16px;
        right: 10px;
        padding: 0px 11px;
        font-size: 25px;
        background-color: #fd5252;
        z-index: 15;
        color: white;
        border-radius: 100px;
        cursor: pointer
    }
</style>
<header>
    <div class="d-flex">
        <div class="info-header-2 text-center">
            @if(!isset($detail->foto))
                <img src="{{asset('assets/images/uptdetail.png')}}" height="400" alt="">
                {{-- <img src="{{asset('assets/images/umahupt.png')}}" alt=""> --}}
            @else
                <img title="" src="{{Storage::disk('s3')->temporaryUrl($detail->foto, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
            @endif
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
                    <p class="mb-4"><i class="fa fa-map-marker "></i> {{$detail->alamat}}</p>
                    <p><i class="fa fa-user"></i> {{$count}} Orang</p>
                {{-- </div> --}}
            </div>
            <div class="col-md-6">
                {{-- <div class="d-flex"> --}}
                    <p class="mb-4"><i class="fa fa-list-alt"></i> {{$detail->nama}}</p>
                    <a target="new" target="_blank" href="{{$detail->maps}}"><i class="fa fa-location-arrow"></i> Lihat Lokasi</a>
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
    <div class="penampungs">
        <div class="subhead">
            <p>Kegiatan</p>
        </div>
        <div class="head">
            <h3>Kegiatan {{ucwords($detail->nama)}}</h3>
        </div>
        <div class="news">
        <div class="carousel" data-flickity='{ "wrapAround": false, "contain": true, "autoPlay": 3000 }'>
        @foreach ($kegiatanUpt as $n)
        <div class="carousel-image" style="width: 300px;margin-right: 20px">
            <div class="cards" >
                <div class="penampungimg">
                    <a target="new" href="#">
                        @if(isset($n->photo) && ($n->photo!=null))
                            <a href="{{route('halaman-upt-detail-kegiatan', ['uuid' => $detail->id, 'kegiatan_uuid' => $n->id])}}">
                                <img class="imgcontent" src="{{Storage::disk('s3')->temporaryUrl($n->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                            </a>
                        @else
                            <a href="{{route('halaman-upt-detail-kegiatan', ['uuid' => $detail->id, 'kegiatan_uuid' => $n->id])}}">
                                <img class="imgcontent" src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                            </a>
                        @endif
                    </a>
                </div>
                <div class="dalemcards">
                    <a href="{{route('halaman-upt-detail-kegiatan', ['uuid' => $detail->uuid, 'kegiatan_uuid' => $n->id])}}">
                        <h1 id="juduld" class="juduldalam" >{{$n->title}}</h1>
                    </a>
                    <p class="text-muted tanggal">{{ date('Y-m-d H:i:s', strtotime($n->created_at)) }}</p>
                    {{-- <p class="sinopsiscard"  class="text-muted">{{$n->budget}}</p> --}}
                    <hr>
                    <div style="display: flex;">
                        <div class="icons" >
                            <a onclick="facebook('{{route('halaman-upt-detail-kegiatan', ['uuid' => $detail->uuid, 'kegiatan_uuid' => $n->id])}}')">
                                <div class="imgfb" title="Facebook Kemenparekraf"></div>
                            </a>
                            <a onclick="twitter('{{route('halaman-upt-detail-kegiatan', ['uuid' => $detail->uuid, 'kegiatan_uuid' => $n->id])}}')">
                                <div class="imgtt" title="Twitter Kemenparekraf"></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>
<script>
    $(document).ready(() => {
        var flkty = new Flickity( '.main-carousel', {
            // options
            pageDots: false,
            cellAlign: 'center',
            autoPlay: 3000
        });
    })
    function facebook(a) {
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${a}`, "", "width=400,height=500");
    }
    function twitter(a) {
        window.open(`https://twitter.com/intent/tweet?text=${a}`, "", "width=400,height=500");
    }
</script>
@endsection
