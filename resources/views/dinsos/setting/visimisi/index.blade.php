@extends('layout.template')
@section('content')
<style>
    .logo-visi{
        width: 100%;
        height: 300px;
    }
    .contentvisimisi h1,h2,h3,h4,h5,h6{
        text-align: center;
        margin-bottom: 10px
    }
    .contentvisimisi p{
        text-indent: 45px;
        margin: 10px 0;
        font-size: 15px;
    }
    .logo-visi img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .carde-logo{
        border-radius: 15px;
        overflow: hidden;
        padding: 10px;
    }
</style>
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="head-judul text-center">
                            <h5>
                               <i class="fa fa-list-alt text-primary"></i> Visi & Misi
                            </h5>
                            {{-- <hr> --}}
                        </div>
                        <div class="d-flex justify-content-end my-4">
                            <a href="{{route('dinsos-setting-visimisi-edit', ['uuid' => $visimisi->uuid])}}" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="row my-4">
                            <div class="col-lg-12 mt-4 contentvisimisi">
                                <h5>Deskripsi</h5>
                                {!! $visimisi->deskripsi !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
