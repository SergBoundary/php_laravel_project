@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Districts $paths, $title, $items */
        /** @var \Illuminate\Database\Eloquent $countryList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.districts.update', $districts->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @if($errors->any())
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-10">
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">x</span>
                                            </button>
                                            {{$errors->first()}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-10">
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">x</span>
                                            </button>
                                            {{session()->get('success')}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='country_id'>Название страны</label>
                                    <select name='country_id' value='{{ $districts->country_id }}' id='country_id' type='text' placeholder="Выберите страну" class="form-control" title='Наименование страны' required>
                                    @foreach($countryList as $countryOption)
                                    <option value="{{ $countryOption->id }}" 
                                        @if($countryOption->id == $districts->country_id) selected @endif>
                                        {{ $countryOption->id }}. {{ $countryOption->title }}
                                    </option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название области</label>
                                    <input name='title' value='{{ $districts->title }}' id='title' type='text' maxlength="50" class="form-control" title='Наименование области (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название области</label>
                                    <input name='national_name' value='{{ $districts->national_name }}' id='national_name' type='text' maxlength="50" class="form-control" title='Национальное наименование областии (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number_iso'>Код области</label>
                                    <input name='number_iso' value='{{ $districts->number_iso }}' id='number_iso' type='text' maxlength="8" class="form-control" title='Международный код области (штата, земли, воевудства)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.districts.show', $districts->country_id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.districts.show', $districts->country_id) }}">{{ __('Отмена') }}</a>
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