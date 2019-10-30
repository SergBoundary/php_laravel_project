@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\TaxRecipients $menu, $title, $taxRecipientsList
         * @var \Illuminate\Database\Eloquent $countriesList, $districtsList, $regionsList, $citiesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.tax-recipients.update', $taxRecipientsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.tax-recipients.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Название страны</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='{{ $taxRecipientsList->countries_id }}' id='country_id' type='text' placeholder="Название страны" class="form-control" title='Название страны' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" 
                                                @if($countriesOption->id == $taxRecipientsList->country_id) selected @endif>
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
                                    <label for='district_id'>Название области</label>
                                    <div class="input-group mb-3"
>                                        <select name='district_id' value='{{ $taxRecipientsList->districts_id }}' id='district_id' type='text' placeholder="Название области" class="form-control" title='Название области' required>
                                            @foreach($districtsList as $districtsOption)
                                            <option value="{{ $districtsOption->id }}" 
                                                @if($districtsOption->id == $taxRecipientsList->district_id) selected @endif>
                                                {{ $districtsOption->district }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.districts.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='region_id'>Название района</label>
                                    <div class="input-group mb-3"
>                                        <select name='region_id' value='{{ $taxRecipientsList->regions_id }}' id='region_id' type='text' placeholder="Название района" class="form-control" title='Название района' required>
                                            @foreach($regionsList as $regionsOption)
                                            <option value="{{ $regionsOption->id }}" 
                                                @if($regionsOption->id == $taxRecipientsList->region_id) selected @endif>
                                                {{ $regionsOption->region }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.regions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='city_id'>Населенный пунк</label>
                                    <div class="input-group mb-3"
>                                        <select name='city_id' value='{{ $taxRecipientsList->cities_id }}' id='city_id' type='text' placeholder="Населенный пунк" class="form-control" title='Населенный пунк' required>
                                            @foreach($citiesList as $citiesOption)
                                            <option value="{{ $citiesOption->id }}" 
                                                @if($citiesOption->id == $taxRecipientsList->city_id) selected @endif>
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
                                    <label for='title'>Получатель подоходного налога</label>
                                    <input name='title' value='{{ $taxRecipientsList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Получатель подоходного налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-recipients.show', $taxRecipientsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-recipients.show', $taxRecipientsList->id) }}">{{ __('Отмена') }}</a>
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