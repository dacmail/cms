@if (count(explode(',', $web->getConfig('langs'))))
    <div class="widget-langs" style="text-align: center">
        @foreach(explode(',', $web->getConfig('langs')) as $lang)
            <a href=""><img src="/assets/images/flags/{{ $lang }}.png" width="20" alt=""></a>
        @endforeach
    </div>
@endif