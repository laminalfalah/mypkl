@extends('frontend.layouts.v_master')

@section('title', 'Cara Pemesanan Sako Holidays')

@section('content')
  <div class="row" style="margin-top: 10px;">
    <div class="kol-md-12">
      <div class="" style="box-shadow: 0 0 3px 0px #222; margin-bottom: 25px; padding: 5px;">
        <h1>CARA PEMESANAN DI SAKO HOLIDAYS</h1>
        <div class="" style="text-align: justify; font-size: 15px; color: #000">
          <div class="" style="padding: 5px; margin: 5px;">
            @for ($i=1; $i <= 42; $i++)
              CARA PEMESANAN DI SAKO HOLIDAYS&nbsp;,
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
