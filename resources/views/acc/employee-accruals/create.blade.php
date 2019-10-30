@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccruals $menu, $title, $employeeAccrualsList
         * @var \Illuminate\Database\Eloquent $departmentsList, $departmentAccrualsList, $teamsList, $objectsList, $personalCardsList, $yearsList, $monthsList, $currencyKursesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.employee-accruals.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.employee-accruals.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='department_id'>Подразделение</label>
                                    <div class="input-group mb-3"
>                                        <select name='department_id' value='department_id' id='department_id' type='text' placeholder="Подразделение" class="form-control" title='Подразделение' required>
                                            @foreach($departmentsList as $departmentsOption)
                                            <option value="{{ $departmentsOption->id }}" >
                                                {{ $departmentsOption->department }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.departments.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department_accrual_id'>Начисление по подразделению</label>
                                    <div class="input-group mb-3"
>                                        <select name='department_accrual_id' value='department_accrual_id' id='department_accrual_id' type='text' placeholder="Начисление по подразделению" class="form-control" title='Начисление по подразделению' required>
                                            @foreach($departmentAccrualsList as $departmentAccrualsOption)
                                            <option value="{{ $department_accrualsOption->id }}" >
                                                {{ $departmentAccrualsOption->department_accrual }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('acc.department-accruals.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team_id'>Бригада</label>
                                    <div class="input-group mb-3"
>                                        <select name='team_id' value='team_id' id='team_id' type='text' placeholder="Бригада" class="form-control" title='Бригада' required>
                                            @foreach($teamsList as $teamsOption)
                                            <option value="{{ $teamsOption->id }}" >
                                                {{ $teamsOption->team }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.teams.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
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
                                    <label for='year_id'>Год учета</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='year_id' id='year_id' type='text' placeholder="Год учета" class="form-control" title='Год учета' required>
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
                                    <label for='month_id'>Месяц учета</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='month_id' id='month_id' type='text' placeholder="Месяц учета" class="form-control" title='Месяц учета' required>
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
                                    <label for='currency_kurs_id'>Курс обмена валюты</label>
                                    <div class="input-group mb-3"
>                                        <select name='currency_kurs_id' value='currency_kurs_id' id='currency_kurs_id' type='text' placeholder="Курс обмена валюты" class="form-control" title='Курс обмена валюты' required>
                                            @foreach($currencyKursesList as $currencyKursesOption)
                                            <option value="{{ $currency_kursesOption->id }}" >
                                                {{ $currencyKursesOption->currency_kurs }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.currency-kurses.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Отработанные дни</label>
                                    <input name='days' id='days' type='text' maxlength="50" class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработанные часы</label>
                                    <input name='hours' id='hours' type='text' maxlength="50" class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления работнику</label>
                                    <input name='accrual_amount' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма начисления работнику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' id='account_title' type='text' maxlength="50" class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_id'>Валют</label>
                                    <input name='currency_id' id='currency_id' type='text' maxlength="50" class="form-control" title='Валют'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' id='currency_amount' type='text' maxlength="50" class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления работнику</label>
                                    <input name='tariff' id='tariff' type='text' maxlength="50" class="form-control" title='Тариф начисления работнику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year'>Год расчета и начисления</label>
                                    <input name='calculation_year' id='calculation_year' type='text' maxlength="50" class="form-control" title='Год расчета и начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month'>Месяц расчета и  начисления</label>
                                    <input name='calculation_month' id='calculation_month' type='text' maxlength="50" class="form-control" title='Месяц расчета и  начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' id='comment' type='text' maxlength="50" class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accruals.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accruals.index') }}">{{ __('Отмена') }}</a>
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