@extends('layout.template')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.7.1/tinymce.min.js" ></script>
<link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
@endsection
@section('content')
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
                            <a href="{{route('dinsos-berita')}}" class="d-flex">
                                <img src="{{asset('/assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
                        <div class="head-judul text-center mb-5">
                            <h3><i class="fa fa-news text-primary"></i> Edit Berita</h3>
                        </div>
                        <hr>
                        <form action="" class="kegiatantambah my-3" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="judul_berita">Judul Berita</label>
                                        <input type="text" name="title" id="judul_berita" value="{{$berita->title}}" class="form-control" placeholder="Cth: Upacara Dinsos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dibuat">Editor</label>
                                        <input type="text" name="editor" id="dibuat" class="form-control" placeholder="{{ucwords(auth()->user()->username)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="images">Gambar Berita</label>
                                        <input type="file" id="images" name="images" data-show-remove="false" class="dropify" data-default-file="{{Storage::disk('s3')->temporaryUrl($berita->images ?? '' == null, \Carbon\Carbon::now()->addMinutes(3600))}}" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="deskripsi_berita">Deskripsi Berita</label>
                                        <textarea name="content" id="deskripsiberita" cols="30" rows="20">{{$berita->content}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 my-4">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                        <a style="margin-left: 5px;" href="{{route('dinsos-berita')}}" class="btn btn-danger">Batal</a>
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
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove':  'Remove',
                    'error':   'Ooops, something wrong happended.'
                }
            });
        })
        tinymce.init({
            selector: '#deskripsiberita'
        });
    </script>
@endsection
