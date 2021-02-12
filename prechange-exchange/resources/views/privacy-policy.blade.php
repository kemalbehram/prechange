@include('layouts.header')

<section class="user">
    <div class="container">

  <h3>Privacy Policy</h3>

  <section class="main_content">
  <div class="container">
    <h2 class="text-uppercase heading text-center mt-5 mb-5" style="color: white;"></h2>
    <div class="col-md-10 col-lg-10 col-12 m-auto">
      <div class="main_div">
        <div class="buy_chrge">
          <div class="row">

               @if($policy != '')
      <p>{{ strip_tags($policy) }}</p>
    @else
    <h3 class="t-darkblue fnt-bld mt-10">Changes to this privacy policy</h3>
    <p class="content t-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
    <h3 class="t-darkblue fnt-bld">Website Security</h3>
    <p class="content t-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
    <p class="content t-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
    <h3 class="t-darkblue fnt-bld">Communications</h3>
    <p class="content t-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages</p>
    @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


</div>
</section>
@include('layouts.footer')