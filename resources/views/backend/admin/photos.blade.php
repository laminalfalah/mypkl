@extends('backend.layouts.master')

@section('title', 'Photos Manager')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('dashboard.admin.photos') }}">Photos Manager</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <iframe src="/laravel-filemanager?type=image" style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
    </div>
  </div>
@endsection
