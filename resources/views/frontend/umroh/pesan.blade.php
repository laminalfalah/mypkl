@extends('frontend.layouts.v_master')

@section('title', $umroh->title)

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>DETAIL PEMESANAN</h3>
          {!! Form::open(['url' => route('umroh.sendPesan',$umroh->slug), 'method' => 'post', 'id' => 'form-pesan'])!!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ''}}">
              <div class="row">
                <div class="kol-md-12">
                  <label>NAMA PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control" placeholder="NAMA LENGKAP ANDA" required>
                    {!! $errors->first('name','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>EMAIL PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control" placeholder="EMAIL ANDA" required>
                    {!! $errors->first('email','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>TELEPON PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-phone-square"></i></span>
                    <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="NOMOR TELEPON / HP ANDA" required>
                    {!! $errors->first('telephone','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12" style="text-align: center;">
                  <label>DETAIL PRODUK PAKET TOUR</label>
                  <p style="border-bottom: 2px solid #222; margin-bottom: 10px;"></p>
                </div>
                <div class="kol-md-12">
                  <label>NAMA PAKET</label>
                  <div class="detail">
                    <h4>{{ $umroh->title }}</h4>
                    {!! Form::hidden('package', $umroh->title) !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>HARGA PAKET</label>
                  <div class="detail">
                    <h4>Rp. {{ number_format($umroh->price,0,",",".") }}</h4>
                    {!! Form::hidden('price', $umroh->price) !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>JUMLAH PESERTA</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-users"></i></span>
                    <input type="text" id="participant" name="participant" class="form-control" placeholder="MASUKKAN JUMLAH PESERTA DENGAN ANGKA" required>
                    {!! $errors->first('participant','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <p style="font-style: italic; color: #ff0000;">* permintaan anda akan di proses 24 - 48 jam</p>
                  <input type="checkbox" id="agree" required>&nbsp;Saya Menyetujui Bahwa Form Yang Diisi Adalah Benar.
                </div>
                <div class="kol-md-12">
                  <div class="pull-right">
                    <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-lg btn-primary" disabled>
                      <span class="fa fa-send"></span>&nbsp;Submit
                    </button>
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
