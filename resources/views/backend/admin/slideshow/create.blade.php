@extends('backend.layouts.master')

@section('title', 'Tambah Data Paket Tour')

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('tour.create') }}">Tambah Paket Tour</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          @include('backend.layouts.flash')
          <h3 class="box-title">TAMBAH PAKET TOUR</h3>
        </div>
        <div class="box-body">
          {!! Form::open(['url' => route('slideshow.store'), 'method' => 'post', 'class' => 'form-horizontal']) !!}
          <div class="form-group {{ $errors->has('name') ? 'has-error': ' '}}">
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
              {!! Form::label('slug','TIPE', ['class' => 'col-md-2 control-label']) !!}
              <div class="col-md-9">
                <div class="radio">
                  <label style="margin-right: 10px;">
                    {!! Form::radio('slug', 'tiket', true) !!} TIKET
                  </label>
                  <label style="margin-right: 10px;">
                    {!! Form::radio('slug', 'hotel') !!} HOTEL
                  </label>
                  <label style="margin-right: 10px;">
                    {!! Form::radio('slug', 'tour') !!} TOUR
                  </label>
                  <label style="margin-right: 10px;">
                    {!! Form::radio('slug', 'umroh') !!} UMROH
                  </label>
                </div>
                {!! $errors->first('slug','<p class="help-block"></p>') !!}
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
        </div>
      </div>
    </div>
  </div>
@endsection
