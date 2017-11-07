@extends('backend.layouts.master')

@section('title', $blog->title)

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('blog.show') }}">Detail Artikel</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL PAKET TOUR</h3>
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
                  <td>Judul</td>
                  <td>{{ $blog->title }}</td>
                </tr>
                <tr>
                  <td>Author</td>
                  <td>{{ $blog->name }}</td>
                </tr>
                <tr>
                  <td>Dibuat Tanggal</td>
                  <td>{{ $blog->created_at }}</td>
                </tr>
                <tr>
                  <td>Images</td>
                  <td><img src="{{ asset($blog->images) }}" width="100%" height="250px"></td>
                </tr>
                <tr>
                  <td>Deskripsi</td>
                  <td>{!! $blog->description !!}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
