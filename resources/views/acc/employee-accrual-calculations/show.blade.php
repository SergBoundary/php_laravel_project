@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualCalculations $menu, $title, $employeeAccrualCalculationsList */
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
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $employeeAccrualCalculationsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $employeeAccrualCalculationsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начиcления</label>
                                    <input name='accrual' value='{{ $employeeAccrualCalculationsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm'>Алгоритм начисления</label>
                                    <input name='algorithm' value='{{ $employeeAccrualCalculationsList->algorithm }}' id='algorithm' type='text' maxlength="50" readonly class="form-control" title='Алгоритм начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax'>Ставка налогообложения</label>
                                    <input name='tax' value='{{ $employeeAccrualCalculationsList->tax }}' id='tax' type='text' maxlength="50" readonly class="form-control" title='Ставка налогообложения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления</label>
                                    <input name='accrual_amount' value='{{ $employeeAccrualCalculationsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Действие ставки налога от даты</label>
                                    <input name='start' value='{{ $employeeAccrualCalculationsList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Действие ставки налога от даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Действие ставки налога до даты</label>
                                    <input name='expiry' value='{{ $employeeAccrualCalculationsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Действие ставки налога до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='save_of_analytics'>Для хранения аналитики по адресу</label>
                                    <input name='save_of_analytics' value='{{ $employeeAccrualCalculationsList->save_of_analytics }}' id='save_of_analytics' type='text' maxlength="50" readonly class="form-control" title='Для хранения аналитики по адресу'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_title'>Номер бухгалтерского счета</label>
                                    <input name='account_title' value='{{ $employeeAccrualCalculationsList->account_title }}' id='account_title' type='text' maxlength="50" readonly class="form-control" title='Номер бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.employee-accrual-calculations.destroy', $employeeAccrualCalculationsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-calculations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-calculations.edit', $employeeAccrualCalculationsList->id) }}">{{ __('Изменить') }}</a>
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