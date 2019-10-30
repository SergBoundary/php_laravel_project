@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\WorkOrdersAmounts $menu, $title, $workOrdersAmountsList */
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
                                    <input name='personal_card' value='{{ $workOrdersAmountsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_order'>Номер наряда</label>
                                    <input name='work_order' value='{{ $workOrdersAmountsList->work_order }}' id='work_order' type='text' maxlength="50" readonly class="form-control" title='Номер наряда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='piecework'>Сдельная работа</label>
                                    <input name='piecework' value='{{ $workOrdersAmountsList->piecework }}' id='piecework' type='text' maxlength="50" readonly class="form-control" title='Сдельная работа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Счет затрат выполненой работы</label>
                                    <input name='account' value='{{ $workOrdersAmountsList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Счет затрат выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект выполнения работ</label>
                                    <input name='object' value='{{ $workOrdersAmountsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='algorithm'>Алгоритм расчета суммы</label>
                                    <input name='algorithm' value='{{ $workOrdersAmountsList->algorithm }}' id='algorithm' type='text' maxlength="50" readonly class="form-control" title='Алгоритм расчета суммы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quantity'>Количество выполненой работы</label>
                                    <input name='quantity' value='{{ $workOrdersAmountsList->quantity }}' id='quantity' type='text' maxlength="50" readonly class="form-control" title='Количество выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='price'>Цена единицы</label>
                                    <input name='price' value='{{ $workOrdersAmountsList->price }}' id='price' type='text' maxlength="50" readonly class="form-control" title='Цена единицы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма выполненой работы</label>
                                    <input name='amount' value='{{ $workOrdersAmountsList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holidays_amount'>Сумма выполненой работы в праздники</label>
                                    <input name='holidays_amount' value='{{ $workOrdersAmountsList->holidays_amount }}' id='holidays_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма выполненой работы в праздники'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработано часов на выполнение наряда</label>
                                    <input name='hours' value='{{ $workOrdersAmountsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Отработано часов на выполнение наряда'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.work-orders-amounts.destroy', $workOrdersAmountsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.work-orders-amounts.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.work-orders-amounts.edit', $workOrdersAmountsList->id) }}">{{ __('Изменить') }}</a>
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