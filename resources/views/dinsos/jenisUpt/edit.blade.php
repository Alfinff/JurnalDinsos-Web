@extends('layout.template')
@section('content')
	<div class="col-lg-10 bg-col" style="min-height: 100vh">
		<div class="row my-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-card">
                        <div class="back">
                            <a href="{{route('dinsos-jenisupt')}}" class="d-flex">
                                <img src="{{asset('assets/images/back.png')}}" alt="">
                                <p>Kembali</p>
                            </a>
                        </div>
						<div class="d-flex justify-content-center mb-3">
							<div class="d-flex head-juduls">
								<h5 style="margin: 0 0 0 5px"><i class="fa fa-pencil-square-o text-primary"></i>  Edit Jenis Upt</h5>
							</div>
						</div>
						<hr>
						<form action="" class="kegiatantambah" method="post">
                            @csrf
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nama">Nama</label>
											<input type="text" required name="nama" id="nama" class="form-control" placeholder="Cth: Nama" value="{{$jenisupt->nama}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="editor">Editor</label>
											<input type="text" readonly name="editor" id="editor" class="form-control" value="{{ucwords(auth()->user()->username)}}">
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="form-group">
											<label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{$jenisupt->keterangan}}</textarea>
										</div>
									</div>
									<div class="col-md-12 my-4">
										<div class="d-flex justify-content-center">
											<button class="btn btn-success">Edit</button>
                                            <a style="margin-left: 5px;" href="{{route('dinsos-jenisupt')}}" class="btn btn-danger">Batal</a>
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

@endsection
