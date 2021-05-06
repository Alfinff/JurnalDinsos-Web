@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
@endsection

@section('content')
<style>
    .card{
        box-shadow: 0px 4px 28px rgba(140, 140, 140, 0.2) !important;

    }
    .col-md-4{
        margin: 20px 0;
    }
</style>
<header>
    <div class="d-flex">
        <div class="info-header-2">
            <img src="{{asset('assets/images/uptprofile.png')}}" height="400" alt="">
            <h2>Profil UPT</h2>
            <p>Beberapa UPT yang ada di Provinsi Jawa Timur.</p>
            <input type="text" name="search" id="search" placeholder="Cari UPT">
        </div>
    </div>
</header>
<section>
    <div class="subhead">
        <p>UPT</p>
    </div>
    <div class="head">
        <h3>Beberapa UPT yang ada di Provinsi Jawa Timur</h3>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Asuhan Balita Sidoarjo</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Asuhan Anak Trenggalek</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Asuhan Anak Situbondo</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Asuhan Anak Sumenep</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Asuhan Anak Nganjuk</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Perlindungan dan Pelayanan Sosial Petirahan Anak Batu</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Bina Remaja Jombang</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Bina Remaja Blitar</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Bina Remaja Bojonegoro</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Bina Remaja Pamekasan</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Tresna Werdha Pasuruan</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Tresna Werdha Jombang</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Tresna Werdha Blitar</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Tresna Werdha Magetan</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="judulcard-upt">
                            <h3>UPT Pelayanan Sosial Tresna Werdha Jember</h3>
                        </div>
                        <div class="lihat-upt">
                            <a href="#">Lihat Profil ></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection