<?php $__env->startSection('title', 'Commission Settings'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title">
		<h1>Commission Settings</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="<?php echo e(url('admin/commission')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to Commission</a>
					<br /><br />
					<?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
					<form method="post" action="<?php echo e(url('admin/commissionupdate')); ?>" autocomplete="off">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" value="<?php echo e($commission->id); ?>" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Coin / Currency</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="currency" class="form-control" value="<?php echo e($commission->source != NULL ? $commission->source : '0'); ?>" readonly/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
				<!-- 		<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Withdraw Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="withdraw" class="form-control" value="<?php echo e($commission->withdraw != NULL ? $commission->withdraw : '0'); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('withdraw')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('withdraw')); ?></strong>
					                    </span>
					                <?php endif; ?>
								</div>
							</div> 
						</div>  -->
								<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="buy" class="form-control" value="<?php echo e($commission->trade != NULL ? $commission->trade : '0'); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('buy')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('buy')); ?></strong>
					                    </span>
				                	<?php endif; ?>
								</div>
							</div>
						</div>
				<!-- 		<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Buy Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="buy" class="form-control" value="<?php echo e($commission->buy_trade != NULL ? $commission->buy_trade : '0'); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('buy')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('buy')); ?></strong>
					                    </span>
				                	<?php endif; ?>
								</div>
							</div>
						</div> -->
					<!-- 	<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Trade Sell Commission (%)</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="sell" class="form-control" value="<?php echo e($commission->sell_trade != NULL ? $commission->sell_trade : '0'); ?>"/><i class="form-group__bar"></i>
									<?php if($errors->has('sell')): ?>
					                    <span class="help-block">
					                        <strong><?php echo e($errors->first('sell')); ?></strong>
					                    </span>
				                	<?php endif; ?>
								</div>
							</div>
						</div> -->
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/commission/edit.blade.php ENDPATH**/ ?>