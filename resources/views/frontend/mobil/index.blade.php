@extends('frontend.layouts.master')

@section('title', 'Sewa Mobil di Palembang')

@section('form')
  <div class="search-panel-form-container" >
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-mobil"><i class="fa fa-car"></i>&nbsp; Sewa Mobil</li>
    </ul>
    <div id="tab-mobil" class="tab-content-home current">
      <div class="search-panel-form">
        <h3>Sewa Mobil</h3>
        <form id="form-hotel" action="" method="post" role="form">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <div class="row">
                <div class="kol-md-12">
                  <label>LOKASI PENJEMPUTAN ?</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-map-marker"></i></span>
                    <div id="scrollable-dropdown-menu1">
                      <input type="text" id="location" name="location" data-provide="typeahead" placeholder="Lokasi" class="form-control required typeahead" value="" required>
                    </div>
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>TANGGAL JEMPUT</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="jemput" name="jemput" style="padding-right: 1px;" class="form-control" readonly value="{!! date('d-F-Y', strtotime(' next day')) !!}" data-date="{!! date('d-F-Y', strtotime(' next day')) !!}" required>
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>TANGGAL SELESAI</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="selesai" name="selesai" style="padding-right: 1px;" class="form-control" readonly value="{!! date('d-F-Y', strtotime(' +2 day')) !!}" required>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>NAMA PEMESAN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nama Pemesan" required>
                  </div>
                </div>
                <style media="screen">
                  .fast-response { text-align: justify; font-size: 15px; font-weight: 600; color: #000; font-style: italic; margin: 5px; }
                  .fast-response > i.fa-phone { font-style: normal; color: #07dbdb; font-size: 20px; }
                  .fast-response > i.fa-whatsapp { font-style: normal; color: #22b041; font-size: 20px; }
                </style>
                <div class="kol-md-12">
                  <div class="fast-response">
                    FAST REPONSE CALL US&nbsp;&nbsp;<i class="fa fa-phone"></i>&nbsp;0711-xxxxxx&nbsp;&nbsp;<i class="fa fa-whatsapp"></i>&nbsp;0821-1221-1212
                  </div>
                </div>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <div class="kol-md-12">
                <label>NO. HANDPHONE</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-phone"></i></span>
                  <input type="tel" id="hp" name="hp" class="form-control" required placeholder="No. Handphone Yang Bisa Dihubungi">
                </div>
              </div>
              <div class="kol-md-12">
                <label>JUMLAH</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-suitcase"></i></span>
                  <select id="count" class="form-control" name="count" required role="presentation">
                    @for ($i=1; $i <= 10; $i++)
                      <option value="{{$i}}">{{$i}}&nbsp;UNIT</option>
                    @endfor
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 95%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-12">
                <label>TIPE MOBIL ATAU BUS</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-car"></i></span>
                  <select class="form-control" name="tipe" id="tipe" required role="presentation">
                    <option value="0">TIPE MOBIL ATAU BUS</option>
                    <optgroup label="Mobil">
                      <option value="">TOYOTA INNOVA REBORN 7 SEAT</option>
                      <option value="">HONDA MOBILIO 7 SEAT</option>
                      <option value="">TOYOTA AVANZA 7 SEAT</option>
                    </optgroup>
                    <optgroup label="Bis">
                      <option value="">Mercedenz Benz 50 SEAT</option>
                      <option value="">Mercedenz Benz 40 SEAT</option>
                      <option value="">Mercedenz Benz 32 SEAT</option>
                    </optgroup>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 95%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <!-- Button -->
              <div class="kol-md-12">
                <div class="pull-right" style="margin-top: 10px;">
                  <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 420px;">
                    <i class="fa fa-send"></i>&nbsp;Kirim
                  </button>
                </div>
              </div>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
  <div class="clearfix" style="margin-bottom: 40px;"></div>
@endsection
