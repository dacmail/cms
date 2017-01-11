<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <link rel="stylesheet" href="">

    <style>
        @font-face {
            src: url('/assets/fonts/OpenSans-Regular.ttf');
            font-family: 'OpenSans';
            font-weight: normal;
        }

        @font-face {
            src: url('/assets/fonts/OpenSans-Light.ttf');
            font-family: 'OpenSans';
            font-weight: 100;
        }

        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            width: 100%;
            color: #fff;
            display: table;
            font-weight: 100;
            font-family: 'OpenSans';
            font-size: 18px;
            background: #25c2e6;
            background: repeating-linear-gradient(#25c2e6, #7ac2e6);
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 52px;
            margin-bottom: 40px;
        }

        a,
        a:visited {
            color: #fefefe;
        }

        .btn {
            padding: 10px 15px;
            border: 1px solid #ccc;
            color: #333 !important;
            border-radius: 10px;
            background-color: #eee;
            text-decoration: none;
        }

        @media all and (max-width: 1000px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">
            @yield('title')
        </div>

        @yield('content')
    </div>
</div>
</body>
</html>
