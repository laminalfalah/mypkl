<?php $__env->startSection('title', 'Pilihan Paket Tour Domestik dan Internasional'); ?>

<?php $__env->startSection('form'); ?>
  <div class="search-panel-form-container" style="height: 250px;">
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-tour"><i class="fa fa-globe"></i>&nbsp; Paket Tour</li>
    </ul>
    <div id="tab-tour" class="tab-content-home current">
      <div class="search-panel-form" style="text-align: center;">
        <h3>ALASAN MEMILIH TOUR BERSAMA SAKO HOLIDAYS</h3>
        <div class="row" style="line-height: 3; ">
          <div class="kol-md-3">
            <span class="fa fa-4x fa-globe"></span>
            <h5>PAKET YANG BERAGAM</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-calendar"></span>
            <h5>JADWAL YANG FLEXIBLE</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-dollar"></span>
            <h5>HARGA YANG KOMPETITIF</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-star"></span>
            <h5>PELAYANAN PRIMA</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="clearfix" style="height: 10px;"></div>
    <div class="maincontent">
      <ul class="tabs">
        <h3 class="awesome">INGIN TOUR ? AYO TOUR BERSAMA SAKO HOLIDAYS !</h3>
        <li class="tab-link current" data-tab="tab-domestik"><i class="fa fa-map-marker"></i>&nbsp;Domestik</li>
        <li class="tab-link" data-tab="tab-internasional"><i class="fa fa-map-marker"></i>&nbsp;Internasional</li>
      </ul>
      <!-- Start Tab Domestik -->
      <div id="tab-domestik" class="tab-content current">
        <div class="row">
          <div class="kol-md-12">
            <?php if(count($domestik)): ?>
              <?php $__currentLoopData = $domestik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $domestiks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mainpaket">
                  <div class="judul">
                    <a href="<?php echo e(route('tour.view',$domestiks->slug)); ?>"><?php echo e($domestiks->title); ?></a>
                    <div class="tgl">
                      Tanggal : <?php echo e(date('d F Y', strtotime($domestiks->created_at))); ?> &nbsp;, Disunting : <?php echo e($domestiks->name); ?>

                    </div>
                  </div>
                  <div class="foto">
                    <img src="<?php echo e(asset($domestiks->images)); ?>" alt="Tour Domestik">
                  </div>
                  <div class="durasi_harga">
                    <div class="pull-left">
                      <span class="fa fa-clock-o"></span>&nbsp;DURASI : <?php echo e($domestiks->duration); ?> <br>
                      <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($domestiks->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($domestiks->end_period)); ?>
                    </div>
                    <div class="pull-right">
                      <span class="fa fa-money"></span>&nbsp;HARGA : RP <?php echo e(number_format($domestiks->price, 0,'.','.')); ?>

                      <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                    </div>
                  </div>
                  <div class="deskripsi"></div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="pull-right">
                <?php echo $domestik->render(); ?>

              </div>
            <?php else: ?>
              <h3 class="notfound">PAKET TOUR DOMESTIK TIDAK TERSEDIA</h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- End Tab Domestik -->

      <!-- Start Tab Internasional -->
      <div id="tab-internasional" class="tab-content">
        <div class="row">
          <div class="kol-md-12">
            <?php if(count($internasional)): ?>
              <?php $__currentLoopData = $internasional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $internasionals): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mainpaket">
                  <div class="judul">
                    <a href="<?php echo e(route('tour.view',$internasionals->slug)); ?>"><?php echo e($internasionals->title); ?></a>
                    <div class="tgl">
                      Tanggal : <?php echo e(date('d F Y', strtotime($internasionals->created_at))); ?> &nbsp;, Disunting : <?php echo e($internasionals->name); ?>

                    </div>
                  </div>
                  <div class="foto">
                    <img src="<?php echo e(asset($internasionals->images)); ?>" alt="Tour Domestik">
                  </div>
                  <div class="durasi_harga">
                    <div class="pull-left">
                      <span class="fa fa-clock-o"></span>&nbsp;DURASI : <?php echo e($internasionals->duration); ?> <br>
                      <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($internasionals->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($internasionals->end_period)); ?>
                    </div>
                    <div class="pull-right">
                      <span class="fa fa-money"></span>&nbsp;HARGA : RP <?php echo e(number_format($internasionals->price,0,",",".")); ?>

                      <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                    </div>
                  </div>
                  <div class="deskripsi"></div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <div class="pull-right">
                <?php echo $internasional->render(); ?>

              </div>
            <?php else: ?>
              <h3 class="notfound">PAKET TOUR INTERNASIONAL TIDAK TERSEDIA</h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <!-- End Tab Internasional -->
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>