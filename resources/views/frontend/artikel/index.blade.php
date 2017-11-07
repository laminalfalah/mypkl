@extends('frontend.layouts.v_master')

@section('title', 'Artikel')

@section('content')
  <div class="row">
    <div class="clearfix" style="height: 30px;"></div>
    <div class="maincontent">
      <div class="row">
        <div class="kol-md-12">
          @if (count($blog))
            @foreach ($blog as $blogs)
              <div class="mainpaket">
                <div class="judul">
                  <a href="{{ route('blog.lihat',$blogs->slug) }}">{{ $blogs->title }}</a>
                  <div class="tgl">
                    Tanggal : {{ date('d F Y', strtotime($blogs->created_at)) }} &nbsp;, Disunting : {{ $blogs->name }}
                  </div>
                </div>
                <div class="foto">
                  <img src="{{ asset($blogs->images) }}" alt="Artikel">
                </div>
                <div class="deskripsi">
                  <div class="isi">
                    <div class="itinerary" style="width:100%;">
                      {{ strip_tags(substr($blogs->description, 0, 400)) }}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            <div class="pull-right">
              {!! $blog->render() !!}
            </div>
          @else
            <h3 class="notfound">TIDAK ADA ENTRI ARTIKEL</h3>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
