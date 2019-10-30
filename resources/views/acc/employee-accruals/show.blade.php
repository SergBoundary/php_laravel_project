@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccruals $menu, $title, $employeeAccrualsList */
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
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $employeeAccrualsList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department_accrual'>Начисление по подразделению</label>
                                    <input name='department_accrual' value='{{ $employeeAccrualsList->department_accrual }}' id='department_accrual' type='text' maxlength="50" readonly class="form-control" title='Начисление по подразделению'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Бригада</label>
                                    <input name='team' value='{{ $employeeAccrualsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Бригада'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $employeeAccrualsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $employeeAccrualsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год учета</label>
                                    <input name='year' value='{{ $employeeAccrualsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц учета</label>
                                    <input name='month' value='{{ $employeeAccrualsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Отработанные дни</label>
                                    <input name='days' value='{{ $employeeAccrualsList->days }}' id='days' type='text' maxlength="50" readonly class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработанные часы</label>
                                    <input name='hours' value='{{ $employeeAccrualsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления работнику</label>
                                    <input name='accrual_amount' value='{{ $employeeAccrualsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма начисления работнику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' value='{{ $employeeAccrualsList->account_title }}' id='account_title' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency'>Валют</label>
                                    <input name='currency' value='{{ $employeeAccrualsList->currency }}' id='currency' type='text' maxlength="50" readonly class="form-control" title='Валют'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_amount'>Сумма в валюте</label>
                                    <input name='currency_amount' value='{{ $employeeAccrualsList->currency_amount }}' id='currency_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма в валюте'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_kurs'>Курс обмена валюты</label>
                                    <input name='currency_kurs' value='{{ $employeeAccrualsList->currency_kurs }}' id='currency_kurs' type='text' maxlength="50" readonly class="form-control" title='Курс обмена валюты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф начисления работнику</label>
                                    <input name='tariff' value='{{ $employeeAccrualsList->tariff }}' id='tariff' type='text' maxlength="50" readonly class="form-control" title='Тариф начисления работнику'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year'>Год расчета и начисления</label>
                                    <input name='calculation_year' value='{{ $employeeAccrualsList->calculation_year }}' id='calculation_year' type='text' maxlength="50" readonly class="form-control" title='Год расчета и начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month'>Месяц расчета и  начисления</label>
                                    <input name='calculation_month' value='{{ $employeeAccrualsList->calculation_month }}' id='calculation_month' type='text' maxlength="50" readonly class="form-control" title='Месяц расчета и  начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='comment'>Примечание</label>
                                    <input name='comment' value='{{ $employeeAccrualsList->comment }}' id='comment' type='text' maxlength="50" readonly class="form-control" title='Примечание'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.employee-accruals.destroy', $employeeAccrualsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accruals.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accruals.edit', $employeeAccrualsList->id) }}">{{ __('Изменить') }}</a>
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