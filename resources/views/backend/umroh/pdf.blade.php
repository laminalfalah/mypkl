<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
  </head>
  <body>
    <h2 style="text-align: center; font-size: 15px">SAKO HOLIDAYS</h2>
    <table border="1">
      <tbody>
        <tr>
          <td>Judul</td>
          <td>{!! $umroh->title !!}</td>
        </tr>
        <tr>
          <td>Author</td>
          <td>{{ $umroh->name }}</td>
        </tr>
        <tr>
          <td>Kategori</td>
          <td>{{ $umroh->category }}</td>
        </tr>
        <tr>
          <td>Images</td>
          <td>
            <img src="{!! public_path($umroh->images) !!}" width="525px" height="250px"alt="">
          </td>
        </tr>
        <tr>
          <td>Durasi Perjalanan</td>
          <td>{{ $umroh->duration }}</td>
        </tr>
        <tr>
          <td>Awal Periode</td>
          <td>{{ date('d-F-Y', strtotime($umroh->start_period)) }}</td>
        </tr>
        <tr>
          <td>Akhir Periode</td>
          <td>{{ date('d-F-Y', strtotime($umroh->end_period)) }}</td>
        </tr>
        <tr>
          <td>Harga</td>
          <td>Rp&nbsp;{{ number_format($umroh->price,0,",",".") }}</td>
        </tr>
        <tr>
          <td>Itinerary</td>
          <td>{!! $umroh->itinerary !!}</td>
        </tr>
        <tr>
          <td>Syarat & Ketentuan</td>
          <td>{!! $umroh->terms_conditions   !!}</td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
