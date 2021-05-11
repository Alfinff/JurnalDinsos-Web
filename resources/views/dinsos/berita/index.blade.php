@extends('layout.template')
@section('content')
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="head-judul text-center">
                            <h3><i class="fa fa-news text-primary"></i> Berita</h3>
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <a class="btn btn-primary" href="{{route('dinsos-berita-tambah')}}"> + Tambah</a>
                        </div>
                        <table id="dinsos-Data-Berita" class="table table-bordered dt-responsive table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul Berita</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jquery')
    <script>
        $(function() {
            $('#dinsos-Data-Berita').DataTable({
                processing: true,
                ajax: '{{URL::to('/dinsos/berita/data')}}',
                columns:[
                    {data:'title', name:'Judul'},
                    {data:'editor', name:'Dibuat Oleh'},
                    {data:'created_at', name:'Dibuat Tanggal'},
                    {data:'action', name:'Tindakan'},
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
