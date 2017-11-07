@extends('backend.layouts.master')

@section('title', 'DAFTAR PAKET UMROH')

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('umroh.index') }}">Daftar Paket Umroh</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.umroh.index') }}">Daftar Paket Umroh</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.umroh.index') }}">Daftar Paket Umroh</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          @include('backend.layouts.flash')
          <h3 class="box-title">DAFTAR PAKET UMROH</h3>
          <div class="pull-right">
            @if (Auth::user()->hasRole('admin'))
              <a href="{{ route('umroh.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Umroh
              </a>
            @elseif (Auth::user()->hasRole('operator'))
              <a href="{{ route('operator.umroh.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Umroh
              </a>
            @else
              <a href="{{ route('company.umroh.create') }}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Umroh
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
