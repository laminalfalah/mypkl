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
          <td>Nama Paket</td>
          <td>{{ $tour->title }}</td>
        </tr>
        <tr>
          <td>Author</td>
          <td>{{ $tour->name }}</td>
        </tr>
        <tr>
          <td>Kategori</td>
          <td>{{ $tour->category }}</td>
        </tr>
        <tr>
          <td>Images</td>
          <td>
            <img src="{!! public_path($tour->images) !!}" width="525px" height="250px"alt="">
          </td>
        </tr>
        <tr>
          <td>Durasi Perjalanan</td>
          <td>{{ $tour->duration }}</td>
        </tr>
        <tr>
          <td>Awal Periode</td>
          <td>{!! date('d-F-Y',strtotime($tour->start_period)) !!}</td>
        </tr>
        <tr>
          <td>Akhir Periode</td>
          <td>{{ date('d-F-Y',strtotime($tour->end_period)) }}</td>
        </tr>
        <tr>
          <td>Harga</td>
          <td>Rp&nbsp;{{ number_format($tour->price,0,",",".") }}</td>
        </tr>
        <tr>
          <td>Itinerary</td>
          <td>{!! $tour->itinerary !!}</td>
        </tr>
        <tr>
          <td>Syarat & Ketentuan</td>
          <td>{!! $tour->terms_conditions !!}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
