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
          <div class="head-judul text-center">
            <h3>Kegiatan UPT</h3>
          </div>
            <form action="{{route('dinsos-filter-kegiatan')}}" class="data-pegawai" method="post">
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
      @foreach($kegiatan as $k)
          <div class="col-md-4 my-3">
              <div class="card">
                  <div class="card-card">
                      <div class="photocard">
                            <a href="{{Storage::disk('s3')->temporaryUrl($k->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" data-fancybox="images" data-caption="">
                                <img src="{{Storage::disk('s3')->temporaryUrl($k->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
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
