@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $pemesanan->name }}<br>
      Permesanan Tour Anda Sedang Diproses. Harap menunggu konfirmasi dari kami dalam kurun waktu kurang dari 24 jam.<br>
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
            <td>PAKET TOUR</td>
            <td>{{ $pemesanan->title }}</td>
          </tr>
          <tr>
            <td>TANGGAL TOUR</td>
            <td>{!! date('d-F-Y',strtotime($pemesanan->departure_date)) !!}</td>
          </tr>
          <tr>
            <td>HARGA</td>
            <td>Rp. {{ number_format($pemesanan->price,0,",",".") }}</td>
          </tr>
          <tr>
            <td>JUMLAH PESERTA</td>
            <td>{{ $pemesanan->participant }}&nbsp;Orang</td>
          </tr>
          <tr>
            <td>TOTAL HARGA</td>
            <?php $jum = $pemesanan->price * $pemesanan->participant; ?>
            <td>Rp.&nbsp;{!! number_format($jum ,0,",",".") !!}</td>
          </tr>
          <tr>
            <td>CATATAN</td>
            <td>{{ $pemesanan->note }}</td>
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
