@extends('layout.template')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            <div class="d-flex justify-content-around" style="padding-top: 25px;">
              <div class="jenis-legend">
                <img style="widht: 32px; height: 32px;" src="{{asset('assets/images/man.png')}}" alt="">
                <p>Laki-laki</p>
                <h3 id="blue">{{$lakiperempuan[1]->jumlah}} orang</h3>
              </div>
              <div class="jenis-legend">
                <img style="widht: 32px; height: 32px;" src="{{asset('assets/images/woman.png')}}" alt="">
                <p>Perempuan</p>
                <h3 id="yellow">{{$lakiperempuan[0]->jumlah}} orang</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        {{-- {{dd($datajenisaduan)}} --}}
        <div class="card">
          <div class="card-card">
            <div class="d-flex title-card align-items-center justify-content-between">
              <h3 class="m-0">Jenis Aduan</h3>
              {{-- <img src="{{asset('assets/images/refresh.png')}}" alt=""> --}}
            </div>
            <hr>
            <div id="chartjenisaduan"></div>
            <div class="chart-labels-wrapper" style="margin-top: 15px;">
              <div class="row">
                @foreach($datajenisaduan as $dd)
                <div class="col-sm-6">
                  <div class="item">
                    <div class="name">
                      {{$dd->nama}}
                    </div>
                    <div class="count">
                      {{ $dd->jumlah}} Aduan
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        <div class="card">
          <div class="card-card">
            <h4 class="title-header">KLIEN MASUK & KELUAR</h4>
            <div id="chartklien"></div>
          </div>
        </div>
      </div>
      <div class="col-md-12 mb-4">
        <div class="card">
          <div class="card-card">
            <div class="head-judul text-center">
                <h5><i class="fa fa-users text-primary"></i> Jumlah Jenis Aduan Semua UPT</h5>
            </div>
            <form action="{{route('dinsos-home-jenisaduan')}}" class="data-pengguna" method="post">
                {!! csrf_field() !!}
                <div class="row align-items-center position-relative my-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="daftarupt">Pilih UPT</label> <br>
                            <select class="js-example-basic-single w-100 form-control" name="upt" id="daftarupt" required>
                                <option value="" selected disabled>Daftar UPT</option>
                                @foreach ($upt as $u)
                                    <option value="{{$u->uuid}}">{{$u->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="width: auto; margin-left: 10px;" class="mt-3">
                        <button class="btn btn-primary" style="">Filter</button>
                    </div>
                </div>
            </form>
            <hr>
            <table class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                    <tr>
                        <th>Jenis Aduan</th>
                        <th>Jenis Kelamin</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datajenisaduantable as $dd => $val)
                        <tr>
                            <td>{{$val->nama}}</td>
                            <td>{{$val->jeniskelamin}}</td>
                            <td>{{$val->jumlah}} orang</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
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
              {
                  name: 'Klien Masuk',
                  data: [
                      @foreach($klienmasuk as $k)
                          {{$k['jumlah']}},
                      @endforeach
                  ]
              },
              {
                  name: 'Klien Keluar',
                  data: [
                      @foreach($klienkeluar as $tt)
                          {{$tt['jumlah']}},
                      @endforeach
                  ]
              }
          ],
          xaxis: {
            categories: [
              @foreach($bulan as $b => $val)
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
@endsection
@section('jquery')
    <script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

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
    series: [{{$lakiperempuan[1]->jumlah}}, {{$lakiperempuan[0]->jumlah}}],
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
              {{ $dd->jumlah}},
            @endforeach],
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
    labels: [@foreach($datajenisaduan as $aa)
              "{{ $aa->nama }}",
            @endforeach],
    colors: ["#FF5733", "#0d6efd", "#ffc107", "#6c757d", "#dc3545", "#198754"],
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
