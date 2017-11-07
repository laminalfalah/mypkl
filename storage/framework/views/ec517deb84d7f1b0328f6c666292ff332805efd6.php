<?php $__env->startSection('title', 'DAFTAR PAKET TOUR'); ?>

<?php $__env->startSection('breadcrumb'); ?>
  <?php if(Auth::user()->hasRole('admin')): ?>
    <li><a href="<?php echo e(route('dashboard.admin')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('tour.index')); ?>">Tour</li>
  <?php elseif(Auth::user()->hasRole('operator')): ?>
    <li><a href="<?php echo e(route('dashboard.operator')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('operator.tour.index')); ?>">Tour</li>
  <?php else: ?>
    <li><a href="<?php echo e(route('dashboard.company')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Dashboard</li>
    <li class="<?php echo e(set_active('company.tour.index')); ?>">Tour</li>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="row">
    <div class="col-lg-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <?php echo $__env->make('backend.layouts.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <h3 class="box-title">DAFTAR PAKET TOUR</h3>
          <div class="pull-right">
            <?php if(Auth::user()->hasRole('admin')): ?>
              <a href="<?php echo e(route('tour.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            <?php elseif(Auth::user()->hasRole('operator')): ?>
              <a href="<?php echo e(route('operator.tour.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            <?php else: ?>
              <a href="<?php echo e(route('company.tour.create')); ?>" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>&nbsp;Tambah Paket Tour
              </a>
            <?php endif; ?>
          </div>
        </div>
        <div class="box-body no-padding">
          <?php echo $html->table(['class' => 'table table-striped table-bordered table-hover']); ?>

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <?php echo $html->scripts(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>