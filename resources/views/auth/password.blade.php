@extends('auth.base')

@section('content')
    <!-- BEGIN LOGIN -->
    <div class="content">
        <form class="login-form recovery-form" action="{{ route('auth::password_post') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <h3 class="form-title font-green">Cambiar contraseña</h3>

            <div class="alert alert-danger {{ $errors->any() ? '' : 'display-hide' }}">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}<br></span>
                @endforeach
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Contraseña</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Contraseña" name="password" />
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Repita la contraseña</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Repita la contraseña" name="password_confirmation" />
            </div>

            <div class="form-actions center">
                <button type="submit" class="btn btn-primary uppercase">Cambiar contraseña</button>
            </div>
        </form>
    </div>
@stop