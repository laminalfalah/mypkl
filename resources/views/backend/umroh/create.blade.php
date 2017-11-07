@extends('backend.layouts.master')

@section('title', 'TAMBAH PAKET UMROH')

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('umroh.create') }}">Tambah Paket Umroh</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.umroh.create') }}">Tambah Paket Umroh</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.umroh.create') }}">Tambah Paket Umroh</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">TAMBAH PAKET UMROH</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('admin'))
            {!! Form::open(['url' => route('umroh.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ' '}}">
              <div class="form-group">
                {!! Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Ekonomis', true) !!} Ekonomis
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Gold') !!} Gold
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'VIP') !!} VIP
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']) !!}
                  {!! $errors->first('duration','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']) !!}
                  {!! $errors->first('start_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']) !!}
                  {!! $errors->first('end_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('price','HARGA', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']) !!}
                  {!! $errors->first('price','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('itinerary',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('itinerary','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('terms_conditions',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('terms_conditions','<p class="help-block"></p>') !!}
                </div>
              </div>
              {!! Form::hidden('author', Auth::user()->name) !!}
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          @elseif (Auth::user()->hasRole('operator'))
            {!! Form::open(['url' => route('operator.umroh.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ' '}}">
              <div class="form-group">
                {!! Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Ekonomis', true) !!} Ekonomis
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Gold') !!} Gold
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'VIP') !!} VIP
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']) !!}
                  {!! $errors->first('duration','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']) !!}
                  {!! $errors->first('start_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']) !!}
                  {!! $errors->first('end_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('price','HARGA', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']) !!}
                  {!! $errors->first('price','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('itinerary',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('itinerary','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('terms_conditions',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('terms_conditions','<p class="help-block"></p>') !!}
                </div>
              </div>
              {!! Form::hidden('author', Auth::user()->name) !!}
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          @else
            {!! Form::open(['url' => route('company.umroh.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ' '}}">
              <div class="form-group">
                {!! Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Ekonomis', true) !!} Ekonomis
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Gold') !!} Gold
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'VIP') !!} VIP
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']) !!}
                  {!! $errors->first('duration','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']) !!}
                  {!! $errors->first('start_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']) !!}
                  {!! $errors->first('end_period','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('price','HARGA', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']) !!}
                  {!! $errors->first('price','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('itinerary',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('itinerary','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('terms_conditions',null, ['class' => 'form-control']) !!}
                  {!! $errors->first('terms_conditions','<p class="help-block"></p>') !!}
                </div>
              </div>
              {!! Form::hidden('author', Auth::user()->name) !!}
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
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
