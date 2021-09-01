@extends('layout.template')
@section('head')
  <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
<style>
    .head-dalem{
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #F3F4F8;
      padding: 15px 15px 15px 15px;
      border-bottom: 1px solid #f3f4f8;
    }
    .head-dalem h5{
      font-size: 16px;
      font-weight: 400;
      color: #8890A7;
    }
    .head-dalem h5,.head-dalem p {
      margin: 0;
    }
    .accordion{
      overflow: hidden;
      padding: 3px;
    }
    .accordion h5{
      font-weight: 600;
    }
    .accordion-button{
      border-bottom: 1px solid #ddd;
      border-bottom-width: 1px !important;
      font-size: 16px;
      font-weight: 400;
      color: #0c63e4;
      background-color: #e7f1ff;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      border: none;
    }
    .show{
      border: none;
    }
    .accordion-item:last-of-type .accordion-collapse{
      border-bottom-left-radius: 10px !important;
      border-bottom-right-radius: 10px !important;
    }
    .accordion-button.collapsed{
      border-radius: 10px !important;
    }
    .accordion-collapse{
      border-width: 1px !important;
    }
    .linestraight{
      position: relative;
      top: 25px;
      display: flex;
      flex-direction: column;
      align-items: center;
      height: 100%;
    }
    .plus{
      width: 20px;
      height: 20px;
      border-radius: 50%;
      font-size: 20px;
      border: 4px solid #CFE0FF;
      color: #b9bfca;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #126AFC;
    }
    .dashed{
      border: 2px dashed #D6E5FF;
      height: calc(100% - 20px);
      width: 0;
    }
    @media only screen and (max-width: 600px) {
      .accordion-item{
        width: 100%;
      }
      .linestraight{
        margin-right: 10px
      }
    }
</style>
    <div class="col-lg-10">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                      <div class="back">
                        <a href="{{route('upt-penerima-manfaat')}}" class="d-flex">
                          <img src="{{asset('assets/images/back.png')}}" alt="">
                          <p>Kembali</p>
                        </a>
                      </div>
                        <div class="head-judul text-center">
                            <h3>Riwayat Perkembangan</h3>
                        </div>
                        <button id="download" class="btn btn-warning" >Download Data Perkembangan</button>
                        <hr>
                        <div class="accordion my-2" id="accordionTambah">
                          <h5>{{$bulan_sekarang}}</h5>
                          <div class="d-flex">
                            <div class="col-md-1">
                              <div class="linestraight">
                                <div class="plus">
                                </div>
                                <div class="dashed"></div>
                              </div>
                            </div>
                            <div class="col-md-11 accordion-item my-2">
                              <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#bulansekarang" aria-expanded="true" aria-controls="collapseOne">
                                + Tambah Riwayat
                              </button>
                              </h2>
                              <div id="bulansekarang" class="shadow-sm accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionTambah">
                                <div class="accordion-body">
                                  <form action="" class="kegiatantambah" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="perkembangan">Apakah Ada Perkembangan ? <small class="text-danger">*</small></label>
                                              <select name="perkembangan" required id="perkembangan" class="form-select">
                                                <option value="" selected disabled>Pilih Perkembangan</option>
                                                <option value="1" @if(old('perkembangan') == 1) selected @endif>Ya</option>
                                                <option value="2" @if(old('perkembangan') == 2) selected @endif>Tidak</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="bukti">Dokumentasi <small class="text-danger">*</small></label>
                                              <input type="file" required id="bukti" name="dokumentasi" data-show-remove="false" class="dropify" data-default-file="{{old('dokumentasi')}}" accept="image/*"/>
                                              <div class="warn">
                                                <small class="text-danger">Jenis File yang diterima : .jpg dan .png saja</small>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="keterangan">Keterangan <small class="text-danger">*</small></label>
                                              <textarea name="keterangan" id="keterangan" cols="30" rows="3" class="form-control" placeholder="Cth: Keterangan Perkembangan" required>{{old('keterangan')}}</textarea>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                          <button class="btn btn-primary" style="margin-right: 10px">Tambah</button>
                                          <a href="{{route('upt-penerima-manfaat')}}" class="btn btn-danger">Batal</a>
                                        </div>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if (isset($arrData))
                            @php
                                $ii = 1;
                            @endphp
                            @foreach ($arrData as $tahun => $val)
                                <div class="accordion my-2" id="accordionExample{{$ii}}">
                                    <h3>{{$tahun}}</h3>
                                    @foreach ($val as $isi => $v)
                                        <h5>- {{$isi}}</h5>
                                        @foreach ($v as $data => $s)
                                            <div class="d-flex accordion">
                                                <div class="col-md-1">
                                                    <div class="linestraight">
                                                        <div class="plus"></div>
                                                        <div class="dashed"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-11 accordion-item my-2">
                                                    <h2 class="accordion-header" id="heading{{$s['idjs']}}">
                                                        <button class="accordion-button shadow-sm collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#bulan{{$s['idjs']}}" aria-expanded="true" aria-controls="collapseOne">
                                                            {{$s['title']}}
                                                        </button>
                                                    </h2>
                                                    <div id="bulan{{$s['idjs']}}" class="shadow-sm accordion-collapse collapse" aria-labelledby="heading{{$s['idjs']}}" data-bs-parent="#accordionExample{{$ii}}">
                                                        <div class="accordion-body">
                                                          <div class="row">
                                                            <div class="col-md-6 " style="border-right: 2px solid #999">
                                                              <p>{{$s['keterangan']}}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                              <img src="{{Storage::disk('s3')->temporaryUrl($s['dokumentasi'], \Carbon\Carbon::now()->addMinutes(3600))}}" class="w-100" style="height: 290px;border-radius: 10px;">
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            @php
                                $ii++;
                            @endphp
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
  <script src="{{asset('assets/js/dropify.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('.dropify').dropify({
        messages: {
          'default': 'Drag and drop a file here or click',
          'replace': 'Drag and drop or click to replace',
          'remove':  'Remove',
          'error':   'Ooops, something wrong happended.'
        }
      });
    })
  </script>
@endsection
