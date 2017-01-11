@extends('web.themes.default.layouts.base')

@section('content')

	<div class="posts">
		@foreach ($last_posts as $post)
			<div class="row post">
				<div class="col-md-12">
					@include('web.themes.default.partials.post', [
						'post' => $post
					])
				</div>
			</div>
		@endforeach

		<div class="clearfix"></div>

		{!! $last_posts->render() !!}
	</div>

@stop