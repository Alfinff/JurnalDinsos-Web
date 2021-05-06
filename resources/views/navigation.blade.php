<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vertical-responsive-menu.css')}}">

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/448f6b23f4.js"></script>

    <!-- Apex Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

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
    <div>
      <div class="navbar2">
        <div class="p-navbar2">
          <div class="logo-img2">
            <img src="{{asset('assets/images/DinsosWhite.png')}}" alt="">
          </div>
          <div class="button-navbar2">
            <div class="notif" onclick="notif()">
              <a href="#">
                <i class="fa fa-bell"></i>
                <small class="badge badge-danger" style="top: -6px;position: absolute;left: 15px;border-radius: 100%;">1</small>
              </a>
              <div class="boxnotif" id="boxnotif">
                <h6 class="dropdown-item-text font-15 m-0 py-3 bg-light text-dark d-flex justify-content-between align-items-center">
                  Notification
                  <span class="badge badge-primary badge-pill">2</span>
                </h6>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 695px;">
                  <div class="slimscroll notification-list" style="overflow-y: auto; width: auto; height: 695px;background: white;">
                  <!-- item-->
                  <a href="#" class="dropdown-item py-3">
                      <small class="float-right text-muted pl-2">2 min ago</small>
                      <div class="media">
                          <div class="media-body align-self-center ml-2 text-truncate">
                              <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>
                              <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                          </div><!--end media-body-->
                      </div><!--end media-->
                  </a><!--end-item-->
                  <!-- item-->
                  <a href="#" class="dropdown-item py-3">
                      <small class="float-right text-muted pl-2">10 min ago</small>
                      <div class="media">
                          <div class="media-body align-self-center ml-2 text-truncate">
                              <h6 class="my-0 font-weight-normal text-dark">Meeting with designers</h6>
                              <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                          </div><!--end media-body-->
                      </div><!--end media-->
                  </a><!--end-item-->
                  <!-- item-->
                  <a href="#" class="dropdown-item py-3">
                      <small class="float-right text-muted pl-2">40 min ago</small>
                      <div class="media">
                          <div class="media-body align-self-center ml-2 text-truncate">
                              <h6 class="my-0 font-weight-normal text-dark">UX 3 Task complete.</h6>
                              <small class="text-muted mb-0">Dummy text of the printing.</small>
                          </div><!--end media-body-->
                      </div><!--end media-->
                  </a><!--end-item-->
                  <!-- item-->
                  <a href="#" class="dropdown-item py-3">
                      <small class="float-right text-muted pl-2">1 hr ago</small>
                      <div class="media">
                          <div class="media-body align-self-center ml-2 text-truncate">
                              <h6 class="my-0 font-weight-normal text-dark">Your order is placed</h6>
                              <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                          </div><!--end media-body-->
                      </div><!--end media-->
                  </a><!--end-item-->
                  <!-- item-->
                  <a href="#" class="dropdown-item py-3">
                      <small class="float-right text-muted pl-2">2 hrs ago</small>
                      <div class="media">
                          <div class="media-body align-self-center ml-2 text-truncate">
                              <h6 class="my-0 font-weight-normal text-dark">Payment Successfull</h6>
                              <small class="text-muted mb-0">Dummy text of the printing.</small>
                          </div><!--end media-body-->
                      </div><!--end media-->
                  </a><!--end-item-->
              </div><div class="slimScrollBar" style="background: rgba(162, 177, 208, 0.13); width: 7px; position: absolute; top: 0px; opacity: 1; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 142.353px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
              </div>
            </div>
            <div class="afterprof">
              <div class="d-flex align-items-center infoprofile" onclick="clickProfile()">
                <img src="{{asset('assets/images/photouser.png')}}" alt="">
                <div class="nameprofile">
                  <p>User Name</p>
                  <h3>{{auth()->user()->username ?? ''}}</h3>
                </div>
              </div>
              <div class="showpopup" id="showpopup">
                <a href="{{route('logout')}}">
                  <div class="menu-pop">
                    <i class="fa fa-sign-out"></i>
                    <p>Logout</p>
                  </div>
                </a>
              </div>
            </div>
            <button type="button" class="toggle_menu" id="toggle_menu">
              <i class="fa fa-bars"></i>
            </button>        
          </div>
        </div>
      </div>
      
      <div class="row m-0" style="background: #E5E5E5">
        <div class="col-md-2 shad">
          <div class="sidebar">
            <div class="side1">
              <img src="{{asset('assets/images/photouser.png')}}" alt="">
              <h3>{{auth()->user()->username ?? ''}}</h3>
              <p>Dinsos</p>
            </div>
            <hr>
            <div class="legendside">
              <h6>Menu</h6>
            </div>
            <div class="vertical_nav">
              <ul id="js-menu" style="position: relative;" class="menu">

                <li class="menu--item  ">
                  <a href="{{route('dinsos-home')}}" class="menu--link @if(request()->is('dinsos')) active @endif" title="Item 1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="iconside" d="M20.38 8.57012L19.15 10.4201C19.7432 11.6032 20.0336 12.915 19.9952 14.2378C19.9568 15.5607 19.5908 16.8534 18.93 18.0001H5.06999C4.21116 16.5102 3.85528 14.7832 4.05513 13.0752C4.25497 11.3671 4.9999 9.76895 6.17947 8.51755C7.35904 7.26615 8.91046 6.42816 10.6037 6.12782C12.297 5.82747 14.042 6.08076 15.58 6.85012L17.43 5.62012C15.5465 4.41234 13.3123 3.87113 11.0849 4.08306C8.85744 4.29499 6.76543 5.24782 5.14348 6.78913C3.52153 8.33045 2.46335 10.3712 2.13821 12.5849C1.81306 14.7987 2.23974 17.0575 3.34999 19.0001C3.5245 19.3024 3.77508 19.5537 4.07682 19.7292C4.37856 19.9046 4.72096 19.998 5.06999 20.0001H18.92C19.2724 20.0015 19.6189 19.9098 19.9245 19.7342C20.2301 19.5586 20.4838 19.3053 20.66 19.0001C21.5814 17.404 22.0438 15.5844 21.9961 13.7421C21.9485 11.8998 21.3926 10.1064 20.39 8.56012L20.38 8.57012ZM10.59 15.4101C10.7757 15.5961 10.9963 15.7436 11.2391 15.8442C11.4819 15.9449 11.7422 15.9967 12.005 15.9967C12.2678 15.9967 12.5281 15.9449 12.7709 15.8442C13.0137 15.7436 13.2342 15.5961 13.42 15.4101L19.08 6.92012L10.59 12.5801C10.404 12.7659 10.2565 12.9864 10.1559 13.2292C10.0552 13.472 10.0034 13.7323 10.0034 13.9951C10.0034 14.258 10.0552 14.5182 10.1559 14.761C10.2565 15.0038 10.404 15.2244 10.59 15.4101Z" fill="#8C8C8C"/>
                    </svg>

                    <span class="menu--label">Dashboard</span>
                  </a>
                </li>
          
                @php
                  $url = explode('/', request()->path());
                @endphp
                <li class="menu--item menu--item__has_sub_menu @if(isset($url[1])) @if($url[1] == 'pegawai') menu--subitens__opened @else @endif @endif">
                  <label class="menu--link" title="Item 2">
                    <svg width="24" class="iconside" height="12" viewBox="0 0 24 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4 7C5.1 7 6 6.1 6 5C6 3.9 5.1 3 4 3C2.9 3 2 3.9 2 5C2 6.1 2.9 7 4 7ZM5.13 8.1C4.76 8.04 4.39 8 4 8C3.01 8 2.07 8.21 1.22 8.58C0.48 8.9 0 9.62 0 10.43V12H4.5V10.39C4.5 9.56 4.73 8.78 5.13 8.1ZM20 7C21.1 7 22 6.1 22 5C22 3.9 21.1 3 20 3C18.9 3 18 3.9 18 5C18 6.1 18.9 7 20 7ZM24 10.43C24 9.62 23.52 8.9 22.78 8.58C21.93 8.21 20.99 8 20 8C19.61 8 19.24 8.04 18.87 8.1C19.27 8.78 19.5 9.56 19.5 10.39V12H24V10.43ZM16.24 7.65C15.07 7.13 13.63 6.75 12 6.75C10.37 6.75 8.93 7.14 7.76 7.65C6.68 8.13 6 9.21 6 10.39V12H18V10.39C18 9.21 17.32 8.13 16.24 7.65ZM8.07 10C8.16 9.77 8.2 9.61 8.98 9.31C9.95 8.93 10.97 8.75 12 8.75C13.03 8.75 14.05 8.93 15.02 9.31C15.79 9.61 15.83 9.77 15.93 10H8.07ZM12 2C12.55 2 13 2.45 13 3C13 3.55 12.55 4 12 4C11.45 4 11 3.55 11 3C11 2.45 11.45 2 12 2ZM12 0C10.34 0 9 1.34 9 3C9 4.66 10.34 6 12 6C13.66 6 15 4.66 15 3C15 1.34 13.66 0 12 0Z" fill="#8C8C8C"/>
                    </svg>

                    <span class="menu--label">Master Kepegawaian</span>
                  </label>
                  <ul class="sub_menu">
                    <li class="sub_menu--item">
                      <a href="{{route('dinsos-pegawai-pendaftar')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai/pendaftar')) active @endif">
                      <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 8C13 5.79 11.21 4 9 4C6.79 4 5 5.79 5 8C5 10.21 6.79 12 9 12C11.21 12 13 10.21 13 8ZM11 8C11 9.1 10.1 10 9 10C7.9 10 7 9.1 7 8C7 6.9 7.9 6 9 6C10.1 6 11 6.9 11 8ZM1 18V20H17V18C17 15.34 11.67 14 9 14C6.33 14 1 15.34 1 18ZM3 18C3.2 17.29 6.3 16 9 16C11.69 16 14.78 17.28 15 18H3ZM20 15V12H23V10H20V7H18V10H15V12H18V15H20Z" fill="#8C8C8C"/>
                      </svg>

                        Data Pendaftar
                      </a>
                    </li>
                    <li class="sub_menu--item">
                      <a href="{{route('dinsos-pegawai-semua')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai/semua')) active @endif">
                        <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M19 3H14.82C14.4 1.84 13.3 1 12 1C10.7 1 9.6 1.84 9.18 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM12 2.75C12.22 2.75 12.41 2.85 12.55 3C12.67 3.13 12.75 3.31 12.75 3.5C12.75 3.91 12.41 4.25 12 4.25C11.59 4.25 11.25 3.91 11.25 3.5C11.25 3.31 11.33 3.13 11.45 3C11.59 2.85 11.78 2.75 12 2.75ZM19 19H5V5H19V19ZM12 6C10.35 6 9 7.35 9 9C9 10.65 10.35 12 12 12C13.65 12 15 10.65 15 9C15 7.35 13.65 6 12 6ZM12 10C11.45 10 11 9.55 11 9C11 8.45 11.45 8 12 8C12.55 8 13 8.45 13 9C13 9.55 12.55 10 12 10ZM6 16.47V18H18V16.47C18 13.97 14.03 12.89 12 12.89C9.97 12.89 6 13.96 6 16.47ZM8.31 16C9 15.44 10.69 14.88 12 14.88C13.31 14.88 15.01 15.44 15.69 16H8.31Z" fill="#8C8C8C"/>
                        </svg>
                        Data Semua Pegawai
                      </a>
                    </li>
                    <li class="sub_menu--item">
                      <a href="{{route('dinsos-pegawai-aktif')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai/aktif')) active @endif">
                        <svg width="24" class="iconside" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M9 13.75C6.66 13.75 2 14.92 2 17.25V19H16V17.25C16 14.92 11.34 13.75 9 13.75ZM4.34 17C5.18 16.42 7.21 15.75 9 15.75C10.79 15.75 12.82 16.42 13.66 17H4.34ZM9 12C10.93 12 12.5 10.43 12.5 8.5C12.5 6.57 10.93 5 9 5C7.07 5 5.5 6.57 5.5 8.5C5.5 10.43 7.07 12 9 12ZM9 7C9.83 7 10.5 7.67 10.5 8.5C10.5 9.33 9.83 10 9 10C8.17 10 7.5 9.33 7.5 8.5C7.5 7.67 8.17 7 9 7ZM16.04 13.81C17.2 14.65 18 15.77 18 17.25V19H22V17.25C22 15.23 18.5 14.08 16.04 13.81ZM15 12C16.93 12 18.5 10.43 18.5 8.5C18.5 6.57 16.93 5 15 5C14.46 5 13.96 5.13 13.5 5.35C14.13 6.24 14.5 7.33 14.5 8.5C14.5 9.67 14.13 10.76 13.5 11.65C13.96 11.87 14.46 12 15 12Z" fill="#8C8C8C"/>
                        </svg>
                        Data Pegawai Aktif
                      </a>
                    </li>
                    <li class="sub_menu--item">
                      <a href="{{route('dinsos-pegawai')}}" class="sub_menu--link @if(request()->is('dinsos/pegawai')) active @endif">
                        <svg width="24" height="24" class="iconside" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M12 5.9C13.16 5.9 14.1 6.84 14.1 8C14.1 9.16 13.16 10.1 12 10.1C10.84 10.1 9.9 9.16 9.9 8C9.9 6.84 10.84 5.9 12 5.9ZM12 14.9C14.97 14.9 18.1 16.36 18.1 17V18.1H5.9V17C5.9 16.36 9.03 14.9 12 14.9ZM12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4ZM12 13C9.33 13 4 14.34 4 17V20H20V17C20 14.34 14.67 13 12 13Z" fill="#8C8C8C"/>
                        </svg>
                        Data Pegawai
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="menu--item">
                  <a href="{{route('dinsos-kegiatan')}}" class="menu--link @if(request()->is('dinsos/kegiatan')) active @endif" title="Item 3">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="iconside" d="M8 4H14V6H8V4ZM8 8H14V10H8V8ZM8 12H14V14H8V12ZM4 4H6V6H4V4ZM4 8H6V10H4V8ZM4 12H6V14H4V12ZM17.1 0H0.9C0.4 0 0 0.4 0 0.9V17.1C0 17.5 0.4 18 0.9 18H17.1C17.5 18 18 17.5 18 17.1V0.9C18 0.4 17.5 0 17.1 0ZM16 16H2V2H16V16Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Kegiatan UPT</span>
                  </a>
                </li>
          
                <li class="menu--item">
                  <a href="{{route('dinsos-dataupt')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'dataupt') active @else @endif @endif" title="Item 4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path class="iconside" d="M17 15H19V17H17V15ZM17 11H19V13H17V11ZM17 7H19V9H17V7ZM13.74 7L15 7.84V7H13.74Z" fill="#8C8C8C"/>
                      <path class="iconside" d="M10 3V4.51L12 5.84V5H21V19H17V21H23V3H10Z" fill="#8C8C8C"/>
                      <path class="iconside" d="M8.17 5.7002L15 10.2502V21.0002H1V10.4802L8.17 5.7002ZM10 19.0002H13V11.1602L8.17 8.0902L3 11.3802V19.0002H6V13.0002H10V19.0002Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Data UPT</span>
                  </a>
                </li>
                {{-- <li class="menu--item">
                  <a href="{{route('pegawai-upt')}}" class="menu--link @if(isset($url[1])) @if($url[1] == 'pegawai-upt') active @else @endif @endif" title="Item 4">
                    <svg width="24" height="24" class="iconside" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 5.9C13.16 5.9 14.1 6.84 14.1 8C14.1 9.16 13.16 10.1 12 10.1C10.84 10.1 9.9 9.16 9.9 8C9.9 6.84 10.84 5.9 12 5.9ZM12 14.9C14.97 14.9 18.1 16.36 18.1 17V18.1H5.9V17C5.9 16.36 9.03 14.9 12 14.9ZM12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4ZM12 13C9.33 13 4 14.34 4 17V20H20V17C20 14.34 14.67 13 12 13Z" fill="#8C8C8C"/>
                    </svg>
                    <span class="menu--label">Data Pegawai</span>
                  </a>
                </li> --}}
              </ul>
              <hr style="border: 1px solid #E9E9E9;">
              <ul id="js-menu" class="menu" style="position: relative">
              <li class="menu--item">
                  <a href="#" class="menu--link" title="Item 1">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="iconside" d="M11 18H13V16H11V18ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10H10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 12 11 11.75 11 15H13C13 12.75 16 12.5 16 10C16 7.79 14.21 6 12 6Z" fill="#8C8C8C"/>
                  </svg>
                    <span class="menu--label">Support</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        @yield('content')
      </div>
    </div>

    <!-- Chart -->
    <script>
      var options = {
        chart: {
          // width: 300,
          height: 350,
          type: 'bar',
          toolbar: {
            show: false
          },
        },
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10,
            columnWidth: '40%',
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        colors: ["#5766da", "#999999"],
        series: [{
          name: 'Jenis 1',
          data: [44, 55, 57, 56, 61, 58, 63]
        }, {
          name: 'Jenis 2',
          data: [76, 85, 101, 98, 87, 105, 91]
        }],
        xaxis: {
          categories: ['1Aug', '2Aug', '3Aug', '4Aug', '5Aug', '6Aug', '7Aug'],
          axisBorder: {
            show: true,
            color: '#bec7e0',
          },  
          axisTicks: {
            show: true,
            color: '#bec7e0',
          },    
        },
        legend: {
          offsetY: 6,
        },
        fill: {
          opacity: 1
        },
        grid: {
          row: {
            colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.2
          },
          borderColor: '#f1f3fa'
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        },
        responsive: [{
          options: {
            plotOptions: {
              bar: {
                columnWidth: '70%',
              }
            }
          }
        }]
    }

    var chart = new ApexCharts(
      document.querySelector("#klienbar"),
      options
    );

    chart.render();
    </script>
    <script>
      var options = {
        chart: {
          // width: 20,
            height: 250,
            type: 'donut',
        }, 
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        series: [44, 55, 41],
        legend: {
            show: false,
            position: 'bottom',
            horizontalAlign: 'center',
            verticalAlign: 'middle',
            floating: false,
            fontSize: '14px',
            offsetX: 0,
            offsetY: 6
        },
        labels: ["Series 1", "Series 2", "Series 3"],
        colors: ["#F9544E", "#FAD71E","#2E87FC"],
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: false
                },
            }
        }],
      }

      var chart = new ApexCharts(
        document.querySelector("#pie1"),
        options
      );

      chart.render();
    </script>

    <!-- Sidebar js -->
    <script src="{{asset('assets/js/vertical-responsive-menu.js')}}"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script> -->

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script>
      function notif() {
        boxnotif.classList.toggle('d-block')
      }
      const profile = document.getElementById('showpopup')
      function clickProfile() {
        profile.classList.toggle('d-block')
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

    @yield('jquery')
  </body>
</html>
