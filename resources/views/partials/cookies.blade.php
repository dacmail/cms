<div id="cookie-alert" class="hide">
    Esta página usa cookies propias y de terceros para ofrecerle una mejor experiencia y servicio. Al continuar navegando acepta el uso de estas. <a href="http://politicadecookies.com/cookies.php" target="_blank">Más información</a>
    <a href="javascript:cookieConsent()" class="btn btn-default">Acepto</a>
</div>


@push('scripts')
    <script type="text/javascript">
    if (! Cookies.get('cookieconsent')) {
        $('#cookie-alert').removeClass('hide');
    }

    function cookieConsent() {
        $('#cookie-alert').fadeOut();

        Cookies.set('cookieconsent', 1, { expires: 365 });
    }
    </script>
@endpush
