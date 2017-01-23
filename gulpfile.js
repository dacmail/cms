const elixir = require('laravel-elixir'),
      gulp = require('gulp');

/********************************************
 * Config
 *******************************************/
const browserSyncUrl = 'demo.dev';

/********************************************
 * Global
 *******************************************/
elixir.extend('global', function (mix) {
    mix.copy('resources/assets/fonts', 'public/assets/fonts');
    mix.copy('resources/assets/images', 'public/assets/images');
});

/********************************************
 * Admin
 *******************************************/
elixir.extend('admin', function (mix) {
    mix.sass('./resources/assets/themes/admin/metronic/sass/metronic.scss', 'public/assets/admin/css');
    mix.sass('auth.sass', 'public/assets/admin/css');

    mix.styles([
        './node_modules/font-awesome/css/font-awesome.css',
        './node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
        './node_modules/select2/dist/css/select2.css',
        './resources/assets/plugins/datetimepicker/jquery.datetimepicker.css',
        './node_modules/fullcalendar/dist/fullcalendar.css',
        './node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css',
        './node_modules/cropperjs/dist/cropper.min.css',
        './node_modules/animate.css/animate.css',
        './node_modules/bootstrap-daterangepicker/daterangepicker.css',
        './node_modules/magnific-popup/dist/magnific-popup.css',
    ], 'public/assets/admin/css/admin-plugins.css');

    mix.scripts([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        './node_modules/js-cookie/src/js.cookie.js',
        './node_modules/jquery-slimscroll/jquery.slimscroll.js',
        './resources/assets/plugins/jquery.blockui.min.js',
        './node_modules/bootstrap-switch/dist/js/bootstrap-switch.js',
        './node_modules/tinymce/tinymce.js',
        './resources/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js',
        './node_modules/moment/min/moment-with-locales.js',
        './node_modules/dropzone/dist/dropzone.js',
        './node_modules/fullcalendar/dist/fullcalendar.js',
        './node_modules/fullcalendar/dist/locale-all.js',
        './node_modules/highcharts/highcharts.js',
        './node_modules/highcharts/themes/grid-light.js',
        './node_modules/noty/js/noty/packaged/jquery.noty.packaged.js',
        './resources/assets/plugins/jquery.slugify.js',
        './node_modules/jquery-confirm/dist/jquery-confirm.min.js',
        './node_modules/bootstrap-daterangepicker/daterangepicker.js',
        './node_modules/select2/dist/js/select2.full.js',
        './node_modules/select2/dist/js/i18n/es.js',
        './node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
        './node_modules/cropit/dist/jquery.cropit.js',
        './node_modules/magnific-popup/dist/jquery.magnific-popup.js',
        './resources/assets/themes/admin/metronic/js/app.min.js',
        './resources/assets/themes/admin/metronic/js/layout.min.js',
        './resources/assets/themes/admin/metronic/js/admin.js'
    ], 'public/assets/admin/js/admin-plugins.js');

    // Fontawesome
    mix.copy('./node_modules/font-awesome/fonts', 'public/build/assets/admin/fonts');

    // TinyMCE
    mix.copy('resources/assets/plugins/tinymce/themes', 'public/build/assets/admin/js/themes');
    mix.copy('resources/assets/plugins/tinymce/skins', 'public/build/assets/admin/js/skins');
    mix.copy('resources/assets/plugins/tinymce/langs', 'public/build/assets/admin/js/langs');
    mix.copy('resources/assets/plugins/tinymce/plugins', 'public/build/assets/admin/js/plugins');

    // Colorpicker
    mix.copy('./node_modules/bootstrap-colorpicker/dist/img', 'public/build/assets/admin/img');
});

/********************************************
 * Themes
 *******************************************/
elixir.extend('themesDefault', function (mix) {
    mix.sass('./resources/assets/themes/web/default/sass/default.sass', 'public/themes/default/css');

    mix.styles([
        './node_modules/font-awesome/css/font-awesome.css',
        './node_modules/magnific-popup/dist/magnific-popup.css',
        './node_modules/animate.css/animate.css'
    ], 'public/themes/default/css/app.css');

    mix.scripts([
         './node_modules/jquery/dist/jquery.js',
         './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
         './node_modules/magnific-popup/dist/jquery.magnific-popup.js',
         './node_modules/noty/js/noty/packaged/jquery.noty.packaged.js',
         './node_modules/js-cookie/src/js.cookie.js',
         './resources/assets/themes/web/default/js/app.js'
    ], 'public/themes/default/js/app.js');

    // Fontawesome
    mix.copy('./node_modules/font-awesome/fonts', 'public/build/themes/default/fonts');

    mix.copy('resources/assets/themes/web/default/images', 'public/themes/default/images');
});

/********************************************
 * Install
 *******************************************/
elixir.extend('install', function (mix) {
    mix.sass('install/install.sass', 'public/assets/install/css');

    mix.styles([
        './node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css'
    ], 'public/assets/install/css/install-plugins.css');

    mix.scripts([
        './node_modules/jquery/dist/jquery.js',
        './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
        './node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
        './node_modules/cropit/dist/jquery.cropit.js'
    ], 'public/assets/install/js/app.js');

    // Colorpicker
    mix.copy('./node_modules/bootstrap-colorpicker/dist/img', 'public/build/assets/install/img');
});

/********************************************
 * Execute
 *******************************************/
elixir(function (mix) {
    mix.global(mix);
    mix.admin(mix);
    mix.themesDefault(mix);
    mix.install(mix);

    mix.version([
        // Admin
        'assets/admin/css/metronic.css',
        'assets/admin/css/auth.css',
        'assets/admin/css/admin-plugins.css',
        'assets/admin/js/admin-plugins.js',

        // Themes
        // Default
        'themes/default/css/app.css',
        'themes/default/css/default.css',
        'themes/default/js/app.js',

        // Install
        'assets/install/css/install.css',
        'assets/install/css/install-plugins.css',
        'assets/install/js/app.js'
    ]);

    mix.browserSync({
        proxy: browserSyncUrl
    });
});
