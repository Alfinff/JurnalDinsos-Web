@extends('layout.template')
@section('content')
<div   class = "col-lg-10 bg-col">
<div   class = "row">
<div   class = "col-md-12 my-3">
<div   class = "card">
<div   class = "card-card">
<div   class = "d-flex justify-content-between mb-3">
<div   class = "head-juduls">
<h5><i class = "fa fa-users text-primary"></i> Data Yang Dihubungi</h5>
              </div>
            </div>
            <hr>
            <div   style = "overflow-y: auto">
            <table id    = "upt-Pendaftar-Dihubungi" class = "table table-striped table-bordered dt-responsive" style = "border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <colgroup>
                        <col span = "1" style = "width: 15%;">
                        <col span = "1" style = "width: 15%;">
                        <col span = "1" style = "width: 15%;">
                        <col span = "1" style = "width: 20%;">
                        <col span = "1" style = "width: 15%;">
                        <col span = "1" style = "width: 15%;">
                        <col span = "1" style = "width: 15%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>No. Registrasi</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Aduan</th>
                            <th>NIK</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Penanggung Jawab</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class   = "modal-lengkapi" id      = "modal-lengkapi">
<div class   = "penampung-popup2" style = "overflow-y: auto;">
<div class   = "row">
<div class   = "col-md-12">
<div class   = "card">
<div class   = "card-card">
<div class   = "close">
<a   class   = "d-flex" style           = "text-decoration: none;">
<i   onclick = "closep()" class         = "fa fa-times"></i>
                            </a>
                        </div>
                        <div class = "head-judul text-center">
                            <h3>Form Penerima Manfaat</h3>
                            <hr>
                        </div>
                        <form  action = "" class    = "kegiatantambah">
                        <div   class  = "row">
                        <div   class  = "col-md-6">
                        <div   class  = "row">
                        <div   class  = "col-md-12">
                        <div   class  = "form-group">
                        <label for    = "nomorregistrasi">Nomor Registrasi</label>
                        <input type   = "text" name = "nomorregistrasi" id = "nomorregistrasi" class = "form-control" placeholder = "Masukkan Nomor Registrasi" >
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group">
                                        <label for   = "nama">Nama</label>
                                        <input type  = "text" name = "nama" id = "nama" class = "form-control" placeholder = "Masukkan Nama">
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group">
                                        <label for   = "nik">Nik</label>
                                        <input type  = "number" name = "nik" id = "nik" class = "form-control" placeholder = "Masukkan NIK">
                                            </div>
                                        </div>
                                        <div   class = "col-md-6">
                                        <div   class = "form-group">
                                        <label for   = "tempatlahir">Tempat Lahir</label>
                                        <input type  = "text" name = "tempatlahir" id = "tempatlahir" class = "form-control" placeholder = "Masukkan Tempat Lahir">
                                            </div>
                                        </div>
                                        <div   class = "col-md-6">
                                        <div   class = "form-group">
                                        <label for   = "tanggallahir">Tanggal Lahir</label>
                                        <input type  = "date" name = "tanggallahir" id = "tanggallahir" class = "form-control" >
                                            </div>
                                        </div>
                                        <div   class = "col-md-6">
                                        <div   class = "form-group">
                                        <label for   = "umur">Umur</label>
                                        <input type  = "number" name = "umur" id = "umur" class = "form-control" placeholder = "Masukkan Umur">
                                            </div>
                                        </div>
                                        <div    class = "col-md-6">
                                        <div    class = "form-group">
                                        <label  for   = "jeniskelamin">Jenis Kelamin</label>
                                        <select name  = "jeniskelamin" id = "jeniskelamin" class = "form-select">
                                        <option value = "" selected disabled>Pilih Jenis Kelamin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div    class = "col-md-12">
                                        <div    class = "form-group">
                                        <label  for   = "provinsi">Provinsi</label>
                                        <select name  = "provinsi" id = "provinsi" class = "form-select">
                                        <option value = "" selected disabled>Pilih Provinsi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div    class = "col-md-12">
                                        <div    class = "form-group">
                                        <label  for   = "kota">Kota/Kabupaten</label>
                                        <select name  = "kota" id = "kabupaten" class = "form-select">
                                        <option value = "" selected disabled>Pilih Kota/Kabupaten</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div    class = "col-md-12">
                                        <div    class = "form-group">
                                        <label  for   = "kecamatan">Kecamatan</label>
                                        <select name  = "kecamatan" id = "kecamatan" class = "form-select">
                                        <option value = "" selected disabled>Pilih Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div      class = "col-md-12">
                                        <div      class = "form-group">
                                        <label    for   = "alamat">Alamat Lengkap</label>
                                        <textarea name  = "alamat" id = "alamat" class = "form-control" cols = "30" rows = "4" placeholder = "Masukkan Alamat Lengkap"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div   class = "col-md-6">
                                <div   class = "row">
                                <div   class = "col-md-6">
                                <div   class = "form-group">
                                <label for   = "tanggalmasuk">Tanggal Masuk</label>
                                <input type  = "date" name = "tanggalmasuk" id = "tanggalmasuk" class = "form-control">
                                            </div>
                                        </div>
                                        <div   class = "col-md-6">
                                        <div   class = "form-group">
                                        <label for   = "tanggalkeluar">Tanggal Keluar</label>
                                        <input type  = "date" name = "tanggalkeluar" id = "tanggalkeluar" class = "form-control">
                                            </div>
                                        </div>
                                        <div    class = "col-md-12">
                                        <div    class = "form-group">
                                        <label  for   = "permasalahan">Permasalahan</label>
                                        <select name  = "permasalahan" id = "permasalahan" class = "form-select">
                                        <option value = "" selected disabled>Pilih Permasalahan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group file-area">
                                        <label for   = "fotokondisi">Foto Kondisi</label>
                                        <input type  = "file" name        = "fotokondisi" id                           = "fotokondisi" multiple = "multiple"/>
                                        <div   class = "file-dummy">
                                        <div   class = "success">Great.</div>
                                        <div   class = "default"><img src = "{{asset('assets/images/photo.png')}}" alt = ""> <p>Unggah Disini</p></div>
                                                </div>
                                                <div class = "warn">
                                                <p   class = "text-muted">Jenis File yang diterima : .jpg dan .png saja</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group file-area">
                                        <label for   = "suratpengantar">Surat Pengantar</label>
                                        <input type  = "file" name        = "suratpengantar" id                        = "suratpengantar" multiple = "multiple"/>
                                        <div   class = "file-dummy">
                                        <div   class = "success">Great.</div>
                                        <div   class = "default"><img src = "{{asset('assets/images/photo.png')}}" alt = ""> <p>Unggah Disini</p></div>
                                                </div>
                                                <div class = "warn">
                                                <p   class = "text-muted">Jenis File yang diterima : .pdf</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group">
                                        <label for   = "rekomendasi">Rekomendasi Pendaftar</label>
                                        <input type  = "text" name = "rekomendasi" id = "rekomendasi" class = "form-control" placeholder = "Masukkan Nama Perekomendasi">
                                            </div>
                                        </div>
                                        <div    class = "col-md-12">
                                        <div    class = "form-group">
                                        <label  for   = "pendamping">Petugas pendamping</label>
                                        <select name  = "pendamping" id = "pendamping" class = "form-select">
                                        <option value = "" selected disabled>Pilih Nama Pendamping</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div   class = "col-md-12">
                                        <div   class = "form-group">
                                        <label for   = "jenispengaduan">Jenis Pengaduan</label>
                                        <input type  = "text" name = "jenispengaduan" id = "jenispengaduan" class = "form-control" placeholder = "Masukkan Jenis Pengaduan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div    class = "col-md-12 my-3">
                                <div    class = "d-flex justify-content-center actionnya">
                                <button class = "btn btn-success" type                    = "submit">Tambah</button>
                                <a      href  = "{{route('upt-penerima-manfaat')}}" class = "btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function tangani() {
        document.getElementById('modal-lengkapi').style.display = 'flex'
    }
    function closep() {
        document.getElementById('modal-lengkapi').style.display = 'none'
    }
</script>

@endsection
@section('jquery')
    <script>
        $(function() {
            $('#upt-Pendaftar-Dihubungi').DataTable({
                processing: true,
                ajax: '{{URL::to('/upt/pendaftar/dihubungi/data')}}',
                columns:[
                    {data:'no_reg', name:'No. Registrasi'},
                    {data:'nama_lengkap', name:'Nama Lengkap'},
                    {data:'jenis_aduan', name:'Jenis Aduan'},
                    {data:'nik', name:'NIK'},
                    {data:'alamat', name:'Alamat'},
                    {data:'telp_rekomendasi', name:'Telepon'},
                    {data:'namapj', name:'Penanggung Jawab'},
                    {data:'action', name:'Aksi'},
                ],
                "columnDefs":[{
                    "defaultContent":"-",
                    "targets":"-all"
                }],
                "order":[]
            });
        });
        $(document).ready(function() {
            $.ajax({
                url    : "{{url('api/provinsi')}}",
                method : "GET",
                success: function(result) {
                    console.log(result);
                }
            });

            // Apabila provinsi diganti maka list kabupaten berganti
            $('#provinsi').on('change', function() {
                $.ajax({
                    url    : "{{url('api/kabupaten')}}/"+this.value,
                    method : "GET",
                    success: function(result) {
                        $('#kabupaten').find('option')
                            .remove()
                            .end()
                            .append('<option value="">Pilih Kota/Kabupaten</option>');
                        $('#kecamatan').find('option')
                            .remove()
                            .end()
                            .append('<option value="">Pilih Kecamatan</option>');
                        result.kabupaten.forEach(function(item) {
                            $('#kabupaten').append(`<option value="${item.kab_id}">${item.kab}</option>`);
                        });
                    }
                });
            });

            $('#kabupaten').on('change', function() {
                $.ajax({
                    url    : "{{url('api/kecamatan')}}/"+this.value,
                    method : "GET",
                    success: function(result) {
                        $('#kecamatan').find('option')
                            .remove()
                            .end()
                            .append('<option value="">Pilih Kecamatan</option>');
                        result.kecamatan.forEach(function(item) {
                            $('#kecamatan').append(`<option value="${item.kec_id}">${item.kec}</option>`);
                        });
                    }
                });
            });
        });
    @if(\Session::has('msg'))
        alert("{!! \Session::get('msg') !!}");
    @endif
    </script>
@endsection
