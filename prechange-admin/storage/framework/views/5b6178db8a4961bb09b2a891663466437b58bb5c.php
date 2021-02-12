    <div class="table-responsive search_result">
        <?php if($faq->count()): ?>
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              
              <th>Header</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?></td>
              <td><?php echo e($user->title); ?></td>
              <td><?php echo e($user->description); ?></td>
              <td><a class="btn btn-success btn-xs" href="<?php echo e(url('admin/faq_edit/'.$user->id)); ?>"><i class="zmdi zmdi-edit"></i> View </a> </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php else: ?> 
        <?php echo e('No record found! '); ?>

        <?php endif; ?>
      </div><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/faqajax.blade.php ENDPATH**/ ?>