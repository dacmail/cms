<div class="form">
    @if (! isset($post) && ! isset($page))
        <h3><a href="{{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}">{{ $form->title }}</a></h3>
    @endif
    <div class="form-content">
        {!! $form->text !!}
    </div>

    <form action="{{ route('web::forms::send', ['id' => $form->id]) }}" method="POST" class="margin-top-50 form" role="form">
        {{ csrf_field() }}
        <div class="form-group text-right">
            <small>Todos los campos con * son obligatorios</small>
        </div>
        @foreach ($form->fields()->orderBy('order')->get() as $field)
            <div class="form-group {{ $errors->has($field->name) ? 'has-error' : '' }}">
                <label class="control-label">{{ $field->required ? '*' : '' }} {{ $field->title }}</label>
                <span class="help-block">{{ $errors->first($field->name) }}</span>
                @if ($field->type == 'text')
                    <input type="text" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required="required"' : '' }}">
                @elseif ($field->type == 'password')
                    <input type="password" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required="required"' : '' }}">
                @elseif ($field->type == 'email')
                    <input type="email" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required="required"' : '' }}">
                 @elseif ($field->type == 'date')
                    <input type="date" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required="required"' : '' }}">
                @elseif ($field->type == 'numeric')
                    <input type="number" name="{{ $field->name }}" class="form-control" {{ $field->required ? 'required="required"' : '' }}">
                @elseif ($field->type == 'textarea')
                    <textarea name="{{ $field->name }}" class="form-control" rows="10"></textarea>
                @endif
            </div>
        @endforeach

        <div class="col-md-4" style="margin-bottom: 40px">
            @include('partials.captcha')
        </div>

        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <button type="submit" class="btn btn-default btn-block">Enviar</button>
                </div>
            </div>
        </div>

    </form>
</div>

@if (! isset($post) && ! isset($page))
    <div class="clearfix"></div>
    <div class="post-bottom row">
        <div class="post-data col-md-4 col-xs-5">
            <p>
                <br>
                <i class="fa fa-user"></i> {{ $form->author->name }}<br>
                <i class="fa fa-clock-o"></i> {{ $form->created_at->format('d-m-Y') }}
            </p>
        </div>
        <div class="post-share col-md-8 col-xs-7">
            <p>¡Comparte!</p>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}"><i class="fa fa-facebook-square"></i></a>
            <a href="https://twitter.com/home?status={{ str_limit($form->title, 120, '...') }} - {{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}"><i class="fa fa-twitter-square"></i></a>
            <a href="http://pinterest.com/pin/create/link/?url={{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}"><i class="fa fa-pinterest-square"></i></a>
            <a href="https://plus.google.com/share?url={{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}"><i class="fa fa-google-plus-square"></i></a>
            <a href="mailto:?&subject={{ $form->title }}&body=Echa un vistazo a este enlace: {{ route('web::forms::show', ['id' => $form->id, 'slug' => $form->slug]) }}"><i class="fa fa-envelope-square"></i></a>
        </div>
    </div>
@endif