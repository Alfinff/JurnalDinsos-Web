@extends('layout.template')
@section('content')
  <div class="col-md-10 bg-col">
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
            <div class="back">
                <a href="{{ route('upt-kepegawaian-unitkerja') }}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Form Edit Unit Kerja</h3>
                <hr>
            </div>
            <hr>
            <div class="mx-3 my-3">
              <form action="" class="kegiatantambah" method="post">
                  @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="kode">Kode</label>
                      <input type="text" name="kode" id="kode" class="form-control" placeholder="Cth: Nama" value="{{$unitkerja->kode_unit_kerja}}" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jabatan">Jabatan</label>
                      <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{$unitkerja->nama_unit_kerja}}" placeholder="Cth: Kepala" required>
                    </div>
                  </div>
                  <div class="col-md-12 mt-4">
                    <div class="d-flex justify-content-center">
                      <button class="btn mx-1 btn-primary">Edit</button>
                      <a href="{{route('upt-kepegawaian-unitkerja')}}" class="btn mx-1 btn-danger">Kembali</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
