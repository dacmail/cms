const elixir = require('laravel-elixir'),
      gulp = require('gulp')

/********************************************
 * Config
 *******************************************/
const browserSyncUrl = 'apaexoticos.protecms.dev'

/********************************************
 * Global
 *******************************************/

/********************************************
 * Admin
 *******************************************/
elixir.extend('admin', function (mix) {
    mix.sass('metronic/metronic.scss', 'public/assets/admin/css')
    mix.sass('auth.sass', 'public/assets/admin/css')

    mix.styles([
        './resources/assets/plugins/font-awesome/css/font-awesome.css',
        './resources/assets/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        './resources/assets/plugins/select2/css/select2.min.css',
        './resources/assets/plugins/datetimepicker/jquery.datetimepicker.css',
        './resources/assets/plugins/fullcalendar/fullcalendar.css',
        './resources/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
        './resources/assets/plugins/cropper/cropper.min.css',
        './resources/assets/plugins/animate.css',
        './resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.css'
    ], 'public/assets/admin/css/admin-plugins.css')

    mix.scripts([
        './resources/assets/plugins/jquery.min.js',
        './resources/assets/plugins/bootstrap/js/bootstrap.min.js',
        './resources/assets/plugins/js.cookie.min.js',
        './resources/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        './resources/assets/plugins/jquery.blockui.min.js',
        './resources/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        './resources/assets/plugins/tinymce/tinymce.min.js',
        './resources/assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js',
        './resources/assets/plugins/moment-with-locales.min.js',
        './resources/assets/plugins/dropzone.js',
        './resources/assets/plugins/fullcalendar/fullcalendar.js',
        './resources/assets/plugins/fullcalendar/locale-all.js',
        './resources/assets/plugins/highcharts/highcharts.js',
        './resources/assets/plugins/highcharts/themes/grid-light.js',
        './resources/assets/plugins/jquery.noty.packaged.min.js',
        './resources/assets/plugins/jquery.slugify.js',
        './resources/assets/plugins/jquery.confirm.min.js',
        './resources/assets/plugins/bootstrap-daterangepicker/daterangepicker.js',
        './resources/assets/plugins/select2/js/select2.full.js',
        './resources/assets/plugins/select2/js/i18n/es.js',
        './resources/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
        './resources/assets/plugins/jquery.cropit.js',
        './resources/assets/plugins/metronic/app.min.js',
        './resources/assets/plugins/metronic/layout.min.js',
        './resources/assets/protecms/admin.js'
    ], 'public/assets/admin/js/admin-plugins.js')

    mix.copy('resources/assets/fonts', 'public/assets/fonts')
    mix.copy('resources/assets/images', 'public/assets/images')

    // TinyMCE
    mix.copy('resources/assets/plugins/tinymce/themes', 'public/build/assets/admin/js/themes')
    mix.copy('resources/assets/plugins/tinymce/skins', 'public/build/assets/admin/js/skins')
    mix.copy('resources/assets/plugins/tinymce/langs', 'public/build/assets/admin/js/langs')
    mix.copy('resources/assets/plugins/tinymce/plugins', 'public/build/assets/admin/js/plugins')

    // Colorpicker
    mix.copy('resources/assets/plugins/bootstrap-colorpicker/img', 'public/build/assets/admin/img')
})

/********************************************
 * Themes
 *******************************************/
elixir.extend('themesDefault', function (mix) {
    mix.sass('themes/default.sass', 'public/themes/default/css')

    mix.styles([
        './resources/assets/plugins/font-awesome/css/font-awesome.css',
        './resources/assets/plugins/magnific-popup/magnific-popup.css',
        './resources/assets/plugins/animate.css'
    ], 'public/themes/default/css/app.css')

    mix.scripts([
         './resources/assets/plugins/jquery.min.js',
         './resources/assets/plugins/bootstrap/js/bootstrap.min.js',
         './resources/assets/plugins/magnific-popup/jquery.magnific-popup.js',
         './resources/assets/plugins/jquery.noty.packaged.min.js',
         './resources/assets/plugins/js.cookie.min.js',
         './resources/assets/themes/default/js/app.js'
    ], 'public/themes/default/js/app.js')

    mix.copy('resources/assets/themes/default/images', 'public/themes/default/images')
    mix.copy('resources/assets/themes/default/css/bradius.css', 'public/themes/default/css/bradius.css')
    mix.copy('resources/assets/themes/default/css/default.php', 'public/themes/default/css/default.php')
})

/********************************************
 * Install
 *******************************************/
elixir.extend('install', function (mix) {
    mix.sass('install.sass', 'public/assets/install/css')

    mix.styles([
        './resources/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css'
    ], 'public/assets/install/css/install-plugins.css')

    mix.scripts([
        './resources/assets/plugins/jquery.min.js',
        './resources/assets/plugins/bootstrap/js/bootstrap.min.js',
        './resources/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
        './resources/assets/plugins/jquery.cropit.js'
    ], 'public/assets/install/js/app.js')

    // Colorpicker
    mix.copy('resources/assets/plugins/bootstrap-colorpicker/img', 'public/build/assets/install/img')
})

/********************************************
 * Execute
 *******************************************/
elixir(function (mix) {
    mix.admin(mix)
    mix.themesDefault(mix)
    mix.install(mix)

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
    ])

    mix.browserSync({
        proxy: browserSyncUrl
    })
})
