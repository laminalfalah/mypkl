@extends('backend.layouts.master')

@section('title', 'DETAIL PENGGUNA '.$users->name)

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('users.show') }}">Detail Users</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">DETAIL PENGGUNA</h3>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Field</th>
                  <th>Content</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nama</td>
                  <td>{{ $users->name }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>{{ $users->email }}</td>
                </tr>
                <tr>
                  <td>Status Akun</td>
                  <td>
                    @if ($users->status === "Activated")
                      <i class="fa fa-check-circle" style="color: #23c10f;"></i>&nbsp;Aktif
                    @elseif ($users->status === "Pending")
                      <i class="fa fa-circle" style="color: #d5cc02;"></i>&nbsp;Belum Verifikasi
                    @else
                      <i class="fa fa-times-circle" style="color: #be0000;"></i>&nbsp;Blok
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Level</td>
                  <td>{{ $users->level }}</td>
                </tr>
                <thead>
                  <tr>
                    <th colspan="2">Detail Diri</th>
                  </tr>
                </thead>
                <tr>
                  <td>Tempat, Tanggal Lahir</td>
                  <td>
                    @if ($users->place_of_birth != "") {{ $users->place_of_birth }} @else {{ "Kosong" }} @endif
                    ,  &nbsp;
                    @if ($users->date_of_birth != '') {{ date('d - m - Y', strtotime($users->date_of_birth)) }} @else {{ "Kosong" }} @endif
                  </td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>
                    @if ($users->sex === "Male")
                      <i class="fa fa-male"></i>&nbsp;Pria
                    @elseif ($users->sex === "Female")
                      <i class="fa fa-female"></i>&nbsp;Wanita
                    @else
                      Kosong
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>Agama</td>
                  @if ($users->religion == "Islam")
                    <td>Islam</td>
                  @elseif ($users->religion == "Christian")
                    <td>Kristen Protestan</td>
                  @elseif ($users->religion == "Katholik")
                    <td>Katholik</td>
                  @elseif ($users->religion == "Buddha")
                    <td>Buddha</td>
                  @elseif ($users->religion == "Hindu")
                    <td>Hindu</td>
                  @elseif ($users->religion == "Other")
                    <td>Lainnya</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Status Pernikahan</td>
                  @if ($users->status_marriage == "Single")
                    <td>Belum Menikah</td>
                  @elseif ($users->status_marriage == "Married")
                    <td>Menikah</td>
                  @elseif ($users->status_marriage == "Divorced")
                    <td>Cerai Hidup</td>
                  @elseif ($users->status_marriage == "Death Divorce")
                    <td>Cerai Mati</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Kewarganegaraan</td>
                  @if ($users->citizen == "WNI")
                    <td>WNI</td>
                  @elseif ($users->citizen == "WNA")
                    <td>WNA</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Alamat</td>
                  @if ($users->address != "")
                    <td>{{ $users->address }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Telepon</td>
                  @if ($users->telephone != "")
                    <td>{{ $users->telephone }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <thead>
                  <tr>
                    <th colspan="2">Detail Pendidikan</th>
                  </tr>
                </thead>
                <tr>
                  <td>Nama Universitas</td>
                  @if ($users->univercity != "")
                    <td>{{ $users->univercity }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Pendidikan</td>
                  @if ($users->grade != "")
                    <td>{{ $users->grade }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>IPK</td>
                  @if ($users->ipk != "")
                    <td>{{ $users->ipk }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
                <tr>
                  <td>Tahun Lulus</td>
                  @if ($users->graduation != "")
                    <td>{{ $users->graduation }}</td>
                  @else
                    <td>Kosong</td>
                  @endif
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
