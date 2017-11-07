@extends('frontend.layouts.v_master')

@section('title', $tampil->title)

@section('content')
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="mainpaket">
          <div class="judul">
            {!! $tampil->title !!}
            <div class="tgl">
              Tanggal : {{ date('d F Y', strtotime($tampil->created_at)) }} &nbsp;, Disunting : {{ $tampil->name }}
            </div>
          </div>
          <div class="foto">
            <img src="{{ asset($tampil->images) }}" alt="Artikel">
          </div>
          <div class="deskripsi">

            <div class="isi">
              <div class="maincontent">
                <div class="tab-content current">
                  <div class="itinerary">
                    {!! $tampil->description !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
