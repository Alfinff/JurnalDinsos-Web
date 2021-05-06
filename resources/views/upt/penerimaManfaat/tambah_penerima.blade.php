@extends('layout.template')
@section('content')
<style>
	.imgbukti {
		display: flex;
		justify-content: center;
		align-items: center;
	}
	#datatable td{
		text-align:start; 
    vertical-align: middle;
	}
	.tambah-manfaat label{
		font-weight: 700;
    font-size: 14px;
    color: rgba(40, 40, 40, 1);
    margin-bottom: 10px;
	}
	.tambah-manfaat .form-group{
		margin: 0 0 20px 0;
	}
</style>
<div class="col-md-10 bg-col">
    <div class="row">
      <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
            <div class="head-judul text-center">
              <h3>Tambah Manfaat</h3>
            </div>
            <form action="" class="tambah-manfaat">
              <div class="row">
                <div class="col-md-6">
									<div class="form-group">
										<label for="manfaat">Bantuan</label>
										<input type="text" name="manfaat" id="manfaat" placeholder="Masukkan Bantuan" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal">Tanggal Pemberian</label>
										<input type="date" name="tanggal" id="tanggal" class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="form-group file-area">
											<label for="images">Masukkan Foto Bukti</label>
											<input type="file" name="foto_kondisi" id="images" required="required" multiple="multiple"/>
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
								<div class="col-md-12">
									<div class="d-flex justify-content-center">

										<button class="btn btn-success">Tambah</button>
									</div>
								</div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12 my-3">
        <div class="card">
          <div class="card-card">
            <table id="datatable" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<colgroup>
								<col span="1" style="width: 15%;">
								<col span="1" style="width: 40%;">
								<col span="1" style="width: 45%;">
						 </colgroup>
              <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
              <tr>
                <th>Bukti</th>
                <th>Manfaat</th>
                <th>Tanggal Pemberian</th>
              </tr>
              </thead>
              <tbody>
								<tr>
									<td class="imgbukti">
										<img src="{{asset('assets/images/photouser.png')}}" alt="">
									</td>
									<td>Kopi Kapal Api</td>
									<td>20 Januari 2021</td>
								</tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="modalTambah">
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
                      <form action="" class="kegiatantambah">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="nama">Nama</label>
                                              <input type="text" name="nama" id="nama" class="form-control" value="Nama Klien">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="tanggalmasuk">Tanggal Masuk</label>
                                              <input type="date" name="tanggalmasuk" id="tanggalmasuk" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="tanggalkeluar">Tanggal Keluar</label>
                                              <input type="date" name="tanggalkeluar" id="tanggalkeluar" class="form-control">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="nomorregistrasi">Nomor Registrasi</label>
                                              <input type="text" name="nomorregistrasi" id="nomorregistrasi" class="form-control" placeholder="Nomor Registrasi">  
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="tempatlahir">Tempat Lahir</label>
                                              <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="tanggallahir">Tanggal Lahir</label>
                                              <input type="date" name="tanggallahir" id="tanggallahir" class="form-control">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="provinsi">Provinsi</label>
                                          <select name="provinsi" id="provinsi" class="form-control">
                                              <option value="">Pilih Provinsi</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="kabupaten">Kota / Kabupaten</label>
                                          <select name="kabupaten" id="kabupaten" class="form-control">
                                              <option value="">Pilih Kabupaten</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="kecamatan">Kecamatan</label>
                                          <select name="kecamatan" id="kecamatan" class="form-control">
                                              <option value="">Kecamatan</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="alamat">Alamat Lengkap</label>
                                          <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control" placeholder="Alamat"></textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-12 mt-5">
                                  <center>
                                      <button class="btn btn-success " style="background-color: #12C58E;border-color: #12C58E;">Tambah</button>
                                      <button class="btn btn-danger">Batal</button>    
                                  </center>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('jquery')
<script>
	$(document).ready(function() {
		$('#datatable').DataTable();
	})
</script>

@endsection
