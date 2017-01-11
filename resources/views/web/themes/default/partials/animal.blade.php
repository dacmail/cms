<div class="animal-block">
	<a href="{{ route('web::animals::show', ['id' => $animal->id]) }}">
		<img src="{{ $animal->photos[0]->thumbnail_url or Theme::url('images/animal-default.jpg') }}" alt="Foto de {{ $animal->name }}">
		<div class="animal-content">
			<h5>{{ $animal->name }}</h5>
			<p>
				{{ trans_choice('animals.gender.' . $animal->gender, 1) }}<br>
				{{ $animal->birthDateDiffForHumans() }}<br>
				{{ trans_choice('animals.status.' . $animal->status, 1) }}
			</p>
		</div>
	</a>
</div>