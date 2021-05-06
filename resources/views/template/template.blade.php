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
    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Dashboard</title>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script> --}}

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
            <div class="afterprof" >
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
      <div class="row m-0">
        @if(auth()->user->role == 'dinsos')
            @include('sidebar.dinsos');
        @elseif(auth()->user->role == 'upt')
            @include('sidebar.upt');
        @endif
        @yield('content')
      </div>
    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
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
