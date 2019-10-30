@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\CurrencyKurses $menu, $title, $currencyKursesList
         * @var \Illuminate\Database\Eloquent $currenciesList, $currenciesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.currency-kurses.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.currency-kurses.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='base currency_id'>Базовая валюта</label>
                                    <div class="input-group mb-3"
>                                        <select name='base currency_id' value='base currency_id' id='base currency_id' type='text' placeholder="Базовая валюта" class="form-control" title='Базовая валюта' required>
                                            @foreach($currenciesList as $currenciesOption)
                                            <option value="{{ $currenciesOption->id }}" >
                                                {{ $currenciesOption->base currency }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.currencies.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quoted currency_id'>Котируемая валюта</label>
                                    <div class="input-group mb-3"
>                                        <select name='quoted currency_id' value='quoted currency_id' id='quoted currency_id' type='text' placeholder="Котируемая валюта" class="form-control" title='Котируемая валюта' required>
                                            @foreach($currenciesList as $currenciesOption)
                                            <option value="{{ $currenciesOption->id }}" >
                                                {{ $currenciesOption->quoted currency }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.currencies.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='scale'>Масштаб котировки</label>
                                    <input name='scale' id='scale' type='text' maxlength="50" class="form-control" title='Масштаб котировки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='residual'>Курс</label>
                                    <input name='residual' id='residual' type='text' maxlength="50" class="form-control" title='Курс'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='bay'>Покупка</label>
                                    <input name='bay' id='bay' type='text' maxlength="50" class="form-control" title='Покупка'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sell'>Продажа</label>
                                    <input name='sell' id='sell' type='text' maxlength="50" class="form-control" title='Продажа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.currency-kurses.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.currency-kurses.index') }}">{{ __('Отмена') }}</a>
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