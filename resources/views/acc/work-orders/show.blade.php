@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\WorkOrders $menu, $title, $workOrdersList */
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
                                    <input name='department' value='{{ $workOrdersList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $workOrdersList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Бригада</label>
                                    <input name='team' value='{{ $workOrdersList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Бригада'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Счет затрат выполненой работы</label>
                                    <input name='account' value='{{ $workOrdersList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Счет затрат выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm'>Алгоритм расчета сдельной суммы</label>
                                    <input name='algorithm' value='{{ $workOrdersList->algorithm }}' id='algorithm' type='text' maxlength="50" readonly class="form-control" title='Алгоритм расчета сдельной суммы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date'>Дата наряда</label>
                                    <input name='date' value='{{ $workOrdersList->date }}' id='date' type='text' maxlength="50" readonly class="form-control" title='Дата наряда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер наряда</label>
                                    <input name='number' value='{{ $workOrdersList->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Номер наряда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма наряда</label>
                                    <input name='amount' value='{{ $workOrdersList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма наряда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год расчета</label>
                                    <input name='year' value='{{ $workOrdersList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц расчета</label>
                                    <input name='month' value='{{ $workOrdersList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц расчета'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.work-orders.destroy', $workOrdersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.work-orders.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.work-orders.edit', $workOrdersList->id) }}">{{ __('Изменить') }}</a>
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