<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Jurnal Dinsos - Form Pendaftaran</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="https://kit.fontawesome.com/8455e85ee2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="{{asset('assets/js/intlTelInput.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
  </head>
  <body>
    @extends('index')
    @section('content')

    <style>
      .navbars{
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.16);
        background: white !important;
      }
      .menu-list ul li a{
        color: #C3C3C3 !important;
      }
      .menunya:hover{
        color: #1A73E8 !important;
        border-bottom: 3px solid #1A73E8 !important;
      }
      .menu-list .active {
        color: #1A73E8 !important;
        border-bottom: 3px solid #1A73E8 !important;
      }
      #btnmasuk{
        border: 2px solid #1A73E8 !important;
        color: #1A73E8 !important;
      }
      .logo-dinsos p, .logo-dinsos h5 {
        color: #282828;
      }
      .form-group label{
        padding: 5px;
      }
    </style>
    <div class=" martop">
      <div class="row m-0">
        <div class="col-md-12">
          <div class="card">
            <div class="btn-back">
              <a href="{{URL::to('/')}}" class="backed"><img src="{{asset('assets/images/keyboard_backspace.png')}}" alt=""></a>
            </div>
            <div class="card-body">
              <div class="judul-pengaduan">
                <h1>Form Pendaftaran</h1>
              </div>
              <form action="" class="form-pengaduan" method="POST" enctype="multipart/form-data">
                  @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="nama">Nama Lengkap <small style="color: red;">*</small> </label>
                          <input type="text" name="nama_lengkap" id="nama" class="form-control"
                          placeholder="Cth: Nama" value="{{old('nama_lengkap')}}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="nik">NIK <small style="color: red;">*</small> </label>
                          <input type="text" minlength="16"  class="form-control" maxlength="16" pattern="[0-9]{16}" name="nik" id="nik" onkeypress='validate(event)' placeholder="Cth: 1234567890123456" value="{{old('nik')}}" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tempatlahir">Tempat Lahir <small style="color: red;">*</small></label>
                          <input type="text" name="tempat_lahir" id="tempatlahir" placeholder="Cth: Jawa Timur"
                          class="form-control" value="{{old('tempat_lahir')}}"" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tanggallahir">Tanggal Lahir <small style="color: red;">*</small></label>
                          <input type="date" name="tanggal_lahir" required id="setTodaysDate" class="form-control" value="{{old('tanggal_lahir')}}" >
                          <script>
                            setTodaysDate.max = new Date().toISOString().split("T")[0];
                          </script>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="umur">Umur <small style="color: red;">*</small></label>
                          <input type="number" name="umur" id="umur" value="{{old('umur')}}" placeholder="Cth: 25" class="form-control"
                          required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="jeniskelamin">Jenis Kelamin <small style="color: red;">*</small></label>
                          <select name="jenis_kelamin" id="jeniskelamin" class="form-control" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            @foreach ($jenis_kelamin as $jk)
                                <option value="{{$jk->uuid}}" @if(old('jenis_kelamin') == $jk->uuid) selected @endif>{{ucwords($jk->nama)}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                          <label for="handphone">No. Handphone <small style="color: red;">*</small></label>
                          <input type="text" pattern="[0][0-9]\d{9,}" name="no_hp" value="{{old('no_hp')}}" id="handphone" class="form-control"
                          placeholder="Cth: 08312890981" required>
                          {{-- <script>
                            const phone = document.querySelector('#handphone')
                            const phoneinput = window.intlTelInput(phone, {
                              utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                            })
                          </script> --}}
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="provinsi">Provinsi <small style="color: red;">*</small></label>
                          <select name="prov_id" id="provinsi" class="form-control" disabled required>
                            <option value="" selected>Pilih Provinsi</option>
                            @foreach($provinsi as $p)
                                <option value="{{$p->prov_id}}" @if($p->prov_id == '35') selected @endif>{{$p->prov}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="kabupaten">Kota / Kabupaten <small style="color: red;">*</small></label>
                          <select name="kab_id" id="kabupaten" class="form-control" required>
                            <option value="" selected>Pilih Kota/Kabupaten</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="kecamatan">Kecamatan <small style="color: red;">*</small></label>
                          <select name="kec_id" id="kecamatan" class="form-control" required>
                            <option value="" selected>Pilih Kecamatan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="alamatlengkap">Alamat Lengkap <small style="color: red;">*</small></label>
                          <textarea name="alamat" id="alamatlengkap" cols="30" rows="4" class="form-control" placeholder="Cth: Jl. Jawa Timur No.1" required>{{old('alamat')}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="jenisaduan">Jenis Aduan <small style="color: red;">*</small></label>
                          <select name="jenis_aduan" id="jenisaduan" {{old('jenis_aduan')}} class="form-control" required>
                            <option value="" selected disabled>Pilih Jenis Aduan</option>
                            @foreach ($jenis_aduan as $j)
                                <option value="{{$j->uuid}}" @if(old('jenis_aduan') == $j->uuid) selected @endif>{{$j->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="upt">UPT <small style="color: red;">*</small></label>
                          <select name="upt_id" id="upt" class="form-control" required>
                            <option value="" selected disabled>Pilih UPT</option>
                            @foreach($upt as $u)
                                <option value="{{$u->uuid}}" @if(old('upt_id') == $u->uuid) selected @endif>{{$u->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="images">Foto Kondisi <small style="color: red;">*</small></label>
                          <input type="file" id="input-file-now" data-default-file="{{old('foto_kondisi')}}" name="foto_kondisi" data-show-remove="false" class="dropify" accept="image/*" required/>
                          <div class="warn">
                            <small class="text-danger">Jenis File yang diterima : .png .jpg Max file 5mb</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group file-area">
                          <label for="images">Surat Pengantar <small style="color: red;">*</small></label>
                          <div style="position: relative">
                            <input type="file" name="surat_pengantar" data-default-file="{{old('surat_pengantar')}}" accept="application/pdf" id="images2" required multiple="multiple"/>
                            <div class="file-dummy">
                              <div class="success">Great, your files are selected. Keep on.</div>
                              <div class="default">
                                <i class="fas fa-file-pdf" style="color: #1A73E8;font-size: 30px;margin: 10px 0;"></i>
                                <p>Unggah Disini</p><p class="text-muted" id="alert-images2"></p>
                              </div>
                            </div>
                          </div>
                          <div class="warn">
                            <small class="text-danger">Jenis File yang diterima : .pdf Max file 5mb</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="rekomendasi">Rekomendasi Pendaftar <small style="color: red;">*</small></label>
                          <input required type="text" name="nama_rekomendasi" value="{{old('nama_rekomendasi')}}" id="rekomendasi" class="form-control" placeholder="Cth: Nama Perekomendasi">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                          <label for="telepom">Telepon <small style="color: red;">*</small></label>
                          <input required type="text" name="telp_rekomendasi" value="{{old('telp_rekomendasi')}}" onkeypress='validate(event)' pattern="[0][0-9]\d{9,}" id="telepon" class="form-control" placeholder="Cth: 08312890981" title="Harus Diawali Dengan 0">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row btn-lapor justify-content-center">
                  <button class="btn btn-primary">Laporkan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/dropify.js')}}"></script>

    <script>
      $('#images').on('change', function() {
        document.getElementById('alert-images').innerHTML = document.getElementById('images').files[0].name
      })
      $('#images2').on('change', function() {
        document.getElementById('alert-images2').innerHTML = document.getElementById('images2').files[0].name
      })
        $(document).ready(function() {
          $('.dropify').dropify({
            messages: {
              'default': 'Drag and drop a file here or click',
              'replace': 'Drag and drop or click to replace',
              'remove':  'Remove',
              'error':   'Ooops, something wrong happended.'
            }
          });
          $.ajax({
            url: "{{url('api/provinsi')}}",
            method: "GET",
            success: function(result) {
              console.log(result);
            }
          });
          $.ajax({
            url: "{{url('api/kabupaten')}}/35",
            method: "GET",
            success: function(result) {
              $('#kabupaten').find('option')
                .remove()
                .end()
                .append('<option value="">Pilih Kota/Kabupaten</option>');
              $('#kecamatan').find('option')
                .remove()
                .end()
                .append('<option value="">Pilih Kecamatan</option>');
              result.kabupaten.forEach(function(item) {
                $('#kabupaten').append(`<option value="${item.kab_id}">${item.kab}</option>`);
              });
            }
          });
          $('#kabupaten').on('change', function() {
            $.ajax({
              url: "{{url('api/kecamatan')}}/"+this.value,
              method: "GET",
              success: function(result) {
                var sel = document.getElementById("kabupaten");
                var text = sel.options[sel.selectedIndex].text;
                var res = text.split(" ");
                if(res[1] != null) {
                  var kotanya = res[1];
                } else {
                  var kotanya = res[0];
                }
                $('#kecamatan').find('option')
                  .remove()
                  .end()
                  .append('<option value="">Pilih Kecamatan</option>');
                result.kecamatan.forEach(function(item) {
                  $('#kecamatan').append(`<option value="${item.kec_id}">${item.kec}</option>`);
                });
              }
            });
          });
        });
@if(\Session::has('success'))
    alert("{!! \Session::get('success') !!}");
@endif
@if(\Session::has('failed'))
    alert("{!! \Session::get('failed') !!}");
@endif
    </script>
    <script src="{{asset('assets/js/bootstrap-maxlength.min.js')}}"></script>
    <script>
      $('input#nik').maxlength({
        alwaysShow: true,
        warningClass: "badge badge-info",
        limitReachedClass: "badge badge-warning"
      });
    </script>
    <script>
      function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
          theEvent.returnValue = false;
          if(theEvent.preventDefault) theEvent.preventDefault();
        }
      }

    </script>

  </body>
</html>
@endsection
