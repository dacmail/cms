<script>
	@if (session()->has('flash'))
	noty({
	    layout: 'topRight',
	    theme: 'relax', // or 'relax'
	    type: '{{ session('flash.type', 'success') }}',
	    text: '{!! session('flash.text') !!}', // can be html or string
	    dismissQueue: false, // If you want to use queue feature set this true
	    template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
	    animation: {
	        open: 'animated fadeIn', // or Animate.css class names like: 'animated bounceInLeft'
	        close: 'animated fadeOut', // or Animate.css class names like: 'animated bounceOutLeft'
	        easing: 'swing',
	        speed: 500 // opening & closing animation speed
	    },
	    timeout: 5000, // delay for closing event. Set false for sticky notifications
	    force: false, // adds notification to the beginning of queue when set to true
	    modal: false,
	    maxVisible: 5, // you can set max visible notification for dismissQueue true option,
	    killer: false, // for close all notifications before show
	    closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
	    buttons: false // an array of buttons
	});
	@endif
</script>