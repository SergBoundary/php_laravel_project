@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $menu, $title, $districtsList
         * @var \Illuminate\Database\Eloquent $countriesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.districts.update', $districtsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('references.districts.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Название страны</label>
                                    <div class="input-group mb-3"
>                                        <select name='country_id' value='{{ $districtsList->countries_id }}' id='country_id' type='text' placeholder="Название страны" class="form-control" title='Название страны' required>
                                            @foreach($countriesList as $countriesOption)
                                            <option value="{{ $countriesOption->id }}" 
                                                @if($countriesOption->id == $districtsList->country_id) selected @endif>
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
                                    <label for='title'>Название области</label>
                                    <input name='title' value='{{ $districtsList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название области</label>
                                    <input name='national_name' value='{{ $districtsList->national_name }}' id='national_name' type='text' maxlength="50" class="form-control" title='Национальное название области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number_iso'>Код области</label>
                                    <input name='number_iso' value='{{ $districtsList->number_iso }}' id='number_iso' type='text' maxlength="50" class="form-control" title='Код области'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.districts.show', $districtsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.districts.show', $districtsList->id) }}">{{ __('Отмена') }}</a>
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