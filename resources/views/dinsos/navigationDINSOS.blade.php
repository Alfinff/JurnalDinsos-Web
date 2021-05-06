<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="icon" href="{{asset('assets/images/dinsostitle.png')}}">
    <title>Dahboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vertical-responsive-menu.css')}}">

    <!-- FontAwesome -->
    <script src="https://use.fontawesome.com/448f6b23f4.js"></script>

    <!-- Apex Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

  </head>
  <body>
    <div>
      <div class="navbar2">
        <div class="p-navbar2">
          <div class="logo-img2">
            <img src="{{asset('assets/images/DinsosWhite.png')}}" alt="">
          </div>
          <div class="button-navbar2">
            <a href="{{route('logout')}}">
              <i class="fa fa-sign-out"></i>
            </a>
            <button type="button" class="toggle_menu" id="toggle_menu">
              <i class="fa fa-bars"></i>
            </button>        
          </div>
        </div>
      </div>
      <div class="row m-0">
        <div class="col-md-2 shad">
          <div class="sidebar">
            <div class="side1">
              <img src="{{asset('assets/images/photouser.png')}}" alt="">
              <h3>{{auth()->user()->username ?? ''}}</h3>
              <p>Admin Dinsos</p>
            </div>
            <hr>
            <div class="vertical_nav">
              <ul id="js-menu" class="menu">

                <li class="menu--item  ">
                  <a href="{{route('admin-home')}}" class="menu--link" title="Item 1">
                    <i class="fa fa-tachometer"></i>
                    <span class="menu--label">Dashboard</span>
                  </a>
                </li>
          
                <li class="menu--item menu--item__has_sub_menu">
                  <label class="menu--link" title="Item 2">
                    <i class="fa fa-user"></i>
                    <span class="menu--label">Master Kepegawaian</span>
                  </label>
                  <ul class="sub_menu">
                    <li class="sub_menu--item">
                      <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                      <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                      <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                  </ul>
                </li>
          
                <li class="menu--item">
                  <a href="{{route('admin-kategori')}}" class="menu--link" title="Item 3">
                    <i class="fa fa-user"></i>
                    <span class="menu--label">Kategori</span>
                  </a>
                </li>
          
                <li class="menu--item  ">
                  <a href="{{route('admin-pendaftar')}}" class="menu--link" title="Item 4">
                    <i class="fa fa-database"></i>
                    <span class="menu--label">Data UPT</span>
                  </a>
                </li>          
              </ul>
              <!-- <button id="collapse_menu" class="collapse_menu" id="collapse_menu">
                <i class="collapse_menu--icon  fa fa-fw"></i>
                <span class="collapse_menu--label">Recolher menu</span>
              </button> -->
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
            height: 350,
            type: 'bar',
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                endingShape: 'rounded',
                columnWidth: '55%',
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
        colors: ["#5766da", "red"],
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
        yaxis: {
            // title: {
            //     text: '$ (thousands)'
            // }
        },
        fill: {
            opacity: 1

        },
        // legend: {
        //     floating: true
        // },
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
        }
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
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
   
  </body>
</html>
