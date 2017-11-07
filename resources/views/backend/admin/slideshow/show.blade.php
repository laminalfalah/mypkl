@extends('backend.layouts.master')

@section('title', 'DETAIL SLIDESHOW')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('slideshow.show') }}">Detail Slideshow</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL SLIDESHOW</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Photos</td>
                  <td><img src="{{ asset($slide->images) }}" alt="" width="100%" height="250px"></td>
                </tr>
                <tr>
                  <td>Tipe</td>
                  <td>{{ $slide->slug }}</td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ $slide->post_status }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
