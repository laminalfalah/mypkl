@extends('layouts.app')

@section('content')
  <div class="login-box" style="width: 500px;">
    <div class="login-logo">
      <a href="{{ route('beranda') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Login Internal</p>

      <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        @include('layouts.flash')
        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
          <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
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
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;&nbsp;Rememeber me
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login</button>
          </div>
        </div>
      </form>
      <a href="{{ route('password.request') }}">Forget Password</a>
    </div>
  </div>
@endsection
