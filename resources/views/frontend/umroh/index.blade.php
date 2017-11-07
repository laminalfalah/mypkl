@extends('frontend.layouts.master')

@section('title', 'Pesan Paket Umroh')

@section('form')
  <div class="search-panel-form-container" style="height: 250px; ">
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-umroh"><i class="fa fa-cube"></i>&nbsp; Paket Umroh</li>
    </ul>
    <div id="tab-umroh" class="tab-content-home current">
      <div class="search-panel-form" style="text-align: center;">
        <h3>ALASAN MEMILIH UMROH BERSAMA SAKO HOLIDAYS</h3>
        <div class="row" style="line-height: 3; ">
          <div class="kol-md-3">
            <span class="fa fa-4x fa-globe"></span>
            <h5>TRAVEL BERIZIN</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-calendar"></span>
            <h5>PASTI BERANGKAT</h5>
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
    <div class="clearfix" style="height: 30px;"></div>
    <div class="maincontent">
      <div class="row">
        <div class="kol-md-12">
          @if (count($umroh))
            @foreach ($umroh as $umrohs)
              <div class="mainpaket">
                <div class="judul">
                  <a href="{{ route('umroh.view',$umrohs->slug) }}">{{ $umrohs->title }}</a>
                  <div class="tgl">
                    Tanggal : {{ date('d F Y', strtotime($umrohs->created_at)) }} &nbsp;, Disunting : {{ $umrohs->name }}
                  </div>
                </div>
                <div class="foto">
                  <img src="{{ asset($umrohs->images) }}" alt="Umroh">
                </div>
                <div class="durasi_harga">
                  <div class="pull-left">
                    <span class="fa fa-clock-o"></span>&nbsp;DURASI : {{ $umrohs->duration }} <br>
                    <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($umrohs->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($umrohs->end_period)); ?>
                  </div>
                  <div class="pull-right">
                    <span class="fa fa-money"></span>&nbsp;HARGA : RP {{ number_format($umrohs->price,0,",",".") }}
                    <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                  </div>
                </div>
                <div class="deskripsi"></div>
              </div>
            @endforeach
            <div class="pull-right">
              {!! $umroh->render() !!}
            </div>
          @else
            <h3 class="notfound">PAKET UMROH TIDAK TERSEDIA</h3>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
