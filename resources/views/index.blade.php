<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('assets/images/logo-dinsos.ico')}}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    @yield('head')
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Jurnal Dinsos</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style type="text/css">
      .bolden{font-family:"Arial Black"}
      .table thead th{ background-color:#007bff!important; color:#FFFFFF;}
      #toast-container > div {
          opacity: 1;
          -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
          filter: alpha(opacity=100);
      }

      #toast-container > .alert {
          background-image: none !important;
      }

      #toast-container > .alert:before {
          position: fixed;
          font-family: FontAwesome;
          font-size: 24px;
          float: left;
          color: #FFF;
          padding-right: 0.5em;
          margin: auto 0.5em auto -1.5em;
      }

      #toast-container > .alert-info:before {
          content: "\f05a";
      }
      #toast-container > .alert-info:before,
      #toast-container > .alert-info {
          color: #31708f;
      }

      #toast-container > .alert-success:before {
          content: "\f00c";
      }
      #toast-container > .alert-success:before,
      #toast-container > .alert-success {
          color: #3c763d;
      }

      #toast-container > .alert-warning:before {
          content: "\f06a";
      }
      #toast-container > .alert-warning:before,
      #toast-container > .alert-warning {
          color: #8a6d3b;
      }

      #toast-container > .alert-danger:before {
          content: "\f071";
      }
      #toast-container > .alert-danger:before,
      #toast-container > .alert-danger {
          color: #a94442;
      }
      .toast-top-center {
          top: 12px;
          margin: 0 auto;
          left: 100%;
          }
      @media (min-width: 1400px) {
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
          max-width: 1500px; 
        } 
      }
    </style>
  </head>
  <body>
  <div class="modals-login" id="login-modal">
  <div class="penampung-popup">
      <div class="left-side-login">
        <div class="bg1">
          <img src="{{asset('assets/images/icon-login.png')}}" alt="">
          <h3>Selamat Datang</h3>
          <p>Silahan Masukkan Email dan Password untuk masuk ke Website</p>
        </div>
      </div>
      <div class="right-side-login bg2">
        <div class="close" onclick="closeLogin()">
          <i class="fa fa-times"></i>
        </div>
        <div class="container coneen">
          <div class="d-flex justify-content-center logo-login">
            <a href="/">
              <img src="{{asset('assets/images/Dinsos.png')}}" alt="">
            </a>
          </div>
          <div class="text-login">
            <h3>Silahkan Login dengan akun anda.</h3>
          </div>
          <div class="container">
            <form action="{{url('postLogin')}}" class="login-form" method="POST">
                @csrf
              <div class="form-group">
                <label for="email" class="label-icon m-0"><i class="fa fa-envelope"></i></label>
                <input type="email" name="email" id="email" placeholder="Email" value="{{old('email')}}" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="label-icon m-0"><i class="fa fa-lock"></i></label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                <label for="" onclick="openPassword()" class="label-icon-2 m-0"><i class="fa fa-eye"></i></label>
              </div>
              {{-- <div class="d-flex justify-content-end mt-3 lupapass">
                <a href="{{route('lupa-pass')}}">Lupa Password ?</a>
              </div> --}}
              <div class="d-flex login-btn justify-content-center mt-3">
                <input class="btn btn-primary w-50" vlue="Login" type="submit">
              </div>
            </form>
            <div class="d-flex justify-content-center move-page">
              {{-- <p>Tidak punya akun ? <a href="#">Daftar</a></p> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <div>
      <div class="navbars" id="navbars">
        <div class="logo-img">
          <a href="{{URL::to('/')}}" class="logo-dinsos"><img src="{{asset('assets/images/dinsostitle.png')}}"  alt="">
          <div>
            <h5>
              Dinas Sosial
            </h5>
            <p>
              Jawa Timur
            </p>

          </div>
        </a>
        </div>
        <div class="menu-list">
          <ul>
            @php
              $url = explode('/', request()->path());
            @endphp
            <li><a href="{{ route('index') }}" class="menunya @if(request()->is('/') || request()->is('halaman/pendaftaran')) active @endif">Beranda</a></li>
            <li><a href="{{route('halaman-upt')}}" class="menunya @if(isset($url[1])) @if($url[1] == 'upt') active @endif @endif">UPT</a></li>
            <li><a href="{{route('halaman-berita')}}" class="menunya @if(isset($url[1])) @if($url[1] == 'berita') active @endif @endif">Berita</a></li>
            <li><a href="{{route('tentang')}}" class="menunya @if(isset($url[1])) @if($url[1] == 'tentang') active @endif @endif">Tentang</a></li>
          </ul>
        </div>
        <div class="navbar-click">
          {{--@if(auth()->check())
            @php

              $role = Role::find(auth()->user()->role);
              if ($role->role == 'admin') {
                  $href = route('admin-home');
              } elseif ($role->role == 'upt') {
                  $href = route('upt-home');
              }
            @endphp
            <a href="{{ $href }}" class="btn" id="btnmasuk">Masuk</a>
          @else
            <a onclick="openModal()" class="btn" id="btnmasuk">Masuk</a>
            @endif--}}
            <a onclick="openModal()" class="btn" id="btnmasuk">Masuk</a>
        </div>
      </div>
      @yield('content')
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTIjtHftBY-v57W-AQJD803ArZqnjv_pY&callback=initMap&libraries=&v=weekly" async></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
      function openModal() {
        modal.style.display = 'flex'
      }
      const navbar = document.getElementById('navbars')
      const btn = document.getElementById('btnmasuk')
      const list = document.getElementsByClassName('menunya')
      window.onscroll = () => {
        if (this.scrollY > 80) {
          for (i = 0; i < list.length; i++) {
            list[i].classList.add('menuchange')
          }
          navbar.classList.add("fixeds")
          btn.classList.add("btnfixed")
        } else {
          for(i = 0; i < list.length; i++) {
            list[i].classList.remove('menuchange')
          }
          navbar.classList.remove("fixeds")
          btn.classList.remove("btnfixed")
        }
        // this.scrollY > 80 ?  : ; 
      }
    </script>
    <script>
      function openPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
      var modal = document.getElementById('login-modal')
      function closeLogin() {
        modal.style.display = 'none'
      }
    </script>
    @if(Session::has('message'))
      <script> 
      toastr.options = {
        "debug": false,
        "positionClass": "toast-top-right",
        "timeOut": 3000,
        // "onclick": null,
        // "fadeIn": 300,
        // "fadeOut": 1000,
        // "extendedTimeOut": 1000,
        // "tapToDismiss": true
      }
      @if(Session::has('style') == NULL)  
        document.getElementById('login-modal').style.display = 'flex'
      @endif
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
      }
      </script>
    @endif
    @yield('script')
  </body>
</html>