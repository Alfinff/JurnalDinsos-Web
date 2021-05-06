@extends('layout.template')
@section('content')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Kegiatan</h3>
          </div>
          <form action="" class="data-pendaftar">
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
              <!-- <div style="width: auto;">
                <button class="btn btn-success" style="background-color: #12C58E;border-color: #12C58E;">+ Tambah</button>
              </div> -->
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
                          <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
                      </div>
                      <div class="judulcards">
                          <h3>{{\App\Models\Upt::find($k->idupt)->nama}}</h3>
                      </div>
                      <div class="row justify-content-between">
                          <div class="location col-md-6 mb-2">
                              <img src="{{asset('assets/images/date_range.svg')}}" alt="">
                              <p>
                              {{date('Y-M-d', strtotime($k->start_date))}}
                              -
                              {{date('Y-M-d', strtotime($k->end_date))}}
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
                              <p>Rp {{number_format($k->budget,2,',','.')}}</p>
                          </div>
                      </div>
                      <div class="d-flex mt-4 button-cards">
                          <button class="btn btn-success" >Lihat Kegiatan</button>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
</div>
@endsection
