@extends('layout.template')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
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
            <div class="back">
                <a href="{{route('upt-penerima-tambah-bantuan', ['uuid' => $bantuan->pendaftar_id])}}" class="d-flex">
                    <img src="https://jurnal-dinsos.primakom.co.id//assets/images/back.png" alt="">
                    <p>Kembali</p>
                </a>
            </div>
            <div class="head-judul text-center">
              <h3>Edit Manfaat</h3>
            </div>
            <form action="" class="tambah-manfaat" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6">
                        <div class="form-group">
                            <label for="manfaat">Bantuan</label>
                            <input type="text" name="manfaat" value="{{$bantuan->bantuan}}" id="manfaat" placeholder="Masukkan Bantuan" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Pemberian</label>
                            <input type="date" name="tanggal" id="tanggal" value="{{date('Y-m-d', strtotime($bantuan->tanggal_beri))}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group file-area">
                                <label for="foto_bukti">Masukkan Foto Bukti</label>
                                <input type="file" id="foto_bukti" name="foto_bukti" data-show-remove="false" class="dropify" data-default-file="{{route('images-getter', ['module' => 'bukti', 'filename' => $bantuan->bukti])}}" accept="image/*" />
                                <div class="warn">
                                    <small class="text-danger">Jenis File yang diterima : .jpg dan .png saja</small>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="d-flex justify-content-center actionnya">
                            <button class="btn btn-success" type="submit">Simpan</button>
                            <a href="{{route('upt-penerima-manfaat')}}" class="btn btn-danger">Batal</a>
                        </div>
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
<script src="{{asset('assets/js/dropify.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        });
    })
</script>

@endsection
