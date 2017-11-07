<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <style type="text/css">
    * { font-family: Arial,sans-serif; font-style: normal; color: #000; line-height: 1.2em; }
  </style>
  <body>
    <h2 style="text-align: center; font-size: 15px">PEMESAN SAKO HOLIDAYS</h2>
    <table border="1">
      <tbody>
        <tr>
          <td>Kode Booking</td>
          <td>{{ $Pumroh->code_booking }}</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>{{ $Pumroh->name }}</td>
        </tr>
        <tr>
          <td>Status</td>
          <td>{{ $Pumroh->status }}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>{{ $Pumroh->email }}</td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td>{{ $Pumroh->telephone }}</td>
        </tr>
        <tr>
          <td>Paket Umroh</td>
          <td>{{ $Pumroh->title }}</td>
        </tr>
        <tr>
          <td>Harga</td>
          <td>Rp.&nbsp;{{ number_format($Pumroh->price,0,",",".") }}</td>
        </tr>
        <tr>
          <td>Jumlah Peserta</td>
          <td>{{ $Pumroh->participant }}&nbsp;Orang</td>
        </tr>
        <tr>
          <td>Total Pembayaran</td>
          <td>Rp.&nbsp;{!! $jumlah !!}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
