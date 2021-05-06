@extends('layout.template')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
<div class="col-md-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Data Pendaftar </h3>
          </div>
          <form action="" class="data-pendaftar">
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="daftarupt">Pilih UPT</label>
                  <select name="daftarupt" id="daftarupt" class="form-select">
                    <option value="" selected>Daftar UPT</option>
                    <option value="1">Daftar UPT</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="jabatan">Jabatan</label>
                  <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Jabatan">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="akhiraktif">Tanggal Terakhir Aktif</label>
                  <input type="date" name="akhiraktif" id="akhiraktif" placeholder="Tanggal Terakhir Aktif" class="form-control">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-card">
          <div class="d-flex justify-content-end mb-3">
            {{-- <button class="btn btn-success" id="export">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2ZM15.8 20H14L12 16.6L10 20H8.2L11.1 15.5L8.2 11H10L12 14.4L14 11H15.8L12.9 15.5L15.8 20ZM13 9V3.5L18.5 9H13Z" fill="white"/>
              </svg>
              Eksport Excel
            </button> --}}
          </div>
          <table id="datatable" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <colgroup>
              <col span="1" style="width: 15%;">
              <col span="1" style="width: 15%;">
              <col span="1" style="width: 15%;">
              <col span="1" style="width: 15%;">
              <col span="1" style="width: 15%;">
              <col span="1" style="width: 15%;">
           </colgroup>
            <thead>
            <tr>
              <th >Nama Lengkap</th>
              <th>Jenis Aduan</th>
              <th>NIK</th>
              <th>UPT</th>
              <th>Telepon</th>
              <th>Tindakan</th>
            </tr>
            </thead>
            <tbody>
                @foreach($pengaduan as $p)
                    <tr>
                        <td>{{$p->nama_lengkap}}</td>
                        <td>{{$p->jenis_aduan}}</td>
                        <td>{{$p->nik}}</td>
                        <td>{{\App\Models\Upt::find($p->upt_id)->nama ?? ''}}</td>
                        <td>{{$p->telp_rekomendasi}}</td>
                        <td><p class="badge badge-info">Dihubungi</p></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('jquery')
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#datatable').DataTable({
          order: [],
          dom: 'Bfrtip',
          buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
          ]
        })
    })
  </script>
@endsection
