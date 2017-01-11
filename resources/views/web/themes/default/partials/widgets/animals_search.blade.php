@php

$animals_search_status = $web->animals()->select('status')->groupBy('status')->pluck('status')->toArray();
$animals_search_kind = $web->animals()->select('kind')->groupBy('kind')->pluck('kind')->toArray();
$animals_search_gender = $web->animals()->select('gender')->groupBy('gender')->pluck('gender')->toArray();

@endphp

<div class="row">
    <div class="col-md-10 col-xs-10 col-md-offset-1 col-xs-offset-1">
        <form action="{{ route('web::animals::index') }}" class="form">

            <div class="form-group">
                <label for="" class="control-label">Nombre</label>
                <input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ Request::get('name') }}">
            </div>

            <div class="form-group">
                <label for="" class="control-label">Estado</label>
                <select name="status" class="form-control">
                    <option value="">-- Seleccione --</option>
                    @foreach(config('protecms.animals.status') as $status)
                        @if (in_array($status, $animals_search_status))
                            <option value="{{ $status }}" {{ Request::get('status') == $status ? 'selected' : '' }}>{{ trans_choice('animals.status.' . $status, 1) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Especie</label>
                <select name="kind" class="form-control">
                    <option value="">-- Seleccione --</option>
                    @foreach(config('protecms.animals.kind') as $kind)
                        @if (in_array($kind, $animals_search_kind))
                            <option value="{{ $kind }}" {{ Request::get('kind') == $kind ? 'selected' : '' }}>{{ trans_choice('animals.kind.' . $kind, 1) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Género</label>
                <select name="gender" class="form-control">
                    <option value="">-- Seleccione --</option>
                    @foreach(config('protecms.animals.gender') as $gender)
                        @if (in_array($gender, $animals_search_gender))
                            <option value="{{ $gender }}" {{ Request::get('gender') == $gender ? 'selected' : '' }}>{{ trans_choice('animals.gender.' . $gender, 1) }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Edad</label>
                <select name="birth_date" class="form-control">
                    <option value="">-- Seleccione --</option>
                    <option value="{{ Carbon::now()->subMonths(6)->format('Y/m/d') . ' - ' . Carbon::now()->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subMonths(6)->format('Y/m/d') . ' - ' . Carbon::now()->format('Y/m/d') ? 'selected' : '' }}>< 6 meses</option>
                    <option value="{{ Carbon::now()->subMonths(12)->format('Y/m/d') . ' - ' . Carbon::now()->subMonths(6)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subMonths(12)->format('Y/m/d') . ' - ' . Carbon::now()->subMonths(6)->format('Y/m/d') ? 'selected' : '' }}>De 6 a 12 meses</option>
                    <option value="{{ Carbon::now()->subYears(3)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(1)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subYears(3)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(1)->format('Y/m/d') ? 'selected' : '' }}>De 1 a 3 años</option>
                    <option value="{{ Carbon::now()->subYears(5)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(3)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subYears(5)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(3)->format('Y/m/d') ? 'selected' : '' }}>De 3 a 5 años</option>
                    <option value="{{ Carbon::now()->subYears(7)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(5)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subYears(7)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(5)->format('Y/m/d') ? 'selected' : '' }}>De 5 a 7 años</option>
                    <option value="{{ Carbon::now()->subYears(10)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(7)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subYears(10)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(7)->format('Y/m/d') ? 'selected' : '' }}>De 7 a 10 años</option>
                    <option value="{{ Carbon::now()->subYears(1000)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(10)->format('Y/m/d') }}" {{ Request::get('birth_date') == Carbon::now()->subYears(1000)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(10)->format('Y/m/d') ? 'selected' : '' }}> > 10 años</option>
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-default btn-block">Buscar</button>
            </div>

        </form>
    </div>
</div>