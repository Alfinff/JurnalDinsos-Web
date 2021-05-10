@extends('layout.template')
@section('head')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
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
                <a href="{{route('dinsos-kegiatan')}}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Kegiatan UPT {{$upt->nama}}</h3>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row list-card">
      @foreach($kegiatan as $k)
          <div class="col-md-4 my-3">
              <div class="card">
                  <div class="card-card">
                      <div class="photocard">
                            <a href="{{route('images-getter', ['module' => 'kegiatan', 'filename' => $k->photo])}}" data-fancybox="images" data-caption="">
                                <img src="{{route('images-getter', ['module' => 'kegiatan', 'filename' => $k->photo])}}" alt="">
                            </a>
                      </div>
                      <div class="judulcards">
                          <h3></h3>
                      </div>
                      <div class="row justify-content-between">
                          <div class="location col-md-6 mb-2">
                              <img src="{{asset('assets/images/date_range.svg')}}" alt="">
                              <p>
                              {{\App\Helpers\Fungsi::hari_indo($k->start_date)}}
                              </p>
                          </div>
                          <div class="count-people col-md-6 mb-2">
                              <img src="{{asset('assets/images/public.svg')}}" alt="">
                              <p>{{$k->description}}</p>
                          </div>
                          <div class="location col-md-6 mb-2">
                              <img src="{{asset('assets/images/person.svg')}}" alt="">
                              <p>{{$k->number_of_p}} Orang</p>
                          </div>
                          <div class="count-people col-md-6 mb-2">
                              <img src="{{asset('assets/images/money.svg')}}" alt="">
                              <p>{{\App\Helpers\Fungsi::rupiah($k->budget)}}</p>
                          </div>
                      </div>
                      <div class="d-flex mt-4 button-cards">
                          <a href="{{route('dinsos-lihat-kegiatan', ['id' => $k->id])}}" class="btn btn-success">Lihat Kegiatan</a>
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
