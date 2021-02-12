<?php $__env->startSection('title', 'Support Ticket'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>Social Media SETTING</h1>
  </header>
  <?php if($message = Session::get('success')): ?>
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong><?php echo e($message); ?></strong>
    </div>
  <?php endif; ?> 
  <div class="card">
    <div class="card-body">
      <form method="post" action="<?php echo e(url('admin/save_social_media')); ?>" autocomplete="off">
      <?php echo e(csrf_field()); ?>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Pinterest</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="pinterest" required="required" id="pinterest" class="form-control" value="<?php echo e($link->pinterest); ?>">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Facebook</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="fb" required="required"  class="form-control" value="<?php echo e($link->fb); ?>">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Twitter</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="twitter" required="required"  class="form-control" value="<?php echo e($link->twitter); ?>">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Instagram</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="instagram" required="required"  class="form-control" value="<?php echo e($link->instagram); ?>">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Telegram</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="telegram" required="required"  class="form-control" value="<?php echo e($link->telegram); ?>">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
   
        <input type="hidden" name="token" class="form-control" value="" placeholder="">
        <div class="form-group">
          <button type="submit" name="change_password" class="btn btn-light"><i class=""></i> Save</button>
        </div>
      </form>
      <hr/>
    </div>
  </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/social_media.blade.php ENDPATH**/ ?>