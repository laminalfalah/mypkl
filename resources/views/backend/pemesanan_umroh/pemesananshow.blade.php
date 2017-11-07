@extends('backend.layouts.master')

@section('title', 'DETAIL PEMESANAN UMROH')

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('umroh.pemesanan.detail') }}">Detail Pemesanan Umroh</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.umroh.pemesanan.detail') }}">Detail Pemesanan Umroh</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.umroh.pemesanan.detail') }}">Detail Pemesanan Umroh</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL PEMESANAN UMROH</h3>
          <div class="pull-right">
            @if (Auth::user()->hasRole('admin'))
              <a href="{{ route('umroh.pemesanan.download',$pemesanan->id) }}" target="_blank" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i>&nbsp;Download
              </a>
            @elseif (Auth::user()->hasRole('operator'))
              <a href="{{ route('operator.umroh.pemesanan.download',$pemesanan->id) }}" target="_blank" class="btn btn-sm btn-success">
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
                  <td>{{ $pemesanan->code_booking }}</td>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>{{ $pemesanan->name }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ $pemesanan->status }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{ $pemesanan->email }}</td>
                </tr>
                <tr>
                  <td>Telepon</td>
                  <td>{{ $pemesanan->telephone }}</td>
                </tr>
                <tr>
                  <td>Paket Umroh</td>
                  <td>{{ $pemesanan->title }}</td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td>Rp.&nbsp;{{ number_format($pemesanan->price,0,",",".") }}</td>
                </tr>
                <tr>
                  <td>Jumlah Peserta</td>
                  <td>{{ $pemesanan->participant }}&nbsp;Orang</td>
                </tr>
                <tr>
                  <td>Total Harga</td>
                  <td>Rp.&nbsp;{!! $jumlah !!}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
