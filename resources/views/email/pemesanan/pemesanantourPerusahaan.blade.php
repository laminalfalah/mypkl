@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $user }}<br>
      Ada satu Pemesanan Tour, Harap Buka Dashboard untuk melakukan konfirmasi.<br>
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
            <td>{{ $code_booking }}</td>
          </tr>
          <tr>
            <td>NAMA PAKET</td>
            <td>{{ $package_id }}</td>
          </tr>
          <tr>
            <td>NAMA PEMESAN</td>
            <td>{{ $name }}</td>
          </tr>
          <tr>
            <td>EMAIL PEMESAN</td>
            <td>{{ $email }}</td>
          </tr>
          <tr>
            <td>TELEPON PEMESAN</td>
            <td>{{ $telephone }}</td>
          </tr>
          <tr>
            <td>HARGA</td>
            <td>Rp. {{ number_format($price,0,",",".") }}</td>
          </tr>
          <tr>
            <td>JUMLAH PESERTA</td>
            <td>{{ $participant }}&nbsp;Orang</td>
          </tr>
          <tr>
            <td>TANGGAL KEBERANGKATAN TOUR</td>
            <td>{!! date('d-F-Y',strtotime($departure_date)) !!}</td>
          </tr>
          <tr>
            <td>TOTAL PEMBAYARAN</td>
            <td>Rp.&nbsp;{!! number_format($total,0,",",".") !!}</td>
          </tr>
          <tr>
            <td>CATATAN</td>
            <td>{{ $note }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="line">
      Terima Kasih.
      <br>
      Salam,<br>
      Sako Holidays
    </div>
  </div>
@endsection
