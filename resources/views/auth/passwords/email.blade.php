@extends('layouts.app')

@section('content')
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <a href="{{ route('beranda') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Reset Password</p>
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
      <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="row">
          <div class="col-xs-6"></div>
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
