@extends('frontend.layouts.master')

@section('title', 'Pilihan Paket Tour Domestik dan Internasional')

@section('form')
  <div class="search-panel-form-container" style="height: 250px;">
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-tour"><i class="fa fa-globe"></i>&nbsp; Paket Tour</li>
    </ul>
    <div id="tab-tour" class="tab-content-home current">
      <div class="search-panel-form" style="text-align: center;">
        <h3>ALASAN MEMILIH TOUR BERSAMA SAKO HOLIDAYS</h3>
        <div class="row" style="line-height: 3; ">
          <div class="kol-md-3">
            <span class="fa fa-4x fa-globe"></span>
            <h5>PAKET YANG BERAGAM</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-calendar"></span>
            <h5>JADWAL YANG FLEXIBLE</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-dollar"></span>
            <h5>HARGA YANG KOMPETITIF</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-star"></span>
            <h5>PELAYANAN PRIMA</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="clearfix" style="height: 10px;"></div>
    <div class="maincontent">
      <ul class="tabs">
        <h3 class="awesome">INGIN TOUR ? AYO TOUR BERSAMA SAKO HOLIDAYS !</h3>
        <li class="tab-link current" data-tab="tab-domestik"><i class="fa fa-map-marker"></i>&nbsp;Domestik</li>
        <li class="tab-link" data-tab="tab-internasional"><i class="fa fa-map-marker"></i>&nbsp;Internasional</li>
      </ul>
      <!-- Start Tab Domestik -->
      <div id="tab-domestik" class="tab-content current">
        <div class="row">
          <div class="kol-md-12">
            @if (count($domestik))
              @foreach ($domestik as $domestiks)
                <div class="mainpaket">
                  <div class="judul">
                    <a href="{{ route('tour.view',$domestiks->slug) }}">{{ $domestiks->title }}</a>
                    <div class="tgl">
                      Tanggal : {{ date('d F Y', strtotime($domestiks->created_at)) }} &nbsp;, Disunting : {{ $domestiks->name }}
                    </div>
                  </div>
                  <div class="foto">
                    <img src="{{ asset($domestiks->images) }}" alt="Tour Domestik">
                  </div>
                  <div class="durasi_harga">
                    <div class="pull-left">
                      <span class="fa fa-clock-o"></span>&nbsp;DURASI : {{ $domestiks->duration }} <br>
                      <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($domestiks->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($domestiks->end_period)); ?>
                    </div>
                    <div class="pull-right">
                      <span class="fa fa-money"></span>&nbsp;HARGA : RP {{ number_format($domestiks->price, 0,'.','.') }}
                      <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                    </div>
                  </div>
                  <div class="deskripsi"></div>
                </div>
              @endforeach
              <div class="pull-right">
                {!! $domestik->render() !!}
              </div>
            @else
              <h3 class="notfound">PAKET TOUR DOMESTIK TIDAK TERSEDIA</h3>
            @endif
          </div>
        </div>
      </div>
      <!-- End Tab Domestik -->

      <!-- Start Tab Internasional -->
      <div id="tab-internasional" class="tab-content">
        <div class="row">
          <div class="kol-md-12">
            @if (count($internasional))
              @foreach ($internasional as $internasionals)
                <div class="mainpaket">
                  <div class="judul">
                    <a href="{{ route('tour.view',$internasionals->slug) }}">{{ $internasionals->title }}</a>
                    <div class="tgl">
                      Tanggal : {{ date('d F Y', strtotime($internasionals->created_at)) }} &nbsp;, Disunting : {{ $internasionals->name }}
                    </div>
                  </div>
                  <div class="foto">
                    <img src="{{ asset($internasionals->images) }}" alt="Tour Domestik">
                  </div>
                  <div class="durasi_harga">
                    <div class="pull-left">
                      <span class="fa fa-clock-o"></span>&nbsp;DURASI : {{ $internasionals->duration }} <br>
                      <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($internasionals->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($internasionals->end_period)); ?>
                    </div>
                    <div class="pull-right">
                      <span class="fa fa-money"></span>&nbsp;HARGA : RP {{ number_format($internasionals->price,0,",",".") }}
                      <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                    </div>
                  </div>
                  <div class="deskripsi"></div>
                </div>
              @endforeach
              <div class="pull-right">
                {!! $internasional->render() !!}
              </div>
            @else
              <h3 class="notfound">PAKET TOUR INTERNASIONAL TIDAK TERSEDIA</h3>
            @endif
          </div>
        </div>
      </div>
      <!-- End Tab Internasional -->
    </div>
  </div>
@endsection
