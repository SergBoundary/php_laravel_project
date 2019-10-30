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

                        <form method="POST" action="{{ route('hr.personal-cards.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-cards.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='nationality_id'>Национальность</label>
                                    <div class="input-group mb-3"
>                                        <select name='nationality_id' value='nationality_id' id='nationality_id' type='text' placeholder="Национальность" class="form-control" title='Национальность' required>
                                            @foreach($nationalitiesList as $nationalitiesOption)
                                            <option value="{{ $nationalitiesOption->id }}" >
                                                {{ $nationalitiesOption->nationality }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.nationalities.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_city_id'>Город рождения</label>
                                    <div class="input-group mb-3"
>                                        <select name='born_city_id' value='born_city_id' id='born_city_id' type='text' placeholder="Город рождения" class="form-control" title='Город рождения' required>
                                            @foreach($citiesList as $citiesOption)
                                            <option value="{{ $citiesOption->id }}" >
                                                {{ $citiesOption->born_city }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.cities.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_region_id'>Район рождения</label>
                                    <div class="input-group mb-3"
>                                        <select name='born_region_id' value='born_region_id' id='born_region_id' type='text' placeholder="Район рождения" class="form-control" title='Район рождения' required>
                                            @foreach($regionsList as $regionsOption)
                                            <option value="{{ $regionsOption->id }}" >
                                                {{ $regionsOption->born_region }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.regions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_district_id'>Область рождения</label>
                                    <div class="input-group mb-3"
>                                        <select name='born_district_id' value='born_district_id' id='born_district_id' type='text' placeholder="Область рождения" class="form-control" title='Область рождения' required>
                                            @foreach($districtsList as $districtsOption)
                                            <option value="{{ $districtsOption->id }}" >
                                                {{ $districtsOption->born_district }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.districts.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_country_id'>Страна рождения</label>
                                    <div class="input-group mb-3"
>                                        <select name='born_country_id' value='born_country_id' id='born_country_id' type='text' placeholder="Страна рождения" class="form-control" title='Страна рождения' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" >
                                                {{ $countriesOption->born_country }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.countries.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='marital_status_id'>Семейное положение</label>
                                    <div class="input-group mb-3"
>                                        <select name='marital_status_id' value='marital_status_id' id='marital_status_id' type='text' placeholder="Семейное положение" class="form-control" title='Семейное положение' required>
                                            @foreach($maritalStatusesList as $maritalStatusesOption)
                                            <option value="{{ $maritalStatusesOption->id }}" >
                                                {{ $maritalStatusesOption->marital_status }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.marital-statuses.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='clothing_size_id'>Размер одежды</label>
                                    <div class="input-group mb-3"
>                                        <select name='clothing_size_id' value='clothing_size_id' id='clothing_size_id' type='text' placeholder="Размер одежды" class="form-control" title='Размер одежды' required>
                                            @foreach($clothingSizesList as $clothingSizesOption)
                                            <option value="{{ $clothingSizesOption->id }}" >
                                                {{ $clothingSizesOption->clothing_size }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.clothing-sizes.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='shoe_size_id'>Размер обуви</label>
                                    <div class="input-group mb-3"
>                                        <select name='shoe_size_id' value='shoe_size_id' id='shoe_size_id' type='text' placeholder="Размер обуви" class="form-control" title='Размер обуви' required>
                                            @foreach($shoeSizesList as $shoeSizesOption)
                                            <option value="{{ $shoeSizesOption->id }}" >
                                                {{ $shoeSizesOption->shoe_size }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.shoe-sizes.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='disability_id'>Группа инвалидности</label>
                                    <div class="input-group mb-3"
>                                        <select name='disability_id' value='disability_id' id='disability_id' type='text' placeholder="Группа инвалидности" class="form-control" title='Группа инвалидности' required>
                                            @foreach($disabilitiesList as $disabilitiesOption)
                                            <option value="{{ $disabilitiesOption->id }}" >
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
                                    <label for='personal_account'>Табельный номер</label>
                                    <input name='personal_account' id='personal_account' type='text' maxlength="50" class="form-control" title='Табельный номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_number'>Индивидуальный налоговый номер</label>
                                    <input name='tax_number' id='tax_number' type='text' maxlength="50" class="form-control" title='Индивидуальный налоговый номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='surname'>Фамилия</label>
                                    <input name='surname' id='surname' type='text' maxlength="50" class="form-control" title='Фамилия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='first_name'>Имя (первое имя)</label>
                                    <input name='first_name' id='first_name' type='text' maxlength="50" class="form-control" title='Имя (первое имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='second_name'>Отчество (второе имя)</label>
                                    <input name='second_name' id='second_name' type='text' maxlength="50" class="form-control" title='Отчество (второе имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_surname'>Национальная фамилия</label>
                                    <input name='national_surname' id='national_surname' type='text' maxlength="50" class="form-control" title='Национальная фамилия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_first_name'>Национальное первое имя</label>
                                    <input name='national_first_name' id='national_first_name' type='text' maxlength="50" class="form-control" title='Национальное первое имя'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_second_name'>Национальное второе имя</label>
                                    <input name='national_second_name' id='national_second_name' type='text' maxlength="50" class="form-control" title='Национальное второе имя'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_date'>Дата рождения</label>
                                    <input name='born_date' id='born_date' type='text' maxlength="50" class="form-control" title='Дата рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sex'>Пол</label>
                                    <input name='sex' id='sex' type='text' maxlength="50" class="form-control" title='Пол'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='union_member'>Членство в профсоюзе</label>
                                    <input name='union_member' id='union_member' type='text' maxlength="50" class="form-control" title='Членство в профсоюзе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='disability'>Наличие инвалидости</label>
                                    <input name='disability' id='disability' type='text' maxlength="50" class="form-control" title='Наличие инвалидости'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='pension_date'>Дата выхода на пенсию</label>
                                    <input name='pension_date' id='pension_date' type='text' maxlength="50" class="form-control" title='Дата выхода на пенсию'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='pension_certificate'>Номер пенсионного удостоверения</label>
                                    <input name='pension_certificate' id='pension_certificate' type='text' maxlength="50" class="form-control" title='Номер пенсионного удостоверения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='photo_url'>Фотография</label>
                                    <input name='photo_url' id='photo_url' type='text' maxlength="50" class="form-control" title='Фотография'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-cards.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-cards.index') }}">{{ __('Отмена') }}</a>
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