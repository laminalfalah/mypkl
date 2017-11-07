@extends('backend.layouts.master')

@section('title', 'DETAIL PEMESANAN TOUR '.$pemesanans->name)

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('tour.pemesanan.show') }}">Detail pemesanan Tour</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.tour.pemesanan.show') }}">Detail pemesanan Tour</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.tour.pemesanan.show') }}">Detail pemesanan Tour</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL PEMESANAN PAKET TOUR</h3>
          <div class="pull-right">
            @if (Auth::user()->hasRole('admin'))
              <a href="{{ route('tour.pemesanan.download',$pemesanans->id) }}" target="_blank" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i>&nbsp;Download
              </a>
            @elseif (Auth::user()->hasRole('operator'))
              <a href="{{ route('operator.tour.pemesanan.download',$pemesanans->id) }}" target="_blank" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i>&nbsp;Download
              </a>
            @endif
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-condensed">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Kode Booking</td>
                  <td>{{ $pemesanans->code_booking }}</td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>{{ $pemesanans->name }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ $pemesanans->status }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{ $pemesanans->email }}</td>
                </tr>
                <tr>
                  <td>Telepon</td>
                  <td>{{ $pemesanans->telephone }}</td>
                </tr>
                <tr>
                  <td>Paket Tour</td>
                  <td>{{ $pemesanans->title }}</td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td>Rp. {{ number_format($pemesanans->price,0,",",".") }}</td>
                </tr>
                <tr>
                  <td>Tanggal Tour</td>
                  <td>{!! date('d-F-Y',strtotime($pemesanans->departure_date)) !!}</td>
                </tr>
                <tr>
                  <td>Jumlah Peserta</td>
                  <td>{{ $pemesanans->participant }}&nbsp;Orang</td>
                </tr>
                <tr>
                  <td>Total Harga</td>
                  <td>Rp.&nbsp;{!! number_format($jumlah,0,",",".") !!}</td>
                </tr>
                <tr>
                  <td>Catatan</td>
                  <td>{{ $pemesanans->note }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
