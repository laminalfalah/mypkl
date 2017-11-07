<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <style type="text/css">
    * { font-family: Arial,sans-serif; font-style: normal; color: #000; line-height: 1.2em; }
  </style>
  <body onload="window.print();">
    <h2 style="text-align: center; font-size: 15px">PEMESAN SAKO HOLIDAYS</h2>
    <table border="1">
      <tbody>
        <tr>
          <td>KODE BOOKING PEMESANAN</td>
          <td>{{ $Ptour->code_booking }}</td>
        </tr>
        <tr>
          <td>STATUS PEMESANAN</td>
          <td>{{ $Ptour->status }}</td>
        </tr>
        <tr>
          <td>NAMA PEMESAN</td>
          <td>{{ $Ptour->name }}</td>
        </tr>
        <tr>
          <td>EMAIL PEMESAN</td>
          <td>{{ $Ptour->email }}</td>
        </tr>
        <tr>
          <td>TELEPON PEMESAN</td>
          <td>{{ $Ptour->telephone }}</td>
        </tr>
        <tr>
          <td>PAKET TOUR</td>
          <td>{{ $Ptour->title }}</td>
        </tr>
        <tr>
          <td>HARGA PAKET</td>
          <td>Rp.&nbsp;{{ number_format($Ptour->price,0,",",".") }}</td>
        </tr>
        <tr>
          <td>TANGGAL TOUR</td>
          <td>{!! date('d-F-Y',strtotime($Ptour->departure_date)) !!}</td>
        </tr>
        <tr>
          <td>JUMLAH PESERTA</td>
          <td>{{ $Ptour->participant }}&nbsp;Orang</td>
        </tr>
        <tr>
          <td>TOTAL HARGA</td>
          <td>Rp.&nbsp;{{ number_format($jumlah,0,",",".") }}</td>
        </tr>
        <tr>
          <td>CATATAN</td>
          <td>{{ $Ptour->note }}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
