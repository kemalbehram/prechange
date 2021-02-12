@if (isset(Auth::user()->id))
@include('layouts.before-login')
@else
@include('layouts.header')
@endif

<article>
	<section class="termspagecontent">
		<div class="systembannerbg">
			<div class="container">
				<div class="col-md-12 col-sm-12 col-xs-12 pl-0">
					<div class="own-heading text-center">
						<h2 class="text-uppercase heading text-center mt-5 mb-5" style="color: white;">Frequently Asked Questions</h2>
						<div class="bottom-u-line"></div>
					</div>

					<section class="faq pb-5" id="faq">
						<div class="container">

							<div class="accordion" id="accordionExample">

								@foreach($faq as $index => $faqs)
								<div class="card">
									<div class="card-header" id="headingOne">
										<h2 class="mb-0">
											<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$index}}" aria-expanded="true" aria-controls="collapseOne">
												{{ $faqs->title }} #{{$index+1}}
											</button>
										</h2>
									</div>

									<div id="collapse{{$index}}" class="collapse" aria-labelledby="heading{{$index}}" data-parent="#accordionExample">
										<div class="card-body">
											{{ $faqs->description }}
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</section>


				</div>
			</div>
		</div>
	</section>
</article>
</div>
</div>
</div>
</section>
</article>


@include('layouts.footer')

<script>
	$(document).ready(function () {

		 $("#collapse0").addClass('show');
		$('.collapse.in').prev('.panel-heading').addClass('active');
		$('#accordion, #bs-collapse')
		.on('show.bs.collapse', function (a) {
			$(a.target).prev('.panel-heading').addClass('active');
		})
		.on('hide.bs.collapse', function (a) {
			$(a.target).prev('.panel-heading').removeClass('active');
		});
	});
</script>