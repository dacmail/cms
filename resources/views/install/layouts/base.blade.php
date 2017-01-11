<!DOCTYPE html>
<html>
<head>
	<title>Instalación · ProteCMS</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="{{ elixir('assets/install/css/install.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ elixir('assets/install/css/install-plugins.css') }}">

	@stack('styles')
</head>
<body>

	<div id="wrapper" class="container">
		<div class="col-md-12">
			<div class="header row">
				<div class="col-md-3">
					<img src="/assets/images/logos/logo_original@0.5x.png" class="img-responsive" alt="ProteCMS">
				</div>
				<div class="col-md-9">
					<h3>
						@section('title')
							Instalación del proyecto
						@show
					</h3>
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="progress-block row">
				<div class="progress">
					@section('progress')
						<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
						Paso 1 de 5
						</div>
					@show
				</div>
			</div>

			<div class="content row">
				<div class="col-md-offset-2 col-md-8 text-justify" style="margin-top: 40px; margin-bottom: 40px">
					@yield('content')
				</div>
			</div>


			<div class="footer container text-center">
				Copyright &copy; {{ date('Y') }} <a href="http://protecms.com">ProteCMS</a>.
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{ elixir('assets/install/js/app.js') }}"></script>

	@stack('scripts')
</body>
</html>