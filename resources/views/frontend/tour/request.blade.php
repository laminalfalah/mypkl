@extends('frontend.layouts.v_master')

@section('title', 'Request Tour')

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>Request Tour Anda</h3>
          @include('frontend.layouts.flash')
          {!! Form::open(['url' => route('tour.kirim'), 'method' => 'post', 'id' => 'form-request-tour'])!!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              <div class="row">
                <div class="kol-md-12">
                  <label>NAMA</label>
                  <div class="form-group has-feedback{{ $errors->has('name') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control required" placeholder="Nama Lengkap" required autofocus>
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>EMAIL</label>
                  <div class="form-group has-feedback{{ $errors->has('email') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control required" placeholder="Email Anda" required>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>NOMOR TELEPON/HP</label>
                  <div class="form-group has-feedback{{ $errors->has('telephone') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-phone"></i></span>
                    <input type="text" id="telephone" name="telephone" class="form-control required" placeholder="Nomor Handphone" required>
                    @if ($errors->has('telephone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('telephone') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>LOKASI</label>
                  <div class="form-group has-feedback{{ $errors->has('location') ? 'has-error' : '' }}">
                    <span class="form-control-feedback"><i class="fa fa-map-marker"></i></span>
                    <input type="text" id="location" name="location" class="form-control required" placeholder="Tempat yang akan di kunjungi.. nama negara atau kota" required>
                    @if ($errors->has('location'))
                      <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>DURASI</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-clock-o"></i></span>
                    <select class="form-control required" id="duration" name="duration" required>
                      <option value="0">Berapa Hari</option>
                      @for ($i=1; $i <= 31; $i++)
                        <option value="{!! $i !!}&nbsp;Hari">{!! $i !!}&nbsp;Hari</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>PERMINTAAN KHUSUS</label>
                  <div class="form-group">
                      {!! Form::textarea('note',null, ['class' => 'form-control', 'rows' => '5', 'cols' => '10']) !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <input type="checkbox" id="agree" class="required" required>&nbsp;Saya Menyetujui Bahwa Form Yang Diisi Adalah Benar.
                </div>
                <div class="kol-md-12">
                  <div class="pull-right">
                    <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-lg btn-primary"><span class="fa fa-send"></span>&nbsp;Kirim</button>
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
