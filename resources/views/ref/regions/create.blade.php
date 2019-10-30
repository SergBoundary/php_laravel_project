@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Regions $menu, $title, $regionsList
         * @var \Illuminate\Database\Eloquent $countriesList, $districtsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.regions.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.regions.includes.result_messages')
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
                                    <label for='title'>Название района</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Название района'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название района</label>
                                    <input name='national_name' id='national_name' type='text' maxlength="50" class="form-control" title='Национальное название района'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.regions.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.regions.index') }}">{{ __('Отмена') }}</a>
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