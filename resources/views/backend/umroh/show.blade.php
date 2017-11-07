@extends('backend.layouts.master')

@section('title', 'DETAIL '. $umroh->title)

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('umroh.show') }}">Detail Paket Umroh</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.umroh.show') }}">Detail Paket Umroh</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.umroh.show') }}">Detail Paket Umroh</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL PAKET UMROH</h3>
          <div class="pull-right">
            @if (Auth::user()->hasRole('admin'))
              <a href="{{ route('umroh.download',$umroh->slug) }}" target="_blank" class="btn btn-sm btn-success">
                <i class="fa fa-download"></i>&nbsp;Download
              </a>
            @elseif (Auth::user()->hasRole('operator'))
              <a href="{{ route('operator.umroh.download',$umroh->slug) }}" target="_blank" class="btn btn-sm btn-success">
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
                  <td>Nama Paket</td>
                  <td>{{ $umroh->title }}</td>
                </tr>
                <tr>
                  <td>Author</td>
                  <td>{{ $umroh->name }}</td>
                </tr>
                <tr>
                  <td>Kategori</td>
                  <td>{{ $umroh->category }}</td>
                </tr>
                <tr>
                  <td>Images</td>
                  <td><img src="{{ asset($umroh->images) }}" width="100%" height="250px"></td>
                </tr>
                <tr>
                  <td>Durasi Perjalanan</td>
                  <td>{{ $umroh->duration }}</td>
                </tr>
                <tr>
                  <td>Awal Periode</td>
                  <td>{!! date('d-F-Y',strtotime($umroh->start_period)) !!}</td>
                </tr>
                <tr>
                  <td>Akhir Periode</td>
                  <td>{{ date('d-F-Y',strtotime($umroh->end_period)) }}</td>
                </tr>
                <tr>
                  <td>Harga</td>
                  <td>Rp&nbsp;{{ number_format($umroh->price,0,",",".") }}</td>
                </tr>
                <tr>
                  <td>Itinerary</td>
                  <td>{!! $umroh->itinerary !!}</td>
                </tr>
                <tr>
                  <td>Syarat & Ketentuan</td>
                  <td>{!! $umroh->terms_conditions !!}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
