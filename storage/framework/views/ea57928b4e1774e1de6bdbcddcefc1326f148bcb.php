<?php $__env->startSection('title', 'TAMBAH PAKET TOUR'); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <?php if(Auth::user()->hasRole('admin')): ?>
    <li><a href="<?php echo e(route('dashboard.admin')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('tour.create')); ?>">Tambah Paket Tour</li>
  <?php elseif(Auth::user()->hasRole('operator')): ?>
    <li><a href="<?php echo e(route('dashboard.operator')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('operator.tour.create')); ?>">Tambah Paket Tour</li>
  <?php else: ?>
    <li><a href="<?php echo e(route('dashboard.company')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('company.tour.create')); ?>">Tambah Paket Tour</li>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <?php echo $__env->make('backend.layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <h3 class="box-title">TAMBAH PAKET TOUR</h3>
        </div>
        <div class="box-body">
          <?php if(Auth::user()->hasRole('admin')): ?>
            <?php echo Form::open(['url' => route('tour.store'), 'method' => 'post', 'class' => 'form-horizontal']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error': ' '); ?>">
              <div class="form-group">
                <?php echo Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']); ?>

                  <?php echo $errors->first('title','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Domestik', true); ?> Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Internasional'); ?> Internasional
                    </label>
                  </div>
                  <?php echo $errors->first('category','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Draft', true); ?> Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Publish'); ?> Terbitkan
                    </label>
                  </div>
                  <?php echo $errors->first('post_status','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="input-group">
                    <?php echo Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']); ?>

                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']); ?>

                  <?php echo $errors->first('duration','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']); ?>

                  <?php echo $errors->first('start_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']); ?>

                  <?php echo $errors->first('end_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('price','HARGA', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']); ?>

                  <?php echo $errors->first('price','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('itinerary',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('itinerary','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('terms_conditions',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('terms_conditions','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  <?php echo Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']); ?>

                  <?php echo Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']); ?>

                </div>
              </div>
            </div>
            <?php echo Form::close(); ?>

          <?php elseif(Auth::user()->hasRole('operator')): ?>
            <?php echo Form::open(['url' => route('operator.tour.store'), 'method' => 'post', 'class' => 'form-horizontal']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error': ' '); ?>">
              <div class="form-group">
                <?php echo Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']); ?>

                  <?php echo $errors->first('title','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Domestik', true); ?> Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Internasional'); ?> Internasional
                    </label>
                  </div>
                  <?php echo $errors->first('category','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Draft', true); ?> Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Publish'); ?> Terbitkan
                    </label>
                  </div>
                  <?php echo $errors->first('post_status','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="input-group">
                    <?php echo Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']); ?>

                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']); ?>

                  <?php echo $errors->first('duration','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']); ?>

                  <?php echo $errors->first('start_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']); ?>

                  <?php echo $errors->first('end_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('price','HARGA', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']); ?>

                  <?php echo $errors->first('price','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('itinerary',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('itinerary','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('terms_conditions',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('terms_conditions','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  <?php echo Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']); ?>

                  <?php echo Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']); ?>

                </div>
              </div>
            </div>
            <?php echo Form::close(); ?>

          <?php else: ?>
            <?php echo Form::open(['url' => route('company.tour.store'), 'method' => 'post', 'class' => 'form-horizontal']); ?>

            <div class="form-group <?php echo e($errors->has('name') ? 'has-error': ' '); ?>">
              <div class="form-group">
                <?php echo Form::label('title','NAMA PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('title',null, ['class' => 'form-control', 'placeholder' => 'NAMA PAKET']); ?>

                  <?php echo $errors->first('title','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('category','KATEGORI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Domestik', true); ?> Domestik
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('category', 'Internasional'); ?> Internasional
                    </label>
                  </div>
                  <?php echo $errors->first('category','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('post_status','STATUS', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="radio">
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Draft', true); ?> Simpan
                    </label>
                    <label style="margin-right: 10px;">
                      <?php echo Form::radio('post_status', 'Publish'); ?> Terbitkan
                    </label>
                  </div>
                  <?php echo $errors->first('post_status','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('gambar','GAMBAR', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <div class="input-group">
                    <?php echo Form::text('fupload', null, ['class'=>'form-control', 'id'=>'thumbnail', 'placeholder' => 'UPLOAD GAMBAR MAX 1']); ?>

                    <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-success">
                        <i class="fa fa-picture-o"></i>&nbsp;Pilih Gambar
                      </a>
                    </span>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('duration','DURASI', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('duration',null, ['class' => 'form-control', 'placeholder' => 'DURASI PERJALANAN']); ?>

                  <?php echo $errors->first('duration','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('start_period','AWAL PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('start_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AWAL PERIODE']); ?>

                  <?php echo $errors->first('start_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('end_period','AKHIR PERIODE', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('end_period',null, ['class' => 'form-control', 'placeholder' => 'TANGGAL BULAN TAHUN AKHIR PERIODE']); ?>

                  <?php echo $errors->first('end_period','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('price','HARGA', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::text('price',null, ['class' => 'form-control', 'placeholder' => 'HARGA PAKET']); ?>

                  <?php echo $errors->first('price','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('itinerary','ITINERARY PAKET', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('itinerary',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('itinerary','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <?php echo Form::label('terms_conditions','SYARAT & KETENTUAN', ['class' => 'col-md-2 control-label']); ?>

                <div class="col-md-9">
                  <?php echo Form::textarea('terms_conditions',null, ['class' => 'form-control']); ?>

                  <?php echo $errors->first('terms_conditions','<p class="help-block"></p>'); ?>

                </div>
              </div>
              <div class="form-group">
                <div class="col-md-offset-2 col-md-9">
                  <?php echo Form::button('<i class="fa fa-send"></i>&nbsp;SAVE DATA', ['class' => 'btn btn-primary','type' => 'submit']); ?>

                  <?php echo Form::button('<i class="fa fa-times"></i>&nbsp;CANCEL', ['class' => 'btn btn-danger', 'type' => 'reset']); ?>

                </div>
              </div>
            </div>
            <?php echo Form::close(); ?>

          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>