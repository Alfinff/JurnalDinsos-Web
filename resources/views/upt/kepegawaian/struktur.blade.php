@extends('layout.template')
@section('content')
<div class="col-lg-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="head-juduls">
                    <h5><i class="fa fa-users text-primary"></i> Struktur Organisasi</h5>
                </div>
            </div>
            <section>
                <div class="subhead">
                    <p>Struktur Organisasi</p>
                </div>
                <div class="head">
                    <h3>{{$detail->nama}}</h3>
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

                                            <h5 class="username text-center">
                                                Pimpinan :
                                                @if($pimpinan[$idInduk] != null)
                                                    <u>{{ucwords($pimpinan[$idInduk]->users->username)}}</u>
                                                @else
                                                    <i>Kosong</i>
                                                @endif
                                            </h5>
                                            <div class="judulcard-upt">
                                                <p class="text-center mt-3 mb-0">
                                                    Jabatan : @if(isset($dtInduk['nama_unit_kerja'])){{$dtInduk['nama_unit_kerja']}}@endif
                                                </p>
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

                                                <h5 class="username text-center">
                                                    Pimpinan :
                                                    @if($pimpinan[$id_unit] != null)
                                                        <u>{{ucwords($pimpinan[$id_unit]->users->username)}}</u>
                                                    @else
                                                        <i>Kosong</i>
                                                    @endif
                                                </h5>
                                                <div class="judulcard-upt">
                                                    <p class="text-center mt-3 mb-0">
                                                        Jabatan : {{$dtUnit['nama_unit_kerja'] ?? ''}}
                                                    </p>
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

                                            <h5 class="username text-center">
                                                Pimpinan :
                                                @if($pimpinan[$idx] != null)
                                                    <u>{{ucwords($pimpinan[$idx]->users->username)}}</u>
                                                @else
                                                    <i>Kosong</i>
                                                @endif
                                            </h5>
                                            <div class="judulcard-upt">
                                                <p class="text-center mt-3 mb-0">
                                                    Jabatan : {{$dtx['nama_unit_kerja'] ?? ''}}
                                                </p>
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

            </section>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function dropdowns() {
    document.getElementById("dropdownMenuButton").classList.toggle("show");
  }
</script>


@endsection
@section('jquery')

@endsection
