@extends('frontend.layouts.v_master')

@section('title', 'Cek Pemesanan')

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>CEK PEMESANAN ANDA</h3>
          @include('frontend.layouts.flash')
          {!! Form::open(['url' => route('post.form.cek'), 'method' => 'post'])!!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              <div class="row">
                <div class="kol-md-12">
                  <label>EMAIL</label>
                  <div class="form-group has-feedback{{ $errors->has('email') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Anda" required>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>CODE BOOKING</label>
                  <div class="form-group has-feedback{{ $errors->has('code_booking') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-code"></i></span>
                    <input type="text" id="code_booking" name="code_booking" class="form-control" placeholder="Kode Booking Anda" required>
                    @if ($errors->has('code_booking'))
                      <span class="help-block">
                        <strong>{{ $errors->first('code_booking') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>TIPE PEMESANAN</label>
                  <div class="form-group has-feedback{{ $errors->has('code_booking') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-gift"></i></span>
                    <select class="form-control" name="tipe" required>
                      <option value="0">TIPE PEMESANAN</option>
                      <option value="request_tours">Permintaan Tour</option>
                      <option value="booking_tours">Pemesanan Tour</option>
                      <option value="booking_umrohs">Pemesanan Umroh</option>
                    </select>
                    @if ($errors->has('code_booking'))
                      <span class="help-block">
                        <strong>{{ $errors->first('code_booking') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <div class="pull-right">
                    {!! Form::button('<i class="fa fa-send"></i>&nbsp;KIRIM',['type' => 'submit', 'class' => 'btn btn-lg btn-primary' ]) !!}
                  </div>
                </div>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
