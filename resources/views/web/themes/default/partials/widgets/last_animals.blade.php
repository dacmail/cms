<div class="last-animals">
    <?php $last_animals = $web->animals()->where('visible', 'visible')->orderBy('created_at', 'DESC')->with(['photos' => function ($query) {
    $query->orderBy('main', 'DESC');
}])->orderBy('created_at')->take(5)->get(); ?>
    @if (count($last_animals))
        <br>
        @foreach ($last_animals as $animal)
            <div class="col-md-12 animal">
                <a href="{{ route('web::animals::show', ['id' => $animal->id]) }}">
                    <img src="{{ $animal->photos[0]->thumbnail_url or Theme::url('images/animal-default.jpg') }}" alt="Foto de {{ $animal->name }}" class="img-rounded">
                    <h5>{{ $animal->name }}</h5>
                    <p>
                        {{ $animal->birthDateDiffForHumans() }}<br>
                        {{ trans_choice('animals.status.' . $animal->status, 1) }}
                    </p>
                </a>
            </div>
            <div class="clearfix"></div>
        @endforeach
    @else
        <p class="bg-info text-center" style="margin: 10px">Aún no se han añadido animales.</p>
    @endif
</div>