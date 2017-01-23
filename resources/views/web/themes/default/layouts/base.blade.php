<!DOCTYPE html>
<html>
<head>
	<title>{{ $web->name }}</title>
	<meta name="description" content="{{ $web->description }}" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{ elixir('themes/default/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ elixir('themes/default/css/default.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ route('web::custom_css') }}">

	@if ($web->hasConfig('themes.default.css'))
		<style>
			{{ $web->getConfig('themes.default.css') }}
		</style>
	@endif

	<meta name="twitter:site" content="{{ $web->twitter ?: '@ProteCMS' }}">
	<meta name="twitter:creator" content="{{ $web->twitter ?: '@ProteCMS' }}">
	<meta property="og:site_name" content="{{ $web->name }}" />

	@include('partials.favicon')

	@section('meta.share')

		<!-- Schema.org markup for Google+ -->
		<meta itemprop="name" content="{{ $web->name }}">
		<meta itemprop="description" content="{{ $web->description }}">
		<meta itemprop="image" content="{{ route('web::image', ['file' => $web->logo]) }}">

		<!-- Twitter Card data -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="{{ $web->name }}">
		<meta name="twitter:description" content="{{ $web->description }}">
		<meta name="twitter:image:src" content="{{ route('web::image', ['file' => $web->logo]) }}">

		<!-- Open Graph data -->
		<meta property="og:title" content="{{ $web->name }}" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ $web->getUrl() }}" />
		<meta property="og:image" content="{{ route('web::image', ['file' => $web->logo]) }}" />
		<meta property="og:description" content="{{ $web->description }}" />

	@show

</head>
<body>

	@if (config('protecms.cms.env') == 'demo')
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="text-center">
				<p style="margin-top:10px">Esta versión es una demo. <a href="{{ route('auth::login') }}">Entrar al panel de administración.</a><br>
				Si eres una protectora y quieres una página web como esta haz clic <a href="http://protecms.com">aquí</a>.</p>

			</div>
		</div>
	</nav>
	@endif

	<div id="wrapper" class="container">

		<div class="header">
			<a href="{{ route('web::index') }}" class="logo">
				@if ($web->getConfig('themes.default.header_image'))
					<img src="{{ route('web::image', ['file' => $web->getConfig('themes.default.header_image')]) }}" class="" alt="{{ $web->name }}">
				@elseif ($web->logo)
					<img src="{{ route('web::image', ['file' => $web->logo]) }}" class="img-responsive center-block" alt="{{ $web->name }}">
				@else
					<img src="{!! Theme::url('/images/header-default.jpg') !!}" class="img-responsive" alt="{{ $web->name }}">
				@endif
			</a>

			<div class="logo-mobile">
				<a href="#" class="widgets-left-button">
					<i class="fa fa-reorder"></i>
				</a>
				<a href="{{ route('web::index') }}" class="logo-mobile-link">
					@if ($web->logo)
						<img src="{{ route('web::image', ['file' => $web->logo]) }}" class="img-responsive center-block" alt="{{ $web->name }}">
					@else
						<h1>{{ $web->name }}</h1>
					@endif
				</a>
				<a href="#" class="widgets-right-button">
					<i class="fa fa-reorder"></i>
				</a>
			</div>
		</div>

		@if (count($widgets_left))
		<div class="widgets widgets-left">
				@foreach ($widgets_left as $widget)
					<div class="widget widget-{{ $widget->type }} {{ $widget->getConfig('without_background') ? 'widget-without-background' : '' }}"">
						<h4 class="{{ $widget->getConfig('without_title') ? 'hide' : '' }}">{{ $widget->title }}</h4>
						@if ($widget->type == 'menu')
							<ul>
							@foreach ($widget->links as $link)
								<li>
									<a href="{{ $link->link }}">
										@if (Request::path() === trans_choice('routes.animals', 2))
											{!! $link->link == '/' . urldecode(trans_choice('routes.animals', 2) . str_replace(Request::url(), '', Request::fullUrl())) ? '<i class="fa fa-chevron-circle-right"></i> '
												: '' !!}
										@else
											{!!
												Request::fullUrl() == $link->link ||
												Request::url() == $link->link ||
												'/'.Request::path() == $link->link
												? '<i class="fa fa-chevron-circle-right"></i> '
												: ''
											!!}
										@endif
										{{ $link->title }}
									</a>
								</li>
							@endforeach
							</ul>
						@elseif ($widget->type == 'custom')
							<div class="widget-content">{!! $widget->content !!}</div>
						@elseif ($widget->type == 'protecms')
							@include('web.themes.default.partials.widgets.' . $widget->file)
						@endif
						<div class="widget-bottom {{ $widget->getConfig('without_background') || $widget->getConfig('without_background_bottom') ? 'hide' : '' }}"></div>
					</div>
				@endforeach
		</div>
		@endif

		<div class="content
				{{ ! count($widgets_left) && count($widgets_right) ? 'two-colums' : '' }}
				{{ count($widgets_left) && ! count($widgets_right) ? 'two-colums' : '' }}
				{!! ! count($widgets_left) && ! count($widgets_right) ? 'single' : '' !!}
		">
			@yield('content')
		</div>

		@if (count($widgets_right))
		<div class="widgets widgets-right">
			@foreach ($widgets_right as $widget)
				<div class="widget widget-{{ $widget->type }} {{ $widget->getConfig('without_background') ? 'widget-without-background' : '' }}">
					<h4 class="{{ $widget->getConfig('without_title') ? 'hide' : '' }}">{{ $widget->title }}</h4>
					@if ($widget->type == 'menu')
						<ul>
						@foreach ($widget->links as $link)
							<li>
								<a href="{{ $link->link }}">
									{!!
										Request::fullUrl() == $link->link ||
										Request::url() == $link->link ||
										'/'.Request::path() == $link->link
										? '<i class="fa fa-chevron-circle-right"></i> '
										: ''
									!!}
									{{ $link->title }}
								</a>
							</li>
						@endforeach
						</ul>
					@elseif ($widget->type == 'custom')
						<div class="widget-content">{!! $widget->content !!}</div>
					@elseif ($widget->type == 'protecms')
						@include('web.themes.default.partials.widgets.' . $widget->file)
					@endif
					<div class="widget-bottom {{ $widget->getConfig('without_background') || $widget->getConfig('without_background_bottom') ? 'hide' : '' }}"></div>
				</div>
			@endforeach

			<div class="widget widget-protecms-logo widget-custom widget-without-background {{ ! count($widgets_left) && ! count($widgets_right) ? 'hide' : '' }}">
				<div class="widget-content">
					<a href="http://protecms.com" title="ProteCMS - El gestor gratuito para Protectoras de animales">
						Un proyecto de
						<img src="/assets/images/logos/logo_original@0.5x.png" alt="ProteCMS Logo">
					</a>
				</div>
			</div>
		</div>
	</div>
	@endif

	<a href="#" class="back-to-top"><i class="fa fa-arrow-circle-up"></i></a>

	<div class="footer container text-center">
		Copyright &copy; {{ $web->name }} - {{ date('Y') }} · Página web por <a href="http://protecms.com">ProteCMS</a>.<br>
		<a href="{{ route('admin::panel::index') }}">Acceder al Panel de administración</a>
	</div>

	@include('partials.cookies')

	<script type="text/javascript" src="{{ elixir('themes/default/js/app.js') }}"></script>
	@include('partials.flash')
	@include('partials.googleanalytics')

	@stack('scripts')

</body>
</html>
