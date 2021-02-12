<?php $__env->startSection('title', 'About Us'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
<div class="content__inner">
	<header class="content__title"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<h1>Update About Us Content</h1>
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
			<form method="post" autocomplete="off" action="<?php echo e(url('admin/update_about')); ?>">
			    <?php echo e(csrf_field()); ?>

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
						   <textarea class="ckeditor" name="aboutus">
						        <?php if($aboutus !=''): ?>
                                    <?php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $aboutus->aboutus) ?>
                                    <?php echo e($data); ?>

                                <?php endif; ?>
						   </textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" name="update_content" class="btn btn-light"><i class=""></i> Update Content</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/aboutus.blade.php ENDPATH**/ ?>