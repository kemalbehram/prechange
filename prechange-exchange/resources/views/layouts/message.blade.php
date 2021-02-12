<div class="row">
  <div class="col-md-12">
    <?php $mail = Session::get('email'); ?>
    @if (session('emailnotverify'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('emailnotverify') }} Re-send verification? <a href="{{ url('/resend-verification-code/'.$mail) }}">click here</a>
    </div>
    @endif

   @if (session('bank_fail'))
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('bank_fail') }} <a href="{{ url('myaccount/profile-form') }}">Click Here</a> to bank page.
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('success') }}
    </div>
    @endif
    @if (session('fail'))
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ session('fail') }}
    </div>
    @endif
  </div>
</div>     