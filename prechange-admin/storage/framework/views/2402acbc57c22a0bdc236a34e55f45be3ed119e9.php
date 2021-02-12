<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<header class="content__title"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<h1>View User Details</h1>
	</header>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<a href="<?php echo e(url('admin/users')); ?>"><i class="zmdi zmdi-arrow-left"></i> Back to User</a>
					<br /><br />
					<?php if(session('updated_status')): ?>
					    <div class="alert alert-success">
                              <?php echo e(session('updated_status')); ?>

                        </div>
					<?php endif; ?>
					<form method="post" action="<?php echo e(url('admin/update_user')); ?>" autocomplete="off">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" value="<?php echo e($userdetails->id); ?>" name="id">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Full Name</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="fname" class="form-control" value="<?php echo e($userdetails->name != NULL ? $userdetails->name : ''); ?>"/><i class="form-group__bar"></i>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Email ID</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="email" name="email" class="form-control" value="<?php echo e($userdetails->email); ?>" /><i class="form-group__bar"></i>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Country</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<select class="form-control" name="country">
									<?php if($userdetails->country == ''): ?>
										<option value=""></option> 
										<?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country ): ?> <?php echo e(selected); ?> <?php else: ?> <?php echo e(''); ?>><?php echo e($countrys->name); ?><?php endif; ?></option> 
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?> 
										<?php $__currentLoopData = country(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countrys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($countrys->id); ?>" <?php if($countrys->id == $userdetails->country ): ?> <?php echo e("selected"); ?> <?php else: ?> <?php echo e(''); ?><?php endif; ?>><?php echo e(country_name($countrys->id)->name); ?></option> 
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Phone No</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="phone" class="form-control" value="<?php echo e($userdetails->phone); ?>" /><i class="form-group__bar"></i>
								</div>

							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Address</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								    <textarea class="form-control" rows="3" cols="10" name="address"><?php echo e($userdetails->address); ?></textarea>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label>Email Verified</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="form-group">
										<input type="text" name="emailcheck" class="form-control" value="<?php echo e($userdetails->email_verify == 1 ? 'Verified' : 'Not Verified'); ?>" disabled/><i class="form-group__bar"></i>
									</div>										
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" name="edit" class="btn btn-light"><i class=""></i> Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/user/user_edit.blade.php ENDPATH**/ ?>