<h3><a href="{{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}">{{ $page->title }}</a></h3>
<div class="post-content">{!! $page->text !!}</div>

@if ($page->form)

	<div class="post-form">
		@include('web.themes.default.partials.form', [
			'form' => $page->form
		])
	</div>

@endif

<div class="clearfix"></div>
<div class="post-bottom row">
	<div class="post-data col-md-4 col-xs-5">
		<p>
			<br>
			<i class="fa fa-user"></i> {{ $page->author->name }}<br>
			<i class="fa fa-clock-o"></i> {{ $page->published_at->format('d-m-Y') }}
		</p>
	</div>
	<div class="post-share col-md-8 col-xs-7">
		<p>¡Comparte!</p>
		<a href="https://www.facebook.com/sharer/sharer.php?u={{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}"><i class="fa fa-facebook-square"></i></a>
		<a href="https://twitter.com/home?status={{ str_limit($page->title, 120, '...') }} - {{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}"><i class="fa fa-twitter-square"></i></a>
		<a href="http://pinterest.com/pin/create/link/?url={{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}"><i class="fa fa-pinterest-square"></i></a>
		<a href="https://plus.google.com/share?url={{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}"><i class="fa fa-google-plus-square"></i></a>
		<a href="mailto:?&subject={{ $page->title }}&body=Echa un vistazo a este enlace: {{ route('web::pages::show', ['id' => $page->id, 'slug' => $page->slug]) }}"><i class="fa fa-envelope-square"></i></a>
	</div>
</div>