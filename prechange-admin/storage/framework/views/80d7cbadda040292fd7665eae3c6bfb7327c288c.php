<?php $__env->startSection('title', 'FAQ - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="">
    <header class="content__title">
      <h1>FAQ Settings</h1>
    </header>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="<?php echo e(url('admin\faq_update')); ?>">
        <?php echo e(csrf_field()); ?> 
        <input type="hidden" name="id" value="<?php echo e($faq->id); ?>">
            <div class="row">

    <!--     <div class="col-md-3">
            <div class="form-group">
              <label>Select your language</label>
            </div>
         </div> -->

        <div class="col-md-4"> 
          <div class="form-group">
   <!--        <select class="form-control" id="status" name="language">
            <option value="">select your language</option>
            <option value="en" <?php if($faq->lang == 'en'): ?> selected <?php else: ?> <?php endif; ?>>English</option>
            <option value="loas">Loas</option>
            <option value="rus">Russian</option> 
            <option value="azn">Azerbaijani</option> 
          </select> -->
        </div>
            <?php if($errors->has('language')): ?>
                    <span class="help-block">
                          <strong><?php echo e($errors->first('language')); ?></strong>
                      </span>
            <?php endif; ?>
        </div>
        </div>
  <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label>Heading</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <input type="text" name="heading" class="form-control" value="<?php echo e($faq->title); ?>">
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Description</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <textarea name="description" class="form-control" style="line-height: 30px;" rows=5><?php echo e($faq->description); ?></textarea>
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>  
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>&nbsp;</label>
              </div>
            </div>
            <div class="col-md-4">
               <button class="btn btn-md btn-warning" type="submit"> Update</button><br /><br />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/faq_edit.blade.php ENDPATH**/ ?>