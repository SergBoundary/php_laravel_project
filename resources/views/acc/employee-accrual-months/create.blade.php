@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualMonths $menu, $title, $employeeAccrualMonthsList
         * @var \Illuminate\Database\Eloquent $yearsList, $monthsList, $departmentsList, $positionsList, $objectsList, $teamsList, $personalCardsList, $accrualsList, $employmentTypesList, $yearsList, $monthsList, $accountsList, $taxScalesList, $currenciesList, $currencyKursesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.employee-accrual-months.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.employee-accrual-months.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year_id'>Год</label>
                                    <div class="input-group mb-3"
>                                        <select name='calculation_year_id' value='calculation_year_id' id='calculation_year_id' type='text' placeholder="Год" class="form-control" title='Год' required>
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
                                    <label for='calculation_month_id'>Месяц</label>
                                    <div class="input-group mb-3"
>                                        <select name='calculation_month_id' value='calculation_month_id' id='calculation_month_id' type='text' placeholder="Месяц" class="form-control" title='Месяц' required>
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
                                    <label for='position_id'>Должность</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_id' value='position_id' id='position_id' type='text' placeholder="Должность" class="form-control" title='Должность' required>
                                            @foreach($positionsList as $positionsOption)
                                            <option value="{{ $positionsOption->id }}" >
                                                {{ $positionsOption->position }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.positions.create') }}">Добавить</a>
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
                                    <label for='team_id'>Бригад</label>
                                    <div class="input-group mb-3"
>                                        <select name='team_id' value='team_id' id='team_id' type='text' placeholder="Бригад" class="form-control" title='Бригад' required>
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
                                    <label for='accrual_id'>Вид начисления</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='accrual_id' id='accrual_id' type='text' placeholder="Вид начисления" class="form-control" title='Вид начисления' required>
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
                                    <label for='employment_type_id'>Тип занятости</label>
                                    <div class="input-group mb-3"
>                                        <select name='employment_type_id' value='employment_type_id' id='employment_type_id' type='text' placeholder="Тип занятости" class="form-control" title='Тип занятости' required>
                                            @foreach($employmentTypesList as $employmentTypesOption)
                                            <option value="{{ $employment_typesOption->id }}" >
                                                {{ $employmentTypesOption->employment_type }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.employment-types.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year_id'>Учет за год</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='year_id' id='year_id' type='text' placeholder="Учет за год" class="form-control" title='Учет за год' required>
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
                                    <label for='month_id'>Учет за месяц</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='month_id' id='month_id' type='text' placeholder="Учет за месяц" class="form-control" title='Учет за месяц' required>
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
                                    <label for='tax_scale_id'>Шкала подоходного налога</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_scale_id' value='tax_scale_id' id='tax_scale_id' type='text' placeholder="Шкала подоходного налога" class="form-control" title='Шкала подоходного налога' required>
                                            @foreach($taxScalesList as $taxScalesOption)
                                            <option value="{{ $tax_scalesOption->id }}" >
                                                {{ $taxScalesOption->tax_scale }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-scales.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_id'>Валюта</label>
                                    <div class="input-group mb-3"
>                                        <select name='currency_id' value='currency_id' id='currency_id' type='text' placeholder="Валюта" class="form-control" title='Валюта' required>
                                            @foreach($currenciesList as $currenciesOption)
                                            <option value="{{ $currenciesOption->id }}" >
                                                {{ $currenciesOption->currency }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.currencies.create') }}">Добавить</a>
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
                                    <label for='accrual_amount'>Сумма начисления</label>
                                    <input name='accrual_amount' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_amount'>Сумма удержания</label>
                                    <input name='retention_amount' id='retention_amount' type='text' maxlength="50" class="form-control" title='Сумма удержания'>
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
                                    <label for='analytics'>Аналитика</label>
                                    <input name='analytics' id='analytics' type='text' maxlength="50" class="form-control" title='Аналитика'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' id='currency_amount' type='text' maxlength="50" class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления</label>
                                    <input name='tariff' id='tariff' type='text' maxlength="50" class="form-control" title='Тариф начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount'>Начисление ЕСВ по сотруднику</label>
                                    <input name='ssc_amount' id='ssc_amount' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability'>Начисление ЕСВ по сотруднику инвалиду</label>
                                    <input name='ssc_amount_disability' id='ssc_amount_disability' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику инвалиду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_sickness'>Начисление ЕСВ по сотруднику больничный</label>
                                    <input name='ssc_amount_sickness' id='ssc_amount_sickness' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability_sickness'>Начисление ЕСВ по сотруднику инвалиду  больничный</label>
                                    <input name='ssc_amount_disability_sickness' id='ssc_amount_disability_sickness' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику инвалиду  больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_civil_contract'>Начисление ЕСВ по сотруднику ГПХ</label>
                                    <input name='ssc_amount_civil_contract' id='ssc_amount_civil_contract' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику ГПХ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_date'>Дата ввода начисления и удержания</label>
                                    <input name='retention_date' id='retention_date' type='text' maxlength="50" class="form-control" title='Дата ввода начисления и удержания'>
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
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-months.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-months.index') }}">{{ __('Отмена') }}</a>
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