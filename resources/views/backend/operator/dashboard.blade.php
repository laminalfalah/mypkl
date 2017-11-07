@extends('backend.layouts.master')

@section('title', 'Halaman Dashboard Operator')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="{{ set_active('dashboard.operator') }}">Dashboard</li>
@endsection

@section('content')
  <div class="row">
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0 !important;">
        <h4>
          <i class="fa fa-info"></i>
          Note :
        </h4>
        Untuk menggunakan Dashboard harap diperhatikan bagian-bagian data inti yang perlu dipersiapkan sebelumnya sebelum siap digunakan.
      </div>
    </div>

    <div class="col-lg-12 col-xs-12">
      <div class="box box-warning collapsed-box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Penting !!</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Data penting yang perlu disiapkan antara lain :
          <ul>
            <li>1. Data Paket Tour</li>
            <li>2. Data Paket Umroh</li>
            <li>3. Data Artikel</li>
            <li>4. Data Slideshow</li>
            <li>5. Daftar Pemesanan Tour</li>
            <li>6. Daftar Request Tour</li>
            <li>7. Daftar Pemesanan Umroh</li>
            <li>8. Registrasi Pegawai</li>
            <li>9. Data Pegawai</li>
          </ul>
        </div>
        <div class="box-footer">
          nb : Dalam proses ini sangat tergantung pada urutan proses.
        </div>
      </div>
    </div>

    <!-- Atas -->
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ count($tours) }}</h3>
          <p>Jumlah Paket Tour</p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($umrohs) }}</h3>
          <p>Jumlah Paket Umroh</p>
        </div>
        <div class="icon">
          <i class="fa fa-list"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($blog) }}</h3>
          <p>Jumlah Artikel</p>
        </div>
        <div class="icon">
          <i class="fa fa-sticky-note-o"></i>
        </div>
      </div>
    </div>
    <!-- Tengah -->

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ count($Rtours) }}</h3>
          <p>Jumlah Permintaan Tour</p>
          <i>Baru</i>
        </div>
        <div class="icon">
          <i class="fa fa-info"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($Ptours) }}</h3>
          <p>Pemesanan Tour</p>
          <i>Baru</i>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($Pumrohs) }}</h3>
          <p>Pemesanan Umroh</p>
          <i>Baru</i>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>
          <p>Pengunjung Website</p>
          <i>Baru</i>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ count($Ptours1) }}</h3>
          <p>List Pemesanan Tour</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ count($Pumrohs1) }}</h3>
          <p>List Pemesanan Umroh</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
      </div>
    </div>

  </div>
@endsection
