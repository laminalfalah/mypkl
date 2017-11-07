<?php echo Form::model($model, ['url' => $del_url, 'method'=>'delete', 'style' => 'width: 120px']); ?>

<a href="<?php echo $edit_url; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
<a href="<?php echo $detail_url; ?>" class="btn btn-sm btn-primary"><i class="fa fa-list"></i></a>
<button type="submit" name="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
<?php echo Form::close(); ?>

