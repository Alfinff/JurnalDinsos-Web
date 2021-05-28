@extends('index')
@section('head')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
@endsection
@section('content')
<style>
  .visimisi{
    margin-bottom: 40px;
  }
  .visimisi label{
    font-weight: 700;
    font-size: 24px;
    color: #282828;
    margin-bottom: 16px;
  }
  .visimisi p {
    color: #282828;
    font-weight: 400;
    font-size: 22px;
  }
</style>
<header>
  <div class="d-flex">
    <div class="info-header-2 text-center">
      <img src="{{asset('assets/images/tentang.png')}}" height="400" alt="">
      <h2>Tentang</h2>
      <p class="text-center">Temukan informasi seputar Dinas Sosial Jawa Timur dan UPT yang berada dibawah naungan Dinas Sosial Jawa Timur.</p>
    </div>
  </div>
</header>
<section>
  <div class="subhead">
    <p>Visi dan Misi</p>
  </div>
  {!! $visimisi->deskripsi !!}
</section>
@endsection
