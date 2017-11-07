@extends('frontend.layouts.master')

@section('title', 'Pesan Penginapan Hotel Anda')

@section('form')
  <div class="search-panel-form-container" >
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-hotel"><i class="fa fa-building"></i>&nbsp; Voucher Hotel</li>
    </ul>
    <div id="tab-hotel" class="tab-content-home current">
      <div class="search-panel-form">
        <h3>Pesan Penginapan Hotel Anda</h3>
        <form id="form-hotel" action="" method="post" role="form">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <div class="row">
                <div class="kol-md-12">
                  <label>DIMANA ANDA MENGINAP ?</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-search"></i></span>
                    <input type="text" id="destination" name="destination" data-provide="typeahead" placeholder="Tujuan Kota, Nama Hotel" class="form-control required typeahead" value="">
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>CHECK IN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="checkin" name="checkin" style="padding-right: 1px;" class="form-control" readonly value="{!! date('d-F-Y', strtotime(' next day')) !!}" data-date="{!! date('d-F-Y', strtotime(' next day')) !!}">
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>CHECK OUT</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="checkout" name="checkout" style="padding-right: 1px;" class="form-control" readonly value="{!! date('d-F-Y', strtotime(' +2 day')) !!}">
                  </div>
                </div>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <div class="kol-md-6">
                <label>ORANG</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                  <select id="person" class="form-control" name="">
                    @for ($i=1; $i <= 10; $i++)
                      <option value="{{$i}}">{{$i}}&nbsp;Orang</option>
                    @endfor
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 90%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-6">
                <label>KAMAR</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-bed"></i></span>
                  <select id="room" class="form-control" name="">
                    @for ($i=1; $i <= 5; $i++)
                      <option value="{{$i}}">{{$i}}&nbsp;Kamar</option>
                    @endfor
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 90%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <!-- Button -->
              <div class="kol-md-12">
                <div class="pull-right" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 415px;">
                    <i class="fa fa-search"></i>&nbsp;Cari Hotel
                  </button>
                </div>
              </div>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
@endsection

@section('content')
  <!-- Content Start -->
  <div class="row">
    <!-- ALASAN MEMILIH SAKO HOLIDAYS -->
    <div class="mainfeature">
      <h3><i class="fa fa-arrow-right"></i>&nbsp;ALASAN MEMILIH SAKO HOLIDAYS&nbsp;<i class="fa fa-arrow-left"></i></h3>
      <div class="bodyfeature">
        <div class="kol-md-4">
          <div class="objek">
            <img src="{{ asset('img/icon/piala.png') }}" alt="AGENT TERPERCAYA">
          </div>
          <div class="textobjek">
            AGENT TERPERCAYA
          </div>
        </div>
        <div class="kol-md-4">
          <div class="objek">
            <img src="{{ asset('img/icon/bintang.png') }}" alt="KUALITAS TERBAIK">
          </div>
          <div class="textobjek">
            KUALITAS TERBAIK
          </div>
        </div>
        <div class="kol-md-4">
          <div class="objek">
            <img src="{{ asset('img/icon/cs.png') }}" alt="CUSTOMER SERVICES">
          </div>
          <div class="textobjek">
            CUSTUMER SERVICES
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 50px;"></div>
    <!-- AIRLINES -->
    <div class="mainfeature">
      <h3><i class="fa fa-building"></i>&nbsp;PARTNER PENGINAPAN HOTEL</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center;">
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-garuda-indonesia.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-singapore-airlines.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-qatar-airways.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-thai-air.png') }}" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-citilink.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-jetstar.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-etihad-airways.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-china-airlines.png') }}" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-lion-air.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-xpress-air.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-saudi-arabian-airlines.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-hongkong-airlines.png') }}" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-batik-air.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-air-asia.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-royal-jordanian.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-korean-air.png') }}" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-sriwijaya-air.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-malaysia-airlines.jpg') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-emirates-airlines.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-tiger-air.jpg') }}" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/pesawat/logo-nam-air.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-cathay-pacific.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-qantas-air.png') }}" alt="80x60">
            <img src="{{ asset('img/pesawat/logo-turkish-airlines.png') }}" alt="80x60">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 170px;"></div>
    <!-- PARTNER -->
    <div class="mainfeature">
      <h3><i class="fa fa-handshake-o"></i>&nbsp;PARTNER SAKO HOLIDAYS</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center">
          <div class="kol-md-3">
            <img src="{{ asset('img/mitra/logo-asita.png') }}" alt="125x90">
          </div>
          <div class="kol-md-3">
            <img src="{{ asset('img/mitra/logo-AG2018.png') }}" alt="125x90">
          </div>
          <div class="kol-md-3">
            <img src="{{ asset('img/mitra/logo-pemkot-plm.png') }}" alt="125x90" style="width: 80px;">
          </div>
          <div class="kol-md-3">
            <img src="{{ asset('img/mitra/logo-pemprov-sumsel.png') }}" alt="125x90" style="width: 80px;">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 5px;"></div>
    <!-- CASH -->
    <div class="mainfeature">
      <h3><i class="fa fa-dollar"></i>&nbsp;PARTNER PEMBAYARAN</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center">
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/logo-Bank-BCA.jpg')}}" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/logo-mandiri.jpg')}}" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/bni.png')}}" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/logo-bank-sumsel.png')}}" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/logo-mastercard.jpg')}}" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="{{ asset('img/mitra/logo-visa.jpg')}}" style="width: 90px; height: 40px;" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content End -->
@endsection
