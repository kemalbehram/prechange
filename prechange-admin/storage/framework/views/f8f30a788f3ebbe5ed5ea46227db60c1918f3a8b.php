<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('content'); ?> 
<section class="content">
    <header class="content__title">
        <h1>Dashboard</h1>
    </header>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Recent Trade History</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date / Time</th>
                    <th>User Name</th>
                    <th>Price </th>
                    <th>Amount  </th>
                    <th>Remaining  </th> 
                    <th>Total  </th>
                    <th>Trade Fee</th>
                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($history)): ?>
                                                <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(date('d/m/Y', strtotime($trade->created_at))); ?></td>
                    <td><?php echo e(username($trade->uid)); ?></td>
                    <td><?php echo e(number_format($trade->price, 8, '.', '')); ?></td>
                    <td><?php echo e(number_format($trade->volume, 8, '.', '')); ?></td>
                    <td><?php echo e(number_format($trade->remaining, 8, '.', '')); ?></td> 
                    <td><?php echo e(number_format($trade->value, 8, '.', '')); ?></td>
                    <td><?php echo e(number_format($trade->fees, 8, '.', '')); ?></td>
                    <td>
                        <?php if($trade->status == 0 ): ?> 
                            Pending 
                        <?php elseif($trade->status == 100 ): ?> 
                            Cancelled
                        <?php else: ?> 
                            Completed 
                        <?php endif; ?>
                    </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr><td colspan="6"> No Record Found!</td></tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                 
                        </div>
              
                    </div>
                </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/dashboard.blade.php ENDPATH**/ ?>