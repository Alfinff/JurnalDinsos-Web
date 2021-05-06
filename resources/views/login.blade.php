<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Login Jurnal Dinsos</title>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <script src="https://use.fontawesome.com/448f6b23f4.js"></script>

  </head>
  <body>
    <div class="row m-0 flex-wrap-reverse">
      <div class="col-md-7">
        <div class="bg1">
          <img src="{{asset('assets/images/icon-login.png')}}" alt="">
          <h3>Selamat Datang</h3>
          <p>Silahan Masukkan Email dan Password untuk masuk ke Website</p>
        </div>
      </div>
      <div class="col-md-5 bg2">
        <div class="container coneen">
          <div class="d-flex justify-content-center logo-login">
            <a href="/">
              <img src="{{asset('assets/images/Dinsos.png')}}" alt="">
            </a>
          </div>
          <div class="text-login">
            <h3>Silahkan Login dengan akun anda</h3>
          </div>
          <div class="container">
            <form action="{{url('postLogin')}}" class="login-form" method="POST">
                @csrf
              <div class="form-group">
                <label for="email" class="label-icon"><i class="fa fa-envelope"></i></label>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="label-icon"><i class="fa fa-lock"></i></label>
                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                <label for="" class="label-icon-2"><i class="fa fa-eye"></i></label>
              </div>
              <div class="d-flex justify-content-end mt-3 lupapass">
                <a href="#">Lupa Password ?</a>
              </div>
              <div class="d-flex login-btn justify-content-center">
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
   
  </body>
</html>
