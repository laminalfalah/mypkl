@extends('backend.layouts.master')

@section('title', 'Ubah Password')

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('password.change') }}">Ubah Password</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.password.change') }}">Ubah Password</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.password.change') }}">Ubah Password</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          @include('backend.layouts.flash')
          <h3 class="box-title">UBAH PASSWORD</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('admin'))
            {!! Form::open(['url' => route('password.post'), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <div class="form-group">
                  {!! Form::label('old','Password Lama', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('old',['class' => 'form-control', 'placeholder' => 'Password Lama', 'required']) !!}
                    {!! $errors->first('old','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password','Password Baru', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password Baru', 'required']) !!}
                    {!! $errors->first('password','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password_confirm','Ulangi Password', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password_confirmation',['id' => 'password_confirm', 'class' => 'form-control', 'placeholder' => 'Ulangi Password']) !!}
                    {!! $errors->first('password_confirmation','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-9">
                    {!! Form::button('<i class="fa fa-key"></i>&nbsp;UBAH PASSWORD', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          @elseif (Auth::user()->hasRole('operator'))
            {!! Form::open(['url' => route('operator.password.post'), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <div class="form-group">
                  {!! Form::label('old','Password Lama', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('old',['class' => 'form-control', 'placeholder' => 'Password Lama', 'required']) !!}
                    {!! $errors->first('old','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password','Password Baru', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password Baru', 'required']) !!}
                    {!! $errors->first('password','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password_confirm','Ulangi Password', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password_confirmation',['id' => 'password_confirm', 'class' => 'form-control', 'placeholder' => 'Ulangi Password']) !!}
                    {!! $errors->first('password_confirmation','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-9">
                    {!! Form::button('<i class="fa fa-key"></i>&nbsp;UBAH PASSWORD', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          @else
            {!! Form::open(['url' => route('company.password.post'), 'method' => 'put', 'class' => 'form-horizontal' ]) !!}
              <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <div class="form-group">
                  {!! Form::label('old','Password Lama', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('old',['class' => 'form-control', 'placeholder' => 'Password Lama', 'required']) !!}
                    {!! $errors->first('old','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password','Password Baru', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password Baru', 'required']) !!}
                    {!! $errors->first('password','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  {!! Form::label('password_confirm','Ulangi Password', ['class' => 'col-md-2 control-label']) !!}
                  <div class="col-md-9">
                    {!! Form::password('password_confirmation',['id' => 'password_confirm', 'class' => 'form-control', 'placeholder' => 'Ulangi Password']) !!}
                    {!! $errors->first('password_confirmation','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-9">
                    {!! Form::button('<i class="fa fa-key"></i>&nbsp;UBAH PASSWORD', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  </div>
                </div>
              </div>
            {!! Form::close() !!}
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
