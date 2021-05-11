@extends('layout.template')
@section('content')
<style>
    .modals-edit{
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .card{
        width: 100%;
    }
    .title-modal h4{
        font-size: 19px;
        font-weight: 700;
        color: #282828;
    }
    .title-modal i {
        cursor: pointer;
    }
    .form-group{
        margin: 0 0 1rem 0;
    }
    .form-group label{
        font-weight: 700;
        font-size: 14px;
        line-height: 16.71px;
        color: rgba(40, 40, 40, 1);
    }
    tr th{
      background-color: #007BFF !important;
      color: white;
    }
    .sub1 td{
        background-color: #F6ACAC ;
        color: #3F4254;
    }
    .sub2 td{
        background-color: #B2F7DC !important;
        color: #3F4254;
    }
    table .btn{
        padding: 3px 10px;
        font-size: 14px;
    }

    .sub1 a{
        margin: 0 15px 0 0;
    }
    .sub2 a{
        margin: 0 15px 0 0;
    }
    .sub3 a{
        margin: 0 15px 0 0;
    }
    .sub1 b{
        margin: 0;
    }
    .sub2 b{
        margin: 0 0px 0 40px;
    }
    .sub3 b{
        margin: 0 0 0 80px;
    }
</style>
<div class="col-lg-10 bg-col">
  <div class="row">
    <div class="col-md-12 my-3">
      <div class="card">
        <div class="card-card" style="overflow-x:auto">
            <div class="d-flex justify-content-between pb-3 align-items-center">
                <div class="head-juduls">
                    <h5><i class="fa fa-users text-primary"></i> Pimpinan Unit Kerja</h5>
                </div>
            </div>
            <hr>
            <table id="upt-Unitkerja" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <colgroup>
                    <col span="1" style="width: 33%;">
                    <col span="1" style="width: 33%;">
                    <col span="1" style="width: 33%;">
                 </colgroup>
                <thead>
                    <tr>
                        <th >Kode</th>
                        <th >Jabatan</th>
                        <th >Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arrData as $idInduk => $dtInduk)
                        <tr class="sub1">
                            <td><b>@if(isset($dtInduk['kode_unit_kerja'])){{$dtInduk['kode_unit_kerja']}}@endif</b></td>
                            <td><b>@if(isset($dtInduk['nama_unit_kerja'])){{$dtInduk['nama_unit_kerja']}}@endif</b></td>
                            <td>
                                @if($pimpinan[$idInduk] != null)
                                    <div class="badge badge-primary">
                                        {{ucwords($pimpinan[$idInduk]->users->username)}}
                                    </div>
                                    <div class="btn-group" style="margin-left: 20px;">
                                        <div class="aksi-button">
                                            <div class="relative">
                                                <button class="btn btn-success" type="button" onclick="setpim('{{$idInduk}}')" data-toggle="modal" data-target="#set_pim">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                                    </svg>
                                                </button>
                                                <a href="{{route('hapus-pimpinan', ['id_unit_kerja' => $idInduk])}}" class="btn btn-danger">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span onclick="setpim('{{$idInduk}}')" data-toggle="modal" data-target="#set_pim" class="align-center" style="cursor: pointer"><i class="fas fa-plus btn btn-secondary" aria-hidden="true"></i> Pimpinan</span>
                                @endif
                            </td>
                        </tr>

                        @if(isset($dtInduk['level2']))
                            @if(is_array($dtInduk['level2']))
                                @foreach ($dtInduk['level2'] as $id_unit => $dtUnit)
                                    <tr class="sub2">
                                        <td><b>{{$dtUnit['kode_unit_kerja']}}</b></td>
                                        <td><b>{{$dtUnit['nama_unit_kerja']}}</b></td>
                                        <td>
                                            @if($pimpinan[$id_unit] != null)
                                                <div class="badge badge-primary">
                                                    {{ucwords($pimpinan[$id_unit]->users->username)}}
                                                </div>
                                                <div class="btn-group" style="margin-left: 20px;">
                                                    <div class="aksi-button">
                                                        <div class="relative">
                                                            <button class="btn btn-success" type="button" onclick="setpim('{{$id_unit}}')" data-toggle="modal" data-target="#set_pim">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                                                </svg>
                                                            </button>
                                                            <a href="{{route('hapus-pimpinan', ['id_unit_kerja' => $id_unit])}}" class="btn btn-danger">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span onclick="setpim('{{$id_unit}}')" data-toggle="modal" data-target="#set_pim" class="align-center" style="cursor: pointer">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17 13H13V17H11V13H7V11H11V7H13V11H17V13Z" fill="white"/>
                                                    </svg>
                                                    Pimpinan
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                    @if(isset($child3[$id_unit]))
                                        @foreach($child3[$id_unit] as $idx => $dtx)
                                        <tr class="sub3">
                                            <td><b>{{$dtx['kode_unit_kerja']}}</b></td>
                                            <td><b>{{$dtx['nama_unit_kerja']}}</b></td>
                                            <td>
                                                @if($pimpinan[$idx] != null)
                                                    <div class="badge badge-primary">
                                                        {{ucwords($pimpinan[$idx]->users->username)}}
                                                    </div>
                                                    <div class="btn-group" style="margin-left: 20px;">
                                                        <div class="aksi-button">
                                                            <div class="relative">
                                                                <button class="btn btn-success" type="button" onclick="setpim('{{$idx}}')" data-toggle="modal" data-target="#set_pim">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M0 17.2501V21.0001H3.75L14.81 9.94006L11.06 6.19006L0 17.2501ZM17.71 7.04006C18.1 6.65006 18.1 6.02006 17.71 5.63006L15.37 3.29006C14.98 2.90006 14.35 2.90006 13.96 3.29006L12.13 5.12006L15.88 8.87006L17.71 7.04006Z" fill="white"/>
                                                                    </svg>
                                                                </button>
                                                                <a href="{{route('hapus-pimpinan', ['id_unit_kerja' => $idx])}}" class="btn btn-danger">
                                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M6 19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6V19ZM19 4H15.5L14.5 3H9.5L8.5 4H5V6H19V4Z" fill="white"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span onclick="setpim('{{$idx}}')" data-toggle="modal" data-target="#set_pim" class="align-center" style="cursor: pointer">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM17 13H13V17H11V13H7V11H11V7H13V11H17V13Z" fill="white"/>
                                                        </svg>
                                                        Pimpinan
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                @endforeach
                            @endif
                        @endif
                    @endforeach
                    @php
                        $arrData = array();
                        $child3 = array();
                    @endphp
                </tbody>
            </table>
        </div>
      </div>
  </div>
</div>
<div class="modal fade" id="set_pim" tabindex="-1" role="dialog" aria-labelledby="set_pim" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-alt text-primary"></i> Setting Nama Pimpinan</h5>
                <button type="button" class="close bg-none" style="background: none;border: none;" onclick="closedd()" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
               <form class="form-horizontal" role="form" method="post" id="formsetPimpinan">
                {!! csrf_field() !!}
               <div id="formSetPim">

               </div>
           	   </form>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-warning font-weight-bold" onclick="update_pimpinan()">Simpan</button>
                <button type="button" onclick="closedd()" class="btn btn-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById('modal-edit')
    const tambah = document.getElementById('modal-kepegawaian')
    function closed() {
        modal.style.display = 'none'
        tambah.style.display = 'none'
    }
    function openEdit() {
        modal.style.display = 'flex'
    }
    function tambahdata() {
        tambah.style.display = 'flex'
    }
</script>
<div id="balik"></div>
@endsection
@section('jquery')
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
    function closedd() {
        console.log('aa')
        set_pim.style.display = 'none'
        set_pim.style.opacity = 0
    }

    function update_pimpinan()
    {
        var form = $('#formsetPimpinan');
        var formdata = false;
            if (window.FormData){
                formdata = new FormData(form[0]);
            }
        var request = $.ajax ({
            url : "{{ route('update-pimpinan') }}",
            beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
            data : formdata ? formdata : form.serialize(),
            cache       : false,
            contentType : false,
            processData : false,
            type : "post",
            dataType: "html"
        });

        //menampilkan pesan Sedang mencari saat aplikasi melakukan proses update
        $('#balik').html('Proses Update .... ');

        //Jika pencarian selesai
        request.done(function(output) {
            //Tampilkan hasil pencarian pada tag div dengan id hasil-cari

            $('#balik').html(output);
        });
    }
    function setpim(id_unit)
    {
        set_pim.style.display = 'block'
        set_pim.style.opacity = 1
        var request = $.ajax ({
        url : "{{route('set-pimpinan')}}",
        data:"id_unit="+id_unit,
        type : "get",
        dataType: "html"
    });
    $('#formSetPim').html('Sedang Melakukan Proses Pencarian Data...');
    request.done(function(output) {
        //    console.log(output);
        $('#formSetPim').html(output);
    });
    }
    </script>
@endsection
