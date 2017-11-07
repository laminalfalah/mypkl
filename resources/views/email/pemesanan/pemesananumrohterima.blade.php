@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $pemesanan->name }}<br>
      Pemesanan Tour Anda Diterima. Kami Akan Menghubungi Anda Dalam Kurun Waktu 30 Menit.<br>
      Dengan Kode Booking {{ $pemesanan->code_booking }}. <br>
      <table border="1">
        <thead>
          <tr>
            <th>Field</th>
            <th>Content</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Kode Booking</td>
            <td>{{ $pemesanan->code_booking }}</td>
          </tr>
          <tr>
            <td>Paket Umroh</td>
            <td>{{ $pemesanan->title }}</td>
          </tr>
          <tr>
            <td>Harga</td>
            <td>Rp. {{ number_format($pemesanan->price,0,",",".") }}</td>
          </tr>
          <tr>
            <td>Jumlah Peserta</td>
            <td>{{ $pemesanan->participant }}&nbsp;Orang</td>
          </tr>
          <tr>
            <td>Total Harga</td>
            <?php $jum = $pemesanan->price * $pemesanan->participant; ?>
            <td>Rp.&nbsp;{!! number_format($jum ,0,",",".") !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <p>harap datang ke kantor untuk melengkapi persyaratan</p>
    <ul>
      <li>Fotokopi KTP</li>
      <li>Fotokopi PASPOR minimal masa berlaku 6 Bulan sebelum keberangkatan</li>
    </ul>
    <div class="line">
      Terima Kasih Telah Menggunakan Jasa Sako Holidays Untuk Menemani Perjalanan Anda.
      <br>
      Salam,<br>
      Sako Holidays
    </div>
  </div>
@endsection
