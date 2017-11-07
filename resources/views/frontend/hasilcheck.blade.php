@extends('frontend.layouts.v_master')

@section('title', 'Cek Pemesanan')

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>CEK PEMESANAN ANDA</h3>
          @if ($sql)
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>NAMA</td>
                  <td>{{ $sql->name }}</td>
                </tr>
                <tr>
                  <td>NAMA PAKET / LOKASI</td>
                  <td>{{ $sql->title }}</td>
                </tr>
                <tr>
                  <td>EMAIL</td>
                  <td>{{ $sql->email }}</td>
                </tr>
                <tr>
                  <td>CODE BOOKING</td>
                  <td>{{ $sql->code_booking }}</td>
                </tr>
                <tr>
                  <td>STATUS</td>
                  <td>{{ $sql->status }}</td>
                </tr>
              </tbody>
            </table>
          @else
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2" style="text-align: center;">DATA NOT FOUND</td>
                </tr>
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
