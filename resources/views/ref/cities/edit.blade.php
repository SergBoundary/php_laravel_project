@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Cities $menu, $title, $citiesList
         * @var \Illuminate\Database\Eloquent $countriesList, $districtsList, $regionsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.cities.update', $citiesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.cities.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Название страны</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='{{ $citiesList->countries_id }}' id='country_id' type='text' placeholder="Название страны" class="form-control" title='Название страны' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" 
                                                @if($countriesOption->id == $citiesList->country_id) selected @endif>
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
>                                        <select name='district_id' value='{{ $citiesList->districts_id }}' id='district_id' type='text' placeholder="Название области" class="form-control" title='Название области' required>
                                            @foreach($districtsList as $districtsOption)
                                            <option value="{{ $districtsOption->id }}" 
                                                @if($districtsOption->id == $citiesList->district_id) selected @endif>
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
>                                        <select name='region_id' value='{{ $citiesList->regions_id }}' id='region_id' type='text' placeholder="Название района" class="form-control" title='Название района' required>
                                            @foreach($regionsList as $regionsOption)
                                            <option value="{{ $regionsOption->id }}" 
                                                @if($regionsOption->id == $citiesList->region_id) selected @endif>
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
                                    <label for='title'>Населенный пунк</label>
                                    <input name='title' value='{{ $citiesList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Населенный пунк'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название населенного пункта</label>
                                    <input name='national_name' value='{{ $citiesList->national_name }}' id='national_name' type='text' maxlength="50" class="form-control" title='Национальное название населенного пункта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.cities.show', $citiesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.cities.show', $citiesList->id) }}">{{ __('Отмена') }}</a>
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