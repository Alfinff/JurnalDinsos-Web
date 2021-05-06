@extends('navigation')
@section('content')
<div class="col-md-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Daftar UPT</h3>
          </div>
          <form action="" class="data-pendaftar">
            <div class="row justify-content-between">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="daftarupt">Pilih UPT</label>
                  <select name="daftarupt" id="daftarupt" class="form-select">
                    <option value="" selected>Daftar UPT</option>
                    <option value="1">Daftar UPT</option>
                  </select>
                </div>
              </div>
              <div style="width: auto;">
                <button class="btn btn-success" style="background-color: #12C58E;border-color: #12C58E;">Tambah</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-card">
          <div class="photocard">
            <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
          </div>
          <div class="judulcards">
            <h3>UPT.PSTW BLITAR</h3>
          </div>
          <div class="d-flex justify-content-between">
            <div class="location">
              <i class="fa fa-map-marker"></i>
              <p>Surabaya</p>
            </div>
            <div class="count-people">
              <i class="fa fa-user"></i>
              <p>190 Orang</p>
            </div>
          </div>
          <hr>
          <div class="d-flex mt-4 button-cards">
            <button class="btn btn-success" >Lihat Detail</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-card">
          <div class="photocard">
            <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
          </div>
          <div class="judulcards">
            <h3>UPT.PSTW BLITAR</h3>
          </div>
          <div class="d-flex justify-content-between">
            <div class="location">
              <i class="fa fa-map-marker"></i>
              <p>Surabaya</p>
            </div>
            <div class="count-people">
              <i class="fa fa-user"></i>
              <p>190 Orang</p>
            </div>
          </div>
          <hr>
          <div class="d-flex mt-4 button-cards">
            <button class="btn btn-success" >Lihat Detail</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-card">
          <div class="photocard">
            <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
          </div>
          <div class="judulcards">
            <h3>UPT.PSTW BLITAR</h3>
          </div>
          <div class="d-flex justify-content-between">
            <div class="location">
              <i class="fa fa-map-marker"></i>
              <p>Surabaya</p>
            </div>
            <div class="count-people">
              <i class="fa fa-user"></i>
              <p>190 Orang</p>
            </div>
          </div>
          <hr>
          <div class="d-flex mt-4 button-cards">
            <button class="btn btn-success" >Lihat Detail</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-card">
          <div class="photocard">
            <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
          </div>
          <div class="judulcards">
            <h3>UPT.PSTW BLITAR</h3>
          </div>
          <div class="d-flex justify-content-between">
            <div class="location">
              <i class="fa fa-map-marker"></i>
              <p>Surabaya</p>
            </div>
            <div class="count-people">
              <i class="fa fa-user"></i>
              <p>190 Orang</p>
            </div>
          </div>
          <hr>
          <div class="d-flex mt-4 button-cards">
            <button class="btn btn-success" >Lihat Detail</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card">
        <div class="card-card">
          <div class="photocard">
            <img src="{{asset('assets/images/uptsementara.png')}}" alt="">
          </div>
          <div class="judulcards">
            <h3>UPT.PSTW BLITAR</h3>
          </div>
          <div class="d-flex justify-content-between">
            <div class="location">
              <i class="fa fa-map-marker"></i>
              <p>Surabaya</p>
            </div>
            <div class="count-people">
              <i class="fa fa-user"></i>
              <p>190 Orang</p>
            </div>
          </div>
          <hr>
          <div class="d-flex mt-4 button-cards">
            <button class="btn btn-success" >Lihat Detail</button>
            <button class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection