@extends('backend.layouts.master')

@section('title', 'Edit Pengguna')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('users.edit') }}">Edit Users</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">EDIT PENGGUNA</h3>
        </div>
        <div class="box-body">
          {!! Form::model($users,['url' => route('users.update',$users->num), 'method' => 'put', 'class' => 'form-horizontal']) !!}
          <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <div class="form-group">
              {!! Form::label('name','Nama', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
                {!! $errors->first('name','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('email','Email', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Pengguna']) !!}
                {!! $errors->first('email','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('place_of_birth','Tempat Lahir', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('place_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Tempat Lahir']) !!}
                {!! $errors->first('place_of_birth','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('date_of_birth','Tanggal Lahir', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('date_of_birth', null, ['class' => 'form-control', 'placeholder' => 'Tanggal Lahir']) !!}
                {!! $errors->first('date_of_birth','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="sex">Jenis Kelamin</label>
              <div class="col-md-8">
                <select class="form-control" name="sex">
                  <option value="Male" @if ($users->sex === "Male") selected="selected" @endif>Pria</option>
                  <option value="Female" @if ($users->sex === "Female") selected="selected" @endif>Wanita</option>
                </select>
                {!! $errors->first('level','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="religion">Agama</label>
              <div class="col-md-8">
                <select class="form-control" name="religion">
                  <option value="Islam" @if ($users->religion === "Islam") selected="selected" @endif>Islam</option>
                  <option value="Christian" @if ($users->religion === "Christian") selected="selected" @endif>Kristen Protestan</option>
                  <option value="Katholik" @if ($users->religion === "Katholik") selected="selected" @endif>Katholik</option>
                  <option value="Buddha" @if ($users->religion === "Buddha") selected="selected" @endif>Buddha</option>
                  <option value="Hindu" @if ($users->religion === "Hindu") selected="selected" @endif>Hindu</option>
                  <option value="Others" @if ($users->religion === "Others") selected="selected" @endif>Lainnya</option>
                </select>
                {!! $errors->first('religion','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="status_marriage">Status Pernikahan</label>
              <div class="col-md-8">
                <select class="form-control" name="status_marriage">
                  <option value="Single" @if ($users->status_marriage === "Single") selected="selected" @endif>Belum Menikah</option>
                  <option value="Married" @if ($users->status_marriage === "Married") selected="selected" @endif>Menikah</option>
                  <option value="Divorced" @if ($users->status_marriage === "Divorced") selected="selected" @endif>Cerai Hidup</option>
                  <option value="Death Divorce" @if ($users->status_marriage === "Death Divorce") selected="selected" @endif>Cerai Mati</option>
                </select>
                {!! $errors->first('status_marriage','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="citizen">Kewarganegaraan</label>
              <div class="col-md-8">
                <select class="form-control" name="citizen">
                  <option value="WNI" @if ($users->citizen === "WNI") selected="selected" @endif>WNI</option>
                  <option value="WNA" @if ($users->citizen === "WNA") selected="selected" @endif>WNA</option>
                </select>
                {!! $errors->first('citizen','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('address','Alamat', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::textarea('address',null, ['class' => 'form-control', 'placeholder' => 'Alamat', 'rows' => '3']) !!}
                {!! $errors->first('address','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('telephone','Telepon', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'Telepon']) !!}
                {!! $errors->first('telephone','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('univercity','Nama Sekolah / Universitas', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('univercity', null, ['class' => 'form-control', 'placeholder' => 'Nama Sekolah / Universitas']) !!}
                {!! $errors->first('univercity','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="grade">Tingkat Pendidikan</label>
              <div class="col-md-8">
                <select class="form-control" name="grade">
                  <option value="Strata 3 (S3)" @if ($users->grade === "Strata 3 (S3)") selected="selected" @endif>Strata 3 (S3)</option>
                  <option value="Strata 2 (S2)" @if ($users->grade === "Strata 2 (S2)") selected="selected" @endif>Strata 2 (S2)</option>
                  <option value="Strata 1 (S1)" @if ($users->grade === "Strata 1 (S1)") selected="selected" @endif>Strata 1 (S1)</option>
                  <option value="Diploma 4 (D4)" @if ($users->grade === "Diploma 4 (D4)") selected="selected" @endif>Diploma 4 (D4)</option>
                  <option value="Diploma 3 (D3)" @if ($users->grade === "Diploma 3 (D3)") selected="selected" @endif>Diploma 3 (D3)</option>
                  <option value="Diploma 2 (D2)" @if ($users->grade === "Diploma 2 (D2)") selected="selected" @endif>Diploma 2 (D2)</option>
                  <option value="Diploma 1 (D1)" @if ($users->grade === "Diploma 1 (D1)") selected="selected" @endif>Diploma 1 (D1)</option>
                  <option value="SMA/SMK" @if ($users->grade === "SMA/SMK") selected="selected" @endif>SMA/SMK</option>
                </select>
                {!! $errors->first('grade','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('ipk','Nilai', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                {!! Form::text('ipk', null, ['class' => 'form-control', 'placeholder' => 'Nilai']) !!}
                {!! $errors->first('ipk','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('graduation','Tahun Lulus', ['class' => 'col-md-3 control-label']) !!}
              <div class="col-md-8">
                <select class="form-control" name="graduation">
                  <option value="">Tahun Lulus</option>
                  @for ($i=2000; $i <= date('Y', strtotime('next year')); $i++)
                    <option value="{{ $i }}" selected="selected">{{ $i }}</option>
                  @endfor
                </select>
                {!! $errors->first('graduation','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="status">Status Pengguna</label>
              <div class="col-md-8">
                <select class="form-control" name="status">
                  <option value="Activated" @if ($users->status === "Activated") selected="selected" @endif>Aktif</option>
                  <option value="Pending" @if ($users->status === "Pending") selected="selected" @endif>Di Tunda</option>
                  <option value="Blocked" @if ($users->status === "Blocked") selected="selected" @endif>Di Blok</option>
                </select>
                {!! $errors->first('level','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label" for="level">Jabatan</label>
              <div class="col-md-8">
                <select class="form-control" name="level">
                  <option value="">Jabatan</option>
                  <option value="admin" @if ($users->level === "Administrator") selected="selected" @endif>Administrator</option>
                  <option value="operator" @if ($users->level === "Operator") selected="selected" @endif>Operator</option>
                  <option value="company" @if ($users->level === "Company") selected="selected" @endif>Perusahaan</option>
                </select>
                {!! $errors->first('level','<p class="help-block"></p>') !!}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-3 col-md-8">
                {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
