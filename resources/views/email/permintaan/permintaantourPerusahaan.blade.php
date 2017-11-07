@extends('email.layouts.app')

@section('content')
  <div class="body">
    <div class="line">
      Hi, {{ $user }}<br>
      Ada satu permintan Tour, Harap Buka Dashboard untuk melakukan konfirmasi.<br>
      Detail Request Tour :
      <table>
        <thead>
          <tr>
            <th>Field</th>
            <th>Content</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Kode Booking &nbsp;</td>
            <td>{{ $code_booking }}</td>
          </tr>
          <tr>
            <td>NAMA REQUEST &nbsp;</td>
            <td>{{ $name }}</td>
          </tr>
          <tr>
            <td>EMAIL &nbsp;</td>
            <td>{{ $email }}</td>
          </tr>
          <tr>
            <td>TELEPON &nbsp;</td>
            <td>{{ $telephone }}</td>
          </tr>
          <tr>
            <td>LOKASI TOUR &nbsp;</td>
            <td>{{ $location }}</td>
          </tr>
          <tr>
            <td>DURASI &nbsp;</td>
            <td>{{ $duration }}</td>
          </tr>
          <tr>
            <td>CATATAN &nbsp;</td>
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
