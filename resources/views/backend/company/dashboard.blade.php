@extends('backend.layouts.master')

@section('title', 'Halaman Dashboard Perusahaan')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="{{ set_active('dashboard.company') }}">Dashboard</li>
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

  </div>
@endsection
