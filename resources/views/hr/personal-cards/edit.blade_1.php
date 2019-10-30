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
                                    <a href="">
                                    <img src="{{ $personalCardsList->photo_url }}" alt="..." class="img-thumbnail mr-3">
                                    </a>
                                    <input name='photo_url' value='{{ $personalCardsList->surname }}' id='photo_url' type='hidden'>
                                    <div class="media-body">
                                        <div class='form-group col-md-auto'>
                                            <label for='surname'>Фамилия</label>
                                            <input name='surname' value='{{ $personalCardsList->surname }}' id='surname' type='text' maxlength="50" class="form-control" title='Фамилия'>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='first_name'>Имя (первое имя)</label>
                                            <input name='first_name' value='{{ $personalCardsList->first_name }}' id='first_name' type='text' maxlength="50" class="form-control" title='Имя (первое имя)'>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='second_name'>Отчество (второе имя)</label>
                                            <input name='second_name' value='{{ $personalCardsList->second_name }}' id='first_name' type='text' maxlength="50" class="form-control" title='Имя (первое имя)'>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='full_name_latina'>Имя и фамилия латиницей</label>
                                            <input name='full_name_latina' value='{{ $personalCardsList->full_name_latina }}' id='first_name' type='text' maxlength="50" class="form-control" title='Имя (первое имя)'>
                                        </div>
                                        <div class="row col-md-auto">
                                            <div class='form-group col-md-4'>
                                                <label for='personal_account'>Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardsList->personal_account }}' id='personal_account' type='text' maxlength="15" class="form-control" title='Табельный номер'>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                <label for='born_date'>Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardsList->born_date }}' id='born_date' type='date' maxlength="50" class="form-control" title='Дата рождения'>
                                            </div>
                                            <div class='form-group col-md-2'>
                                                <label for='sex'>Пол</label>
                                                <input name='sex' value='{{ $personalCardsList->sex }}' id='sex' type='text' maxlength="50" class="form-control" title='Пол'>
                                            </div>
                                        </div>
                                        <div class="row col-md-auto">
                                            <div class='form-group col-md-6'>
                                                <label for='nationality_id'>Национальность</label>
                                                <div class="input-group mb-3">                                        <select name='nationality_id' value='{{ $personalCardsList->nationalities_id }}' id='nationality_id' type='text' placeholder="Национальность" class="form-control" title='Национальность' required>
                                                        @foreach($nationalitiesList as $nationalitiesOption)
                                                        <option value="{{ $nationalitiesOption->id }}" 
                                                            @if($nationalitiesOption->id == $personalCardsList->nationality_id) selected @endif>
                                                            {{ $nationalitiesOption->nationality }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary" href="{{ route('ref.nationalities.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-6'>
                                                <label for='marital_status_id'>Семейное положение</label>
                                                <div class="input-group mb-3">
                                                    <select name='marital_status_id' value='{{ $personalCardsList->marital_statuses_id }}' id='marital_status_id' type='text' placeholder="Семейное положение" class="form-control" title='Семейное положение' required>
                                                        @foreach($maritalStatusesList as $maritalStatusesOption)
                                                        <option value="{{ $maritalStatusesOption->id }}" 
                                                            @if($maritalStatusesOption->id == $personalCardsList->marital_status_id) selected @endif>
                                                            {{ $maritalStatusesOption->marital_status }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary" href="{{ route('ref.marital-statuses.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='born_country_id'>Страна рождения</label>
                                            <div class="input-group mb-3"
        >                                        <select name='born_country_id' value='{{ $personalCardsList->countries_id }}' id='born_country_id' type='text' placeholder="Страна рождения" class="form-control" title='Страна рождения' required>
                                                    @foreach($countriesList as $countriesOption)
                                                    <option value="{{ $countriesOption->id }}" 
                                                        @if($countriesOption->id == $personalCardsList->born_country_id) selected @endif>
                                                        {{ $countriesOption->born_country }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='born_district_id'>Область рождения</label>
                                            <div class="input-group mb-3"
        >                                        <select name='born_district_id' value='{{ $personalCardsList->districts_id }}' id='born_district_id' type='text' placeholder="Область рождения" class="form-control" title='Область рождения' required>
                                                    @foreach($districtsList as $districtsOption)
                                                    <option value="{{ $districtsOption->id }}" 
                                                        @if($districtsOption->id == $personalCardsList->born_district_id) selected @endif>
                                                        {{ $districtsOption->born_district }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-secondary" href="{{ route('ref.districts.create') }}">Добавить</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='born_region_id'>Район рождения</label>
                                            <div class="input-group mb-3"
        >                                        <select name='born_region_id' value='{{ $personalCardsList->regions_id }}' id='born_region_id' type='text' placeholder="Район рождения" class="form-control" title='Район рождения' required>
                                                    @foreach($regionsList as $regionsOption)
                                                    <option value="{{ $regionsOption->id }}" 
                                                        @if($regionsOption->id == $personalCardsList->born_region_id) selected @endif>
                                                        {{ $regionsOption->born_region }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-secondary" href="{{ route('ref.regions.create') }}">Добавить</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-auto'>
                                            <label for='born_city_id'>Город рождения</label>
                                            <div class="input-group mb-3"
        >                                        <select name='born_city_id' value='{{ $personalCardsList->cities_id }}' id='born_city_id' type='text' placeholder="Город рождения" class="form-control" title='Город рождения' required>
                                                    @foreach($citiesList as $citiesOption)
                                                    <option value="{{ $citiesOption->id }}" 
                                                        @if($citiesOption->id == $personalCardsList->born_city_id) selected @endif>
                                                        {{ $citiesOption->born_city }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-secondary" href="{{ route('ref.cities.create') }}">Добавить</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-auto">
                                            <div class='form-group col-md-5'>
                                                <label for='clothing_size_id'>Размер одежды</label>
                                                <div class="input-group mb-3">
                                                    <select name='clothing_size_id' value='{{ $personalCardsList->clothing_sizes_id }}' id='clothing_size_id' type='text' placeholder="Размер одежды" class="form-control" title='Размер одежды' required>
                                                        @foreach($clothingSizesList as $clothingSizesOption)
                                                        <option value="{{ $clothingSizesOption->id }}" 
                                                            @if($clothingSizesOption->id == $personalCardsList->clothing_size_id) selected @endif>
                                                            {{ $clothingSizesOption->clothing_size }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary" href="{{ route('ref.clothing-sizes.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='form-group col-md-5'>
                                                <label for='shoe_size_id'>Размер обуви</label>
                                                <div class="input-group mb-3">
                                                    <select name='shoe_size_id' value='{{ $personalCardsList->shoe_sizes_id }}' id='shoe_size_id' type='text' placeholder="Размер обуви" class="form-control" title='Размер обуви' required>
                                                        @foreach($shoeSizesList as $shoeSizesOption)
                                                        <option value="{{ $shoeSizesOption->id }}" 
                                                            @if($shoeSizesOption->id == $personalCardsList->shoe_size_id) selected @endif>
                                                            {{ $shoeSizesOption->shoe_size }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <a class="btn btn-outline-secondary" href="{{ route('ref.shoe-sizes.create') }}">Добавить</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='disability_id'>Группа инвалидности</label>
                                            <div class="input-group mb-3">
                                                <select name='disability_id' value='{{ $personalCardsList->disabilities_id }}' id='disability_id' type='text' placeholder="Группа инвалидности" class="form-control" title='Группа инвалидности' required>
                                                    @foreach($disabilitiesList as $disabilitiesOption)
                                                    <option value="{{ $disabilitiesOption->id }}" 
                                                        @if($disabilitiesOption->id == $personalCardsList->disability_id) selected @endif>
                                                        {{ $disabilitiesOption->disability }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a class="btn btn-outline-secondary" href="{{ route('ref.disabilities.create') }}">Добавить</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='tax_number'>Индивидуальный налоговый номер</label>
                                            <input name='tax_number' value='{{ $personalCardsList->tax_number }}' id='tax_number' type='text' maxlength="50" class="form-control" title='Индивидуальный налоговый номер'>
                                        </div>
                                        <div class="form-group form-check">
                                            <label class="form-check-label" for="union_member">Членство в профсоюзе</label>
                                            <input type="union_member" class="form-check-input" id="union_member">
                                        </div>
                                        <div class="form-group form-check">
                                            <label class="form-check-label" for="disability">Наличие инвалидости</label>
                                            <input type="disability" class="form-check-input" id="disability">
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='union_member'>Членство в профсоюзе</label>
                                            <input name='union_member' value='{{ $personalCardsList->union_member }}' id='union_member' type='text' maxlength="50" class="form-control" title='Членство в профсоюзе'>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='disability'>Наличие инвалидости</label>
                                            <input name='disability' value='{{ $personalCardsList->disability }}' id='disability' type='text' maxlength="50" class="form-control" title='Наличие инвалидости'>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='pension_date'>Дата выхода на пенсию</label>
                                            <input name='pension_date' value='{{ $personalCardsList->pension_date }}' id='pension_date' type='date' maxlength="50" class="form-control" title='Дата выхода на пенсию'>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <label for='pension_certificate'>Номер пенсионного удостоверения</label>
                                            <input name='pension_certificate' value='{{ $personalCardsList->pension_certificate }}' id='pension_certificate' type='text' maxlength="50" class="form-control" title='Номер пенсионного удостоверения'>
                                        </div>
                                        <div class='form-group col-md-10'>
                                            <button type="submit" class="btn btn-secondary float-left">
                                                {{ __('Сохранить') }}
                                            </button>
                                            @if(session('success'))
                                                <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-cards.show', $personalCardsList->id) }}">{{ __('Закрыть') }}</a>
                                            @else
                                                <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-cards.show', $personalCardsList->id) }}">{{ __('Отмена') }}</a>
                                            @endif
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