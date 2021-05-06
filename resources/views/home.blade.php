<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>{{env('APP_NAME')}}</title>
  </head>
  <body>
    <div>
      <div class="navbars">
        <div class="logo-img">
          <a href="{{URL::to('/')}}"><img src="{{asset('assets/images/Dinsos.png')}}" alt=""></a>
        </div>
        <div class="menu-list">
          <ul>
            <li><a href="{{URL::to('/')}}" class="active">Beranda</a></li>
            {{-- <li><a href="#">Profil</a></li> --}}
            <li><a href="{{URL::to('/upt')}}">UPT</a></li>
            <li><a href="{{URL::to('/berita')}}">Berita</a></li>
            <li><a href="{{URL::to('/tentang')}}">Tentang</a></li>
          </ul>
        </div>
        <div class="navbar-click">
          <a href="{{URL::to('/login')}}" class="btn">Masuk</a>
        </div>
      </div>
      <header>
        <div class="d-flex">
          <div class="info-header-1">
            <img src="{{asset('assets/images/imgheader.png')}}" alt="">
            <h2>Dinas Sosial Provinsi Jawa Timur</h2>
            <p>Dinas Sosial Jawa Timur melayani bantuan kepada masyarakat dari berbagai kota / kabupaten di Jawa Timur.
              Klik tombol dibawah ini untuk membantu sesama.</p>
            <a href="{{URL::to('/pengaduan')}}" class="btn btn-primary">Pengaduan</a>
          </div>
          <!-- <div class="img-donut-header">
            <img src="{{asset('assets/images/header-bulet.svg')}}" alt="">
          </div> -->
        </div>
      </header>
      <section>
        <div class="subhead">
          <p>Agenda</p>
        </div>
        <div class="head">
          <h3>Event yang akan diselenggarakan</h3>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="judulcard">Indonesia Automotified Surabaya</h3>
                  <div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/date_range.png')}}" alt="">
                      <p>14-15 Maret 2020</p>
                    </div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/place.png')}}" alt="">
                      <p>Tunjungan Plaza Lt.6</p>
                    </div>
                  </div>
                  <div class="contentcard">
                    <p>Surabaya PT.HIN Promosindo akan kembali menggelar rangkaian kompetisi modifikasi lewat gelaran Indonesia Automotified (IAM) MBtech 2020 Roadshow...</p>
                  </div>
                  <div class="lihat">
                    <a href="#">
                      <p>Lihat Event <small>></small></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="judulcard">Batik Bordir & Aksesoris Fair</h3>
                  <div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/date_range.png')}}" alt="">
                      <p>4-8 Maret 2020</p>
                    </div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/place.png')}}" alt="">
                      <p>Exhibiton Hall, Grand City Surabaya</p>
                    </div>
                  </div>
                  <div class="contentcard">
                    <p>Surabaya Batik Bordir Aksesoris Fair ke-15 berkolaborasi dengan Gelar Kriya Dekranasda ke-2 “The Authentic Handicraft of East Java” akan digelar pada hari Sabtu dan Minggu. Acara ini...</p>
                  </div>
                  <div class="lihat">
                    <a href="#">
                      <p>Lihat Event <small>></small></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="judulcard">Halal Bihalal dengan Gubernur Jatim</h3>
                  <div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/date_range.png')}}" alt="">
                      <p>2 Juni 2020</p>
                    </div>
                    <div class="daterange">
                      <img src="{{asset('assets/images/place.png')}}" alt="">
                      <p>Tunjungan Plaza Lt.6</p>
                    </div>
                  </div>
                  <div class="contentcard">
                    <p>Halal Bihalal yang akan digelar di kediaman gubernur Jawa Timur, Khofifah Indar Parawansa di Jl. Jemursari VII No.124 Surabaya masih dibanjiri masyarakat untuk bersilatuhrami...</p>
                  </div>
                  <div class="lihat">
                    <a href="#">
                      <p>Lihat Event <small></small></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="subhead">
          <p>Berita</p>
        </div>
        <div class="head">
          <h3>Berita Terbaru</h3>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <div class="img-berita">
                <img src="{{asset('assets/images/news1.png')}}" alt="">
              </div>
              <div class="container-card">
                <div class="card-berita">
                  <div class="card-body-berita">
                    <div class="info-berita">
                      <p>BPJS</p>
                      <p>22 November 2020</p>
                    </div>
                    <div class="judul-berita">
                      <h3>Jaga Alam, Tagana Kota Pasuruan dan</h3>
                    </div>
                    <div class="content-berita">
                      <p>Pantai utara Kelurahan Panggungrejo, Kecamatan Panggungrejo, Kota Pasuruan menjadi lokasi pilihan relawan Tagana...</p>
                    </div>
                    <div class="lihat">
                      <a href="#">
                        <p>Baca Selengkapnya <small>></small></p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="img-berita">
                <img src="{{asset('assets/images/news2.png')}}" alt="">
              </div>
              <div class="container-card">
                <div class="card-berita">
                  <div class="card-body-berita">
                    <div class="info-berita">
                      <p>BPJS</p>
                      <p>26 November 2020</p>
                    </div>
                    <div class="judul-berita">
                      <h3>Bersinergi Lintas Sektor, Tagana Dinsos...</h3>
                    </div>
                    <div class="content-berita">
                      <p>Selama dua hari, Selasa dan Rabu (24-25/11/2020), Tagana Dinsos Kabupaten Trenggalek bersama jeja...</p>
                    </div>
                    <div class="lihat">
                      <a href="#">
                        <p>Baca Selengkapnya <small>></small></p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="img-berita">
                <img src="{{asset('assets/images/news3.png')}}" alt="">
              </div>
              <div class="container-card">
                <div class="card-berita">
                  <div class="card-body-berita">
                    <div class="info-berita">
                      <p>BPJS</p>
                      <p>26 November 2020</p>
                    </div>
                    <div class="judul-berita">
                      <h3>Kemensos Berharap Program Tanam Sejuta...</h3>
                    </div>
                    <div class="content-berita">
                      <p>Di hari kedua kegiatan penguatan informasi penanggulangan bencana, Selasa (24/11/2020), Dinas Sosial...</p>
                    </div>
                    <div class="lihat">
                      <a href="#">
                        <p>Baca Selengkapnya <small>></small></p>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row justify-content-center all-berita">
            <div class="d-flex justify-content-center">
              <a href="#" class="btn btn-primary">Semua Berita</a>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="subhead">
          <p>Materi</p>
        </div>
        <div class="head">
          <h3>Olimp Pahlawan Disdik</h3>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-materi" >
                  <h3>Olimp Pahlawan Disdik 1</h3>
                  <img src="{{asset('assets/images/file_download.png')}}" alt="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-materi">
                  <h3>Olimp Pahlawan Disdik 2</h3>
                  <img src="{{asset('assets/images/file_download.png')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="footer">
        <div class="footer1 row">
          <div class="logo-footer column-footer col-md-3">
            <img src="{{asset('assets/images/DinsosWhite.png')}}" alt="">
          </div>
          <div class="alamat column-footer col-md-3">
            <p class="judulfooter">Alamat</p>
            <p class="alamat-text">Jl. Gayung Kebonsari No.56b, Gayungan, Kec. Gayungan, Kota SBY, Jawa Timur 60235</p>
          </div>
          <div class="kontak column-footer col-md-3">
            <p class="judulfooter">Kontak</p>
            <div class="kontak-div">
              <img src="{{asset('assets/images/alternate_email.png')}}" alt="">
              <p>dinsosjatim56b@gmail.com</p>
            </div>
            <div class="kontak-div">
              <img src="{{asset('assets/images/call.png')}}" alt="">
              <p>031-8290794</p>
            </div>
          </div>
          <div class="medsos column-footer col-md-3">
            <p class="judulfooter">Media Sosial</p>
            <div class="medsos-div">
              <img src="{{asset('assets/images/mdi_facebook.png')}}" alt="">
              <img src="{{asset('assets/images/mdi_instagram.png')}}" alt="">
              <img src="{{asset('assets/images/mdi_twitter.png')}}" alt="">  
              <img src="{{asset('assets/images/mdi_youtube.png')}}" alt="">  
            </div>
          </div>
        </div>
        <div class="footer2">
          <p>© 2020, Dinas Sosial Provinsi Jawa Timur.</p>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
   
  </body>
</html>