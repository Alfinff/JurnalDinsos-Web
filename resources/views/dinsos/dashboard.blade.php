@extends('layout.template')
@section('content')
<div class="col-lg-10" style="background-color: #fbfbfb;">
  <div class="mx-2">
    <div class="row my-3">
      <div class="col-md-4 my-3">
        <div class="card">
          <div class="card-card">
            <div class="d-flex justify-content-between">
              <div class="content-card">
                <h4>Total KLIEN</h4>
                <h3>@if(isset($countklien)) {{$countklien}} @endif</h3>
              </div>
              <div class="icon-card">
                <img src="{{asset('assets/images/Klien.png')}}" alt="">
              </div>
            </div>
            {{-- <div class="presentase-card">
              <div class="green-info">
                <i class="fa fa-arrow-up"></i>
                <p>20%</p>
              </div>
              <div class="muted-info">
                <p>Sejak Bulan Lalu</p>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 my-3">
        <div class="card">
          <div class="card-card">
            <div class="d-flex justify-content-between">
              <div class="content-card">
                <h4>Total UPT</h4>
                <h3>@if(isset($countupt)) {{$countupt}} @endif</h3>
              </div>
              <div class="icon-card">
                <img src="{{asset('assets/images/UPT.png')}}" alt="">
              </div>
            </div>
            {{-- <div class="presentase-card">
              <div class="red-info">
                <i class="fa fa-arrow-down"></i>
                <p>4%</p>
              </div>
              <div class="muted-info">
                <p>Sejak Bulan Lalu</p>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="col-md-4 my-3">
        <div class="card">
          <div class="card-card">
            <div class="d-flex justify-content-between">
              <div class="content-card">
                <h4>Total Pengeluaran Semua UPT</h4>
                <h3>{{$pengeluaransemuaupt}}</h3>
              </div>
              <div class="icon-card">
                <img src="{{asset('assets/images/Pengeluaran.png')}}" alt="">
              </div>
            </div>
            {{-- <div class="presentase-card">
              <div class="green-info">
                <i class="fa fa-arrow-up"></i>
                <p>24%</p>
              </div>
              <div class="muted-info">
                <p>Sejak Bulan Lalu</p>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="row my-3">
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-card">
            <div class="d-flex title-card align-items-center justify-content-between">
              <h3 class="m-0">Jenis Kelamin</h3>
              {{-- <img src="{{asset('assets/images/refresh.png')}}" alt=""> --}}
            </div>
            <hr>
            <div id="chartpiejeniskelamin"></div>
            <div class="d-flex justify-content-around">
              <div class="jenis-legend">
                <img style="widht: 32px; height: 32px;" src="{{asset('assets/images/man.png')}}" alt="">
                <p>Pria</p>
                <h3 id="blue">{{$lakilaki}}%</h3>
              </div>
              <div class="jenis-legend">
                <img style="widht: 32px; height: 32px;" src="{{asset('assets/images/woman.png')}}" alt="">
                <p>Wanita</p>
                <h3 id="yellow">{{$perempuan}}%</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-4 mb-4">
        <div class="card">
          <div class="card-card">
            <div class="d-flex title-card align-items-center justify-content-between">
              <h3 class="m-0">Jenis Aduan</h3>
              {{-- <img src="{{asset('assets/images/refresh.png')}}" alt=""> --}}
            </div>
            <hr>
            <div id="chartjenisaduan"></div>
            {{-- <div class="d-flex justify-content-around">
              <div class="jenis-legend">
                <p>Pria</p>
                <h3 id="blue">{{$lakilaki}}%</h3>
              </div>
              <div class="jenis-legend">
                <p>Wanita</p>
                <h3 id="yellow">{{$perempuan}}%</h3>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        <div class="card">
          <div class="card-card">
            <h4 class="title-header">KLIEN MASUK</h4>
            <div id="chartklien"></div>
          </div>
          {{-- {{dd($datajenisaduan)}} --}}
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
          series: [
              // {
              //     name: 'Tahun Kemarin',
              //     data: [
              //         @foreach($klienmasuk_tahunini as $k)
              //             {{$k->jumlah}},
              //         @endforeach
              //     ]
              // },
              {
                  name: 'Tahun Ini',
                  data: [
                      @foreach($klienmasuk_tahunini as $k)
                          {{$k->jumlah}},
                      @endforeach
                  ]
              }
          ],
          xaxis: {
            categories: [
              @foreach($bulan_tahunini as $b => $val)
                  '{{$val}}',
              @endforeach
            ],
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
                return val
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
        document.querySelector("#chartklien"),
        options
      );

      chart.render();
      </script>
    </div>
  </div>
</div>
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
    series: [{{$lakilaki}}, {{$perempuan}}],
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
    labels: ["Laki-laki", "Perempuan"],
    colors: ["#F9544E", "#2E87FC"],
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
    document.querySelector("#chartpiejeniskelamin"),
    options
    );

    chart.render();

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
    series: [@foreach($datajenisaduan as $dd)
              {{ $dd['jumlah']}},
            @endforeach],
    // series: [{{$lakilaki}}, {{$perempuan}}],
    // series: [
    //     <?php foreach($datajenisaduan as $dd) { echo (int)$dd->jumlah.","; } ?>
    // ],
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
    labels: [@foreach($datajenisaduan as $dd)
              {{ $dd[0]}},
            @endforeach],
    // labels: [
    //     <?php foreach($datajenisaduan as $dd) { echo $dd->nama; } ?>
    // ],
    colors: ["#34495E", "#FF5733"],
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

    var chart = new ApexCharts(document.querySelector("#chartjenisaduan"),options);

    chart.render();
</script>
@endsection
