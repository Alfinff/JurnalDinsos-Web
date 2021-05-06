@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
@endsection
@section('content')
<header>
        <div class="d-flex">
          <div class="info-header-1">
            <img src="{{asset('assets/images/imgheader.png')}}" alt="">
            <h2>Dinas Sosial Provinsi Jawa Timur</h2>
            <p>Dinas Sosial Jawa Timur melayani bantuan kepada masyarakat dari berbagai kota / kabupaten di Jawa Timur.
              Klik tombol dibawah ini untuk membantu sesama.</p>
            <a href="{{route('pendaftaran')}}" class="btn btn-primary" style="font-weight: bolder">Pendaftaran</a>
          </div>
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
                    <p>Surabaya Batik Bordir Aksesoris Fair ke-15 berkolaborasi dengan Gelar Kriya Dekranasda ke-2  Authentic Handicraft of East  akan digelar pada hari Sabtu dan Minggu. Acara ini...</p>
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
          <p>Video</p>
        </div>
        <div class="head">
          <h3>Video Dinas Sosial</h3>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-video">
                  <iframe src="https://www.youtube.com/embed/t6ZvwhZ3EE4" frameborder="0"></iframe>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-video">
                  <iframe src="https://www.youtube.com/embed/GbbCxHHyyFI" frameborder="0"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="subhead">
          <p>Alamat</p>
        </div>
        <div class="head">
          <h3>Lokasi Dinas Sosial Jawa Timur</h3>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                {{-- <div class="card-body"> --}}
                  <div id="map" style="width: 100%;height: 400px"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById("map"),{
            zoom: 17,
            center: new google.maps.LatLng(-7.3300895,112.7255647),
            scrollwheel: false,
            draggable: true,
          });
          const infowindow = new google.maps.InfoWindow();
          var marker, i;
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(-7.3300895,112.7255647),
            // icon: {
            //   url: '/img/marker.svg',
            //   scaledSize : new google.maps.Size(45, 50),
            // },
            map: map
          });
          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent('Dinas Sosial Provinsi Jawa Timur')
              infowindow.open(map, marker);
            }
          })(marker, i))

        }
      </script>
  
      @endsection