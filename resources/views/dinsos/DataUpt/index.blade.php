@extends('layout.template')
@section('content')
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="head-judul text-center">
                            <h3>Daftar UPT</h3>
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
                            </div>
                        </form>
                        <div style="width: auto;">
                            <button class="btn btn-success" style="background-color: #12C58E;border-color: #12C58E;">+ Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row list-card">

            @foreach($upt as $u)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-card">
                            <div class="photocard">
                                <img src="{{asset('assets/images/dataupt2.png')}}" alt="">
                            </div>
                            <div class="judulcards">
                                <h3>{{ucwords($u->nama)}}</h3>
                            </div>
                            <div class="row justify-content-between">
                                <div class="location col-md-6">
                                    <i class="fa fa-map-marker"></i>
                                    <p>{{ucwords($u->alamat)}}</p>
                                </div>
                                <div class="count-people col-md-6">
                                    <i class="fa fa-user"></i>
                                    <p>{{count($u->pendaftaran)}} Orang</p>
                                </div>
                            </div>
                            <div class="d-flex mt-4 button-cards">
                                <a href="{{route('dinsos-dataupt-detail', ['uuid' => $u->uuid])}}" class="btn btn-success" >Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection
