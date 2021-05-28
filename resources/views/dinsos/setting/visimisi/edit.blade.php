@extends('layout.template')
@section('head')
<link rel="stylesheet" href="{{asset('assets/css/dropify.css')}}">
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

@endsection
@section('content')
<style>
    .label-right{
        display: flex;
        padding: 10px 0 0 30px;
    }
    .form-group{
        margin: 20px 0;
    }
</style>
    <div class="col-lg-10 bg-col">
        <div class="row">
            <div class="col-md-12 my-3">
                <div class="card">
                    <div class="card-card">
                        <div class="back">
							<a href="{{route('dinsos-setting-visimisi')}}" class="d-flex">
								<img src="https://jurnal-dinsos.primakom.co.id//assets/images/back.png" alt="">
								<p>Kembali</p>
							</a>
						</div>
                        <div class="head-judul text-center">
                            <h5>
                                <i class="fa fa-pencil-square-o text-primary"></i> Edit Visi & Misi
                            </h5>
                            <hr>
                        </div>
                        <form action="" class="kegiatantambah" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" placeholder="Cth: Dinsos Jatim">{{$visimisi->deskripsi}}</textarea>

                                            <script>
                                                CKEDITOR.replace( 'deskripsi' );
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-primary">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
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
</script>
@endsection
