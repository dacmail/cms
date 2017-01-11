@extends('web.themes.default.layouts.base')

@section('meta.share')
	@if (count($animal->photos))
		<meta itemprop="image" content="{{ $animal->photos[0]->medium_thumbnail_url }}">
		<meta name="twitter:image:src" content="{{ $animal->photos[0]->medium_thumbnail_url }}">
		<meta property="og:image" content="{{ $animal->photos[0]->medium_thumbnail_url }}" />
		<meta property="og:image:width" content="600" />
		<meta property="og:image:height" content="600" />
	@else
		<meta itemprop="image" content="{{ $web->getUrl() . Theme::url('images/animal-default.jpg') }}">
		<meta name="twitter:image:src" content="{{ $web->getUrl() . Theme::url('images/animal-default.jpg') }}">
		<meta property="og:image" content="{{ $web->getUrl() . Theme::url('images/animal-default.jpg') }}" />
		<meta property="og:image:width" content="385" />
		<meta property="og:image:height" content="385" />
	@endif

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="Ficha de {{ $animal->name }}">
	<meta itemprop="description" content="{{ trans_choice('animals.kind.' . $animal->kind, 1) }} | Sexo {{ strtolower(trans_choice('animals.gender.'. $animal->gender, 1)) }} | Estado {{ strtolower(trans_choice('animals.status.' . $animal->status, 1)) }} | Edad {{ $animal->birthDateDiffForHumans() }} | Historia: {{ strip_tags($animal->text) }}">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="Ficha de {{ $animal->name }}">
	<meta name="twitter:description" content="{{ trans_choice('animals.kind.' . $animal->kind, 1) }} | Sexo {{ strtolower(trans_choice('animals.gender.'. $animal->gender, 1)) }} | Estado {{ strtolower(trans_choice('animals.status.' . $animal->status, 1)) }} | Edad {{ $animal->birthDateDiffForHumans() }} | Historia: {{ strip_tags($animal->text) }}">

	<!-- Open Graph data -->
	<meta property="og:title" content="Ficha de {{ $animal->name }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ route('web::animals::show', ['id' => $animal->id]) }}" />
	<meta property="og:description" content="{{ trans_choice('animals.kind.' . $animal->kind, 1) }} | Sexo {{ strtolower(trans_choice('animals.gender.'. $animal->gender, 1)) }} | Estado {{ strtolower(trans_choice('animals.status.' . $animal->status, 1)) }} | Edad {{ $animal->birthDateDiffForHumans() }} | Historia: {{ strip_tags($animal->text) }}" />

@stop

@section('content')

	<div class="animal-card row">
		<div class="row">
			<div class="col-md-12 animal-card-title">
				<div class="row">
					<div class="col-xs-6 col-md-6">
						<h4>Ficha de {{ $animal->name }}</h4>
					</div>
					<div class="col-xs-6 col-md-6">
						<div class="animal-share">
							<a href="https://www.facebook.com/sharer/sharer.php?u={{ route('web::animals::show', ['id' => $animal->id]) }}"><i class="fa fa-facebook-square"></i></a>
							<a href="https://twitter.com/home?status=Ficha de {{ str_limit($animal->name, 120, '...') }} - {{ trans_choice('animals.kind.' . $animal->kind, 1) }} - Sexo {{ strtolower(trans_choice('animals.gender.'. $animal->gender, 1)) }} - Estado {{ strtolower(trans_choice('animals.status.' . $animal->status, 1)) }} - Edad {{ $animal->birthDateDiffForHumans() }} - {{ route('web::animals::show', ['id' => $animal->id]) }}"><i class="fa fa-twitter-square"></i></a>
							<a href="http://pinterest.com/pin/create/link/?url={{ route('web::animals::show', ['id' => $animal->id]) }}"><i class="fa fa-pinterest-square"></i></a>
							<a href="https://plus.google.com/share?url={{ route('web::animals::show', ['id' => $animal->id]) }}"><i class="fa fa-google-plus-square"></i></a>
							<a href="mailto:?&subject={{ $animal->title }}&body=Mira la ficha de {{ $animal->name }}: {{ route('web::animals::show', ['id' => $animal->id]) }}"><i class="fa fa-envelope-square"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">	
				<hr>
			</div>
			<div class="animal-photo-mobile col-xs-12 hidden-sm hidden-md hidden-lg">
				<img src="{{ $animal->photos[0]->thumbnail_url or Theme::url('images/animal-default.jpg') }}" alt="Foto de {{ $animal->name }}" class="img-responsive img-rounded">
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<table class="table table-condensed">
                    <tbody>
						@if (in_array('name', json_decode($web->getConfig('animals.fields'))))
							<tr class="first">
								<td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.name')) }}</strong></td>
								<td>{{ $animal->name }}</td>
							</tr>
						@endif
						@if (in_array('birth_date', json_decode($web->getConfig('animals.fields'))))
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.birth')) }}</strong></td>
	                        <td>{{ $animal->birthDateDiffForHumans() }}</td>
	                    </tr>
						@endif
						@if (in_array('gender', json_decode($web->getConfig('animals.fields'))))
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.gender')) }}</strong></td>
	                        <td>{{ trans_choice('animals.gender.' . $animal->gender, 1) }}</td>
	                    </tr>
						@endif
						@if (in_array('kind', json_decode($web->getConfig('animals.fields'))))
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans_choice('validation.attributes.kind', 1)) }}</strong></td>
	                        <td>{{ trans_choice('animals.kind.' . $animal->kind, 1) }}</td>
	                    </tr>
						@endif
						@if (in_array('breed', json_decode($web->getConfig('animals.fields'))))
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.breed')) }}</strong></td>
	                        <td>{{ $animal->breed or '-' }}</td>
	                    </tr>
						@endif
						@if (in_array('status', json_decode($web->getConfig('animals.fields'))))
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.status')) }}</strong></td>
	                        <td>{{ trans_choice('animals.status.' . $animal->status, 1) }}</td>
	                    </tr>
						@endif
						@if (in_array('location', json_decode($web->getConfig('animals.fields'))) && $animal->status !== 'dead')
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.location')) }}</strong></td>
	                        <td>{{ trans('animals.location.' . $animal->location) }}</td>
	                    </tr>
						@endif
						@if (in_array('weight', json_decode($web->getConfig('animals.fields'))))
							<tr>
								<td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.weight')) }}</strong></td>
								<td>{{ $animal->weight ? $animal->weight . 'kg' :  '-' }}</td>
							</tr>
						@endif
						@if (in_array('height', json_decode($web->getConfig('animals.fields'))))
							<tr>
								<td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.height')) }}</strong></td>
								<td>{{ $animal->height ? $animal->height . 'cm' :  '-' }}</td>
							</tr>
						@endif
						@if (in_array('length', json_decode($web->getConfig('animals.fields'))))
							<tr>
								<td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.length')) }}</strong></td>
								<td>{{ $animal->length ? $animal->length . 'cm' :  '-' }}</td>
							</tr>
						@endif
	                    @if ($animal->health_text && in_array('health_text', json_decode($web->getConfig('animals.fields'))) && $animal->status !== 'dead')
	                    <tr>
	                        <td class="text-right"><strong>{{ ucfirst(trans('validation.attributes.health')) }}</strong></td>
	                        <td>{{ $animal->health_text }}</td>
	                    </tr>
	                   	@endif
                    </tbody>
                </table>
			</div>
			<div class="animal-photo col-md-6 col-sm-6 hidden-xs">
				<img src="{{ $animal->photos[0]->thumbnail_url or Theme::url('images/animal-default.jpg') }}" alt="Foto de {{ $animal->name }}" class="img-responsive img-rounded">
			</div>
		</div>

		@if (count($animal->public_sponsorships))
			<div class="row alert">
				<div class="col-md-12">
					Apadrinado por:
					@foreach ($animal->public_sponsorships as $sponsorship)
						<span class="label label-lg label-info">{{ $sponsorship->name }}</span>
					@endforeach
				</div>
			</div>
		@endif

		<div class="row animal-content">
			<h4>Descripción</h4>
			<hr>
			<div class="col-md-12">
				{!! $animal->text !!}
			</div>
		</div>

		@if (count($animal->photos))
		<div class="row animal-gallery">
			<div class="col-md-12">
				<h4>Galería</h4>
				<hr>
			</div>
			<div class="col-md-12 lightbox-gallery">
				@foreach ($animal->photos as $photo)
					<div class="animal-gallery-photo col-md-4 col-xs-4">
						<div class="animal-gallery-photo-item">
							<a href="{{ $photo->photo_url }}">
								<img src="{{ $photo->thumbnail_url }}" alt="Foto de {{ $animal->name }}" class="img-responsive thumbnail">
								<div class="overlay">
									<div class="overlay-icon">
										<i class="fa fa-search"></i>
									</div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		@endif
	</div>

	<div class="animal-contact row {{ in_array($animal->status, ['adopted', 'dead']) ? 'hide' : '' }}">
		<h4>Contactar por {{ $animal->name }}</h4>
		<div class="row">
			<div class="col-md-12">
				<small class="pull-right">Todos los campos son obligatorios</small>
				<form action="{{ route('web::animals::contact', ['id' => $animal->id]) }}" class="form-horizontal" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="" class="control-label col-md-2 col-xs-12">Tu nombre</label>
						<div class="col-md-10 col-xs-12">
							<input type="text" name="name" class="form-control" required>
							{!! $errors->first('name', '<span class="help-block">:message</span>') !!}
						</div>
					</div>

					<div class="form-group">
						<label for="" class="control-label col-md-2 col-xs-12">Tu email</label>
						<div class="col-md-10 col-xs-12">
							<input type="email" name="email" class="form-control" required>
							{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
						</div>
					</div>

					<div class="form-group">
						<label for="" class="control-label col-md-2 col-xs-12">Tu teléfono</label>
						<div class="col-md-10 col-xs-12">
							<input type="text" name="phone" class="form-control">
							{!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
						</div>
					</div>

					<div class="form-group">
						<label for="" class="control-label col-md-2 col-xs-12">Asunto</label>
						<div class="col-md-10 col-xs-12">
							<select name="subject" id="" class="form-control">
								@if (in_array($animal->status, ['lost', 'found']))
									<option value="Contactar sobre {{ $animal->name }}">Contactar sobre {{ $animal->name }}</option>
								@else
									<option value="Pedir información sobre {{ $animal->name }}">Pedir información sobre {{ $animal->name }}</option>
									<option value="Apadrinar a {{ $animal->name }}">Apadrinar a {{ $animal->name }}</option>
									<option value="Adoptar a {{ $animal->name }}">Adoptar a {{ $animal->name }}</option>
								@endif
							</select>
							{!! $errors->first('subject', '<span class="help-block">:message</span>') !!}
						</div>
					</div>

					<div class="form-group">
						<label for="" class="control-label col-md-2 col-xs-12">Mensaje</label>
						<div class="col-md-10 col-xs-12">
							<textarea name="message" id="" rows="10" class="form-control"></textarea>
							{!! $errors->first('message', '<span class="help-block">:message</span>') !!}
						</div>
					</div>

					<div class="col-md-offset-4 col-md-4" style="margin-bottom: 40px">
						@include('partials.captcha')
					</div>

					<div class="form-actions">
			            <div class="row">
			                <div class="col-md-offset-3 col-md-6">
			                    <button type="submit" class="btn btn-default btn-block">Enviar</button>
			                </div>
			            </div>
			        </div>

				</form>
			</div>
		</div>
	</div>

@stop