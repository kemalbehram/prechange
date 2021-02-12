<div class="table-responsive" style="overflow-x: auto;white-space: nowrap;">
	<?php if(count($trades)>0): ?>
		<table class="table" id="dows">
			<thead>
				<tr>
					<th>Date / Time</th>
					<th>User Name</th>
					<th>txid </th>
					<th>Changelly Fee  </th>
					<th>Payin Address  </th> 
					<th>Payout Address  </th>
					<th>Receive Amount </th>
					<th>Spend Amount</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $trades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
				<tr>
					<td><?php echo e(date('d/m/Y', strtotime($trade->created_at))); ?></td>
					<td><?php echo e(username($trade->uid)); ?></td>
				
					<td><?php echo e($trade->txid); ?></td>
					<td><?php echo e($trade->changelly_fee); ?></td>
					<td><?php echo e($trade->payin_Address); ?></td>
					<td><?php echo e($trade->payout_address); ?></td>
					<td><?php echo e($trade->amount_expected_from.' '.$trade->currency_from); ?></td>
					<td><?php echo e($trade->amount_expected_to.' '.$trade->currency_to); ?></td>
				
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
			</tbody>
		</table>
		<?php else: ?> 
			<div class="alert alert-info">Yet no trades available</div>
		<?php endif; ?>
	</div>

	<div class="col-md-12 col-sm-12 col-xs-12 nopadding">
<div class="pagination-tt clearfix">
    <?php if($trades->count()): ?>
    	<?php echo e($trades->links()); ?>

	<?php endif; ?>
</div>
</div><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/tradehistory/koboexajax_tradehistory.blade.php ENDPATH**/ ?>