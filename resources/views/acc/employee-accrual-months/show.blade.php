@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualMonths $menu, $title, $employeeAccrualMonthsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year'>Год</label>
                                    <input name='calculation_year' value='{{ $employeeAccrualMonthsList->calculation_year }}' id='calculation_year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month'>Месяц</label>
                                    <input name='calculation_month' value='{{ $employeeAccrualMonthsList->calculation_month }}' id='calculation_month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $employeeAccrualMonthsList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position'>Должность</label>
                                    <input name='position' value='{{ $employeeAccrualMonthsList->position }}' id='position' type='text' maxlength="50" readonly class="form-control" title='Должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $employeeAccrualMonthsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Бригад</label>
                                    <input name='team' value='{{ $employeeAccrualMonthsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Бригад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $employeeAccrualMonthsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начисления</label>
                                    <input name='accrual' value='{{ $employeeAccrualMonthsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_type'>Тип занятости</label>
                                    <input name='employment_type' value='{{ $employeeAccrualMonthsList->employment_type }}' id='employment_type' type='text' maxlength="50" readonly class="form-control" title='Тип занятости'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Учет за год</label>
                                    <input name='year' value='{{ $employeeAccrualMonthsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Учет за год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Учет за месяц</label>
                                    <input name='month' value='{{ $employeeAccrualMonthsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Учет за месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Номер бухгалтерского счета</label>
                                    <input name='account' value='{{ $employeeAccrualMonthsList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_scale'>Шкала подоходного налога</label>
                                    <input name='tax_scale' value='{{ $employeeAccrualMonthsList->tax_scale }}' id='tax_scale' type='text' maxlength="50" readonly class="form-control" title='Шкала подоходного налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления</label>
                                    <input name='accrual_amount' value='{{ $employeeAccrualMonthsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_amount'>Сумма удержания</label>
                                    <input name='retention_amount' value='{{ $employeeAccrualMonthsList->retention_amount }}' id='retention_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Отработанные дни</label>
                                    <input name='days' value='{{ $employeeAccrualMonthsList->days }}' id='days' type='text' maxlength="50" readonly class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработанные часы</label>
                                    <input name='hours' value='{{ $employeeAccrualMonthsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='analytics'>Аналитика</label>
                                    <input name='analytics' value='{{ $employeeAccrualMonthsList->analytics }}' id='analytics' type='text' maxlength="50" readonly class="form-control" title='Аналитика'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency'>Валюта</label>
                                    <input name='currency' value='{{ $employeeAccrualMonthsList->currency }}' id='currency' type='text' maxlength="50" readonly class="form-control" title='Валюта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' value='{{ $employeeAccrualMonthsList->currency_amount }}' id='currency_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_kurs'>Курс обмена валюты</label>
                                    <input name='currency_kurs' value='{{ $employeeAccrualMonthsList->currency_kurs }}' id='currency_kurs' type='text' maxlength="50" readonly class="form-control" title='Курс обмена валюты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления</label>
                                    <input name='tariff' value='{{ $employeeAccrualMonthsList->tariff }}' id='tariff' type='text' maxlength="50" readonly class="form-control" title='Тариф начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount'>Начисление ЕСВ по сотруднику</label>
                                    <input name='ssc_amount' value='{{ $employeeAccrualMonthsList->ssc_amount }}' id='ssc_amount' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability'>Начисление ЕСВ по сотруднику инвалиду</label>
                                    <input name='ssc_amount_disability' value='{{ $employeeAccrualMonthsList->ssc_amount_disability }}' id='ssc_amount_disability' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику инвалиду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_sickness'>Начисление ЕСВ по сотруднику больничный</label>
                                    <input name='ssc_amount_sickness' value='{{ $employeeAccrualMonthsList->ssc_amount_sickness }}' id='ssc_amount_sickness' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability_sickness'>Начисление ЕСВ по сотруднику инвалиду  больничный</label>
                                    <input name='ssc_amount_disability_sickness' value='{{ $employeeAccrualMonthsList->ssc_amount_disability_sickness }}' id='ssc_amount_disability_sickness' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику инвалиду  больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_civil_contract'>Начисление ЕСВ по сотруднику ГПХ</label>
                                    <input name='ssc_amount_civil_contract' value='{{ $employeeAccrualMonthsList->ssc_amount_civil_contract }}' id='ssc_amount_civil_contract' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику ГПХ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_date'>Дата ввода начисления и удержания</label>
                                    <input name='retention_date' value='{{ $employeeAccrualMonthsList->retention_date }}' id='retention_date' type='text' maxlength="50" readonly class="form-control" title='Дата ввода начисления и удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' value='{{ $employeeAccrualMonthsList->comment }}' id='comment' type='text' maxlength="50" readonly class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.employee-accrual-months.destroy', $employeeAccrualMonthsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-months.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-months.edit', $employeeAccrualMonthsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection