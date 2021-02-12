@extends('layouts.header')
@section('title', 'About Us')
@section('content')
<section class="content">
<div class="content__inner">
	<header class="content__title">
		<h1>Update Meta Data Content</h1>
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
			<form method="post" autocomplete="off" action="{{ url('admin/update_meta') }}">
			    {{ csrf_field() }}
				<div class="row">
					<div class="col-md-12">
                        <label>Title</label>
						<div class="form-group">
						   <textarea class="ckeditor" name="title">
						        @if(is_object($meta) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $meta->title) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12">
                        <label>Meta Description</label>
						<div class="form-group">
						   <textarea class="ckeditor" name="desc">
						        @if(is_object($meta) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $meta->desc) @endphp
                                    {{ $data }}
                                @endif
						   </textarea>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-12">
                        <label>Meta Keywords</label>
						<div class="form-group">
						   <textarea class="ckeditor" name="keyword">
						        @if(is_object($meta) > 0)
                                    @php $data = str_replace(array("\r\n", "\r", "\n"), "<br />", $meta->keyword) @endphp
                                    {{ $data }}
                                @endif
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
@endsection