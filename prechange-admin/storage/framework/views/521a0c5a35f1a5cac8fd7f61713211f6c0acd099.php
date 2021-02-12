<?php $__env->startSection('title', ' Trade History'); ?>
<?php $__env->startSection('content'); ?>
<section class="content">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<h5 class="text-uppercase maginf">Trade History</h5>
				</div>
			</div>
		</div>
	</div>
	<div class="card"> 
		<div class="card-body">
			<div class="row">
			<!-- 	<div class="col-md-2">                
					<input type="text" name="statdate" id="from_date" class="form-control date-picker" placeholder="From Date" />	
				</div> -->
			<!-- 	<div class="col-md-2">                
					<input type="text" id="to_date" name="st-date" class="form-control date-picker2" placeholder="To Date" />
				</div> -->
			<!-- 	<div class="col-md-2">                
					<input type="text" id="email" name="email" class="form-control" placeholder="Email" />
				</div> -->
		
			
		
				<div class="col-md-2">                
					<select class="form-control" id="status">
						<option value="All">All</option>
						<option value="0">Pending</option>
						<option value="1">Completed</option> 
						<option value="100">Cancelled</option> 
					</select>
				</div>

					<div class="col-md-3">
						<input type="button" id="btnExport" class="btn btn-success user_date" value="Export To Excel" />  

					</div>
			</div>
			<br/>
			<br/> 
			<div class="tab-content">
				<div id="buyo" class="tab-pane fade in active show">
					<div id="history"></div>
				</div>
			</div>
		</div>
	</div>  
<script type="text/javascript">
	$(document).ready(function() {
      	history_search()
	  });

	$('#from_date,#to_date,#tradepair,#status,#type1,#type2,#email').on('change', function(event){ 
	      history_search()
	  });

	function history_search(){
      $.ajax({
      url: '<?php echo e(url("/admin/koboex_his_search")); ?>',
      type: 'POST',
      data: {
        "_token": "<?php echo e(csrf_token()); ?>",
        "fromdate": $('#from_date').val(),
        "todate": $('#to_date').val(),
        "type1": $('#type1').val(),
        "type2": $('#type2').val(),
        "email": $('#email').val(),
        "tradepair": $('#tradepair').val(),
        "status": $('#status').val()
      }, 
      success: function (data) {
        $('#history').html(data); 
      },
    }); 
  };
</script>
<script type="text/javascript">

$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('loding');

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
        url: url,
        type: 'POST',
        data: {
          "_token": "<?php echo e(csrf_token()); ?>",
          "fromdate": $('#from_date').val(),
          "todate": $('#to_date').val(),
          "type1": $('#type1').val(),
          "type2": $('#type2').val(),
          "email": $('#email').val(),
          "tradepair": $('#tradepair').val(),
          "status": $('#status').val(),
          "url": url
        }, 
        success: function (data) {
          $('#history').html(data); 
        },
      }); 
    }
});


$("#btnExport").click(function (e) {
    //getting values of current time for generating the file name
    var dt = new Date();
    var day = dt.getDate();
    var month = dt.getMonth() + 1;
    var year = dt.getFullYear();
    var hour = dt.getHours();
    var mins = dt.getMinutes();
    var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;
    //creating a temporary HTML link element (they support setting file names)
    var a = document.createElement('a');
    //getting data from our div that contains the HTML table
    var data_type = 'data:application/vnd.ms-excel;charset=utf-8';
    
    var table_html = $('#history')[0].outerHTML;
//    table_html = table_html.replace(/ /g, '%20');
    table_html = table_html.replace(/<tfoot[\s\S.]*tfoot>/gmi, '');
    
    var css_html = '<style>td {border: 0.5pt solid #c0c0c0} .tRight { text-align:right} .tLeft { text-align:left} </style>';
//    css_html = css_html.replace(/ /g, '%20');
    
    a.href = data_type + ',' + encodeURIComponent('<html><head>' + css_html + '</' + 'head><body>' + table_html + '</body></html>');
    
    //setting the file name
    a.download = 'Koboex_transaction' + postfix + '.xls';
    //triggering the function
    a.click();
    //just in case, prevent default behaviour
    e.preventDefault();
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\prechange\prechange-admin\resources\views/tradehistory/koboexhistory.blade.php ENDPATH**/ ?>