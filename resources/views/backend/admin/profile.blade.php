@extends('backend.layouts.master')

@section('title', 'Profile Dashboard Admin')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('dashboard.admin.profile') }}">Profile</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <!-- Column Left -->
      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Biodata Diri</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Nama</td>
                  <td>{{ $profil->name }}</td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td>{{ $profil->place_of_birth }}</td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>{{ date('d-F-Y', strtotime($profil->date_of_birth)) }}</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  @if($profil->sex === "Male")
                    <td>Pria</td>
                  @else
                    <td>Wanita</td>
                  @endif
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>{{ $profil->address }}</td>
                </tr>
                <tr>
                  <td>Agama</td>
                  @if ($profil->religion == "Islam")
                    <td>Islam</td>
                  @elseif ($profil->religion == "Christian")
                    <td>Kristen Protestan</td>
                  @elseif ($profil->religion == "Katholik")
                    <td>Katholik</td>
                  @elseif ($profil->religion == "Buddha")
                    <td>Buddha</td>
                  @elseif ($profil->religion == "Hindu")
                    <td>Hindu</td>
                  @else
                    <td>Lainnya</td>
                  @endif
                </tr>
                <tr>
                  <td>Status</td>
                  @if ($profil->status_marriage == "Married")
                    <td>Menikah</td>
                  @elseif ($profil->status_marriage == "Divorced")
                    <td>Cerai Hidup</td>
                  @elseif ($profil->status_marriage == "Death Divorce")
                    <td>Cerai Mati</td>
                  @else
                    <td>Belum Menikah</td>
                  @endif
                </tr>
                <tr>
                  <td>Kewarganegaraan</td>
                  <td>{{ $profil->citizen }}</td>
                </tr>
                <tr>
                  <td>Telepon</td>
                  <td>{{ $profil->telephone }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Column Right -->
      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Pendidikan</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Nama Universitas</td>
                  <td>{{ $profil->univercity }}</td>
                </tr>
                <tr>
                  <td>Pendidikan</td>
                  <td>{{ $profil->grade }}</td>
                </tr>
                <tr>
                  <td>IPK</td>
                  <td>{{ $profil->ipk }}</td>
                </tr>
                <tr>
                  <td>Tahun Lulus</td>
                  <td>{{ $profil->graduation }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Akun</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>Email</td>
                  <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                  <td>Level</td>
                  @if (Auth::user()->hasRole('admin'))
                    <td>Administrator</td>
                  @elseif (Auth::user()->hasRole('operator'))
                    <td>Operator</td>
                  @else
                    <td>Perusahaan</td>
                  @endif
                </tr>
                <tr>
                  <td>Password</td>
                  <td>
                    @if (Auth::user()->hasRole('admin'))
                      <a href="{{ route('password.change') }}" class="btn btn-xs btn-primary">
                        <i class="fa fa-key"></i>&nbsp;Ubah Password
                      </a>
                    @elseif (Auth::user()->hasRole('operator'))
                      <a href="{{ route('operator.password.change') }}" class="btn btn-xs btn-primary">
                        <i class="fa fa-key"></i>&nbsp;Ubah Password
                      </a>
                    @else
                      <a href="{{ route('company.password.change') }}" class="btn btn-xs btn-primary">
                        <i class="fa fa-key"></i>&nbsp;Ubah Password
                      </a>
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
