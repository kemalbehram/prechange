<?php $__env->startSection('title', 'Support Ticket'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
<div class="content__inner">
  <header class="content__title">
    <h1>SECURITY SETTING</h1>
  </header>
  <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        <?php echo e(session('status')); ?>

        </div>
  <?php endif; ?>
  <div class="card">
    <div class="card-body"> 
      <form method="post" action="<?php echo e(url('admin/changeusername')); ?>" autocomplete="off">
      <?php echo e(csrf_field()); ?>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Current Username</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="currentusername" required="required" placeholder="Current login username" id="site_title" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>New username</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="newusername" required="required" placeholder="New login username" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <input type="hidden" name="token" class="form-control" value="" placeholder="">
        <div class="form-group">
          <button type="submit" name="change_password" class="btn btn-light"><i class=""></i> Save</button>
        </div>
      </form>
      <hr />
      <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <?php echo e(session('success')); ?>

            </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <?php echo e(session('error')); ?>

            </div>
      <?php endif; ?>
      <form method="post" action="<?php echo e(url('admin/changepassword')); ?>" autocomplete="off">
      <?php echo e(csrf_field()); ?>

        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Current Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="currentpassword" required="required" placeholder="Old Password" id="site_title" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="password" name="password" required="required" placeholder="New Password" class="form-control" value="">
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Confirm New Password</label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group"> <span id="amount"></span>
              <input type="password" name="password_confirmation" required="required"  class="form-control" placeholder="Confirm Password" 
								value="" >
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <input type="hidden" name="token" class="form-control" value="" placeholder="">
        <div class="form-group">
          <button type="submit" name="change_password" class="btn btn-light"><i class=""></i> Change Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/security.blade.php ENDPATH**/ ?>