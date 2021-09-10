@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
<link rel="stylesheet" href="/assets/css/icons/icomoon/styles.css">
<style>
  p a{
    width: 100%;
    overflow-wrap: break-word;
  }


  .backall{
    position: relative;
    padding-bottom: 210px;
  }
  .modal-body{
    padding: 0 !important;
  }
  .footers{
    width: 100%;
    height: auto;
    padding: 30px 30px 20px 30px;
    background: url('https://i.ibb.co/8jgqsLc/image.png') no-repeat;
    background-size: cover;
    background-position: bottom;
  }
  .footers h5{
    font-family: 'myFirstFont';
  }
  .iconfooter img{
    object-fit: cover;
    margin: 5px 20px 5px 0;
  }
  .navbar-inverse {
    background-color: #2196F3;
    border-color: #2196F3;
  }
  .footers{
    position: absolute;
    bottom: 0;
  }
  /* @font-face {
    font-family: 'myFirstFont';
    src: url('https://mice.id/assets/FontsFree-Net-SFProText-Semibold.ttf');
  }
  @font-face {
    font-family: 'SecondFont';
    src: url('https://mice.id/assets/FontsFree-Net-SFProText-Regular.ttf');
  } */
  *{
    font-size: 16px;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'SecondFont';
    color: #333333;
    list-style: none;
    text-decoration: none;
  }
  h1, h2,h3,h4,h5,h6{
    font-family: 'myFirstFont';
    margin: 0;
  }
  ul{
    margin: 0;
  }
  .absolute{
    z-index: 1;
    position: fixed;
    right: 70px;
    display: none;
    box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.29);
  }
  .penampung{
    border-radius: 10px;
    width: 500px;
    height: auto;
    background: white;
  }
  .headjudul{
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
  }
  .headjudul h5{
    font-weight: bold;
    font-size: 22px;
    color: black;
  }
  .contents{
    padding: 1rem;
    position: relative;
  }
  .item{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 5px 0;
  }
  .item img{
    width: 70px;
  }
  .item h6{
    font-size: 14px;
    color: black;
  }
  .item:hover{
    background: whitesmoke;
  }
  .block{
    display: block;
  }
  .navnew a{
    color: rgba(255, 255, 255, 0.7) !important;
  }
  .navnew a:hover{
    color: white !important;
  }
  .mobel{
      display: none;
  }
  .imgdes{
      display: block;
  }
  .masuk:hover{
      background: #f3f3f3;
  }
  .containers{
    width: 100%;
    height: auto;
  }
  .navbars{
    width: 100%;
    height: 80px;
    position: relative;
  }
  .navebar{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  width: 100%;
  height: 80px;
  transition: all 1s;
  background-image: linear-gradient(45deg, transparent, transparent), linear-gradient(45deg, #671F9E, #45aaf2) !important;
  }
  .sticky{
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1;
  }
  .sticky2{
    position: fixed !important;
    top: 80px !important;
    left: 18px !important;
  }
  .content{
    width: 100%;
    padding: 40px 50px;
  }
  .penampungs{
    margin: 0;
    background: white;
    border-radius: 10px;
    padding: 50px 0;
    display: flex;
    flex-wrap: wrap;
    box-shadow: 0 0 25px 0 rgba(0,0,0,.13);
  }
  .berita{
    /* width: 900px; */
    padding: 0 20px;
    border-right: 1px solid rgba(0,0,0,.1);
  }
  .imegberita{
    width: 100%;
    height: 500px;
    object-fit: cover;
    margin: 0 0 40px;
    border-radius: 8px;
  }
  .judulberita{
    width: 100%;
    margin: 0 0 20px;
    text-align: center;
  }
  .judulberita h1{
    line-height: normal;
    font-size: 30px;
  }
  .tanggal{
    margin: 10px 0;
    color: #999;
    padding-bottom: 10px;
    border-bottom: 3px solid rgba(0,0,0,.1);
  }
  .related{
    padding: 0 20px;
    /* width: calc(100% - 900px); */
  }
  .share{
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: flex-end;
  }
  .share p{
    color: #999;
  }
  .bardesktop{
    display: flex !important;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin: 5px 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.3);
  }
  .isiberita h5{
    color: #333333;
    font-size: 18px;
    margin: 0 0 30px;
  }
  .isiberita p{
    color: #333333;
    margin: 0 0 20px;
    font-size: 18px;
  }
  .d-flex{
    display: flex;

  }
  .align-items-center{
    align-items: center;
  }
  .popular h4{
    color: #333333;
    border-bottom: 2px solid #00aeef;
    font-size: 23px;
  }
  .isiberita p:first-child {
    text-indent: 45px;
  }
  .jess{
    border-bottom: 3px solid rgba(0,0,0,.1);
    padding-bottom: 30px;
    position: relative;
  }
  .back{
    transition: all .2s;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #2D1152;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    top: -75px;
    left: -45px;
    position: absolute;
    cursor: pointer;
    font-size: 25px;
    font-weight: bold;
  }
  .back img{
    width: 40px;
    height: 50px;
  }
  .backmobile{
    display: none;
  }
  .shareagain{
    margin: 30px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .shareagain h3{
    margin-bottom: 10px;
  }
  .tags{
    margin: 0 0 50px;
  }
  .tags h3{
    letter-spacing: 2px;
    border-bottom: 2px solid #00AEEF;
  }
  .tager{
    display: flex;
    width: 100%;
    flex-wrap: wrap;
    margin-top: 10px;
  }
  .tager p {
    margin: 5px;
    color: #333333;
    font-size: 14px;
    font-weight: bold;
    padding: 10px 15px;
    background: white;
    border: 1px solid #00AEEF;
    border-radius: 50px;
  }
  .barmobile{
    display:none;
  }
  @media only screen and (max-width: 1200px) {
    .related{
      width: 100% !important;
    }
    .cardes{
      /* flex-direction: row !important; */
    }
  }
  @media only screen and (max-width: 600px) {
    .content{
      padding: 0;
      margin: 40px 0 0 0;
    }
    .imegberita{
      height: 200px;
    }
    .related{
      width: 100%;
    }
    .tager p{
      margin: 5px !important;
    }
    .berita{
      width: 100%;
    }
    .back{
      display: none;
    }
    .backmobile{
      display: block;
    }
    .backmobile img{
      width: 50px;
    }
    .bars{
      display: block !important;
    }
    .bars i{
      border-radius: 0;
      font-size: 30px;
      padding: 20px;
    }
    .barmobile{
      display:block;
      width: 35px;
      height: 35px;
    }
    .navebar{
      padding: 0 5px 0 0px;
    }
    .navebar li{
      margin: 20px 40px !important;
    }
    .navbarmenu{
      overflow: hidden;
      transition: all .5s;
      align-items: flex-start !important;
      position: absolute;
      top: 80px;
      height: 0;
      width: 100%;
      z-index: -1;
      flex-direction: column;
      left: 0;
      background: linear-gradient(45deg, transparent, transparent), linear-gradient(45deg, #671F9E, #45aaf2) !important;
    }
    .imageapp{
      display: none;
    }
  }
  .cards{
    padding: 0 20px 0 0px;
    width: 100%;
    height: auto;
    cursor: pointer;
    margin: 15px 0;
  }
  .cardes{
    display: flex;
    flex-direction: column;
  }
  .imgcards{
    width: 100%;
    height: 150px;
    overflow: hidden;
  }
  .imgcards img{
    object-fit: cover;
    width: 100%;
    height: 100%;
  }
  .judulcards{
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
  .judulcards h2{
    margin: 10px 0 0 0;
    font-size: 18px;
  }
  .cards:hover > .judulcards h2{
    color: #cc0000;
  }
  .cards:hover > .imgcards img{
    transition: all .3s;
    transform: scale(1.1);
  }
  .time p{
    margin: 5px 0 0 0 ;
    color: #909090;
    font-size: 12px;
  }
  /*  */
  .logos{
    display: flex;
    align-items: center;
  }
  .imglogo{
    width: 150px;
    height: 60px;
  }
  .listmenu{
    width: 70%;
  }
  .navbarmenu{
    align-items: center;
    display: flex;
    justify-content: flex-end;
  }
  .navbarmenu li{
    margin: 0 10px;
  }
  .navbarmenu li a{
    color: rgba(255, 255, 255, 0.7);
    font-weight: bold;
  }
  .navbarmenu li a:hover{
    color: white;
  }
  .imageapp{
    width: 35px;
    height: 35px;
  }
  .bars{
    display: none;
  }
  .show{
    height: auto !important;
    z-index: 55 !important;
  }
  .modal-dialog{
    height: 495px !important;
  }
  .modal-body{
    padding-bottom: 20px !important;
  }
  .modal-header{
    margin: 0 0 15px 0;
    padding: 1rem 1rem !important;
    border-bottom: 1px solid #CCCCCC !important;
  }
  .close{
    top: 0 !important;
    padding: 0 !important;
    margin: 0 !important;
  }
</style>
@endsection

@section('content')
<div class="backall">
  <header>
    <div class="d-flex">
       <div class="info-header-2">
          <img title="" src="{{Storage::disk('s3')->temporaryUrl($detail->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
          <div class="overlay-header d-flex align-items-end text-white">
             <div class="header-news">
             </div>
          </div>
       </div>
    </div>
  </header>
 
  <div class="containers mt-4">

      <div class="content">
          <div class="penampungs row">
              <div class="berita col-md-9">
                  <div class="jess">
                      <div class="back">
                          <a href=" {{ URL::previous() }}">
                            <img title="Back" src="https://i.ibb.co/2FZhpvP/icons-back.png" alt="">
                          {{-- @if(!isset($detail->photo))
                              <img title="Back" src="https://i.ibb.co/2FZhpvP/icons-back.png" alt="">
                          @else
                              <img title="" src="{{Storage::disk('s3')->temporaryUrl($detail->photo, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
                          @endif --}}
                          </a>
                      </div>
                  <div class="judulberita">
                      <h1>{{$detail->title}}</h1>
                      <p class="tanggal">{{ date('Y-m-d H:i:s', strtotime($detail->created_at)) }}</p>
                      <!-- <div class="share">
                      <p>Share On :</p>
                      <i class="fa fa-facebook"></i>
                      <i class="fa fa-twitter"></i>
                      <i class="fa fa-instagram"></i>
                      </div> -->
                  </div>
                  <div class="imageberita">
                      {{-- <img class="imegberita" src="{{ route('assets-getter', ['module' => 'news','filename' => $detail->image ?? '1']) }}" alt=""> --}}
                  </div>
                  <div class="isiberita">
                      <p><?php echo str_replace("&nbsp;", ' ',$detail->description)?></p>
                  </div>
                  </div>
                  <div class="shareagain">
                  <h3>SHARE :</h3>
                  <div class="d-flex">
                      <i onclick="facebook(window.location.href)" class="fa fa-facebook bardesktop"></i>
                      <i onclick="twitter(window.location.href)" class="fa fa-twitter bardesktop"></i>
                      <i onclick="copy(window.location.href)" class="fa fa-copy bardesktop"></i>
                      <input type="text" value="{{url()->current()}}" id="myCopy" hidden>
                  </div>
                  </div>
                  <div class="tags">
                  <div class="d-flex">
                      <h3>KATEGORI</h3>
                  </div>
                  <div class="tager">
                      {{-- @foreach(json_decode($detail->category) as $cat => $val)
                          <p>{{$val}}</p>
                      @endforeach --}}
                  </div>
                  </div>
              </div>
              {{-- <div class="related col-md-3">
                  <div class="d-flex align-items-center popular">
                  <h4>Berita Lainnya</h4>
                  <!-- <p>Popular</p> -->
                  </div>
                  <div class="cardes">
                  @foreach($semua_berita as $nk)
                  <div class="cards">
                      <div class="imgcards">
                      <a target="new" href="{{route('news_detail', ['newsId' => $nk->id])}}">
                      <img src="{{ route('assets-getter', ['module' => 'news','filename' => $nk->image ?? '1']) }}" alt="">
                      </a>
                      </div>
                      <div class="judulcards">
                      <a target="new" href="{{route('news_detail', ['newsId' => $nk->id])}}">
                      <h2>{{$nk->headline}}</h2>
                      </a>
                      </div>
                      <div class="time">
                      <p>{{ date('Y-m-d H:i:s', strtotime($nk->created_at)) }}</p>
                      </div>
                  </div>
                  @endforeach
                  </div>
              </div> --}}
          </div>
      </div>

  </div>
</div>
<script>
  function facebook(a) {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${a}`, "", "width=400,height=500");
  }
  function twitter(a) {
    window.open(`https://twitter.com/intent/tweet?text=${a}`, "", "width=400,height=500");
  }
  function copy(a) {
    var copyText = document.getElementById("myCopy");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    alert("Berhasil di Copy!");
  }
</script>
@endsection