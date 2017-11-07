@extends('layouts.app')

@section('content')
  <div class="register-box" style="width: 500px;">
    <div class="login-logo">
      <a href="{{ route('beranda') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="register-box-body">
      <p class="login-box-msg">Set Password Akun</p>

      {!! Form::open(['url' => route('save',["email" => $user->email, "verifyToken" => $user->verifyToken]), 'method' => 'put']) !!}
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Retype password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-7"></div>
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Set Password</button>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
