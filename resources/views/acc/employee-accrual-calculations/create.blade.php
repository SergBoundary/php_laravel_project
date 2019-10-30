@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualCalculations $menu, $title, $employeeAccrualCalculationsList
         * @var \Illuminate\Database\Eloquent $objectsList, $personalCardsList, $accrualsList, $algorithmsList, $taxRatesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.employee-accrual-calculations.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.employee-accrual-calculations.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='object_id'>Объект</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='object_id' id='object_id' type='text' placeholder="Объект" class="form-control" title='Объект' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" >
                                                {{ $objectsOption->object }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.objects.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='personal_card_id' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" >
                                                {{ $personalCardsOption->personal_card }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Вид начиcления</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='accrual_id' id='accrual_id' type='text' placeholder="Вид начиcления" class="form-control" title='Вид начиcления' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" >
                                                {{ $accrualsOption->accrual }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm_id'>Алгоритм начисления</label>
                                    <div class="input-group mb-3"
>                                        <select name='algorithm_id' value='algorithm_id' id='algorithm_id' type='text' placeholder="Алгоритм начисления" class="form-control" title='Алгоритм начисления' required>
                                            @foreach($algorithmsList as $algorithmsOption)
                                            <option value="{{ $algorithmsOption->id }}" >
                                                {{ $algorithmsOption->algorithm }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.algorithms.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_id'>Ставка налогообложения</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_id' value='tax_id' id='tax_id' type='text' placeholder="Ставка налогообложения" class="form-control" title='Ставка налогообложения' required>
                                            @foreach($taxRatesList as $taxRatesOption)
                                            <option value="{{ $tax_ratesOption->id }}" >
                                                {{ $taxRatesOption->tax }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-rates.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления</label>
                                    <input name='accrual_amount' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Действие ставки налога от даты</label>
                                    <input name='start' id='start' type='text' maxlength="50" class="form-control" title='Действие ставки налога от даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Действие ставки налога до даты</label>
                                    <input name='expiry' id='expiry' type='text' maxlength="50" class="form-control" title='Действие ставки налога до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='save_of_analytics'>Для хранения аналитики по адресу</label>
                                    <input name='save_of_analytics' id='save_of_analytics' type='text' maxlength="50" class="form-control" title='Для хранения аналитики по адресу'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' id='account_title' type='text' maxlength="50" class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-calculations.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-calculations.index') }}">{{ __('Отмена') }}</a>
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