@extends('frontend.layouts.v_master')

@section('title','Pencarian Data')

@section('content')
  <div class="row" style="margin-top: 120px;">
    <div class="kol-md-12">
      <h1>TEST PENCARIAN</h1>
      <p>Paket : {!! $package !!}</p>
      <p>Bulan : {!! $month !!}</p>
      <p>Tahun : {!! $year !!}</p>
    </div>
  </div>
@endsection
