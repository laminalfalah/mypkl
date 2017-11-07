<?php $__env->startSection('title', 'Request Tour'); ?>

<?php $__env->startSection('content'); ?>
  <div class="form-main">
    <div class="row">
      <div class="kol-md-12">
        <div class="search-panel-form">
          <h3>Request Tour Anda</h3>
          <?php echo $__env->make('frontend.layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo Form::open(['url' => route('tour.kirim'), 'method' => 'post', 'id' => 'form-request-tour']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
              <div class="row">
                <div class="kol-md-12">
                  <label>NAMA</label>
                  <div class="form-group has-feedback<?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" class="form-control required" placeholder="Nama Lengkap" required autofocus>
                    <?php if($errors->has('name')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('name')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>EMAIL</label>
                  <div class="form-group has-feedback<?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                    <span class="form-control-feedback"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control required" placeholder="Email Anda" required>
                    <?php if($errors->has('email')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>NOMOR TELEPON/HP</label>
                  <div class="form-group has-feedback<?php echo e($errors->has('telephone') ? 'has-error' : ''); ?>">
                    <span class="form-control-feedback"><i class="fa fa-phone"></i></span>
                    <input type="text" id="telephone" name="telephone" class="form-control required" placeholder="Nomor Handphone" required>
                    <?php if($errors->has('telephone')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('telephone')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>LOKASI</label>
                  <div class="form-group has-feedback<?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
                    <span class="form-control-feedback"><i class="fa fa-map-marker"></i></span>
                    <input type="text" id="location" name="location" class="form-control required" placeholder="Tempat yang akan di kunjungi.. nama negara atau kota" required>
                    <?php if($errors->has('location')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('location')); ?></strong>
                      </span>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>DURASI</label>
                  <div class="form-group has-feedback">
                    <span class="form-control-feedback"><i class="fa fa-clock-o"></i></span>
                    <select class="form-control required" id="duration" name="duration" required>
                      <option value="0">Berapa Hari</option>
                      <?php for($i=1; $i <= 31; $i++): ?>
                        <option value="<?php echo $i; ?>&nbsp;Hari"><?php echo $i; ?>&nbsp;Hari</option>
                      <?php endfor; ?>
                    </select>
                  </div>
                </div>
                <div class="kol-md-12">
                  <label>PERMINTAAN KHUSUS</label>
                  <div class="form-group">
                      <?php echo Form::textarea('note',null, ['class' => 'form-control', 'rows' => '5', 'cols' => '10']); ?>

                  </div>
                </div>
                <div class="kol-md-12">
                  <input type="checkbox" id="agree" class="required" required>&nbsp;Saya Menyetujui Bahwa Form Yang Diisi Adalah Benar.
                </div>
                <div class="kol-md-12">
                  <div class="pull-right">
                    <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-lg btn-primary"><span class="fa fa-send"></span>&nbsp;Kirim</button>
                  </div>
                </div>
              </div>
            </div>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.v_master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>