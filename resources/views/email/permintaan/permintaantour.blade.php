@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $mintatour->name }}<br>
      Permintaan Tour Anda Sedang Diproses. Harap menunggu konfirmasi dari kami dalam kurun waktu 24 - 48 jam.<br>
      <table border="1">
        <thead>
          <tr>
            <th>Field</th>
            <th>Content</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>KODE BOOKING</td>
            <td>{{ $mintatour->code_booking }}</td>
          </tr>
          <tr>
            <td>NAMA PERMINTAAN</td>
            <td>{{ $mintatour->name }}</td>
          </tr>
          <tr>
            <td>TUJUAN</td>
            <td>{{ $mintatour->location }}</td>
          </tr>
          <tr>
            <td>DURASI TOUR</td>
            <td>{{ $mintatour->name }}</td>
          </tr>
          <tr>
            <td>CATATAN</td>
            <td>{{ $mintatour->note }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="line">
      Terima Kasih Telah Menggunakan Jasa Sako Holidays Untuk Menemani Perjalanan Anda.
      <br>
      Salam,<br>
      Sako Holidays
    </div>
  </div>
@endsection
