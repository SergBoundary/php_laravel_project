@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCitizenship $menu, $title, $personalCitizenshipList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $countriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-citizenship.update', $personalCitizenshipList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-citizenship.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $personalCitizenshipList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $personalCitizenshipList->personal_card_id) selected @endif>
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
                                    <label for='country_id'>Страна</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='{{ $personalCitizenshipList->countries_id }}' id='country_id' type='text' placeholder="Страна" class="form-control" title='Страна' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" 
                                                @if($countriesOption->id == $personalCitizenshipList->country_id) selected @endif>
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
                                    <label for='start'>Дата вступления</label>
                                    <input name='start' value='{{ $personalCitizenshipList->start }}' id='start' type='text' maxlength="50" class="form-control" title='Дата вступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата выхода</label>
                                    <input name='expiry' value='{{ $personalCitizenshipList->expiry }}' id='expiry' type='text' maxlength="50" class="form-control" title='Дата выхода'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-citizenship.show', $personalCitizenshipList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-citizenship.show', $personalCitizenshipList->id) }}">{{ __('Отмена') }}</a>
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