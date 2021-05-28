@extends('layout.template')
@section('head')
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
                        <h5>
                            <svg width="24" height="24" class="iconside" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 5.9C13.16 5.9 14.1 6.84 14.1 8C14.1 9.16 13.16 10.1 12 10.1C10.84 10.1 9.9 9.16 9.9 8C9.9 6.84 10.84 5.9 12 5.9ZM12 14.9C14.97 14.9 18.1 16.36 18.1 17V18.1H5.9V17C5.9 16.36 9.03 14.9 12 14.9ZM12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4ZM12 13C9.33 13 4 14.34 4 17V20H20V17C20 14.34 14.67 13 12 13Z" fill="#0d6efd"/>
                            </svg> Data Pegawai
                        </h5>
                    </div>
                    <form action="{{route('dinsos-filter-pegawai')}}" class="data-pegawai" method="post">
                    {!! csrf_field() !!}
                    <div class="d-flex justify-content-between mt-4">
                        <div class="d-flex justify-content-start">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($pegawai as $p)
            <div class="col-md-4 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="photouser">
                            @if(!isset($p->profile->photo))
                                <img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                            @else
                                <img src="{{route('images-getter', ['module' => 'profile', 'filename' => $p->profile->photo])}}" alt="">
                            @endif
                        </div>
                        <div class="data-pegawai">
                            <h3>Nama : {{ucwords($p->username)}}</h3>
                            @if(isset($p->title->unitkerja->nama_unit_kerja) && ($p->title->unitkerja->nama_unit_kerja!=null))
                                <h3>Jabatan : <u>{{ucwords($p->title->unitkerja->nama_unit_kerja)}}</u></h3>
                            @else
                                <h3>Jabatan : -</h3>
                            @endif
                            <h3>Instansi : @if(isset($p->upt->nama)){{$p->upt->nama}}@endif</h3>
                        </div>
                        <hr>
                        {{-- <div class="d-flex mt-5 button-card" >
                            <button class="btn btn-success" >Login</button>
                        </div> --}}
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
