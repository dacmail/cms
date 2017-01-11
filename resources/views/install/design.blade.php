@extends('install.layouts.base')

@section('progress')
	<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
	Paso 3 de 5
	</div>
@stop

@section('content')

	<h4>Configura el diseño de la página web</h4><br>
	<p>Aquí puedes configurar el apartado gráfico de la página web. Actualmente solo existe 1 tema, aunque esto irá incrementando con el tiempo.</p>

	<form action="{{ route('install::design_post') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group">
			<p>Selecciona el color principal de tu protectora <small>(Éste será el color principal de la página web)</small>:</p>
			<input type="text" name="color" id="color" value="#25c2e6" class="form-control colorpicker">
		</div>

		<div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.logo')) }}</label>
			<div class="col-md-10">
				<div class="image-editor-logo">
					<input type="file" class="cropit-image-input">
					<div class="cropit-preview"></div>
					<div class="image-size-label">
						Redimensionar imagen
					</div>
					<input type="range" class="cropit-image-zoom-input">
					<input type="hidden" name="logo" class="hidden-image-data-logo" />
				</div>
				{!! $errors->first('logo', '<span class="help-block">:message</span>') !!}
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="form-group {{ $errors->has('header') ? 'has-error' : '' }}">
			<label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.header_image')) }}</label>
			<div class="col-md-10">
				<div class="image-editor-header">
					<input type="file" class="cropit-image-input">
					<div class="cropit-preview"></div>
					<div class="image-size-label">
						Redimensionar imagen
					</div>
					<input type="range" class="cropit-image-zoom-input">
					<input type="hidden" name="header" class="hidden-image-data-header" />
				</div>
				{!! $errors->first('header', '<span class="help-block">:message</span>') !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-offset-4 col-md-4" style="margin-top: 50px">
				<button type="submit" class="btn btn-success btn-block">Continuar</button>
			</div>
		</div>

	</form>

@stop

@push('scripts')
<script>
	$('form img').on('click', function() {
		$('form img').removeClass('img-thumbnail');
		$(this).addClass('img-thumbnail');
	});

	$(document).on('ready', function() {
		$('.colorpicker').colorpicker({
			align: 'left',
			format: 'hex'
		});
	});
</script>
@endpush

@push('styles')
<style>
	.image-editor-header .cropit-preview {
		background-color: #f8f8f8;
		background-size: cover;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-top: 7px;
		width: 600px;
		height: 100px;
	}

	.image-editor-header .cropit-preview-image-container {
		cursor: move;
	}

	.image-editor-header .image-size-label {
		margin-top: 10px;
	}

	.image-editor-header .cropit-preview-background {
		opacity: .2;
	}

	.image-editor-logo .cropit-preview {
		background-color: #f8f8f8;
		background-size: cover;
		border: 1px solid #ccc;
		border-radius: 3px;
		margin-top: 7px;
		width: 400px;
		height: 400px;
	}

	.image-editor-logo .cropit-preview-image-container {
		cursor: move;
	}

	.image-editor-logo .image-size-label {
		margin-top: 10px;
	}

	.image-editor-logo .cropit-preview-background {
		opacity: .2;
	}
</style>
@endpush

@push('scripts')
<script>
	$('.image-editor-logo').cropit({
		smallImage: 'allow',
		freeMove: true,
		width: 400,
		height: 400,
		maxZoom: 1.5
	});
	$('.image-editor-header').cropit({
		smallImage: 'allow',
		width: 1200,
		height: 200,
		freeMove: true,
		maxZoom: 1.5
	});

	$('form').submit(function() {
		// Move cropped image data to hidden input
		var imageData = $('.image-editor-logo').cropit('export');
		$('.hidden-image-data-logo').val(imageData);

		var imageData = $('.image-editor-header').cropit('export');
		$('.hidden-image-data-header').val(imageData);
	});

	/**
	 * Throttle Resize-triggered Events
	 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
	 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
	 */
	var waitForFinalEvent = (function () {
		var timers = {};
		return function (callback, ms, uniqueId) {
			if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
			if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
			timers[uniqueId] = setTimeout(callback, ms);
		};
	})();


	var timeToWaitForLast = 100, // How often to run the resize event during resize (ms)
			$imageCropperLogo; // Set up a global object to hold image cropper container


	/**
	 * Runs on window resize
	 */
	function resizeHandler()
	{
		/**
		 * Adjust the size of the preview area to be 100% of the image cropper container
		 */
		if ( $imageCropperHeader )
		{
			var finalWidth  = 1200, // The desired width for final image output
					finalHeight = 200, // The desired height for final image output
					sizeRatio   = finalHeight / finalWidth,
					newWidth    = $imageCropperHeader.width(),
					newHeight   = newWidth * sizeRatio,
					newZoom     = finalWidth / newWidth;
			$imageCropperHeader.cropit('previewSize', { width: newWidth, height: newHeight });
			$imageCropperHeader.cropit('exportZoom', newZoom);
		}

		if ( $imageCropperLogo )
		{
			var finalWidth  = 400, // The desired width for final image output
					finalHeight = 400, // The desired height for final image output
					sizeRatio   = finalHeight / finalWidth,
					newWidth    = $imageCropperHeader.width(),
					newHeight   = newWidth * sizeRatio,
					newZoom     = finalWidth / newWidth;

			if (newWidth > 400) {
				newWidth = 400;
				newHeight = 400;
			}

			$imageCropperLogo.cropit('previewSize', { width: newWidth, height: newHeight });
			$imageCropperLogo.cropit('exportZoom', newZoom);
		}
	}

	document.addEventListener('DOMContentLoaded', function() {

		/**
		 * Set up the image cropper when the DOM is loaded
		 */
		$imageCropperHeader = jQuery('.image-editor-header');
		$imageCropperHeader.cropit({
			exportZoom: 3, // This will get adjusted when we change the size of the preview
			onImageLoaded: function() {
				resizeHandler();
			},
		});

		/**
		 * Set up the image cropper when the DOM is loaded
		 */
		$imageCropperLogo = jQuery('.image-editor-logo');
		$imageCropperLogo.cropit({
			exportZoom: 3, // This will get adjusted when we change the size of the preview
			onImageLoaded: function() {
				resizeHandler();
			},
		});

		/**
		 * Set up the resize event
		 */
		resizeHandler();
		window.addEventListener('resize', function() {
			waitForFinalEvent(resizeHandler, timeToWaitForLast, 'mainresize');
		});
	});
</script>
@endpush
