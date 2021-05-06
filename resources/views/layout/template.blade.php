<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    @yield('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
    <link rel="icon" href="{{asset('assets/images/logo-dinsos.ico')}}">
    <title>Dashboard</title>

    <link href="{{asset('datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vertical-responsive-menu.css')}}">
    <!-- FontAwesome -->
    {{-- <script src="https://use.fontawesome.com/448f6b23f4.js"></script> --}}
    <script src="https://kit.fontawesome.com/8455e85ee2.js" crossorigin="anonymous"></script>

    <!-- Apex Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style type="text/css">
      .bolden{font-family:"Arial Black"}
      .table thead th{ background-color:#007bff!important; color:#FFFFFF !important;}
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
                <img src="{{asset('assets/images/notif.png')}}" style="width: 18px" alt="">
                {{-- <i class="fa fa-bell"></i> --}}
                <small class="badge badge-danger" style="top: -6px;position: absolute;left: 15px;border-radius: 100%;">{{auth()->user()->unreadNotifications->count()}}</small>
              </a>
              <div class="boxnotif" id="boxnotif">
                <h6 class="dropdown-item-text font-15 m-0 py-3 bg-light text-dark d-flex justify-content-between align-items-center">
                  Notification
                  <span class="badge badge-primary badge-pill">{{auth()->user()->unreadNotifications->count()}}</span>
                </h6>
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 695px;">
                    <div class="slimscroll notification-list" style="overflow-y: auto; width: auto; height: 695px;background: white;">
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <form action="/notifmarkasread" class="dropdown-item py-3" method="post">
                                @csrf
                                <button type="submit" style="width: 100%;text-decoration: none;background: none;border: none;">
                                  <input type="hidden" name="url" value="{{$notification->data['url']}}">
                                  <input type="hidden" name="notificationid" value="{{$notification->id}}">
                                  <small class="float-right text-muted pl-2">{{ \App\Helpers\Fungsi::time_elapsed_string(date('Y-m-d H:i:s', strtotime($notification->created_at))) }}</small>
                                  <div class="media">
                                      <div class="media-body align-self-center ml-2 text-truncate">
                                          <h6 style="text-align: left" class="my-0 font-weight-normal text-dark">{{ $notification->data['judul'] }}</h6>
                                          <small class="text-muted mb-0">{{ str_replace('  ', '', $notification->data['pesan']) }}</small>
                                      </div>
                                  </div>
                                </button>
                                {{-- <button>Lihat</button> --}}
                            </form>
                        @endforeach
                    </div>
              <div class="slimScrollBar" style="background: rgba(162, 177, 208, 0.13); width: 7px; position: absolute; top: 0px; opacity: 1; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 142.353px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
              </div>
            </div>
            <div class="afterprof" >
              <div class="d-flex align-items-center infoprofile" onclick="clickProfile()">
                @if(!isset(auth()->user()->profile->photo))
                  <img src="https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg" alt="">
                @else
                  <img src="{{route('images-getter', ['module' => 'profile', 'filename' => auth()->user()->profile->photo])}}" alt="">
                @endif
                <div class="nameprofile">
                  {{-- <p>User Name</p> --}}
                  <h3>{{auth()->user()->username ?? ''}}</h3>
                </div>
              </div>
              <div class="showpopup" id="showpopup">
                <a href="{{route('profil-home', ['uuid' => auth()->user()->uuid])}}">
                  <div class="menu-pop">
                    <i class="fa fa-user"></i>
                    <p>Profil</p>
                  </div>
                </a>
                <a href="{{route('logout')}}">
                  <div class="menu-pop">
                    <i class="fa fa-sign-out"></i>
                    <p>Keluar</p>
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
      <div class="row m-0">
        @php
            $role = \App\Models\Role::find(auth()->user()->role);
        @endphp
        @if($role->role == 'dinsos')
            @include('sidebar.dinsos')
        @elseif($role->role == 'upt' || $role->role == 'pegawai')
            @include('sidebar.upt')
        @else

        @endif
        @yield('content')
      </div>
    </div>

    <!-- Sidebar js -->
    <script src="{{asset('assets/js/vertical-responsive-menu.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('datatables/jszip.min.js')}}"></script>
    <script src="{{asset('datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-maxlength.min.js')}}"></script>
    <script>
      $('input#nik').maxlength({
        alwaysShow: true,
        warningClass: "badge badge-info",
        limitReachedClass: "badge badge-warning"
      });
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
      document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByTagName("INPUT");
        for (var i = 0; i < elements.length; i++) {
          elements[i].oninvalid = function(e) {
          console.log(e)
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
              if (!e.target.title) {
                e.target.setCustomValidity('Silahkan Lengkapi')
              } else{
                e.target.setCustomValidity(e.target.title);
              }
            }
          };
          elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
          };
        }
      })

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
