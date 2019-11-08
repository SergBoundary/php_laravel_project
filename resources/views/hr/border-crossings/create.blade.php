@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\BorderCrossings $menu, $title, $borderCrossingsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $countriesList, $countriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.border-crossings.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.border-crossings.includes.result_messages')
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
                                    <label for='country_out_id'>Страна выезда</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_out_id' value='country_out_id' id='country_out_id' type='text' placeholder="Страна выезда" class="form-control" title='Страна выезда' required>
                                            @foreach($countriesOutList as $countriesOutOption)
                                            <option value="{{ $countriesOutOption->id }}" >
                                                {{ $countriesOutOption->country_out }}
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
                                            @foreach($countriesInList as $countriesInOption)
                                            <option value="{{ $countriesInOption->id }}" >
                                                {{ $countriesInOption->country_in }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата пересечения</label>
                                    <input name='date' id='date' type='text' maxlength="50" class="form-control" title='Дата пересечения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' id='comment' type='text' maxlength="50" class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.border-crossings.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.border-crossings.index') }}">{{ __('Отмена') }}</a>
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