@extends('layouts.header')
@section('title', 'Terms & Conditions')
@section('content')
<section class="content">
<div class="content__inner">
	<header class="content__title">
		<h1>Update Kyc Aml Content</h1>
	</header>
	@if(session('status'))
	    <div class="alert alert-success" role="alert">
	        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            <span aria-hidden="true">&times;</span>
	        </button>
	    {{ session('status') }}
	    </div>
	@endif
	<div class="card">
		<div class="card-body"> 
			<form method="post" autocomplete="off" action="{{ url('admin/updatekycaml') }}">
			    {{ csrf_field() }}
				<div class="row">
						<div class="col-md-12">
								<div class="form-group">
								   <textarea class="ckeditor" name="kyc_aml">
								        @if(is_object($kycaml) > 0)
		                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $kycaml->kyc_aml) @endphp
		                                    {{ $data }}
		                                @endif
								   </textarea>
								</div>
						<!-- 		<div class="form-group">
								   <textarea class="ckeditor" name="kyc_aml_rus">
								        @if(is_object($kycaml) > 0)
		                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $kycaml->kyc_aml_rus) @endphp
		                                    {{ $data }}
		                                @endif
								   </textarea>
								</div> -->
						<!-- 		<div class="form-group">
								   <textarea class="ckeditor" name="kyc_aml_azn">
								        @if(is_object($kycaml) > 0)
		                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $kycaml->kyc_aml_azn) @endphp
		                                    {{ $data }}
		                                @endif
								   </textarea>
								</div> -->
						</div>
					
				</div>
				<div class="form-group">
					<button type="submit" name="update_content" class="btn btn-light"><i class=""></i> Update Content</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection