@extends('web.themes.default.layouts.base')

@section('content')

	<div class="animals row">

		@if (count($animals))
			<h3>Listado de animales <small class="pull-right" style="margin-top: 7px; font-size: 0.6em">{{ $animals->count() }} de {{ $total }}</small></h3>

			<div class="animals-list">
				@foreach ($animals as $animal)
					<div class="col-md-4 col-xs-6 col-sm-4 animal">
						@include('web.themes.default.partials.animal', [
							'animal' => $animal
						])
					</div>
				@endforeach
			</div>

			<div class="clearfix"></div>

			{!! $animals->appends(Request::all())->render() !!}

		@else
			<h4 class="bg-info text-center">No existen fichas de animales.</h4>
		@endif

	</div>

@stop
