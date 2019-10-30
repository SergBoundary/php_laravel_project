@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\VacationAmounts $menu, $title, $vacationAmountsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $vacationsList, $accrualsList, $accountsList, $yearsList, $monthsList, $yearsList, $monthsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.vacation-amounts.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.vacation-amounts.includes.result_messages')
                            <div class="row justify-content-center">
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
                                    <label for='vacation_id'>Запись об отпуске</label>
                                    <div class="input-group mb-3"
>                                        <select name='vacation_id' value='vacation_id' id='vacation_id' type='text' placeholder="Запись об отпуске" class="form-control" title='Запись об отпуске' required>
                                            @foreach($vacationsList as $vacationsOption)
                                            <option value="{{ $vacationsOption->id }}" >
                                                {{ $vacationsOption->vacation }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('acc.vacations.create') }}">Добавить</a>
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
                                    <label for='account_id'>Номер бухгалтерского счета</label>
                                    <div class="input-group mb-3"
>                                        <select name='account_id' value='account_id' id='account_id' type='text' placeholder="Номер бухгалтерского счета" class="form-control" title='Номер бухгалтерского счета' required>
                                            @foreach($accountsList as $accountsOption)
                                            <option value="{{ $accountsOption->id }}" >
                                                {{ $accountsOption->account }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accounts.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year_id'>Год расчета</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='year_id' id='year_id' type='text' placeholder="Год расчета" class="form-control" title='Год расчета' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" >
                                                {{ $yearsOption->year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.years.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month_id'>Месяц расчета</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='month_id' id='month_id' type='text' placeholder="Месяц расчета" class="form-control" title='Месяц расчета' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" >
                                                {{ $monthsOption->month }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.months.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year_id'>Расчет за год</label>
                                    <div class="input-group mb-3"
>                                        <select name='calculation_year_id' value='calculation_year_id' id='calculation_year_id' type='text' placeholder="Расчет за год" class="form-control" title='Расчет за год' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" >
                                                {{ $yearsOption->calculation_year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.years.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month_id'>Расчет за месяц</label>
                                    <div class="input-group mb-3"
>                                        <select name='calculation_month_id' value='calculation_month_id' id='calculation_month_id' type='text' placeholder="Расчет за месяц" class="form-control" title='Расчет за месяц' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" >
                                                {{ $monthsOption->calculation_month }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.months.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Расчет от даты</label>
                                    <input name='date_from' id='date_from' type='text' maxlength="50" class="form-control" title='Расчет от даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Расчет до даты</label>
                                    <input name='date_to' id='date_to' type='text' maxlength="50" class="form-control" title='Расчет до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_type'>Тип расчета</label>
                                    <input name='calculation_type' id='calculation_type' type='text' maxlength="50" class="form-control" title='Тип расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Дни</label>
                                    <input name='days' id='days' type='text' maxlength="50" class="form-control" title='Дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Часы</label>
                                    <input name='hours' id='hours' type='text' maxlength="50" class="form-control" title='Часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_unpaid'>Не оплачиваемые дни отпуска</label>
                                    <input name='days_unpaid' id='days_unpaid' type='text' maxlength="50" class="form-control" title='Не оплачиваемые дни отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_paid'>Оплачиваемые дни отпуска</label>
                                    <input name='days_paid' id='days_paid' type='text' maxlength="50" class="form-control" title='Оплачиваемые дни отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_total'>Всего дней отпуска</label>
                                    <input name='days_total' id='days_total' type='text' maxlength="50" class="form-control" title='Всего дней отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours_total'>Всего часов отпуска</label>
                                    <input name='hours_total' id='hours_total' type='text' maxlength="50" class="form-control" title='Всего часов отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_days'>Сумма за день</label>
                                    <input name='amount_days' id='amount_days' type='text' maxlength="50" class="form-control" title='Сумма за день'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_hours'>Сумма за час</label>
                                    <input name='amount_hours' id='amount_hours' type='text' maxlength="50" class="form-control" title='Сумма за час'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_total'>Сумма всего</label>
                                    <input name='amount_total' id='amount_total' type='text' maxlength="50" class="form-control" title='Сумма всего'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='percent'>Процент оплаты</label>
                                    <input name='percent' id='percent' type='text' maxlength="50" class="form-control" title='Процент оплаты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.vacation-amounts.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.vacation-amounts.index') }}">{{ __('Отмена') }}</a>
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