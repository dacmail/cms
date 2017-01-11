@extends('web.themes.default.layouts.base')

@section('meta.share')
	@if (preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->text, $metaimage))
		<meta itemprop="image" content="{{ $web->getUrl() . $metaimage['src'] }}" />
		<meta name="twitter:image:src" content="{{ $web->getUrl() . $metaimage['src'] }}" />
		<meta property="og:image" content="{{ $web->getUrl() . $metaimage['src'] }}" />
	@else
		<meta itemprop="image" content="{{ route('web::image', ['file' => $web->logo]) }}" />
		<meta name="twitter:image:src" content="{{ route('web::image', ['file' => $web->logo]) }}" />
		<meta property="og:image" content="{{ route('web::image', ['file' => $web->logo]) }}" />
	@endif

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="{{ $post->title }}">
	<meta itemprop="description" content="{{ strip_tags(str_limit($post->text, 150)) }}">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="{{ $post->title }}">
	<meta name="twitter:description" content="{{ strip_tags($post->text) }}">

	<!-- Open Graph data -->
	<meta property="og:title" content="{{ $post->title }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}" />
	<meta property="og:description" content="{{ strip_tags($post->text) }}" />

@stop

@section('content')

	<div class="posts">
		<div class="row post">
			<div class="col-md-12">
				@include('web.themes.default.partials.post', [
					'post' => $post
				])
			</div>
		</div>
	</div>

@stop