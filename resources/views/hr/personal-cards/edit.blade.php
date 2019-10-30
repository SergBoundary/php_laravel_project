@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards $menu, $title, $personalCardsList
         * @var \Illuminate\Database\Eloquent $nationalitiesList, $citiesList, $regionsList, $districtsList, $countriesList, $maritalStatusesList, $clothingSizesList, $shoeSizesList, $disabilitiesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-cards.update', $personalCardsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-cards.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <input name='photo_url' value='{{ $personalCardsList->surname }}' src="{{ $personalCardsList->photo_url }}" id='photo_url' type='image' class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-auto">
                                                <label for='surname' class="col-form-label col-form-label-sm">Фамилия</label>
                                                <input name='surname' value='{{ $personalCardsList->surname }}' id='surname' type='text' maxlength="50" class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class="col-md-auto">
                                                <label for='first_name' class="col-form-label col-form-label-sm">Имя</label>
                                                <input name='first_name' value='{{ $personalCardsList->first_name }}' id='first_name' type='text' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-auto">
                                                <label for='second_name' class="col-form-label col-form-label-sm">Отчество</label>
                                                <input name='second_name' value='{{ $personalCardsList->second_name }}' id='first_name' type='text' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardsList->personal_account }}' id='first_name' type='text' maxlength="50" class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-5">
                                                <label for='full_name_latina' class="col-form-label col-form-label-sm">Фамилия и имя латиницей</label>
                                                <input name='full_name_latina' value='{{ $personalCardsList->full_name_latina }}' id='surname' type='text' maxlength="50" class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='tax_number' class="col-form-label col-form-label-sm">Налоговый номер</label>
                                                <input name='tax_number' value='{{ $personalCardsList->tax_number }}' id='tax_number' type='text' maxlength="15" class="form-control form-control-sm" size="5" title='Индивидуальный налоговый номер'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $personalCardsList->sex }}' id='sex' type='text' maxlength="50" class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-auto'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardsList->born_date }}' id='born_date' type='date' maxlength="50" class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                            <div class='col-md-6'>
                                                <label for='nationality_id' class="col-form-label col-form-label-sm">Национальность</label>
                                                <div class="input-group mb-3">
                                                    <select name='nationality_id' value='{{ $personalCardsList->nationalities_id }}' id='nationality_id' type='text' placeholder="Национальность" class="form-control form-control-sm" title='Национальность' required>
                                                        @foreach($nationalitiesList as $nationalitiesOption)
                                                        <option value="{{ $nationalitiesOption->id }}" 
                                                            @if($nationalitiesOption->id == $personalCardsList->nationality_id) selected @endif>
                                                            {{ $nationalitiesOption->nationality }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.nationalities.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='form-group col-md-4'>
                                                <label for='born_country_id' class="col-form-label col-form-label-sm">Страна рождения</label>
                                                <div class="input-group mb-3">
                                                    <select name='born_country_id' value='{{ $personalCardsList->countries_id }}' id='born_country_id' type='text' placeholder="Страна рождения" class="form-control form-control-sm" title='Страна рождения' required>
                                                        @foreach($countriesList as $countriesOption)
                                                        <option value="{{ $countriesOption->id }}" 
                                                            @if($countriesOption->id == $personalCardsList->born_country_id) selected @endif>
                                                            {{ $countriesOption->born_country }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.countries.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-4'>
                                                <label for='born_district_id' class="col-form-label col-form-label-sm">Область рождения</label>
                                                <div class="input-group mb-3">
                                                    <select name='born_district_id' value='{{ $personalCardsList->districts_id }}' id='born_district_id' type='text' placeholder="Область рождения" class="form-control form-control-sm" title='Область рождения' required>
                                                        @foreach($districtsList as $districtsOption)
                                                        <option value="{{ $districtsOption->id }}" 
                                                            @if($districtsOption->id == $personalCardsList->born_district_id) selected @endif>
                                                            {{ $districtsOption->born_district }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.districts.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-4'>
                                                <label for='born_city_id' class="col-form-label col-form-label-sm">Город рождения</label>
                                                <div class="input-group mb-3">
                                                    <select name='born_city_id' value='{{ $personalCardsList->cities_id }}' id='born_city_id' type='text' placeholder="Город рождения" class="form-control form-control-sm" title='Город рождения' required>
                                                        @foreach($citiesList as $citiesOption)
                                                        <option value="{{ $citiesOption->id }}" 
                                                            @if($citiesOption->id == $personalCardsList->born_city_id) selected @endif>
                                                            {{ $citiesOption->born_city }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.cities.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-auto'>
                                                <label for='marital_status_id' class="col-form-label col-form-label-sm">Семейное положение</label>
                                                <div class="input-group mb-3">
                                                    <select name='marital_status_id' value='{{ $personalCardsList->marital_statuses_id }}' id='marital_status_id' type='text' placeholder="Семейное положение" class="form-control form-control-sm" title='Семейное положение' required>
                                                        @foreach($maritalStatusesList as $maritalStatusesOption)
                                                        <option value="{{ $maritalStatusesOption->id }}" 
                                                            @if($maritalStatusesOption->id == $personalCardsList->marital_status_id) selected @endif>
                                                            {{ $maritalStatusesOption->marital_status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.marital-statuses.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-auto'>
                                                <label for='clothing_size_id' class="col-form-label col-form-label-sm">Размер одежды</label>
                                                <div class="input-group mb-3">
                                                    <select name='clothing_size_id' value='{{ $personalCardsList->clothing_sizes_id }}' id='clothing_size_id' type='text' placeholder="Размер одежды" class="form-control form-control-sm" title='Размер одежды' required>
                                                        @foreach($clothingSizesList as $clothingSizesOption)
                                                        <option value="{{ $clothingSizesOption->id }}" 
                                                            @if($clothingSizesOption->id == $personalCardsList->clothing_size_id) selected @endif>
                                                            {{ $clothingSizesOption->clothing_size }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.clothing-sizes.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-auto'>
                                                <label for='shoe_size_id' class="col-form-label col-form-label-sm">Размер обуви</label>
                                                <div class="input-group mb-3">
                                                    <select name='shoe_size_id' value='{{ $personalCardsList->shoe_sizes_id }}' id='shoe_size_id' type='text' placeholder="Размер обуви" class="form-control form-control-sm" title='Размер обуви' required>
                                                        @foreach($shoeSizesList as $shoeSizesOption)
                                                        <option value="{{ $shoeSizesOption->id }}" 
                                                            @if($shoeSizesOption->id == $personalCardsList->shoe_size_id) selected @endif>
                                                            {{ $shoeSizesOption->shoe_size }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.shoe-sizes.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='form-group col-md-auto'>
                                            <button type="submit" class="btn btn-primary float-left btn-sm">
                                                {{ __('Сохранить') }}
                                            </button>
                                            @if(session('success'))
                                                <a class='btn btn-outline-secondary btn-sm' style="margin-left: 10px;" href="{{ route('hr.personal-cards.show', $personalCardsList->id) }}">{{ __('Закрыть') }}</a>
                                            @else
                                                <a class='btn btn-outline-secondary btn-sm' style="margin-left: 10px;" href="{{ route('hr.personal-cards.show', $personalCardsList->id) }}">{{ __('Отмена') }}</a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection