@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $user->name }}<br>
      Harap konfirmasikan alamat email anda dengan mengklik tombol di bawah ini
    </div>
    <div class="action">
      <a href="{{route('verifikasi', ["email" => $user->email, "verifyToken" => $user->verifyToken]) }}" target="_blank">Verfikasi Akun</a>
    </div>
    <div class="line">
      Gunakan Akun untuk melakukan pembuatan Paket tour dan umroh, melihat pemesanan tour dan umroh, melihat permintaan tour dan pembuatan artikel traveling.
      <br>
      Salam,<br>
      Sako Holidays
    </div>
    <div class="trouble">
      Jika mengalami masalah pada tombol verifikasi akun, silahkan klik link dibawah ini atau copy link ke tab address browser anda.
      <br>
      <a href="{{route('verifikasi', ["email" => $user->email, "verifyToken" => $user->verifyToken]) }}">{{route('verifikasi', ["email" => $user->email, "verifyToken" => $user->verifyToken]) }}</a>
    </div>
  </div>
@endsection
