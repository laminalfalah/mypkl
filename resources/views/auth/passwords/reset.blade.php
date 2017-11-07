@extends('layouts.app')

@section('content')
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <a href="{{ route('beranda') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Reset Password</p>

      <form action="{{ route('password.request') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ $email or old('email') }}" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Repeat Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if ($errors->has('password_confirmation'))
            <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
          @endif
        </div>
        <div class="row">
          <div class="col-xs-7"></div>
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
