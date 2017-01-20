<!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2015-{{ date('Y') }} &copy; {{ config('protecms.cms.name') }} v{{ config('protecms.cms.version') }} por <a target="_blank" href="http://jaimesares.com">Jaime Sares</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
</div>

<script src="{{ elixir('assets/admin/js/admin-plugins.js') }}" type="text/javascript"></script>

@include('partials.flash')

<script>
    if ($('.from-slug').value === undefined) {
        $('.to-slug').slugify('.from-slug');
    }

    $('.menu-toggler').on('click', function() {
        if (! $('.page-sidebar').hasClass('in')) {
            $('body').addClass('noscroll');
        } else {
            $('body').removeClass('noscroll');
        }
    });

    /**
     * Notifications
     */
    $('#header_notification_bar > a').on('click', function() {
        if (parseInt($(this).data('notifications')) > 0) {
            $.post('{{ route('admin::panel::users::read_notifications') }}', {
                _token: '{{ csrf_token() }}'
            }).success(function() {
                $('#header_notification_bar > a').data('notifications', 0);
                $('#header_notification_bar .badge.badge-default').fadeOut();
            });
        }
    });
</script>

@stack('scripts')

@include('partials.googleanalytics')