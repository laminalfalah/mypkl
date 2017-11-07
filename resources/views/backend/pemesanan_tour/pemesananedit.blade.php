@extends('backend.layouts.master')

@section('title', 'EDIT STATUS PEMESANAN '.$pemesanans->name)

@section('breadcrumb')
  <li><a href="{{ route('dashboard.admin') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li>Dashboard</li>
  <li class="{{ set_active('tour.pemesanan.edit') }}">Edit Daftar Pemesanan Tour</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">EDIT STATUS PEMESANAN PAKET TOUR</h3>
        </div>
        <div class="box-body">
          @if (Auth::user()->hasRole('admin'))
            {!! Form::model($pemesanans,['url' => route('tour.pemesanan.update',$pemesanans->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ''}}">
              <div class="form-group">
                {!! Form::label('name','Nama Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('name',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('name','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('email','Email Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::email('email',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('email','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('telephone','Telepon Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::tel('telephone',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('telephone','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('title','Nama Paket', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('price','Harga Paket', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('price',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('price','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('participant','Jumlah Peserta', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('participant',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('participant','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('departure_date','Tanggal Berangkat', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('departure_date',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('departure_date','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('note','Catatan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('note',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('note','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','Status', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Approved') !!} Diterima
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Pending', true) !!} Ditunda
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Rejected') !!} Ditolak
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('reason_rejection','ALASAN DI TOLAK', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9" id="reason" style="diplay:none" >
                  {!! Form::textarea('reason_rejection',null,['class' => 'form-control', 'rows' => '3']) !!}
                  {!! $errors->first('reason_rejection','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;UPDATE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                  {!! Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']) !!}
                </div>
              </div>
            </div>
            {!! Form::close() !!}
          @else
            {!! Form::model($pemesanans,['url' => route('operator.tour.pemesanan.update',$pemesanans->id), 'method' => 'put', 'class' => 'form-horizontal']) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error': ''}}">
              <div class="form-group">
                {!! Form::label('name','Nama Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('name',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('name','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('email','Email Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::email('email',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('email','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('telephone','Telepon Pemesan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::tel('telephone',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('telephone','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('title','Nama Paket', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('title',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('title','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('price','Harga Paket', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('price',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('price','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('participant','Jumlah Peserta', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('participant',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('participant','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('departure_date','Tanggal Berangkat', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::text('departure_date',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('departure_date','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('note','Catatan', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  {!! Form::textarea('note',null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                  {!! $errors->first('note','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('status','Status', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Approved') !!} Diterima
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Pending', true) !!} Ditunda
                    </label>
                    <label style="margin-right: 10px;">
                      {!! Form::radio('status', 'Rejected') !!} Ditolak
                    </label>
                  </div>
                  {!! $errors->first('status','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('reason_rejection','ALASAN DI TOLAK', ['class' => 'col-md-2 control-label']) !!}
                <div class="col-md-9" id="reason" style="diplay:none;" >
                  {!! Form::textarea('reason_rejection',null,['class' => 'form-control', 'rows' => '3']) !!}
                  {!! $errors->first('reason_rejection','<p class="help-block"></p>') !!}
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  {!! Form::button('<i class="fa fa-send"></i>&nbsp;UPDATE DATA', ['class' => 'btn btn-primary','type' => 'submit']) !!}
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
