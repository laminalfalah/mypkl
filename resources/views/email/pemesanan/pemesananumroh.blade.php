@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $pemesanan->name }}<br>
      Permesanan Umroh Anda Sedang Diproses. Harap menunggu konfirmasi dari kami dalam kurun waktu kurang dari 24 jam.<br>
      Detail Pemesaann Tour :
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
            <td>{{ $pemesanan->code_booking }}</td>
          </tr>
          <tr>
            <td>PAKET UMROH</td>
            <td>{{ $pemesanan->title }}</td>
          </tr>
          <tr>
            <td>HARGA</td>
            <td>{{ $pemesanan->price }}</td>
          </tr>
          <tr>
            <td>JUMLAH PESERTA</td>
            <td>{{ $pemesanan->participant }}</td>
          </tr>
          <tr>
            <td>TOTAL PEMBAYARAN</td>
            <td>{{ $pemesanan->total }}</td>
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
