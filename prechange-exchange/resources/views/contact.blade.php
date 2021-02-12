@include('layouts.header')

<style type="text/css">
  .dissable-active{
    opacity: 0.4;
  }
</style>

  <section class="banner_section">
    <div class="container">
      <div class="ban_sec">
        <div class="ex_cen">        

            <div class="row">

              <div class="col-md-6 col-lg-6 col-12 m-auto">

                <div class="wall_bx">
                  <h2 class="title">Contact</h2>

                  @include('layouts.message')

                  <form method="POST" action="{{ url('sendcontactmail') }}">   
                     {{ csrf_field() }}
                  <div class="form-group">
                    <label >Name <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" placeholder="" id="name" name="name" >
                    <span id="address_error" style="color: red"></span>  

                         @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif                
                  </div>

                  <div class="form-group">
                    <label >Email Id <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" placeholder="" id="email" name="email">
                    <span id="address_error" style="color: red"></span>   

                         @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif               
                  </div>

                  <div class="form-group">
                    <label >Phone <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" placeholder="" id="phone" name="phone">
                    <span id="address_error" style="color: red"></span>    

                         @if ($errors->has('phone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                  @endif              
                  </div>

                  <div class="form-group">
                    <label >Subject <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" placeholder="" id="subject" name="subject">
                    <span id="address_error" style="color: red"></span>    

                         @if ($errors->has('subject'))
                      <span class="help-block">
                        <strong>{{ $errors->first('subject') }}</strong>
                      </span>
                  @endif              
                  </div>

                   <div class="form-group">
                    <label >Message <span class="mandatory">*</span></label>
                    <input type="text" class="form-control" placeholder="" id="message" name="message">
                    <span id="address_error" style="color: red"></span>       
                         @if ($errors->has('message'))
                      <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                      </span>
                  @endif           
                  </div>

           
                  <button class="exchange-button" type="submit">Submit</button>
                  <!-- <a class="exchange-button" href="{{ url('checkout') }}" style="display: none;"><span>Next Step</span></a> -->
                  </form>
                 
                  </div>

              </div>

            </div>
        
        </div>

      </div>
    </div>
  </section>





  @include('layouts.footer')

  <script>
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  </script>


  <script type="text/javascript">
    $(".my-select").chosen({
      width: "100%"
    });
  </script>






</body>


</html>