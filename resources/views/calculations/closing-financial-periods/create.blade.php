@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Countries $paths, $title, $items */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.countries.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('references.countries.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название страны</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Наименование страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='national_name'>Национальное название страны</label>
                                    <input name='national_name' id='national_name' type='text' maxlength="50" class="form-control" title='Национальное наименование страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='symbol_alfa2'>Код страны Alfa 2</label>
                                    <input name='symbol_alfa2' id='symbol_alfa2' type='text' maxlength="8" class="form-control" title='Международный код страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='symbol_alfa3'>Код страны Alfa 3</label>
                                    <input name='symbol_alfa3' id='symbol_alfa3' type='text' maxlength="8" class="form-control" title='Международный код страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number_iso'>Код страны ISO</label>
                                    <input name='number_iso' id='number_iso' type='text' maxlength="8" class="form-control" title='Международный код страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visible'>Видимость страны в списках</label>
                                    <input name='visible' id='visible' type='text' maxlength="8" class="form-control" title='Международный код страны'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.countries.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.countries.index') }}">{{ __('Отмена') }}</a>
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