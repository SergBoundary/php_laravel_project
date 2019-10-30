@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\VacationAmounts $menu, $title, $vacationAmountsList */
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
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $vacationAmountsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='vacation'>Запись об отпуске</label>
                                    <input name='vacation' value='{{ $vacationAmountsList->vacation }}' id='vacation' type='text' maxlength="50" readonly class="form-control" title='Запись об отпуске'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начиcления</label>
                                    <input name='accrual' value='{{ $vacationAmountsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Номер бухгалтерского счета</label>
                                    <input name='account' value='{{ $vacationAmountsList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год расчета</label>
                                    <input name='year' value='{{ $vacationAmountsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц расчета</label>
                                    <input name='month' value='{{ $vacationAmountsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_year'>Расчет за год</label>
                                    <input name='calculation_year' value='{{ $vacationAmountsList->calculation_year }}' id='calculation_year' type='text' maxlength="50" readonly class="form-control" title='Расчет за год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_month'>Расчет за месяц</label>
                                    <input name='calculation_month' value='{{ $vacationAmountsList->calculation_month }}' id='calculation_month' type='text' maxlength="50" readonly class="form-control" title='Расчет за месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Расчет от даты</label>
                                    <input name='date_from' value='{{ $vacationAmountsList->date_from }}' id='date_from' type='text' maxlength="50" readonly class="form-control" title='Расчет от даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Расчет до даты</label>
                                    <input name='date_to' value='{{ $vacationAmountsList->date_to }}' id='date_to' type='text' maxlength="50" readonly class="form-control" title='Расчет до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='calculation_type'>Тип расчета</label>
                                    <input name='calculation_type' value='{{ $vacationAmountsList->calculation_type }}' id='calculation_type' type='text' maxlength="50" readonly class="form-control" title='Тип расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Дни</label>
                                    <input name='days' value='{{ $vacationAmountsList->days }}' id='days' type='text' maxlength="50" readonly class="form-control" title='Дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Часы</label>
                                    <input name='hours' value='{{ $vacationAmountsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_unpa'>Не оплачиваемые дни отпуска</label>
                                    <input name='days_unpa' value='{{ $vacationAmountsList->days_unpa }}' id='days_unpa' type='text' maxlength="50" readonly class="form-control" title='Не оплачиваемые дни отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_pa'>Оплачиваемые дни отпуска</label>
                                    <input name='days_pa' value='{{ $vacationAmountsList->days_pa }}' id='days_pa' type='text' maxlength="50" readonly class="form-control" title='Оплачиваемые дни отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days_total'>Всего дней отпуска</label>
                                    <input name='days_total' value='{{ $vacationAmountsList->days_total }}' id='days_total' type='text' maxlength="50" readonly class="form-control" title='Всего дней отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours_total'>Всего часов отпуска</label>
                                    <input name='hours_total' value='{{ $vacationAmountsList->hours_total }}' id='hours_total' type='text' maxlength="50" readonly class="form-control" title='Всего часов отпуска'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_days'>Сумма за день</label>
                                    <input name='amount_days' value='{{ $vacationAmountsList->amount_days }}' id='amount_days' type='text' maxlength="50" readonly class="form-control" title='Сумма за день'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_hours'>Сумма за час</label>
                                    <input name='amount_hours' value='{{ $vacationAmountsList->amount_hours }}' id='amount_hours' type='text' maxlength="50" readonly class="form-control" title='Сумма за час'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_total'>Сумма всего</label>
                                    <input name='amount_total' value='{{ $vacationAmountsList->amount_total }}' id='amount_total' type='text' maxlength="50" readonly class="form-control" title='Сумма всего'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='percent'>Процент оплаты</label>
                                    <input name='percent' value='{{ $vacationAmountsList->percent }}' id='percent' type='text' maxlength="50" readonly class="form-control" title='Процент оплаты'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.vacation-amounts.destroy', $vacationAmountsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.vacation-amounts.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.vacation-amounts.edit', $vacationAmountsList->id) }}">{{ __('Изменить') }}</a>
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