@extends('frontend.layouts.v_master')

@section('title', 'Pemesanan Telah di kirim')

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>DETAIL PEMESANAN</h3>
          @include('frontend.layouts.flash')
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">setTimeout(function() {window.location.replace("{{ route('umroh.beranda') }}")}, 5000);</script>
@endsection
