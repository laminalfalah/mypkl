@extends('frontend.layouts.v_master')

@section('title', 'Pesan '.$tour->title)

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>DETAIL PEMESANAN</h3>
          {!! Form::open(['url' => route('tour.sendPesan',$tour->slug), 'method' => 'post' ,' id' => 'form-pesan'])!!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ''}}">
              <div class="row">
                <div class="kol-md-12">
                  <label>NAMA PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control required" placeholder="NAMA LENGKAP ANDA" required>
                    {!! $errors->first('name','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>EMAIL PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control required" placeholder="EMAIL ANDA" required>
                    {!! $errors->first('email','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>TELEPON PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-phone-square"></i></span>
                    <input type="tel" id="telephone" name="telephone" class="form-control required" placeholder="NOMOR TELEPON / HP ANDA" required>
                    {!! $errors->first('telp','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12" style="text-align: center;">
                  <label>DETAIL PRODUK PAKET TOUR</label>
                  <p style="border-bottom: 2px solid #222; margin-bottom: 10px;"></p>
                </div>
                <div class="kol-md-12">
                  <label>NAMA PAKET</label>
                  <div class="detail">
                    <h4>{{ $tour->title }}</h4>
                    {!! Form::hidden('package', $tour->title) !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>HARGA PAKET</label>
                  <div class="detail">
                    <h4>Rp. {{ number_format($tour->price,0,",",".") }}</h4>
                    {!! Form::hidden('price', $tour->price) !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>TANGGAL</label>
                  <div class="row">
                    <div class="kol-md-4">
                      <div class="form-group has-feedback">
                        <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                        <select class="form-control required" id="days" name="days" required>
                          @for ($i=1; $i <= 31; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    <div class="kol-md-4">
                      <div class="form-group has-feedback">
                        <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                        <select class="form-control required" id="months" name="months" required>
                          @foreach ($month as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="kol-md-4">
                      <div class="form-group has-feedback">
                        <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                        <select class="form-control required" id="years" name="years" required>
                          <option value="{!! date('Y') !!}">{!! date('Y') !!}</option>
                          <option value="{!! date('Y', strtotime('next year')) !!}">{!! date('Y', strtotime('next year')) !!}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>JUMLAH PESERTA</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-users"></i></span>
                    <input type="text" id="participant" name="participant" class="form-control required" placeholder="MASUKKAN JUMLAH PESERTA DENGAN ANGKA" required>
                    {!! $errors->first('participant','<p class="help-block"></p>') !!}
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>PERMINTAAN TAMBAHAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-list"></i></span>
                    <textarea id="note" name="note" rows="5" cols="80" class="form-control"></textarea>
                    {!! $errors->first('note','<p class="help-block"></p>') !!}
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
