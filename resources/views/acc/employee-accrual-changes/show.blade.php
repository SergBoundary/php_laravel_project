@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualChanges $menu, $title, $employeeAccrualChangesList */
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
                                    <label for='algorithm'>Алгоритм начисления</label>
                                    <input name='algorithm' value='{{ $employeeAccrualChangesList->algorithm }}' id='algorithm' type='text' maxlength="50" readonly class="form-control" title='Алгоритм начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_rates'>Ставка налогообложения</label>
                                    <input name='tax_rates' value='{{ $employeeAccrualChangesList->tax_rates }}' id='tax_rates' type='text' maxlength="50" readonly class="form-control" title='Ставка налогообложения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Переформирование до даты</label>
                                    <input name='date_to' value='{{ $employeeAccrualChangesList->date_to }}' id='date_to' type='text' maxlength="50" readonly class="form-control" title='Переформирование до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Новое значение</label>
                                    <input name='amount' value='{{ $employeeAccrualChangesList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Новое значение'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.employee-accrual-changes.destroy', $employeeAccrualChangesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-changes.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.employee-accrual-changes.edit', $employeeAccrualChangesList->id) }}">{{ __('Изменить') }}</a>
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