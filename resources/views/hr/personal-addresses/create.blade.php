@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalAddresses $menu, $title, $personalAddressesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $citiesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-addresses.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-addresses.includes.result_messages')
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
                                    <label for='city_id'>Город</label>
                                    <div class="input-group mb-3"
>                                        <select name='city_id' value='city_id' id='city_id' type='text' placeholder="Город" class="form-control" title='Город' required>
                                            @foreach($citiesList as $citiesOption)
                                            <option value="{{ $citiesOption->id }}" >
                                                {{ $citiesOption->city }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.cities.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='postcode'>Индекс</label>
                                    <input name='postcode' id='postcode' type='text' maxlength="50" class="form-control" title='Индекс'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='street'>Улица</label>
                                    <input name='street' id='street' type='text' maxlength="50" class="form-control" title='Улица'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='house'>Дом</label>
                                    <input name='house' id='house' type='text' maxlength="50" class="form-control" title='Дом'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='apartment'>Квартира</label>
                                    <input name='apartment' id='apartment' type='text' maxlength="50" class="form-control" title='Квартира'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-addresses.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-addresses.index') }}">{{ __('Отмена') }}</a>
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