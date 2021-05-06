<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Jurnal Dinsos - Form Pengaduan</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="https://use.fontawesome.com/448f6b23f4.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
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
                          <label for="nama">Nama Lengkap</label>
                          <input type="text" name="nama_lengkap" id="nama" class="form-control" 
                          placeholder="Masukkan Nama Pasien" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="nik">NIK</label>
                          <!-- <input type="number" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK Pasien" required> -->
                          <input type="text" minlength="16" class="form-control" maxlength="16" pattern="{0-9}{0,16}" name="nik" id="nik" onkeypress='validate(event)' placeholder="Masukkan NIK Pasien" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tempatlahir">Tempat Lahir</label>
                          <input type="text" name="tempat_lahir" id="tempatlahir" placeholder="Tempat Lahir Pasien"
                          class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="tanggallahir">Tanggal Lahir</label>
                          <input type="date" name="tanggal_lahir" id="setTodaysDate" class="form-control">
                          <script>
                            setTodaysDate.max = new Date().toISOString().split("T")[0];
                          </script>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="umur">Umur</label>
                          <input type="number" name="umur" id="umur" placeholder="Masukkan Umur" class="form-control"
                          required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="jeniskelamin">Jenis Kelamin</label>
                          <select name="jenis_kelamin" id="jeniskelamin" class="form-control" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="L">Laki Laki</option>
                            <option value="P">Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                          <label for="handphone">No. Handphone</label>
                          <input type="number" name="no_hp" id="handphone" class="form-control" 
                          placeholder="Masukkan Nomor Handphone" required>
                          <script>
                            const phone = document.querySelector('#handphone')
                            const phoneinput = window.intlTelInput(phone, {
                              utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                            })
                          </script>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="provinsi">Provinsi</label>
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
                          <label for="kabupaten">Kota / Kabupaten</label>
                          <select name="kab_id" id="kabupaten" class="form-control" required>
                            <option value="" selected>Pilih Kota/Kabupaten</option>
                          </select>
                        </div>
                      </div>
    
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="kecamatan">Kecamatan</label>
                          <select name="kec_id" id="kecamatan" class="form-control" required>
                            <option value="" selected>Pilih Kecamatan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="alamatlengkap">Alamat Lengkap</label>
                          <textarea name="alamat" id="alamatlengkap" cols="30" rows="4" class="form-control" 
                              placeholder="Masukkan Alamat Lengkap" required></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="jenisaduan">Jenis Aduan</label>
                          <select name="jenis_aduan" id="jenisaduan" class="form-control" required>
                            <option value="" selected>Pilih Jenis Aduan</option>
                            <option value="1">Disabilitas</option>
                            <option value="2">Gangguan Jiwa</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="upt">UPT</label>
                          <select name="upt_id" id="upt" class="form-control" required>
                            <option value="" selected>Pilih UPT</option>
                            @foreach($upt as $u)
                                <option value="{{$u->id}}">{{$u->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group file-area">
                          <label for="images">Foto Kondisi</label>
                          <input type="file" name="foto_kondisi" id="images" required="required" multiple="multiple"/>
                          <div class="file-dummy">
                            <div class="success">Great, your files are selected. Keep on.</div>
                            <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p><p class="text-muted" id="alert-images"></p></div>
                          </div>
                          <div class="warn">
                            <small class=" text-danger">Jenis File yang diterima : .jpg dan .png saja Max file 5mb</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group file-area">
                          <label for="images">Surat Pengantar</label>
                          <input type="file" name="surat_pengantar" id="images2" required="required" multiple="multiple"/>
                          <div class="file-dummy">
                            <div class="success">Great, your files are selected. Keep on.</div>
                            <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p><p class="text-muted" id="alert-images2"></p></div>
                          </div>
                          <div class="warn">
                            <small class="text-danger">Jenis File yang diterima : .pdf Max file 5mb</small>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="rekomendasi">Rekomendasi Pendaftar</label>
                          <input type="text" name="nama_rekomendasi" id="rekomendasi" class="form-control" placeholder="Masukkan Nama Perekomendasian">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                          <label for="telepom">Telepon</label>
                          <input type="number" name="telp_rekomendasi" [ng2TelInputOptions]="{initialCountry: 'eg'}" id="telepon" class="form-control" placeholder="Masukkan Nomor Telepon">
                        </div>
                        <script>
                          const telephone = document.querySelector('#telepon')
                          const phoneinputs = window.intlTelInput(telephone, {
                            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                          })
                        </script>
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
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      $('#images').on('change', function() {
        document.getElementById('alert-images').innerHTML = document.getElementById('images').files[0].name
      })
      $('#images2').on('change', function() {
        document.getElementById('alert-images2').innerHTML = document.getElementById('images2').files[0].name
      })
        $(document).ready(function() {
            $.ajax({
                url: "{{url('api/provinsi')}}",
                method: "GET",
                success: function(result) {
                    console.log(result);
                }
            });

            // Apabila provinsi diganti maka list kabupaten berganti
            // $('#provinsi').on('change', function() {
            //     $.ajax({
            //         url: "{{url('api/kabupaten')}}/"+this.value,
            //         method: "GET",
            //         success: function(result) {
            //             $('#kabupaten').find('option')
            //                 .remove()
            //                 .end()
            //                 .append('<option value="">Pilih Kota/Kabupaten</option>');
            //             $('#kecamatan').find('option')
            //                 .remove()
            //                 .end()
            //                 .append('<option value="">Pilih Kecamatan</option>');
            //             result.kabupaten.forEach(function(item) {
            //                 $('#kabupaten').append(`<option value="${item.kab_id}">${item.kab}</option>`);
            //                 });
            //             }
            //         });
            //     });
                $(document).ready(function() {
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
                })
            $('#kabupaten').on('change', function() {
                $.ajax({
                    url: "{{url('api/kecamatan')}}/"+this.value,
                    method: "GET",
                    success: function(result) {
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
