<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Acceso al panel | ProteCMS</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/admin/css/auth.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/admin/css/metronic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ elixir('assets/admin/css/admin-plugins.css') }}">
    <link rel="shortcut icon" href="/favicon.png" />
</head>
<!-- END HEAD -->

<body class=" login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <img src="/assets/images/logos/logo_white@0.75x.png" width="200px" alt="" />
    </div>
    <!-- END LOGO -->

        @yield('content')

    <div class="copyright"> {{ date('Y') }} © ProteCMS. Panel de Administración. </div>

    <script src="{{ elixir('assets/admin/js/admin-plugins.js') }}" type="text/javascript"></script>

    @include('partials.flash')
</body>

</html>