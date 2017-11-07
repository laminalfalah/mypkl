<?php $__env->startSection('title', 'Pesan Paket Umroh'); ?>

<?php $__env->startSection('form'); ?>
  <div class="search-panel-form-container" style="height: 250px; ">
    <ul class="tabs-home">
      <h3 class="awesome">Nikmati Beragam Diskon Bersama Sako Holidays</h3>
      <li class="tab-link current" data-tab="tab-umroh"><i class="fa fa-cube"></i>&nbsp; Paket Umroh</li>
    </ul>
    <div id="tab-umroh" class="tab-content-home current">
      <div class="search-panel-form" style="text-align: center;">
        <h3>ALASAN MEMILIH UMROH BERSAMA SAKO HOLIDAYS</h3>
        <div class="row" style="line-height: 3; ">
          <div class="kol-md-3">
            <span class="fa fa-4x fa-globe"></span>
            <h5>TRAVEL BERIZIN</h5>
          </div>
          <div class="kol-md-3">
            <span class="fa fa-4x fa-calendar"></span>
            <h5>PASTI BERANGKAT</h5>
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
    <div class="clearfix" style="height: 30px;"></div>
    <div class="maincontent">
      <div class="row">
        <div class="kol-md-12">
          <?php if(count($umroh)): ?>
            <?php $__currentLoopData = $umroh; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umrohs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="mainpaket">
                <div class="judul">
                  <a href="<?php echo e(route('umroh.view',$umrohs->slug)); ?>"><?php echo e($umrohs->title); ?></a>
                  <div class="tgl">
                    Tanggal : <?php echo e(date('d F Y', strtotime($umrohs->created_at))); ?> &nbsp;, Disunting : <?php echo e($umrohs->name); ?>

                  </div>
                </div>
                <div class="foto">
                  <img src="<?php echo e(asset($umrohs->images)); ?>" alt="Umroh">
                </div>
                <div class="durasi_harga">
                  <div class="pull-left">
                    <span class="fa fa-clock-o"></span>&nbsp;DURASI : <?php echo e($umrohs->duration); ?> <br>
                    <span class="fa fa-calendar"></span>&nbsp;PERIODE : <?php echo date('d - F - Y', strtotime($umrohs->start_period)); echo ' s/d '; echo date('d - F - Y',strtotime($umrohs->end_period)); ?>
                  </div>
                  <div class="pull-right">
                    <span class="fa fa-money"></span>&nbsp;HARGA : RP <?php echo e(number_format($umrohs->price,0,",",".")); ?>

                    <p>* Harga termasuk Tiket Pesawat dan Hotel</p>
                  </div>
                </div>
                <div class="deskripsi"></div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="pull-right">
              <?php echo $umroh->render(); ?>

            </div>
          <?php else: ?>
            <h3 class="notfound">PAKET UMROH TIDAK TERSEDIA</h3>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>