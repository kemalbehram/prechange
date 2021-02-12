<?php $__env->startSection('title', 'Users List - Admin'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
  <header class="content__title">
    <h1>FAQ</h1>   
  </header>
  <?php if($message = Session::get('success')): ?>
    <div class="alert alert-info"><?php echo e($message); ?> </div><br />
  <?php endif; ?>
  <div class="card">
    <div class="card-body">
	<div class="row">
			  <div class="col-md-3 col-sm-8 col-12">                
			<!-- 	  <select class="form-control" id="status">
						<option value="All">select your language</option>
						<option value="en">English</option>
						<option value="loas">Loas</option>
						<option value="rus">Russian</option> 
						<option value="azn">Azerbaijani</option> 
				  </select> -->
			</div>
			 <div class="col-md-9 col-sm-4 col-12 rightbtnboxcard">   
			 <a href="<?php echo e(url('admin/faq_add')); ?>" class="addbtns btn btn-success">Add</a>
			 </div>
        </div>
      <div class="table-responsive search_result">

      <div class="tab-content">
        <div class="tab-pane fade in active show">
          <div id="history"></div>
        </div>
      </div>

 <!--        <?php if($faq->count()): ?>
        <table class="table" id="dows">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Language</th>
              <th>Header</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($key+1); ?></td>
              <td><?php echo e($user->lang); ?></td>
              <td><?php echo e($user->heading); ?></td>
              <td><a class="btn btn-success btn-xs" href="<?php echo e(url('admin/faq_edit/'.$user->id)); ?>"><i class="zmdi zmdi-edit"></i> View </a> </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php else: ?> 
        <?php echo e('No record found! '); ?>

        <?php endif; ?> -->
      </div>
    </div>
  </div>
</div>
</div>
</section>


<script type="text/javascript">
  $(document).ready(function() {
        history_search()
    });

  $('#status').on('change', function(event){ 
        history_search()
    });

  function history_search(){
      $.ajax({
      url: '<?php echo e(url("/admin/faq_ajax_search")); ?>',
      type: 'POST',
      data: {
        "_token": "<?php echo e(csrf_token()); ?>",
        "status": 'en'
      }, 
      success: function (data) {
        $('#history').html(data); 
      },
    }); 
  };
</script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/settings/faq.blade.php ENDPATH**/ ?>