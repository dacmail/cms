@if ($web->hasConfig('themes.default.favicon'))
    @if (ends_with($web->getConfig('themes.default.favicon'), '.png'))
        <link type="image/png" href="{{ route('web::image', ['file' => $web->getConfig('themes.default.favicon')]) }}" rel="icon" />
    @elseif (ends_with($web->getConfig('themes.default.favicon'), '.ico'))
        <link type="image/x-icon" href="{{ route('web::image', ['file' => $web->getConfig('themes.default.favicon')]) }}" rel="icon" />
    @else
        <link type="image/jpeg" href="{{ route('web::image', ['file' => $web->getConfig('themes.default.favicon')]) }}" rel="icon" />
    @endif
@else
    <link type="image/png" href="favicon.png" rel="icon" />
@endif