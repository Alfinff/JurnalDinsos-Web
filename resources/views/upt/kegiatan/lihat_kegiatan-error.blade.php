@extends('layout.template')
@section('content')
<style>
  .kegiatantambah .col-md-6, .kegiatantambah .col-md-12 {
    margin-bottom: 15px;
  }
  .kegiatantambah label{
    font-weight: 700;
    font-size: 14px;
    color: rgba(40, 40, 40, 1);
    margin-bottom: 10px;
  }
  .kegiatantambah input::placeholder, .kegiatantambah textarea{
    color: rgba(195, 195, 195, 1);
    font-weight: 400;
    font-size: 14px;
  }
  .overlay-modal{
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #ddd;
    opacity: .6;
    position: absolute;
  }
  .head-judul2{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
</style>
<div class="col-md-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul2">
            <h3>Form Kegiatan</h3>
            <hr>
          </div>
          <form action="" class="kegiatantambah" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="namaupt">Nama UPT</label>
                      <input type="text" name="upt_name" id="namaupt" class="form-control" disabled value="UPT BAGUS">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalmulai">Tanggal Mulai</label>
                      <input type="date" name="start_date" id="tanggalmulai" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggalselesai">Tanggal Selesai</label>
                      <input type="date" name="end_date" id="tanggalselesai" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jeniskegiatan">Jenis Kegiatan</label>
                      <input type="text" name="type" id="jeniskegiatan" class="form-control" placeholder="cth:
                      Upacara Bendera" required> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="jumlahpeserta">Jumlah Peserta</label>
                      <input type="number" name="number_of_p" id="jumlahpeserta" class="form-control"
                                                                                   placeholder="Masukkan Jumlah Peserta"
                                                                                   required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="budget">Budget</label>
                      <input type="text" name="budget" id="budget" placeholder="Masukkan Nominal Uang"
                      class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="deskripsikegiatan">Deskripsi Kegiatan</label>
                    <textarea name="description" id="deskripsikegiatan" cols="30" rows="4" class="form-control" placeholder="Masukkan Deskripsi Kegiatan"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group file-area">
                    <label for="dokumentasi">Dokumentasi Kegiatan</label>
                    <input type="file" name="dokumentasi" id="dokumentasi" />
                    <div class="file-dummy">
                      <div class="success">Great, your files are selected. Keep on.</div>
                      <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p></div>
                    </div>
                    <div class="warn">
                      <p class="text-muted">Jenis File yang diterima : .jpg dan .png saja</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-5">
                <center>
                  <button class="btn btn-success col-md-3" style="background-color: #12C58E;border-color: #12C58E;">Upload</button>
                </center>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card">
          <div class="head-judul">
            <h3>Daftar Kegiatan</h3>
          </div>
          <form action="" class="data-pendaftar" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="row justify-content-between">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="kegiatan">Kegiatan</label>
                          <input type="text" name="kegiatan" id="kegiatan" class="form-control" placeholder="Kegiatan">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="tanggalmulai2">Tanggal Mulai</label>
                          <input type="date" name="tanggalmulai2" id="tanggalmulai2" class="form-control" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label for="tanggalselesai2">Tanggal Selesai</label>
                          <input type="date" name="tanggalselesai2" id="tanggalselesai2" class="form-control" required>
                      </div>
                  </div>
              </div>
              <div class="row mt-5 justify-content-center">
                  <button class="btn btn-success col-md-3" style="background-color: #12C58E;border-color: #12C58E;">Filter</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    {{-- <div class="row"> --}}
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-card">
                    <div style="overflow-x: auto">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Kegiatan</th>
                                    <th>Budget</th>
                                    <th>Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kegiatan as $k)
                                    <tr>
                                        <td>{{date('Y-m-d', strtotime($k->start_date))}}</td>
                                        <td>{{date('Y-m-d', strtotime($k->end_date))}}</td>
                                        <td>{{$k->description}}</td>
                                        <td>{{$k->budget}}</td>
                                        <td>{{$k->number_of_p}}</td>
                                        <td>
                                            <div class="aksi-button">
                                                <a href="{{route('lihat-kegiatan', ['id' => $k->id])}}" class="btn btn-primary m-1">
                                                    <i class="fa fa-eye" style="color: #fff" title="Lihat"></i>
                                                </a>
                                                <a href="{{route('edit-kegiatan', ['id' => $k->id])}}" onclick="openModalEdit()" class="btn btn-warning m-1">
                                                    <i class="fa fa-edit" style="color: #fff;" title="Edit"></i>
                                                </a>
                                                <a href="{{route('delete-kegiatan', ['id' => $k->id])}}" class="btn btn-danger m-1">
                                                    <i class="fa fa-trash" style="color: #fff;" title="Delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    <div class="modal" id="modalEdit">
        <div class="overlay-modal"></div>
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-card">
                        <div class="head-judul2">
                            <h3>Form Kegiatan</h3>
                            <button onclick="closeModalEdit()" class="btn"><i class="fa fa-times"></i></button>
                        </div>
                        <hr>
                        <form action="" class="kegiatantambah" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="namaupt1">Nama UPT</label>
                                                <input type="text" name="namaupt1" id="namaupt1" class="form-control" disabled value="UPT BAGUS">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalmulai1">Tanggal Mulai</label>
                                                <input type="date" name="tanggalmulai1" id="tanggalmulai1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tanggalselesai1">Tanggal Selesai</label>
                                                <input type="date" name="tanggalselesai1" id="tanggalselesai1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jeniskegiatan1">Jenis Kegiatan</label>
                                                <input type="text" name="jeniskegiatan1" id="jeniskegiatan1" class="form-control" placeholder="cth: Upacara Bendera">  
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jumlahpeserta1">Jumlah Peserta</label>
                                                <input type="number" name="jumlahpeserta1" id="jumlahpeserta1" class="form-control" placeholder="Masukkan Jumlah Peserta">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="budget1">Budget</label>
                                                <input type="text" name="budget1" id="budget1" placeholder="Masukkan Nominal Uang" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsikegiatan1">Deskripsi Kegiatan</label>
                                            <textarea name="deskripsikegiatan1" id="deskripsikegiatan1" cols="30" rows="4"
                                                                                                                  class="form-control" placeholder="Masukkan Deskripsi Kegiatan" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group file-area">
                                            <label for="dokumentasi1">Dokumentasi Kegiatan</label>
                                            <input type="file" name="dokumentasi1" id="dokumentasi1" required>
                                            <div class="file-dummy">
                                                <div class="success">Great, your files are selected. Keep on.</div>
                                                <div class="default"><img src="{{asset('assets/images/photo.png')}}" alt=""> <p>Unggah Disini</p></div>
                                            </div>
                                            <div class="warn">
                                                <p class="text-muted">Jenis File yang diterima : .jpg dan .png saja</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <center>
                                        <button class="btn btn-success col-md-3" style="background-color: #12C58E;border-color: #12C58E;">Upload</button>
                                    </center>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable()
        })
    </script>
    <script>
        function closeModalEdit() {
            document.getElementById('modalEdit').style.display = 'none';
        }
function openModalEdit() {
    document.getElementById('modalEdit').style.display = 'block';
}
    </script>
  </div>
@endsection
