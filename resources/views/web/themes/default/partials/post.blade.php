<h3><a href="{{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
<div class="post-content">{!! $post->text !!}</div>

@if (! Request::is('/') && $post->form)

	<div class="post-form">
		@include('web.themes.default.partials.form', [
			'form' => $post->form
		])
	</div>

@endif

<div class="clearfix"></div>
<div class="post-bottom row">
	<div class="post-data col-md-4 col-xs-5">
		<p>
			<i class="fa fa-tag"></i> {{ $post->category->title }}<br>
			<i class="fa fa-user"></i> {{ $post->author->name }}<br>
			<i class="fa fa-clock-o"></i> {{ $post->published_at->format('d-m-Y') }}
		</p>
	</div>
	<div class="post-share col-md-8 col-xs-7">
		<p>¡Comparte!</p>

		<a href="https://www.facebook.com/sharer/sharer.php?u={{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}"><i class="fa fa-facebook-square"></i></a>
		<a href="https://twitter.com/home?status={{ str_limit($post->title, 120, '...') }} - {{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}"><i class="fa fa-twitter-square"></i></a>
		<a href="http://pinterest.com/pin/create/link/?url={{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}"><i class="fa fa-pinterest-square"></i></a>
		<a href="https://plus.google.com/share?url={{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}"><i class="fa fa-google-plus-square"></i></a>
		<a href="mailto:?&subject={{ $post->title }}&body=Echa un vistazo a este enlace: {{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->slug]) }}"><i class="fa fa-envelope-square"></i></a>
	</div>
</div>