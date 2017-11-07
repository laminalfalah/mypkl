@extends('backend.layouts.master')

@section('title', 'DAFTAR PAKET TOUR')

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('tour.index') }}">Tour</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.tour.index') }}">Tour</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.tour.index') }}">Tour</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          @include('backend.layouts.flash')
          <h3 class="box-title">DAFTAR PAKET TOUR</h3>
          <div class="pull-right">
            @if(Auth::user()->hasRole('admin'))
              <a href="{{ route('tour.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            @elseif (Auth::user()->hasRole('operator'))
              <a href="{{ route('operator.tour.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            @else
              <a href="{{ route('company.tour.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            @endif
          </div>
        </div>
        <div class="box-body no-padding">
          {!! $html->table(['class' => 'table table-striped table-bordered table-hover']) !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  {!! $html->scripts() !!}
@endsection
