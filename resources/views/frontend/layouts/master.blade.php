<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js"><head><title>Sako Holidays | @yield('title')</title><meta http-equiv="content-type" charset="text/html; charset=utf-8"><meta http-equiv="refresh" content="600"><meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=0"><meta name="owner" content="Sako Holidays Tour dan Umroh"><meta name="author" content="Sako Holidays Tour dan Umroh"><meta name="keywords" content="Tiket Pesawat Murah, Voucher Hotel Murah, Paket Tour Domestik, Paket Tour Internasional, Paket Wisata Murah, Paket Umroh Ekonomis, Paket Umroh Gold, Paket Umroh VIP, Paket Umroh Plus Tour Turki, Dubai, Mesir, Malaysia. Kualitas Pelayanan Prima, Harga Kompetitif, Harga Bersaing, Pasti Lebih Murah."><meta name="description" content="Pemesanan Tiket Pesawat, Voucher Hotel, Paket Tour, Paket Wisata, Paket Umroh.">
  <!-- CSS --><link type="text/css" rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('assets/ionicons/css/ionicons.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('css/normalize.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('css/reset.css') }}"><link type="text/css" rel="stylesheet" href="{{ asset('css/pace.css') }}">
  <!-- JS --><script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script><script src="{{ asset('assets/bootstrap/js/bootstrap.js') }}"></script><script src="{{ asset('assets/jquery-validation/dist/jquery.validate.js') }}"></script><script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script><script src="{{ asset('assets/bootstrap-typeahead/bootstrap3-typeahead.js') }}"></script><script src="{{ asset('assets/moment/moment.js') }}"></script><script src="{{ asset('js/modernizr-custom.js')}}"></script><script src="{{ asset('js/pace.js') }}"></script><!-- Custom --><link type="text/css" rel="stylesheet" href="{{ asset('css/main.css') }}"><script src="{{ asset('js/main.js') }}"></script><!-- Theme Browser Mobile --><meta name="theme-color" content="#12B58A"><meta name="msapplication-navbutton-color" content="#12B58A"><meta name="msapplication-Tilecolor" content="#12B58A"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="#12B58A"><!-- Icon --><link type="image/x-icon" rel="icon" href="{{ asset('favicon.ico') }}"><link type="image/x-icon" rel="shortcut icon" href="{{ asset('favicon.ico') }}"><meta http-equiv="expires" content="{{ date('l, d-F-Y, H:i:s, T', strtotime('next day')) }}"><meta name="csrf-token" content="{{ csrf_token() }}"><!--[if lt IE 9]> <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]--></head>

  <body>
    <noscript>Situs ini membutuhkan Javascript. Silahkan Aktifkan Javascript untuk melanjutkan. <a href="http://www.enable-javascript.com/id/" target="_blank" class="notjs">Klik disini</a></noscript><div><!--[if lte IE 6]> <div id='badBrowser'>Browser ini tidak mendukung. Silakan gunakan browser seperti <a href="https://www.mozilla.org/id/firefox/fx/" rel="nofollow">Firefox</a>, <a href="https://www.google.com/intl/id/chrome/browser/" rel="nofollow">Chrome</a> atau <a https="http://www.apple.com/safari/" rel="nofollow">Safari</a></div> <![endif]--></div>

    <div id="home">
      <!-- Header Start -->
      <header id="top-header">
        <div id="top-menu">
          <div class="top-menu-container">
            <div id="top-menu-container-content">
              <!-- Menu Green Start -->
              <div id="top-menu-green">
                <div class="top-menu-green-left">
                  <i class="fa fa-phone-square"></i>&nbsp;Telp.&nbsp;&#43;62711&nbsp;&#45;&nbsp;820627&nbsp;&#47;&nbsp;
                  <i class="fa fa-whatsapp">&nbsp;WA.&nbsp;&#43;62812&nbsp;&#45;&nbsp;7113&nbsp;&#45;&nbsp;0821</i>
                </div>
                <div class="top-menu-green-right">
                  <div id="menu-green-content">
                    <ul>
                      <li><a href="{{ route('form.cek') }}">Cek Pemesanan</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panduan <span class="caret"></span></a>
                        <ul class="dropdown-menu custom1">
                          <li><a href="{{ route('beranda.carapemesanan') }}">Cara Pemesanan</a></li>
                          <li><a href="{{ route('beranda.contactus') }}">Hubungi Kami</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag"></i>&nbsp;Bahasa <span class="caret"></span></a>
                        <ul class="dropdown-menu custom2">
                          <li><a href="{{ route('beranda.id') }}">Bahasa Indonesia</a></li>
                          <li><a href="#">Bahasa Inggris</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Menu White Start -->
              <div id="top-menu-white" class="custom">
                <a id="brand" href="{{ route('beranda') }}"><div id="logo" style="width: 18%;"></div></a>
                <div id="menu-white-content">
                  <ul id="menu-white-link">
                    <li class="{{ set_active('beranda') }}">
                      <a href="{{ route('beranda') }}">
                        <i class="fa fa-fw fa-home" style="color: #ee6d0f"></i>
                      </a>
                    </li>
                    <li class="{{ set_active('tiket.beranda') }}">
                      <a href="{{ route('tiket.beranda') }}">Tiket</a>
                    </li>
                    <li class="{{ set_active('hotel.beranda') }}">
                      <a href="{{ route('hotel.beranda') }}">Hotel</a>
                    </li>
                    <li class="{{ set_active('tour.beranda') }}">
                      <a href="{{ route('tour.beranda') }}">Tour</a>
                    </li>
                    <li class="{{ set_active('umroh.beranda') }}">
                      <a href="{{ route('umroh.beranda')}}">Umroh</a>
                    </li>
                    <li class="{{ set_active('mobil.beranda') }}">
                      <a href="{{ route('mobil.beranda') }}">Sewa Mobil</a>
                    </li>
                  </ul>
                </div>
                <div id="menu-white-user">
                  <ul>
                  @if (Auth::guest())
                    <!--<li>
                      <a href="#">Daftar</a>
                    </li>-->
                    <li>
                      <a href="{{ route('login') }}">
                        <i class="fa fa-sign-in"></i>&nbsp;Login
                      </a>
                    </li>
                  @else
                    <li>
                      <a href="{{ url('/home') }}" target="_blank"> {{ Auth::user()->name }}</a>
                    </li>
                    <li>
                      <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>&nbsp;logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>
                    </li>
                    @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Header Start -->

      <!-- Slideshow Start -->
      <div class="slideshowImage">
        <div class="slideContainer">
          @foreach ($slide as $key)
            <a class="slideLink" href="{{ url($key->slug) }}"><div class="slideImages" style="background-image: url('{!! asset($key->images) !!}');"></div></a>
          @endforeach
        </div>
        <div class="slideBtnContainer">
        @for ($i = 1; $i <= count($slide); $i++)
          <div id="" class="slideBtnIndex" onclick="currentDiv({{$i}})"></div>
        @endfor
        </div>
        <div class="slideBtnNav slideBtnNavNext" onclick="plusDivs(+1)"></div>
        <div class="slideBtnNav slideBtnNavPrev" onclick="plusDivs(-1)"></div>
      </div>
      <!-- Slideshow Start -->

      <div class="container" id="content">
        @yield('form')
        <div class="clearfix"></div>
        @yield('content')
      </div>

      <!-- Footer -->
      @include('frontend.layouts.footer')
      <!-- Footer -->
      <span id="topup"><i class="fa fa-arrow-up"></i></span>
    </div>
    <script type="text/javascript">var slideIndex1 = 1; showDivs(slideIndex1); function plusDivs(n) { showDivs(slideIndex1 += n); } function currentDiv(n) { showDivs(slideIndex1 = n); } function showDivs(n) { var i; var x = document.getElementsByClassName("slideImages"); var dots = document.getElementsByClassName("slideBtnIndex"); if (n > x.length) {slideIndex1 = 1} if (n < 1) {slideIndex1 = x.length}; for (i = 1; i < x.length; i++) { x[i].style.display = "none"; } for (var i = 0; i < dots.length; i++) { dots[i].className = dots[i].className.replace(" Selected", ""); } x[slideIndex1-1].style.display = "block"; dots[slideIndex1-1].className += " Selected"; } </script>
    <!-- Copyright 2017 PT. SAKO UTAMA WISATA All Right Reserved. Hak Cipta Dilindungi -->
  </body>
</html>
