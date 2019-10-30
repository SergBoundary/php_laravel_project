@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualYears $menu, $title, $employeeAccrualYearsList */
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
                                    <input name='calculation_year' value='{{ $employeeAccrualYearsList->calculation_year }}' id='calculation_year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month'>Месяц</label>
                                    <input name='calculation_month' value='{{ $employeeAccrualYearsList->calculation_month }}' id='calculation_month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $employeeAccrualYearsList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position'>Должность</label>
                                    <input name='position' value='{{ $employeeAccrualYearsList->position }}' id='position' type='text' maxlength="50" readonly class="form-control" title='Должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $employeeAccrualYearsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Бригад</label>
                                    <input name='team' value='{{ $employeeAccrualYearsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Бригад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $employeeAccrualYearsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начисления</label>
                                    <input name='accrual' value='{{ $employeeAccrualYearsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_type'>Тип занятости</label>
                                    <input name='employment_type' value='{{ $employeeAccrualYearsList->employment_type }}' id='employment_type' type='text' maxlength="50" readonly class="form-control" title='Тип занятости'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Учет за год</label>
                                    <input name='year' value='{{ $employeeAccrualYearsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Учет за год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Номер бухгалтерского счета</label>
                                    <input name='account' value='{{ $employeeAccrualYearsList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_scale'>Шкала подоходного налога</label>
                                    <input name='tax_scale' value='{{ $employeeAccrualYearsList->tax_scale }}' id='tax_scale' type='text' maxlength="50" readonly class="form-control" title='Шкала подоходного налога'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления</label>
                                    <input name='accrual_amount' value='{{ $employeeAccrualYearsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_amount'>Сумма удержания</label>
                                    <input name='retention_amount' value='{{ $employeeAccrualYearsList->retention_amount }}' id='retention_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Отработанные дни</label>
                                    <input name='days' value='{{ $employeeAccrualYearsList->days }}' id='days' type='text' maxlength="50" readonly class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработанные часы</label>
                                    <input name='hours' value='{{ $employeeAccrualYearsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='analytics'>Аналитика</label>
                                    <input name='analytics' value='{{ $employeeAccrualYearsList->analytics }}' id='analytics' type='text' maxlength="50" readonly class="form-control" title='Аналитика'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency'>Валюта</label>
                                    <input name='currency' value='{{ $employeeAccrualYearsList->currency }}' id='currency' type='text' maxlength="50" readonly class="form-control" title='Валюта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' value='{{ $employeeAccrualYearsList->currency_amount }}' id='currency_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_kurs'>Курс обмена валюты</label>
                                    <input name='currency_kurs' value='{{ $employeeAccrualYearsList->currency_kurs }}' id='currency_kurs' type='text' maxlength="50" readonly class="form-control" title='Курс обмена валюты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления</label>
                                    <input name='tariff' value='{{ $employeeAccrualYearsList->tariff }}' id='tariff' type='text' maxlength="50" readonly class="form-control" title='Тариф начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount'>Начисление ЕСВ по сотруднику</label>
                                    <input name='ssc_amount' value='{{ $employeeAccrualYearsList->ssc_amount }}' id='ssc_amount' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability'>Начисление ЕСВ по сотруднику инвалиду</label>
                                    <input name='ssc_amount_disability' value='{{ $employeeAccrualYearsList->ssc_amount_disability }}' id='ssc_amount_disability' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику инвалиду'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_sickness'>Начисление ЕСВ по сотруднику больничный</label>
                                    <input name='ssc_amount_sickness' value='{{ $employeeAccrualYearsList->ssc_amount_sickness }}' id='ssc_amount_sickness' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_disability_sickness'>Начисление ЕСВ по сотруднику инвалиду  больничный</label>
                                    <input name='ssc_amount_disability_sickness' value='{{ $employeeAccrualYearsList->ssc_amount_disability_sickness }}' id='ssc_amount_disability_sickness' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику инвалиду  больничный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='ssc_amount_civil_contract'>Начисление ЕСВ по сотруднику ГПХ</label>
                                    <input name='ssc_amount_civil_contract' value='{{ $employeeAccrualYearsList->ssc_amount_civil_contract }}' id='ssc_amount_civil_contract' type='text' maxlength="50" readonly class="form-control" title='Начисление ЕСВ по сотруднику ГПХ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention_date'>Дата ввода начисления и удержания</label>
                                    <input name='retention_date' value='{{ $employeeAccrualYearsList->retention_date }}' id='retention_date' type='text' maxlength="50" readonly class="form-control" title='Дата ввода начисления и удержания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' value='{{ $employeeAccrualYearsList->comment }}' id='comment' type='text' maxlength="50" readonly class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.employee-accrual-years.destroy', $employeeAccrualYearsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-years.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-years.edit', $employeeAccrualYearsList->id) }}">{{ __('Изменить') }}</a>
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