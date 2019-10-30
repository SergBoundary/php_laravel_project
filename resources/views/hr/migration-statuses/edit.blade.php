@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\MigrationStatuses $menu, $title, $migrationStatusesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $countriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.migration-statuses.update', $migrationStatusesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.migration-statuses.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $migrationStatusesList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $migrationStatusesList->personal_card_id) selected @endif>
                                                {{ $personalCardsOption->personal_card }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Страна легального пребывания</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='{{ $migrationStatusesList->countries_id }}' id='country_id' type='text' placeholder="Страна легального пребывания" class="form-control" title='Страна легального пребывания' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" 
                                                @if($countriesOption->id == $migrationStatusesList->country_id) selected @endif>
                                                {{ $countriesOption->country }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='status_old'>Текущий статус пребывания</label>
                                    <input name='status_old' value='{{ $migrationStatusesList->status_old }}' id='status_old' type='text' maxlength="50" class="form-control" title='Текущий статус пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='status_new'>Новый статус пребывания</label>
                                    <input name='status_new' value='{{ $migrationStatusesList->status_new }}' id='status_new' type='text' maxlength="50" class="form-control" title='Новый статус пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='opening_reason'>Основание получения нового статуса</label>
                                    <input name='opening_reason' value='{{ $migrationStatusesList->opening_reason }}' id='opening_reason' type='text' maxlength="50" class="form-control" title='Основание получения нового статуса'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='submitted'>Дата подачи документов в орган легализации пребывания</label>
                                    <input name='submitted' value='{{ $migrationStatusesList->submitted }}' id='submitted' type='text' maxlength="50" class="form-control" title='Дата подачи документов в орган легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='incomplete'>Дата требования подать недостающие документы</label>
                                    <input name='incomplete' value='{{ $migrationStatusesList->incomplete }}' id='incomplete' type='text' maxlength="50" class="form-control" title='Дата требования подать недостающие документы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='decision_number'>Номер решения о легализации пребывания</label>
                                    <input name='decision_number' value='{{ $migrationStatusesList->decision_number }}' id='decision_number' type='text' maxlength="50" class="form-control" title='Номер решения о легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='decision_date'>Дата выдачи решения о легализации пребывания</label>
                                    <input name='decision_date' value='{{ $migrationStatusesList->decision_date }}' id='decision_date' type='text' maxlength="50" class="form-control" title='Дата выдачи решения о легализации пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_opening'>Дата открытия пребывания в стране</label>
                                    <input name='date_opening' value='{{ $migrationStatusesList->date_opening }}' id='date_opening' type='text' maxlength="50" class="form-control" title='Дата открытия пребывания в стране'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_closing'>Дата закрытия пребывания в стране</label>
                                    <input name='date_closing' value='{{ $migrationStatusesList->date_closing }}' id='date_closing' type='text' maxlength="50" class="form-control" title='Дата закрытия пребывания в стране'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='closing_reason'>Основание анулирования пребывания</label>
                                    <input name='closing_reason' value='{{ $migrationStatusesList->closing_reason }}' id='closing_reason' type='text' maxlength="50" class="form-control" title='Основание анулирования пребывания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.migration-statuses.show', $migrationStatusesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.migration-statuses.show', $migrationStatusesList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection