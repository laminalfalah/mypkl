@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $pemesanan->name }}<br>
      Pemesanan Umroh Anda tolak. Dengan Kode Booking {{ $pemesanan->code_booking }}.
      Dengan Alasan {{ $pemesanan->reason_rejection }}
    </div>
    <p>Silahkan Pilih Paket Umroh Lain nya dengan mengklik tombol di bawah ini.</p>
    <div class="action">
      <a href="{{ url('/umroh') }}" target="_blank">Paket Umroh</a>
    </div>
    <div class="line">
      Terima Kasih Telah Menggunakan Jasa Sako Holidays Untuk Menemani Perjalanan Anda.
      <br>
      Salam,<br>
      Sako Holidays
    </div>
  </div>
@endsection
