@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\VisaStatuses $menu, $title, $visaStatusesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $countriesList, $countriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.visa-statuses.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.visa-statuses.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='personal_card_id' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" >
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
                                    <label for='country_out_id'>Страна оформления визы</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_out_id' value='country_out_id' id='country_out_id' type='text' placeholder="Страна оформления визы" class="form-control" title='Страна оформления визы' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" >
                                                {{ $countriesOption->country_out }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_in_id'>Страна въезда</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_in_id' value='country_in_id' id='country_in_id' type='text' placeholder="Страна въезда" class="form-control" title='Страна въезда' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" >
                                                {{ $countriesOption->country_in }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='opening_reason'>Основание открытия визы</label>
                                    <input name='opening_reason' id='opening_reason' type='text' maxlength="50" class="form-control" title='Основание открытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='submitted'>Дата подачи документов в визовый орган</label>
                                    <input name='submitted' id='submitted' type='text' maxlength="50" class="form-control" title='Дата подачи документов в визовый орган'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='incomplete'>Дата требования недостающих документов</label>
                                    <input name='incomplete' id='incomplete' type='text' maxlength="50" class="form-control" title='Дата требования недостающих документов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visa_issued'>Дата выдачи визы</label>
                                    <input name='visa_issued' id='visa_issued' type='text' maxlength="50" class="form-control" title='Дата выдачи визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visa_type'>Тип визы</label>
                                    <input name='visa_type' id='visa_type' type='text' maxlength="50" class="form-control" title='Тип визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_opening'>Дата открытия визы</label>
                                    <input name='date_opening' id='date_opening' type='text' maxlength="50" class="form-control" title='Дата открытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_closing'>Дата закрытия визы</label>
                                    <input name='date_closing' id='date_closing' type='text' maxlength="50" class="form-control" title='Дата закрытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='closing_reason'>Основание закрытия визы</label>
                                    <input name='closing_reason' id='closing_reason' type='text' maxlength="50" class="form-control" title='Основание закрытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.visa-statuses.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.visa-statuses.index') }}">{{ __('Отмена') }}</a>
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