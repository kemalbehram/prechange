<style>
.passwordChange {
  display:none;
}
</style>
<footer class="footer hidden-xs-down">
  <p>Copyright@<?php echo $curYear = date('Y');?> All Rights Reserved.</p>
</footer>
</section>
</main>

<script src="{{ url('adminpanel/js/popper.min.js') }}"></script>
<script src="{{ url('adminpanel/js/bootstrap.min.js') }}"></script>
<script src="{{ url('adminpanel/js/app.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="{{ url('adminpanel/js/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{ url('adminpanel/ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('adminpanel/js/table2excel.js') }}"></script>

<script>

$('#remainder-email').on('show.bs.modal', function(e) {
  $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});


  $('#loding').hide();

  $(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
   $(this).val($(this).val().replace(/[^0-9\.]/g,''));
   if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
});

$("#proof_upload1").change(function() {
    var limit_size = 1048576;
    var photo_size = this.files[0].size;
    if(photo_size > limit_size){
        $("#kyc_btn").attr('disabled',true);
        $('#proof_upload1').val('');
        alert('Image Size Larger than 1MB');
    }
    else
    { 
        $("#proof_upload1").text(this.files[0].name);
        $("#kyc_btn").attr('disabled',false);
        
        var file = document.getElementById('proof_upload1').value;
        var ext = file.split('.').pop();
        switch(ext) {
              case 'jpg':
              case 'JPG':
              case 'Jpg':
              case 'jpeg':
              case 'JPEG':
              case 'Jpeg':
              case 'png':
              case 'PNG':
              case 'Png':
              readURL8(this);
              break;
              default:
              alert('Upload your proof like JPG, JPEG, PNG');
              break;
        }
    }
});

function readURL8(input) {
    var limit_size = 1048576;
    var photo_size = input.files[0].size;
  if(photo_size > limit_size){
    alert('Image size larger than 1MB');
  }
  else
  {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
}

$("#proof_upload2").change(function() {
    var limit_size = 1048576;
    var photo_size = this.files[0].size;
    if(photo_size > limit_size){
        $("#kyc_btn").attr('disabled',true);
        $('#proof_upload2').val('');
        alert('Image Size Larger than 1MB');
    }
    else
    { 
        $("#proof_upload2").text(this.files[0].name);
        $("#kyc_btn").attr('disabled',false);
        
        var file = document.getElementById('proof_upload2').value;
        var ext = file.split('.').pop();
        switch(ext) {
            case 'jpg':
            case 'JPG':
            case 'Jpg':
            case 'jpeg':
            case 'JPEG':
            case 'Jpeg':
            case 'png':
            case 'PNG':
            case 'Png':
              readURL7(this);
            break;
            default:
              alert('Upload your proof like JPG, JPEG, PNG');
            break;
        }
    }
});

function readURL7(input) {
var limit_size = 1048576;
var photo_size = input.files[0].size;
if(photo_size > limit_size){
    alert('Image Size Larger than 1MB');
}
else
{
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#doc3').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
}
}

  $('#accountname').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
     event.preventDefault();
     return false;
   }
 });
  $(function(){

    $('.adminaddress').keyup(function()
    {
      var yourInput = $(this).val();
      re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
      var isSplChar = re.test(yourInput);
      if(isSplChar)
      {
        var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
        $(this).val(no_spl_char);
      }
    });

  });

  $('.datepicker4').each(function(e) {
    e.datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    });
    $(this).on("click", function() {
      e.datepicker("show");
    });
  });



 // $('.date-picker').datepicker({
 //   format: 'dd-mm-yyyy',
 //     endDate: '1d',
 //    autoclose: true
 // });


 //  $('.date-picker2').datepicker({
 //    format: 'dd-mm-yyyy',
 //    endDate: '1d',
 //    autoclose: true
 // });



var startDate = new Date('01/01/2020');
var FromEndDate = new Date();
var ToEndDate = new Date();
// ToEndDate.setDate(ToEndDate.getDate() + 365);

$('.date-picker').datepicker({
weekStart: 1,
format: 'dd-mm-yyyy',
startDate: '01/01/2020',
endDate: FromEndDate,
autoclose: true
})
.on('changeDate', function (selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('.date-picker2').datepicker('setStartDate', startDate);
    });

$('.date-picker2')
    .datepicker({
        weekStart: 1,
        format: 'dd-mm-yyyy',
        startDate: startDate,
        endDate: ToEndDate,
        defaultDate: null,
        autoclose: true
    })
    // .on('changeDate', function (selected) {
    //     FromEndDate = new Date(selected.date.valueOf());
    //     FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
    //     $('.date-picker').datepicker('setEndDate', FromEndDate);
    // });


  function isNumberKey(evt)
  {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31 
      && (charCode < 48 || charCode > 57))
     return false;

   return true;
 }

 $(document).ready(function () {
  //called when key is pressed in textbox
  $("#numberonly").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
        return false;
      }
    });
});
 $("#reason").on("keydown", function (e) {
  var c = $("#reason").val().length;
  if(c == 0)
    return e.which !== 32;
});



  function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#doc1').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#file-upload1").change(function() {
  $("#file-name1").text(this.files[0].name);
  readURL1(this);
});

  function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#doc2').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#file-upload2").change(function() {
  $("#file-name2").text(this.files[0].name);
  readURL2(this);
});


  </script>

  <!-- click mene highlight svript -->
<script type="text/javascript">
$(function() {
// var pgurl = window.location.href.substr(window.location.href
var pgurl = 'http://ser5.bitrota.com'+window.location.pathname;
$(".navigation li a").each(function() { 
if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
    $(this).addClass("hilight-active");
    $(this).parent().addClass("navigation__sub--toggled");
})
});
</script>
<style type="text/css">
  .hilight-active{
    background-color: #556e85;
  }
      
</style>

</body>
</html>