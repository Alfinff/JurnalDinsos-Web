@extends('layout.template')
@section('head')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .desc-head {
        font-size: 14px;
        opacity: .5;
    }
    .desc-content {
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul text-center">
            <h5><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="iconside" d="M8 4H14V6H8V4ZM8 8H14V10H8V8ZM8 12H14V14H8V12ZM4 4H6V6H4V4ZM4 8H6V10H4V8ZM4 12H6V14H4V12ZM17.1 0H0.9C0.4 0 0 0.4 0 0.9V17.1C0 17.5 0.4 18 0.9 18H17.1C17.5 18 18 17.5 18 17.1V0.9C18 0.4 17.5 0 17.1 0ZM16 16H2V2H16V16Z" fill="#0d6efd"/>
            </svg> Kegiatan UPT</h5>
          </div>
            <form action="{{route('dinsos-filter-kegiatan')}}" class="data-pegawai" method="post">
                {!! csrf_field() !!}
                <div class="d-flex align-items-end">
                    <div class="d-flex justify-content-between align-items-start mt-4">
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
                            @if(isset($k->photo) && ($k->photo!=null))
                                <a href="{{Storage::disk('s3')->temporaryUrl($k->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" data-fancybox="images" data-caption="">
                                    <img src="{{Storage::disk('s3')->temporaryUrl($k->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                                </a>
                            @else
                                <img src="" alt="">
                            @endif
                      </div>
                      <div class="judulcards">
                          <h3>{{$k->title}}</h3>
                      </div>
                      <div class="row justify-content-between">
                          <div class="location col-12 mb-2">
                              <img src="{{asset('assets/images/date_range.svg')}}" alt="">
                              <p>
                              {{\App\Helpers\Fungsi::hari_indo($k->start_date)}}
                              </p>
                          </div>
                          <div class="count-people col-md-6 mb-2">
                              <img src="{{asset('assets/images/money.svg')}}" alt="">
                              <p>{{\App\Helpers\Fungsi::rupiah($k->budget)}}</p>
                          </div>
                          <div class="location col-md-6 mb-2">
                            <img src="{{asset('assets/images/person.svg')}}" alt="">
                            <p>{{$k->number_of_p}} Orang</p>
                        </div>
                      </div>
                      <div>
                        <div class="mt-2">
                            <div class="desc-head">Deskripsi</div>
                            <div class="desc-content">{{$k->description}}</div>
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
