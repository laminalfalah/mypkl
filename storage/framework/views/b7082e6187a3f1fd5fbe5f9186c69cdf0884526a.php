<?php if(session()->has('flash_notification.message')): ?>
<div class="col-md-12" style="margin: 10px 0 5px 0;">
  <div class="alert alert-<?php echo e(session()->get('flash_notification.level')); ?>">
    <button type="button" class="close" data-dismiss="alert" ariahidden="true">&times;</button>
    <?php echo session()->get('flash_notification.message'); ?>

  </div>
</div>
<?php endif; ?>
