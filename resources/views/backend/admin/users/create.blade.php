@extends('backend.layouts.master')

@section('title', 'Tambah Pengguna')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('users.create') }}">Create Users</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">TAMBAH PENGGUNA</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('users.store'), 'method' => 'post', 'class' => 'form-horizontal' ]) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              <div class="form-group">
                {!! Form::label('name','Nama', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
                  {!! $errors->first('name','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('email','Email', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email Pengguna']) !!}
                  {!! $errors->first('email','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="level">Jabatan</label>
                <div class="col-md-9">
                  <select class="form-control" name="level">
                    <option value="">Jabatan</option>
                    @foreach ($role as $key)
                      <option value="{{$key->name}}">{{$key->display_name}}</option>
                    @endforeach
                  </select>
                  {!! $errors->first('level','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
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
