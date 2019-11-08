@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualYears $menu, $title, $employeeAccrualYearsList
         * @var \Illuminate\Database\Eloquent $yearsList, $monthsList, $departmentsList, $positionsList, $objectsList, $teamsList, $personalCardsList, $accrualsList, $employmentTypesList, $yearsList, $accountsList, $taxScalesList, $currenciesList, $currencyKursesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.employee-accrual-years.update', $employeeAccrualYearsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.employee-accrual-years.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year_id'>Год</label>
                                    <div class="input-group mb-3"
>                                        <select name='calculation_year_id' value='{{ $employeeAccrualYearsList->years_id }}' id='calculation_year_id' type='text' placeholder="Год" class="form-control" title='Год' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $employeeAccrualYearsList->calculation_year_id) selected @endif>
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
>                                        <select name='calculation_month_id' value='{{ $employeeAccrualYearsList->months_id }}' id='calculation_month_id' type='text' placeholder="Месяц" class="form-control" title='Месяц' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" 
                                                @if($monthsOption->id == $employeeAccrualYearsList->calculation_month_id) selected @endif>
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
>                                        <select name='department_id' value='{{ $employeeAccrualYearsList->departments_id }}' id='department_id' type='text' placeholder="Подразделение" class="form-control" title='Подразделение' required>
                                            @foreach($departmentsList as $departmentsOption)
                                            <option value="{{ $departmentsOption->id }}" 
                                                @if($departmentsOption->id == $employeeAccrualYearsList->department_id) selected @endif>
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
>                                        <select name='position_id' value='{{ $employeeAccrualYearsList->positions_id }}' id='position_id' type='text' placeholder="Должность" class="form-control" title='Должность' required>
                                            @foreach($positionsList as $positionsOption)
                                            <option value="{{ $positionsOption->id }}" 
                                                @if($positionsOption->id == $employeeAccrualYearsList->position_id) selected @endif>
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
>                                        <select name='object_id' value='{{ $employeeAccrualYearsList->objects_id }}' id='object_id' type='text' placeholder="Объект" class="form-control" title='Объект' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" 
                                                @if($objectsOption->id == $employeeAccrualYearsList->object_id) selected @endif>
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
>                                        <select name='team_id' value='{{ $employeeAccrualYearsList->teams_id }}' id='team_id' type='text' placeholder="Бригад" class="form-control" title='Бригад' required>
                                            @foreach($teamsList as $teamsOption)
                                            <option value="{{ $teamsOption->id }}" 
                                                @if($teamsOption->id == $employeeAccrualYearsList->team_id) selected @endif>
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
>                                        <select name='personal_card_id' value='{{ $employeeAccrualYearsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $employeeAccrualYearsList->personal_card_id) selected @endif>
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
>                                        <select name='accrual_id' value='{{ $employeeAccrualYearsList->accruals_id }}' id='accrual_id' type='text' placeholder="Вид начисления" class="form-control" title='Вид начисления' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" 
                                                @if($accrualsOption->id == $employeeAccrualYearsList->accrual_id) selected @endif>
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
>                                        <select name='employment_type_id' value='{{ $employeeAccrualYearsList->employment_types_id }}' id='employment_type_id' type='text' placeholder="Тип занятости" class="form-control" title='Тип занятости' required>
                                            @foreach($employmentTypesList as $employmentTypesOption)
                                            <option value="{{ $employment_typesOption->id }}" 
                                                @if($employmentTypesOption->id == $employeeAccrualYearsList->employment_type_id) selected @endif>
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
>                                        <select name='year_id' value='{{ $employeeAccrualYearsList->years_id }}' id='year_id' type='text' placeholder="Учет за год" class="form-control" title='Учет за год' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $employeeAccrualYearsList->year_id) selected @endif>
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
                                    <label for='account_id'>Номер бухгалтерского счета</label>
                                    <div class="input-group mb-3"
>                                        <select name='account_id' value='{{ $employeeAccrualYearsList->accounts_id }}' id='account_id' type='text' placeholder="Номер бухгалтерского счета" class="form-control" title='Номер бухгалтерского счета' required>
                                            @foreach($accountsList as $accountsOption)
                                            <option value="{{ $accountsOption->id }}" 
                                                @if($accountsOption->id == $employeeAccrualYearsList->account_id) selected @endif>
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
>                                        <select name='tax_scale_id' value='{{ $employeeAccrualYearsList->tax_scales_id }}' id='tax_scale_id' type='text' placeholder="Шкала подоходного налога" class="form-control" title='Шкала подоходного налога' required>
                                            @foreach($taxScalesList as $taxScalesOption)
                                            <option value="{{ $tax_scalesOption->id }}" 
                                                @if($taxScalesOption->id == $employeeAccrualYearsList->tax_scale_id) selected @endif>
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
>                                        <select name='currency_id' value='{{ $employeeAccrualYearsList->currencies_id }}' id='currency_id' type='text' placeholder="Валюта" class="form-control" title='Валюта' required>
                                            @foreach($currenciesList as $currenciesOption)
                                            <option value="{{ $currenciesOption->id }}" 
                                                @if($currenciesOption->id == $employeeAccrualYearsList->currency_id) selected @endif>
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
>                                        <select name='currency_kurs_id' value='{{ $employeeAccrualYearsList->currency_kurses_id }}' id='currency_kurs_id' type='text' placeholder="Курс обмена валюты" class="form-control" title='Курс обмена валюты' required>
                                            @foreach($currencyKursesList as $currencyKursesOption)
                                            <option value="{{ $currency_kursesOption->id }}" 
                                                @if($currencyKursesOption->id == $employeeAccrualYearsList->currency_kurs_id) selected @endif>
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
                                    <input name='accrual_amount' value='{{ $employeeAccrualYearsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_amount'>Сумма удержания</label>
                                    <input name='retention_amount' value='{{ $employeeAccrualYearsList->retention_amount }}' id='retention_amount' type='text' maxlength="50" class="form-control" title='Сумма удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Отработанные дни</label>
                                    <input name='days' value='{{ $employeeAccrualYearsList->days }}' id='days' type='text' maxlength="50" class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработанные часы</label>
                                    <input name='hours' value='{{ $employeeAccrualYearsList->hours }}' id='hours' type='text' maxlength="50" class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='analytics'>Аналитика</label>
                                    <input name='analytics' value='{{ $employeeAccrualYearsList->analytics }}' id='analytics' type='text' maxlength="50" class="form-control" title='Аналитика'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' value='{{ $employeeAccrualYearsList->currency_amount }}' id='currency_amount' type='text' maxlength="50" class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления</label>
                                    <input name='tariff' value='{{ $employeeAccrualYearsList->tariff }}' id='tariff' type='text' maxlength="50" class="form-control" title='Тариф начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount'>Начисление ЕСВ по сотруднику</label>
                                    <input name='ssc_amount' value='{{ $employeeAccrualYearsList->ssc_amount }}' id='ssc_amount' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability'>Начисление ЕСВ по сотруднику инвалиду</label>
                                    <input name='ssc_amount_disability' value='{{ $employeeAccrualYearsList->ssc_amount_disability }}' id='ssc_amount_disability' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику инвалиду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_sickness'>Начисление ЕСВ по сотруднику больничный</label>
                                    <input name='ssc_amount_sickness' value='{{ $employeeAccrualYearsList->ssc_amount_sickness }}' id='ssc_amount_sickness' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability_sickness'>Начисление ЕСВ по сотруднику инвалиду  больничный</label>
                                    <input name='ssc_amount_disability_sickness' value='{{ $employeeAccrualYearsList->ssc_amount_disability_sickness }}' id='ssc_amount_disability_sickness' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику инвалиду  больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_civil_contract'>Начисление ЕСВ по сотруднику ГПХ</label>
                                    <input name='ssc_amount_civil_contract' value='{{ $employeeAccrualYearsList->ssc_amount_civil_contract }}' id='ssc_amount_civil_contract' type='text' maxlength="50" class="form-control" title='Начисление ЕСВ по сотруднику ГПХ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_date'>Дата ввода начисления и удержания</label>
                                    <input name='retention_date' value='{{ $employeeAccrualYearsList->retention_date }}' id='retention_date' type='text' maxlength="50" class="form-control" title='Дата ввода начисления и удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' value='{{ $employeeAccrualYearsList->comment }}' id='comment' type='text' maxlength="50" class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-years.show', $employeeAccrualYearsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-years.show', $employeeAccrualYearsList->id) }}">{{ __('Отмена') }}</a>
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