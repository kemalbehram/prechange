@include('layouts.header')

<section class="user">
    <div class="container">

  <h3>Terms and Condition</h3>

  <section class="main_content">
  <div class="container">
    <h2 class="text-uppercase heading text-center mt-5 mb-5" style="color: white;"></h2>
    <div class="col-md-10 col-lg-10 col-12 m-auto">
      <div class="main_div">
        <div class="buy_chrge">
          <div class="row">
            <p>{{ strip_tags($terms) }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


</div>
</section>
@include('layouts.footer')