@extends('layout.template')
@section('head')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul text-center">
            <h3>Kegiatan UPT</h3>
          </div>
          {{-- <form action="" class="data-pendaftar">
            <div class="row justify-content-between align-items-end">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="daftarupt">Pilih UPT</label>
                  <select name="daftarupt" id="daftarupt" class="form-select">
                    <option value="" selected>Daftar UPT</option>
                    <option value="1">Daftar UPT</option>
                  </select>
                </div>
              </div>
            </div>
          </form> --}}
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
