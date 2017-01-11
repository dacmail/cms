@extends('auth.base')

@section('content')
    <!-- BEGIN LOGIN -->
    <div class="content">
        <form class="login-form recovery-form" action="{{ route('auth::recovery_post') }}" method="post">
            {{ csrf_field() }}
            <h3 class="form-title font-green">Recuperar cuenta</h3>

            <div class="alert alert-danger {{ $errors->any() ? '' : 'display-hide' }}">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}<br></span>
                @endforeach
            </div>

            <div class="alert alert-info text-center {{ $errors->any() || session('recovery') ? 'display-hide' : '' }}">
                <p>Para recuperar su cuenta escriba su correo electrónico.</p>
                <p>Una vez haya enviado el formulario recibirá a su buzón los pasos a seguir para recuperar la cuenta.</p>
            </div>

            <div class="alert alert-success text-center {{ session('recovery') ? '' : 'display-hide' }}">
                <p>Se ha enviado un correo a su buzón. Revíselo y siga las instrucciones para recuperar su cuenta.</p>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Correo electrónico</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="Correo electrónico" name="email" />
            </div>

            <div class="form-actions center">
                <button type="submit" class="btn btn-primary uppercase">Recuperar</button>
            </div>
        </form>
        <p class="text-center">Para volver al formulario de acceso haz clic <a href="{{ route('auth::login') }}">aquí</a></p>
    </div>
@stop