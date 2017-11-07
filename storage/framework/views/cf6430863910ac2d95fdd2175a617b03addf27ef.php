<?php $__env->startSection('title', 'Melayani Pemesanan Tiket Pesawat, Voucher Hotel, Paket Tour, Paket Umroh dan Sewa Mobil'); ?>

<?php $__env->startSection('form'); ?>
  <!-- Form Start -->
  <div class="search-panel-form-container" >
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link" data-tab="tab-tiket"><i class="fa fa-plane"></i>&nbsp; Tiket Pesawat</li>
      <li class="tab-link" data-tab="tab-hotel"><i class="fa fa-building"></i>&nbsp; Voucher Hotel</li>
      <li class="tab-link current" data-tab="tab-tour"><i class="fa fa-globe"></i>&nbsp; Paket Tour</li>
      <li class="tab-link" data-tab="tab-umroh"><i class="fa fa-cube"></i>&nbsp; Paket Umroh</li>
    </ul>
    <div id="tab-tiket" class="tab-content-home">
      <div class="search-panel-form">
        <h3>Pesan Tiket Pesawat Anda</h3>
        <form id="form-tiket" action="" method="post" role="form">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <div class="row">
                <div class="kol-md-12">
                  <label>DARI</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-map-marker"></i></span>
                    <div id="scrollable-dropdown-menu">
                      <input type="text" id="departure" name="departure" data-provide="typeahead" class="form-control typeahead" placeholder="KOTA KEBERANGKATAN" value="PALEMBANG, INDONESIA [PLM]">
                    </div>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>KE</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-map-marker"></i></span>
                    <div id="scrollable-dropdown-menu">
                      <input type="text" id="arrival" name="arrival" data-provide="typeahead" class="form-control typeahead" placeholder="KOTA TUJUAN" value="JAKARTA, INDONESIA [ALL]">
                    </div>
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>PERGI</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="go" name="go" style="padding-right: 1px;" class="form-control" readonly value="<?php echo date('d-F-Y', strtotime(' next day')); ?>" data-date="<?php echo date('d-F-Y', strtotime(' next day')); ?>">
                  </div>
                </div>
                <div class="kol-md-6">
                  <label><input type="checkbox" id="true_back" name="true_back" value="">&nbsp;PULANG</label>
                  <div class="form-group has-feedback" id="trigger_hidden">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="back" name="back" style="padding-right: 1px;" class="form-control" readonly value="<?php echo date('d-F-Y', strtotime(' +2 day')); ?>">
                  </div>
                </div>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <div class="kol-md-4">
                <label>DEWASA</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                  <select id="adult" class="form-control" name="adult">
                    <?php for($i=1; $i <= 5; $i++): ?>
                      <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 85%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-4">
                <label>ANAK-ANAK</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                  <select id="child" class="form-control" name="child">
                    <?php for($i=0; $i <= 3; $i++): ?>
                      <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 85%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-4">
                <label>BAYI</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                  <select id="baby" class="form-control" name="baby">
                    <?php for($i=0; $i <= 2; $i++): ?>
                      <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                    <?php endfor; ?>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 85%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-12">
                <label>KELAS</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-sitemap"></i></span>
                  <select id="class" class="form-control" name="class">
                    <option value="all">SEMUA</option>
                    <option value="ekonomi">EKONOMI</option>
                    <option value="bisnis">BISNIS</option>
                    <option value="kelas satu">KELAS SATU</option>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 95%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <!-- Button -->
              <div class="kol-md-12">
                <div class="pull-right" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 420px;">
                    <i class="fa fa-search"></i>&nbsp;Cari Penerbangan
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
    <div id="tab-hotel" class="tab-content-home">
      <div class="search-panel-form">
        <h3>Pesan Penginapan Hotel Anda</h3>
        <form id="form-hotel" action="" method="post" role="form">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <div class="row">
                <div class="kol-md-12">
                  <label>DIMANA ANDA MENGINAP ?</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-search"></i></span>
                    <div id="scrollable-dropdown-menu1">
                      <input type="text" id="destination" name="destination" data-provide="typeahead" placeholder="Tujuan Kota, Nama Hotel" class="form-control required typeahead" value="">
                    </div>
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>CHECK IN</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="checkin" name="checkin" style="padding-right: 1px;" class="form-control" readonly value="<?php echo date('d-F-Y', strtotime(' next day')); ?>" data-date="<?php echo date('d-F-Y', strtotime(' next day')); ?>">
                  </div>
                </div>
                <div class="kol-md-6">
                  <label>CHECK OUT</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                    <input type="text" id="checkout" name="checkout" style="padding-right: 1px;" class="form-control" readonly value="<?php echo date('d-F-Y', strtotime(' +2 day')); ?>">
                  </div>
                </div>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <div class="kol-md-6">
                <label>ORANG</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                  <select id="person" class="form-control" name="">
                    <?php for($i=1; $i <= 10; $i++): ?>
                      <option value="<?php echo e($i); ?>"><?php echo e($i); ?>&nbsp;Orang</option>
                    <?php endfor; ?>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 90%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <div class="kol-md-6">
                <label>KAMAR</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-bed"></i></span>
                  <select id="room" class="form-control" name="">
                    <?php for($i=1; $i <= 5; $i++): ?>
                      <option value="<?php echo e($i); ?>"><?php echo e($i); ?>&nbsp;Kamar</option>
                    <?php endfor; ?>
                  </select>
                  <span style="position: absolute; margin: -35px 0px 0px 90%;"><i class="fa fa-caret-down"></i></span>
                </div>
              </div>
              <!-- Button -->
              <div class="kol-md-12">
                <div class="pull-right" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 415px;">
                    <i class="fa fa-search"></i>&nbsp;Cari Hotel
                  </button>
                </div>
              </div>
            </div>
          </div>
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
    <div id="tab-tour" class="tab-content-home current">
      <div class="search-panel-form">
        <h3>Cari Paket Tour</h3>
        <form id="form-tour" action="<?php echo e(route('tour.search')); ?>" method="post" role="form" style="margin-bottom: 17px;">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <label>TIPE PAKET</label>
              <div class="form-group has-feedback">
                <span class="form-control-feedback"><i class="fa fa-gift"></i></span>
                <select id="package" class="form-control required" name="package">
                  <option value="0">PILIH TIPE PAKET</option>
                  <option value="Domestik">Domestik</option>
                  <option value="Internasional">Internasional</option>
                </select>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <!-- Month -->
              <div class="kol-md-6">
                <label>BULAN</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="ion ion-calendar"></i></span>
                  <select id="month" class="form-control required" name="month">
                    <option value="0">BULAN</option>
                    <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month1 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($month1); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <!-- Year -->
              <div class="kol-md-6">
                <label>TAHUN</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                  <select id="year" class="form-control required" name="year">
                    <option value="0">TAHUN</option>
                    <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                    <option value="<?php echo date('Y', strtotime('next year')); ?>"><?php echo date('Y', strtotime('next year')); ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- Button -->
            <div class="kol-md-12">
              <div class="pull-left">
                <a href="<?php echo e(route('tour.request')); ?>" class="btn btn-lg btn-default" style="width: 450px; "><i class="fa fa-pencil"></i>&nbsp;Request Tour</a>
              </div>
              <div class="pull-right" style="margin-right: 13px;">
                <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 420px;">
                  <i class="fa fa-search"></i>&nbsp;Cari Tour
                </button>
              </div>
            </div>
          </div>
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
    <div id="tab-umroh" class="tab-content-home">
      <div class="search-panel-form">
        <h3>Cari Paket Umroh</h3>
        <form id="form-umroh" action="<?php echo e(route('umroh.search')); ?>" method="post" role="form" style="margin-bottom: 17px">
          <div class="row">
            <!-- Column Left -->
            <div class="kol-md-6">
              <label>PAKET UMROH</label>
              <div class="form-group has-feedback">
                <span class="form-control-feedback"><i class="fa fa-gift"></i></span>
                <select id="package" class="form-control required" name="package">
                  <option value="0">PAKET UMROH</option>
                  <option value="Ekonomis">PAKET EKONOMIS</option>
                  <option value="Gold">PAKET GOLD</option>
                  <option value="VIP">PAKET VIP</option>
                </select>
              </div>
            </div>
            <!-- Column Right -->
            <div class="kol-md-6">
              <!-- Month -->
              <div class="kol-md-6">
                <label>BULAN</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="ion ion-calendar"></i></span>
                  <select id="month" class="form-control required" name="month">
                    <option value="0">BULAN</option>
                    <?php $__currentLoopData = $month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month1 => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($month1); ?>"><?php echo e($value); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <!-- Year -->
              <div class="kol-md-6">
                <label>TAHUN</label>
                <div class="form-group has-feedback">
                  <span class="form-control-feedback"><i class="fa fa-calendar"></i></span>
                  <select id="year" class="form-control required" name="year">
                    <option value="0">TAHUN</option>
                    <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                    <option value="<?php echo date('Y', strtotime('next year')); ?>"><?php echo date('Y', strtotime('next year')); ?></option>
                  </select>
                </div>
              </div>
            </div>
            <!-- Button -->
            <div class="kol-md-12">
              <div class="pull-left">
                <a href="<?php echo e(route('umroh.beranda')); ?>" class="btn btn-lg btn-default" style="width: 450px; ">Paket Selengkapnya</a>
              </div>
              <div class="pull-right" style="margin-right: 13px;">
                <button type="submit" class="btn btn-lg btn-success" id="btn-submit" name="btn-submit" style="width: 420px;">
                  <i class="fa fa-search"></i>&nbsp;Cari Umroh
                </button>
              </div>
            </div>
          </div>
          <?php echo e(csrf_field()); ?>

        </form>
      </div>
    </div>
  </div>
  <!-- Form End -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Content Start -->
  <div class="row">
    <!-- ALASAN MEMILIH SAKO HOLIDAYS -->
    <div class="mainfeature">
      <h3><i class="fa fa-arrow-right"></i>&nbsp;ALASAN MEMILIH SAKO HOLIDAYS&nbsp;<i class="fa fa-arrow-left"></i></h3>
      <div class="bodyfeature">
        <div class="kol-md-4">
          <div class="objek">
            <img src="<?php echo e(asset('img/icon/piala.png')); ?>" alt="AGENT TERPERCAYA">
          </div>
          <div class="textobjek">
            AGENT TERPERCAYA
          </div>
        </div>
        <div class="kol-md-4">
          <div class="objek">
            <img src="<?php echo e(asset('img/icon/bintang.png')); ?>" alt="KUALITAS TERBAIK">
          </div>
          <div class="textobjek">
            KUALITAS TERBAIK
          </div>
        </div>
        <div class="kol-md-4">
          <div class="objek">
            <img src="<?php echo e(asset('img/icon/cs.png')); ?>" alt="CUSTOMER SERVICES">
          </div>
          <div class="textobjek">
            CUSTUMER SERVICES
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 50px;"></div>
    <!-- AIRLINES -->
    <div class="mainfeature">
      <h3><i class="fa fa-plane"></i>&nbsp;PARTNER PENERBANGAN</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center;">
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-garuda-indonesia.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-singapore-airlines.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-qatar-airways.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-thai-air.png')); ?>" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-citilink.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-jetstar.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-etihad-airways.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-china-airlines.png')); ?>" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-lion-air.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-xpress-air.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-saudi-arabian-airlines.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-hongkong-airlines.png')); ?>" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-batik-air.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-air-asia.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-royal-jordanian.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-korean-air.png')); ?>" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-sriwijaya-air.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-malaysia-airlines.jpg')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-emirates-airlines.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-tiger-air.jpg')); ?>" alt="80x60">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/pesawat/logo-nam-air.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-cathay-pacific.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-qantas-air.png')); ?>" alt="80x60">
            <img src="<?php echo e(asset('img/pesawat/logo-turkish-airlines.png')); ?>" alt="80x60">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 170px;"></div>
    <!-- PARTNER -->
    <div class="mainfeature">
      <h3><i class="fa fa-handshake-o"></i>&nbsp;PARTNER SAKO HOLIDAYS</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center">
          <div class="kol-md-3">
            <img src="<?php echo e(asset('img/mitra/logo-asita.png')); ?>" alt="125x90">
          </div>
          <div class="kol-md-3">
            <img src="<?php echo e(asset('img/mitra/logo-AG2018.png')); ?>" alt="125x90">
          </div>
          <div class="kol-md-3">
            <img src="<?php echo e(asset('img/mitra/logo-pemkot-plm.png')); ?>" alt="125x90" style="width: 80px;">
          </div>
          <div class="kol-md-3">
            <img src="<?php echo e(asset('img/mitra/logo-pemprov-sumsel.png')); ?>" alt="125x90" style="width: 80px;">
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix" style="height: 5px;"></div>
    <!-- CASH -->
    <div class="mainfeature">
      <h3><i class="fa fa-dollar"></i>&nbsp;PARTNER PEMBAYARAN</h3>
      <div class="bodyfeature">
        <div class="row" style="text-align: center">
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/logo-Bank-BCA.jpg')); ?>" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/logo-mandiri.jpg')); ?>" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/bni.png')); ?>" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/logo-bank-sumsel.png')); ?>" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/logo-mastercard.jpg')); ?>" style="width: 90px; height: 50px;" alt="">
          </div>
          <div class="kol-md-2">
            <img src="<?php echo e(asset('img/mitra/logo-visa.jpg')); ?>" style="width: 90px; height: 40px;" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Content End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>