@extends('index')
@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://use.fontawesome.com/448f6b23f4.js"></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v10.0" nonce="tKkn1PMo"></script>
@endsection
@section('content')
<style>
   .card{
      box-shadow: 0px 4px 28px rgba(140, 140, 140, 0.2) !important;
   }
   .logo-berita{
     height: 275px;
     overflow: hidden;
   }
   .logo-berita img{
     width: 100%;
     height: 100%;
     object-fit: cover;
   }
   .logo-berita-2{
     height: 140px;
     overflow: hidden;
   }
   .logo-berita-2 img{
     width: 100%;
     height: 100%;
     object-fit: cover;
   }
   .judul-berita a{
     text-decoration: none;
   }
   .judul-berita h4 {
     margin-bottom: 20px;
     font-size: 20px;
     font-weight: 700;
     color: #282828;
   }
   .judul-berita-2 a{
     text-decoration: none;
   }
   .judul-berita-2 h4{
     height: 26px;
     overflow: hidden;
     display: -webkit-box;
     -webkit-line-clamp: 1;
     -webkit-box-orient: vertical;
     margin-bottom: 20px;
     font-size: 20px;
     line-height: 26px;
     font-weight: 700;
     color: #282828
   }
   .content-berita p {
     margin-bottom: 30px;
   }
   .click-berita{
     display: flex;
     justify-content: space-between;
   }
   .click-berita a {
     text-decoration: none;
     margin: 0 !important;
     font-weight: 700;
     font-size: 16px;
   }
   .content-berita-2 p{
     height: 85px;
     margin-bottom: 30px;
     color: rgba(140, 140, 140, 1);
     font-weight: 400;
     font-size: 16px;
     line-height: 28px;
     overflow: hidden;
     display: -webkit-box;
     -webkit-line-clamp: 4;
     -webkit-box-orient: vertical;
   }
   .unggulan{
     display: flex;
   }
   .unggulan img{
     height: 180px;
     width: 230px;
     border-radius: 10px;
     margin-right: 15px;
     object-fit: cover;
   }
   .head-unggulan h4{
     font-weight: 700;
     font-size: 20px;
     color: #282828;
     margin-bottom: 20px;
   }
   /* New CSS */
   .overlay-header {
      width: 100%;
      height: 200px;
      position: absolute;
      bottom: 0;
      background: rgb(255,255,255);
      background: linear-gradient(180deg, rgba(255,255,255,0) 0%, rgba(0,0,0,.9) 70%);
   }
   .overlay-header .header-news,
   .container-news {
      padding: 30px 40px;
   }
   .overlay-header .header-news h4 {
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 8px;
      max-width: 900px;
   }
   .overlay-header .header-news h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 2px;
      background-color: white;
   }
   .content-berita-detail p {
    margin-bottom: 20px;
    color: rgb(29, 29, 29);
    font-weight: 400;
    font-size: 16px;
    line-height: 28px;
  }
  .thumbnail-img-berita {
     height: 190px;
     overflow: hidden;
     margin-bottom: 15px;
     border-radius: 10px;
  }
  .thumbnail-img-berita img{
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .judul-berita-2 {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    font-size: 18px;
    font-weight: 800;
  }
  .thumbnail-side-wrapper {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e0e0e0;
  }
  .thumbnail-side-wrapper:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: 0;
  }
  .sub-thumbnail {
    margin-bottom: 4px;
  }
  .sub-thumbnail span {
    opacity: .6;
  }
  .sub-thumbnail .author {
    opacity: 1;
    font-weight: 800;
    color: #1A73E8;
  }
  .content-berita-2 a {
    color: unset;
    text-decoration: none;
  }
  .content-berita-2 a:hover {
    color: unset;
    text-decoration: underline;
  }
  a.social-link {
    display:inline;
    background-color: #aaa;
    color:#fff !important;
    text-decoration:none;
    padding:6px 12px;
    margin: 0;
    -webkit-transition: background 0.1s linear;
    -moz-transition: background 0.1s linear;
    -ms-transition: background 0.1s linear;
    -o-transition: background 0.1s linear;
    transition: background 0.1s linear;
  }
  a:hover.facebook {
    background-color:#4a66b7;
  }
  a:hover.twitter {
    background-color:#00acee;
  }
  a:hover.email {
    background-color:#ff9600;
  }
  .share-section {
    border-top: 1px solid #e0e0e0;
    border-bottom: 1px solid #e0e0e0;
    padding: 15px 0 25px;
    margin: 40px 0 25px;
  }
  .share-section .text {
    font-size: 18px;
    margin-bottom: 10px;
  }
  .stamp-section {
    margin-bottom: 25px;
    padding-bottom: 12px;
    border-bottom: 1px solid #e0e0e0;
  }
  .stamp-section .time {
    font-size: 14px;
    opacity: .6;
  }
  .stamp-section .place {
    font-size: 20px;
    opacity: .6;
  }
</style>
{{-- {{dd($berita)}} --}}
<header>
   <div class="d-flex">
      <div class="info-header-2">
         <img src="{{Storage::disk('s3')->temporaryUrl($berita->images, \Carbon\Carbon::now()->addMinutes(3600))}}" alt="">
         <div class="overlay-header d-flex align-items-end text-white">
            <div class="header-news">
               <h4 id="title">{{$berita->title}}</h4>
               <div>Oleh {{$berita->editorberita->username}}</div>
            </div>
         </div>
      </div>
   </div>
</header>
<section style="margin: 0;">
   <div class="container-news">
     <div class="row">
       <div class="col-md-12">
         <div class="card">
           <div class="card-card">
             <div class="stamp-section d-flex justify-content-between align-items-end">
               <a href="{{route('halaman-berita')}}" class="btn btn-outline-primary btn-sm" style="box-shadow: unset !important;"><i class="fa fa-chevron-left" style="margin-right: 5px;" aria-hidden="true"></i> Kembali</a>
               {{-- <div class="time">Gresik - 11 April 2021 | 13.30</div> --}}
               <div class="time">{{\App\Helpers\Fungsi::hari_indo($berita->updated_at)}}</div>
             </div>
             <div class="content-berita-detail">
              {!! substr($berita->content, 0,) !!}
              </div>
              <div class="share-section d-flex flex-column align-items-center">
                <div class="text">Bagikan artikel ini:</div>
                <div></div>
                <div>
                  <a class="social-link facebook" href="" id="fb-share" rel="nofollow" target="_blank" title="Share on Facebook"><i class="fa fa-facebook"></i> Share</a>
                  <a class="social-link twitter" href="" id="tweet" rel="nofollow" target="_blank" title="Tweet this Page"><i class="fa fa-twitter"></i> Tweet</a>
                  <a class="social-link email" href="" id="email-share" title="Email to a Friend"><i class="fa fa-envelope"></i></a>
                </div>
              </div>
              <div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#{{$berita->id}}" data-width="100%" data-numposts="5"></div>
           </div>
         </div>
       </div>
       {{-- <div class="col-md-4">
          <div class="card" style="margin-bottom: 50px;">
            <div class="card-card">
              <div class="judul-berita">
                <h4>Berita Lainnya</h4>
              </div>
              <div class="content-berita-2">
                <div class="thumbnail-side-wrapper">
                  <a href="http://">
                    <div class="thumbnail-img-berita">
                      <img src="{{asset('assets/images/image 5.png')}}" alt="">
                    </div>
                    <div class="sub-thumbnail">
                      <span class="author">BPPK</span>
                      <span> - </span> 
                      <span>10 Jun 2021</span>
                      <span> | </span>
                      <span>10:30</span> 
                    </div>
                    <div class="judul-berita-2">
                      Pensosmas Jatim Lakukan Screening Assist pada Warga Terindikasi Penyalahguna Narkoba
                    </div>
                  </a>
                </div>
                <div class="thumbnail-side-wrapper">
                  <a href="http://">
                    <div class="thumbnail-img-berita">
                      <img src="{{asset('assets/images/image 5.png')}}" alt="">
                    </div>
                    <div class="sub-thumbnail">
                      <span class="author">BPPK</span>
                      <span> - </span> 
                      <span>10 Jun 2021</span>
                      <span> | </span>
                      <span>10:30</span> 
                    </div>
                    <div class="judul-berita-2">
                      Pensosmas Jatim Lakukan Screening Assist pada Warga Terindikasi Penyalahguna Narkoba
                    </div>
                  </a>
                </div>
                <div class="thumbnail-side-wrapper">
                  <a href="http://">
                    <div class="thumbnail-img-berita">
                      <img src="{{asset('assets/images/image 5.png')}}" alt="">
                    </div>
                    <div class="sub-thumbnail">
                      <span class="author">BPPK</span>
                      <span> - </span> 
                      <span>10 Jun 2021</span>
                      <span> | </span>
                      <span>10:30</span> 
                    </div>
                    <div class="judul-berita-2">
                      Pensosmas Jatim Lakukan Screening Assist pada Warga Terindikasi Penyalahguna Narkoba
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
       </div> --}}
     </div>
   </div>
</section>
@endsection
@section('script')
<script>
  $(document).ready(function($){
    function getFBShares(page){
      var shares;
      $.getJSON("http://graph.facebook.com/?ids=" + page, function(data){
        if (data[page].shares > 1){
          shares = data[page].shares;
          $("#fb-share").append(" (" + shares + ")");
        }
      });
    }
    function getTweets(page){
      var tweets;
      $.getJSON("http://urls.api.twitter.com/1/urls/count.json?url=" + page + "&callback=?", function(data){
        if (data.count > 1) {
          tweets = data.count;
          $("#tweet").append(" (" + tweets + ")");
        }
      });
    }

    var Url = window.location.href;
    var UrlEncoded = encodeURIComponent(Url);
    var title = encodeURIComponent(document.getElementById("title").innerText);
    getFBShares(Url);
    getTweets(Url);
    document.getElementById("fb-share").href="http://www.facebook.com/share.php?u=" + UrlEncoded;
    document.getElementById("tweet").href="https://twitter.com/intent/tweet?text=" + title + " - " + UrlEncoded;
    document.getElementById("email-share").href="mailto:?body=Baca berita ini: " + title + ". Anda dapat membacanya disini: " + Url;
  }); 
</script>  
@endsection