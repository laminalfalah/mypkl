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
    <h2 style="text-align: center; font-size: 15px">SAKO HOLIDAYS</h2>
    <table border="1">
      <tbody>
        <tr>
          <td>KODE BOOKING</td>
          <td>{{ $Rtour->code_booking }}</td>
        </tr>
        <tr>
          <td>STATUS PERMINTAAN</td>
          <td>{{ $Rtour->status }}</td>
        </tr>
        <tr>
          <td>NAMA PERMINTAAN</td>
          <td>{{ $Rtour->name }}</td>
        </tr>
        <tr>
          <td>EMAIL PERMINTAAN</td>
          <td>{{ $Rtour->email }}</td>
        </tr>
        <tr>
          <td>TELEPON PERMINTAAN</td>
          <td>{{ $Rtour->telephone }}</td>
        </tr>
        <tr>
          <td>LOKASI TOUR</td>
          <td>{{ $Rtour->location }}</td>
        </tr>
        <tr>
          <td>DURASI</td>
          <td>{{ $Rtour->duration }}</td>
        </tr>
        <tr>
          <td>CATATAN PERMINTAAN</td>
          <td>{{ $Rtour->note }}</td>
        </tr>
      </tbody>
    </table>
    <p>DIBUAT TANGGAL : {{ $Rtour->created_at }}</p>
  </body>
</html>
