@extends('frontend.layouts.v_master')

@section('title','Pencarian Data')

@section('content')
  <div class="row" style="margin-top: 120px;">
    <div class="kol-md-12">
      <div class="hasil">
        <h1>PENCARIAN</h1>
        <p>Tipe Paket : {!! $tipe !!} &nbsp; Bulan : {!! $month !!} &nbsp; Tahun : {!! $year !!} &nbsp; Jumlah Data : {!! count($search) !!}</p>
      </div>
      @if (count($search))
        @foreach ($search as $tours)
          <div class="mainpaket">
            <div class="judul">
              <a href="{{ route('tour.view',$tours->slug) }}">{{ $tours->title }}</a>
              <div class="tgl">
                Tanggal : {{ date('d F Y', strtotime($tours->created_at)) }} &nbsp;, Disunting : {{ $tours->name }}
              </div>
            </div>
            <div class="foto">
              <img src="{{ asset($tours->images) }}" alt="">
            </div>
            <div class="durasi_harga">
              <div class="pull-left">
                <span class="fa fa-clock-o"></span>&nbsp;DURASI : {{ $tours->duration }} <br>
                <span class="fa fa-calendar"></span>&nbsp;BERANGKAT : {!! date('d-F-Y', strtotime($tours->start_period)); echo ' s/d '; echo date('d-F-Y', strtotime($tours->end_period)) !!}
              </div>
              <div class="pull-right">
                <span class="fa fa-money"></span>&nbsp;HARGA : RP {{ $tours->price }}
              </div>
            </div>
            <div class="deskripsi"></div>
          </div>
        @endforeach
      @else
        <h3 class="notfound">PAKET TOUR TIDAK TERSEDIA</h3>
      @endif
    </div>
  </div>
@endsection
