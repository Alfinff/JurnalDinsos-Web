@extends('layout.template')
@section('content')
<style>
    tr th{
        width: 20%;
        border: 1px solid #E9E9E9;
    }
    tr td {
        border: 1px solid #E9E9E9;
    }
</style>
<div class="col-lg-10">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
            <div class="back">
                <a href="{{route('dinsos-dataupt')}}" class="d-flex">
                    <img src="{{asset('assets/images/back.png')}}" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
                <h3>Data Penerima Manfaat</h3>
            </div>
          {{-- <form action="" class="data-pendaftar">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="cariklien">Cari Klien</label>
                  <input type="text" name="cariklien" id="cariklien" class="form-control" placeholder="Cari Klien">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="tanggalmasuk">Tanggal Masuk</label>
                  <input type="date" name="tanggalmasuk" id="tanggalmasuk" placeholder="Tanggal Awal Daftar" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-card"> --}}
          <div class="d-flex justify-content-end mb-3">
            {{-- <button class="btn btn-primary " style="margin: 0 10px 0 0">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2ZM15.8 20H14L12 16.6L10 20H8.2L11.1 15.5L8.2 11H10L12 14.4L14 11H15.8L12.9 15.5L15.8 20ZM13 9V3.5L18.5 9H13Z" fill="white"/>
                </svg>
                Eksport Excel
            </button> --}}
          </div>
          <table id="dinsos-Upt-Detail" class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr style="border: 1px solid #ddd; border-radius: 5px">
                <th >No. Reg</th>
                <th >Tanggal Masuk</th>
                <th >Nama</th>
                <th >TTL</th>
                <th >Alamat</th>
                </tr>
            </thead>


            {{-- <tbody>
                <tr>
                    <td>
                    465/365/XII/2020
                    </td>
                    <td>
                    29 Des 2020
                    </td>
                    <td>
                    Supilan
                    </td>
                    <td>
                    Blitar, 23 Feb 1948
                    </td>
                    <td>
                    Ds.Sumber Kec. Sanankulon  Kab.Blitar
                    </td>
                </tr>
            </tbody> --}}
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $(function() {
        $('#dinsos-Upt-Detail').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{URL::to('/dinsos/dataupt/data')}}'+'/{{$uuid}}',
            columns:[
                {data:'nomor_registrasi', name:'Nomor Registrasi'},
                {data:'tanggal_masuk', name:'Tanggal Masuk'},
                {data:'nama_lengkap', name:'Nama Lengkap'},
                {data:'ttl', name:'Tempat, Tanggal Lahir'},
                {data:'alamat', name:'Alamat'},
            ],
            "columnDefs":[{
              "defaultContent":"-",
              "targets":"_all"
            }],
            "order":[]
        });
    });
</script>
@endsection
