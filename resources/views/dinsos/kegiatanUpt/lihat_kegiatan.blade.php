@extends('layout.template')
@section('head')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
@section('content')
	<div class="col-lg-10 bg-col" style="min-height: 100vh">
		<div class="row my-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-card">
						<div class="back">
							<a href="{{route('dinsos-kegiatan')}}" class="d-flex">
								<img src="{{asset('assets/images/back.png')}}" alt="">
								<p>Kembali</p>
							</a>
						</div>
						<div class="head-judul text-center">
							<h3>Detail Kegiatan</h3>
							<hr>
						</div>
						{{-- <hr> --}}
						<div class="row">
							<div class="col-md-6 detailimg">
                                <a href="{{Storage::disk('s3')->temporaryUrl($kegiatan->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" data-fancybox="images" data-caption="">
								    <img class="shadow-sm" src="{{Storage::disk('s3')->temporaryUrl($kegiatan->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                                </a>
							</div>
							<div class="col-md-6">
								<div class="judulkegiatan">
									<h5>{{$kegiatan->title}}</h5>
									<div class="row mb-4">
										<div class="col-md-6 my-2">
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images/date_range.png')}}" alt="">
												<p class="mb-0 ml-2">{{\App\Helpers\Fungsi::hari_indo($kegiatan->start_date)}}</p>
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images/public.png')}}" alt="">
												<p class="mb-0 ml-2">{{$kegiatan->tipe->nama}}</p>
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images/person.png')}}" alt="">
												<p class="mb-0 ml-2">{{$kegiatan->number_of_p}} Peserta</p>
											</div>
										</div>
										<div class="col-md-6 my-2">
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images/money.png')}}" alt="">
												<p class="mb-0 ml-2">{{\App\Helpers\Fungsi::rupiah($kegiatan->budget)}}</p>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 deskripsikegiatan">
											<p>{{$kegiatan->description}}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
