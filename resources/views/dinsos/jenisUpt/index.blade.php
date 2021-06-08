@extends('layout.template')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="col-lg-10 bg-col" style="min-height: 100vh">
  <div class="row">
    <div class="col-md-12 my-3">
        <div class="card">
            <div class="card-card">
                <div class="head-judul text-center">
                    <h5><i class="fa fa-users text-primary"></i> Data Jenis Upt</h5>
                </div>
                <div style="width: auto;position: absolute;right: 5px;top: 5px;">
                    <a href="{{route('dinsos-jenisupt-tambah')}}" class="btn btn-primary">Tambah</a>
                </div>
            </form>
            <hr>
          <table id="dinsos-jenisUpt" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead style="background-color: #F5F5F5;padding: 1rem .5rem !important;">
                <tr>
                    <th>Nama</th>
                    <th>Editor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenisupt as $jj)
                    <tr>
                        <td>{{ucwords($jj->nama)}}</td>
                        <td>{{ucwords($jj->editornya->username)}}</td>
                        <td>
                            <div class="d-flex w-100 justify-content-center">
                                <a href="{{route('dinsos-jenisupt-edit', ['uuid' => $jj->uuid]) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> </a>
                                <a onclick="return confirm('Hapus Data Ini?')" href="{{route('dinsos-jenisupt-hapus', ['uuid' => $jj->uuid]) }}" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
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
</div>
<script>

</script>
@endsection
@section('jquery')
    <script>
        $('#dinsos-jenisUpt').DataTable();
    </script>
@endsection
