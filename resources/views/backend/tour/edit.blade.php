@extends('backend.layouts.master')

@section('title', 'EDIT PAKET TOUR '. $tour->title)

@section('breadcrumb')
  @if (Auth::user()->hasRole('admin'))
    <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('tour.edit') }}">Edit Tour</li>
  @elseif (Auth::user()->hasRole('operator'))
    <li><a href="{{ route('dashboard.operator') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('operator.tour.edit') }}">Edit Tour</li>
  @else
    <li><a href="{{ route('dashboard.company') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="{{ set_active('company.tour.edit') }}">Edit Tour</li>
  @endif
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">EDIT PAKET TOUR</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('admin'))
            {!! Form::model($tour,['url' => route('tour.update',$tour->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
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
                      {!! Form::radio('category', 'Domestik', true) !!} Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Internasional') !!} Internasional
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('post_status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('images', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
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
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'duration PERJALANAN']) !!}
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
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          @elseif (Auth::user()->hasRole('operator'))
            {!! Form::model($tour,['url' => route('operator.tour.update',$tour->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
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
                      {!! Form::radio('category', 'Domestik', true) !!} Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Internasional') !!} Internasional
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('post_status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('images', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
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
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'duration PERJALANAN']) !!}
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
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          @else
            {!! Form::model($tour,['url' => route('company.tour.update',$tour->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
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
                      {!! Form::radio('category', 'Domestik', true) !!} Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('category', 'Internasional') !!} Internasional
                    </label>
                  </div>
                  {!! $errors->first('category','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Draft', true) !!} Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('post_status', 'Publish') !!} Terbitkan
                    </label>
                  </div>
                  {!! $errors->first('post_status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="input-group">
                    {!! Form::text('images', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']) !!}
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
                  {!! Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'duration PERJALANAN']) !!}
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
