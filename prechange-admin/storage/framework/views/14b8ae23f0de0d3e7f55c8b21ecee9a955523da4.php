<?php $__env->startSection('title', 'Commission Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <div class="content__inner">
    <header class="content__title">
      <h1>Commission Settings</h1>
    </header>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
          <h4 class="card-title">Commission Settings </h4>
            <div class="table-responsive">
           
              <?php if(count($commissions)): ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Coin / Currency</th>
                    <!-- <th>Withdraw Commission</th> -->
                    <!-- <th>Trade Buy Commission</th> -->
                    <th>Trade</th>
                    <!-- <th>Trade Sell Commission</th> -->
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody> 
                <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($commission->source == 'BTC' || $commission->source == 'ETH'): ?>
                        <?php $decimal = 8; ?>
                    <?php else: ?>
                        <?php $decimal = 2; ?>
                    <?php endif; ?>
                  <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($commission->source); ?></td>
                    <!-- <td><?php echo e(number_format($commission->withdraw, $decimal, '.', '')); ?></td> -->
                    <td><?php echo e(number_format($commission->trade, $decimal, '.', '')); ?></td>
                    <td>
                      <?php if($commission->status == 0): ?>
                          Disable
                      <?php else: ?>
                          Enable
                      <?php endif; ?>
                    </td>
                    <td><a href="<?php echo e(url('/admin/commissionsettings', Crypt::encrypt($commission->id))); ?>" class="btn btn-info">View / Edit</a></td>
                    
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <?php echo e($commissions->links()); ?>

              <?php else: ?>
                <?php echo e('No Commissions Settings'); ?>

              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/commission/commission.blade.php ENDPATH**/ ?>