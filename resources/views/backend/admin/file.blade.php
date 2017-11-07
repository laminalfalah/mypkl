@extends('backend.layouts.master')

@section('title', 'Halaman Dashboard Admin')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('dashboard.admin.file') }}">File Manager</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <iframe src="/laravel-filemanager" style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
    </div>
  </div>
@endsection
