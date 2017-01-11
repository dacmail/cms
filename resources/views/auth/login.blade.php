@extends('auth.base')

@section('content')
<!-- BEGIN LOGIN -->
<div class="content">
    <form class="login-form" action="{{ route('auth::login_post', ['to' => route('admin::panel::index')]) }}" method="post">
        {{ csrf_field() }}
        <h3 class="form-title font-green">Acceder al panel</h3>

        @if (env('PROTECMS_ENV') == 'demo')
            <p class="bg-info text-center">Bienvenido a la demo del panel de administración. Haz clic en acceder para entrar al panel.</p>
        @endif

        <div class="alert alert-danger {{ $errors->any() ? '' : 'display-hide' }}">
            @foreach ($errors->all() as $error)
                <span>{{ $error }}<br></span>
            @endforeach
        </div>

        <div class="alert alert-success text-center {{ session('password') ? '' : 'display-hide' }}">
            La contraseña se ha modificado correctamente.
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Correo electrónico</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="Correo electrónico" name="email" value="{{ env('PROTECMS_ENV') == 'demo' ? 'web@protecms.com' : '' }}" />
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Contraseña" name="password" value="{{ env('PROTECMS_ENV') == 'demo' ? 'admin' : '' }}" />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary uppercase">Acceder</button>
            <a href="{{ route('auth::recovery') }}" id="forget-password" class="forget-password">Recuperar cuenta</a>
        </div>

        {{--<div class="login-options">--}}
            {{--<h4>O acceder con</h4>--}}
            {{--<div class="social-icons">--}}
                {{--<a href="javascript:;" class="btn btn-default"><i class="fa fa-facebook"></i></a>--}}
                {{--<a href="javascript:;" class="btn btn-default"><i class="fa fa-google"></i></a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </form>
</div>
@stop