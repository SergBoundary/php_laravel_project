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

                        <form method="POST" action="{{ route('ref.tax-recipients.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.tax-recipients.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Название страны</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='country_id' id='country_id' type='text' placeholder="Название страны" class="form-control" title='Название страны' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" >
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
>                                        <select name='district_id' value='district_id' id='district_id' type='text' placeholder="Название области" class="form-control" title='Название области' required>
                                            @foreach($districtsList as $districtsOption)
                                            <option value="{{ $districtsOption->id }}" >
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
>                                        <select name='region_id' value='region_id' id='region_id' type='text' placeholder="Название района" class="form-control" title='Название района' required>
                                            @foreach($regionsList as $regionsOption)
                                            <option value="{{ $regionsOption->id }}" >
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
>                                        <select name='city_id' value='city_id' id='city_id' type='text' placeholder="Населенный пунк" class="form-control" title='Населенный пунк' required>
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
                                    <label for='title'>Получатель подоходного налога</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Получатель подоходного налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-recipients.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.tax-recipients.index') }}">{{ __('Отмена') }}</a>
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