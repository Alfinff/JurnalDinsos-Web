@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">

@endsection

@section('content')
<style>
    .card{
        box-shadow: 0px 4px 28px rgba(140, 140, 140, 0.2) !important;

    }
    .col-md-4{
        margin: 20px 0;
    }
    .logo-berita{
      height: 275px;
      overflow: hidden;
    }
    .logo-berita img{
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .logo-berita-2{
      height: 140px;
      overflow: hidden;
    }
    .logo-berita-2 img{
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .judul-berita a{
      text-decoration: none;
    }
    .judul-berita h4{
      overflow: hidden;
      margin-bottom: 20px;
      font-size: 20px;
      line-height: 26px;
      font-weight: 700;
      color: #282828;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      height: 52px;
    }
    .judul-berita-2 a{
      text-decoration: none;
    }
    .judul-berita-2 h4{
      height: 26px;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      margin-bottom: 20px;
      font-size: 20px;
      line-height: 26px;
      font-weight: 700;
      color: #282828
    }
    .content-berita p:first-child {
      margin-bottom: 30px;
      display: block !important;
    }
    .content-berita p {
      display: none;
    }
    .click-berita{
      display: flex;
      justify-content: space-between;
    }
    .click-berita a {
      text-decoration: none;
      margin: 0 !important;
      font-weight: 700;
      font-size: 16px;
    }
    .content-berita-2 p{
      height: 85px;
      margin-bottom: 30px;
      color: rgba(140, 140, 140, 1);
      font-weight: 400;
      font-size: 16px;
      line-height: 28px;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
    }
    .unggulan{
      display: flex;
    }
    .height-card{
      height: 188px;
      overflow: hidden;
      object-fit: cover;
      border-radius: 10px
    }
    .unggulan img{
      height: 180px;
      width: 230px;
      border-radius: 10px;
      margin-right: 15px;
      object-fit: cover;
    }
    .head-unggulan h4{
      font-weight: 700;
      font-size: 20px;
      color: #282828;
      margin-bottom: 20px;
    }
</style>
<header>
    <div class="d-flex">
        <div class="info-header-2 text-center">
            <img src="{{asset('assets/images/berita.png')}}" height="400" alt="">
            <h2>Berita</h2>
            <p class="text-center">Temukan berita terbaru tentang Dinas Sosial Jawa Timur dan UPT yang berada dibawah naungan Dinas Sosial Jawa Timur</p>
        </div>
    </div>
</header>
<section>
    <div class="subhead">
        <p>Berita</p>
    </div>
    <div class="head">
        <h3>Berita Terbaru</h3>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <div class="logo-berita">
              <img src="{{Storage::disk('s3')->temporaryUrl($beritaterbaru[0]->images, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
            </div>
            <div class="card-card">
              <div class="judul-berita">
                <a href="{{route('detailberita', ['id' => $beritaterbaru[0]->id])}}">
                  <h4>{{ucwords(substr($beritaterbaru[0]->title, 0, ))}}</h4>
                </a>
              </div>
              <div class="content-berita">
                {!! substr($beritaterbaru[0]->content, 0, 100) !!}
                <div class="click-berita">
                    <a href="#">{{\App\Helpers\Fungsi::hari_indo($beritaterbaru[0]->created_at)}}</a>
                    <a href="{{route('detailberita', ['id' => $beritaterbaru[0]->id])}}">Baca Selengkapnya ></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="margin-bottom: 50px;">
                <div class="card-card">
                  <div class="judul-berita">
                    <a href="#">
                      <h4>{{ucwords(substr($beritaterbaru[1]->title, 0,))}}</h4>
                    </a>
                  </div>
                  <div class="content-berita-2">
                    {!! substr($beritaterbaru[1]->content, 0, 100) !!}
                    <div class="click-berita">
                        <a href="#">{{\App\Helpers\Fungsi::hari_indo($beritaterbaru[1]->created_at)}}</a>
                        <a href="{{route('detailberita', ['id' => $beritaterbaru[1]->id])}}">Baca Selengkapnya ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="logo-berita-2">
                  <img src="{{Storage::disk('s3')->temporaryUrl($beritaterbaru[2]->images, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                </div>
                <div class="card-card">
                  <div class="judul-berita-2">
                    <a href="#">
                      <h4>{!! substr($beritaterbaru[2]->content, 0, 100) !!} </h4>
                    </a>
                  </div>
                  <div class="content-berita">
                    <div class="click-berita">
                        <a href="#">{{\App\Helpers\Fungsi::hari_indo($beritaterbaru[2]->created_at)}}</a>
                        <a href="{{route('detailberita', ['id' => $beritaterbaru[2]->id])}}">Baca Selengkapnya ></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</section>
<section>
  {{-- <div class="subhead">
    <p>Berita</p>
  </div> --}}
  <div class="head">
    <h3>Semua Berita</h3>
  </div>
  <div class="container">
    <div class="row owl-carousel bg-white">
        @foreach ($semuaberita as $b)
            <div class="w-100 p-3">
                <div class="card">
                    <div class="card-card">
                        <div class=" row">
                          <div class="col-md-6">
                            <img class="height-card" src="{{Storage::disk('s3')->temporaryUrl($b->images, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                          </div>
                          <div class="col-md-6">
                            <div class="head-unggulan">
                                <h4>{{ucwords(substr($b->title, 0, 35))}} ...</h4>
                                <div class="content-berita">
                                  {{-- {{$b->content}} --}}
                                    {!! substr($b->content, 0, ) !!}
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="click-berita">
                            <a href="#">{{\App\Helpers\Fungsi::hari_indo($b->created_at)}}</a>
                            <a href="{{route('detailberita', ['id' => $b->id])}}">Baca Selengkapnya ></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
</section>


{{-- <section>
  <div class="subhead">
      <p>Berita</p>
  </div>
  <div class="head">
      <h3>Berita Lainnya</h3>
  </div>
  <div class="container">
    <div class="row flex-row-reverse">
      <div class="col-md-7">
        <div class="card">
          <div class="logo-berita">
            <img src="{{asset('assets/images/image 4.png')}}" alt="">
          </div>
          <div class="card-card">
            <div class="judul-berita">
              <a href="#">
                <h4>Pensosmas Jatim Lakukan Screening Assist pada Warga Terindikasi Penyalahguna Narkoba</h4>
              </a>
            </div>
            <div class="content-berita">
              <p>GRESIK - Tri Juli Yansyah, relawan Penyuluh Sosial Masyarakat (Pensosmas) Jatim melakukan screening assist pada salah satu warga Desa Cerme Lor, Kec. Cerme, Kab. Gresik, Minggu (11/4/2021). Hal ini dilakukan Iyan, sapaan akrabnya, karena warga berinisial FK tersebut terin... </p>
              <div class="click-berita">
                <a href="#">BPPK | 11 April 2021</a>
                <a href="#">Baca Selengkapnya ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card" style="margin-bottom: 50px;">
              <div class="card-card">
                <div class="judul-berita">
                  <a href="#">
                    <h4>Hari Ketiga, Tim Gabungan Masih Lakukan Pencarian Misrin</h4>
                  </a>
                </div>
                <div class="content-berita-2">
                  <p>SITUBONDO – Tim gabungan masih mencari Misrin Balia (82), warga Dusun Jati RT 01 RW 02 Desa Ketah Kec...</p>
                  <div class="click-berita">
                    <a href="#">BPPK | 11 April 2021</a>
                    <a href="#">Baca Selengkapnya ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="logo-berita-2">
                <img src="{{asset('assets/images/image 5.png')}}" alt="">
              </div>
              <div class="card-card">
                <div class="judul-berita-2">
                  <a href="#">
                    <h4>Siaga Hadapi Bencana, Dinsos Boj Dinsos Boj Dinsos Boj</h4>
                  </a>
                </div>
                <div class="content-berita">
                  <div class="click-berita">
                    <a href="#">BPPK | 11 April 2021</a>
                    <a href="#">Baca Selengkapnya ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> --}}


@endsection
@section('script')
  <script>
    $(document).ready(function () {
      $(".owl-carousel").owlCarousel({
        nav: true,
        dots: true,
        dotsEach: 3,
        autoplay: true,
        autoplayTimeout: 5000,
        loop: true,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
          },
          600: {
            items: 1,
            nav: true,
          },
          1000: {
            items: 2,
            nav: true
          }
        }
      });
    })
  </script>
  <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
@endsection
