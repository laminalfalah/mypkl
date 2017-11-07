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
        @foreach ($search as $umrohs)
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
      @else
        <h3 class="notfound">PAKET UMROH TIDAK TERSEDIA</h3>
      @endif
    </div>
  </div>
@endsection
