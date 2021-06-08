@extends('layout.template')
@section('content')
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="head-judul text-center">
                            <h5>
                               <i class="fa fa-list text-primary"></i> Jenis Aduan
                            </h5>
                        </div>
                        <div style="width: auto;position: absolute;right: 0;top: 0;">
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahjenisaduan">Tambah</button>
                        </div>
                        <table id="dinsos-JenisAduan" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Aduan</th>
                                    <th>Editor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisaduan as $j)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ucwords($j->nama)}}</td>
                                        <td>{{ucwords($j->editornya->username)}}</td>
                                        <td>
                                            <div class="d-flex w-100">
                                                <button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editjenisaduan{{$j->uuid}}"><i class="fa fa-pencil"></i></button>
                                                <a onclick="return confirm('Hapus Data Ini?')" href="{{route('dinsos-setting-jenisaduan-hapus', ['uuid' => $j->uuid]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal" tabindex="-1" id="editjenisaduan{{$j->uuid}}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-alt text-primary"></i> Edit Data Jenis Aduan</h5>
                                                    <button type="button" class="close bg-none" style="background: none;border: none;" data-bs-dismiss="modal" aria-label="Close">
                                                        <i aria-hidden="true" class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('dinsos-setting-jenisaduan-edit', ['uuid' => $j->uuid])}}" class="form-horizontal" role="form" method="post">
                                                        {!! csrf_field() !!}
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" required name="nama" id="nama" class="form-control" placeholder="Nama Jenis Aduan" value="{{$j->nama}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning font-weight-bold">Edit</button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger font-weight-bold" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="tambahjenisaduan">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-alt text-primary"></i> Tambah Data Jenis Aduan</h5>
                    <button type="button" class="close bg-none" style="background: none;border: none;" data-bs-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('dinsos-setting-jenisaduan-tambah')}}" class="form-horizontal" role="form" method="post">
                        {!! csrf_field() !!}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" required name="nama" id="nama" class="form-control" placeholder="Nama Jenis Aduan" value="{{old('nama')}}">
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning font-weight-bold">Tambah</button>
                    </form>
                    <button type="button" class="btn btn-danger font-weight-bold" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jquery')
    <script>
        $('#dinsos-JenisAduan').DataTable({});
    </script>
@endsection
