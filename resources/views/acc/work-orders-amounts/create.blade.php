@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\WorkOrdersAmounts $menu, $title, $workOrdersAmountsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $workOrdersList, $pieceworksList, $accountsList, $objectsList, $algorithmsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.work-orders-amounts.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.work-orders-amounts.includes.result_messages')
                            <div class="row justify-content-center">
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
                                    <label for='work_order_id'>Номер наряда</label>
                                    <div class="input-group mb-3"
>                                        <select name='work_order_id' value='work_order_id' id='work_order_id' type='text' placeholder="Номер наряда" class="form-control" title='Номер наряда' required>
                                            @foreach($workOrdersList as $workOrdersOption)
                                            <option value="{{ $work_ordersOption->id }}" >
                                                {{ $workOrdersOption->work_order }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('acc.work-orders.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='piecework_id'>Сдельная работа</label>
                                    <div class="input-group mb-3"
>                                        <select name='piecework_id' value='piecework_id' id='piecework_id' type='text' placeholder="Сдельная работа" class="form-control" title='Сдельная работа' required>
                                            @foreach($pieceworksList as $pieceworksOption)
                                            <option value="{{ $pieceworksOption->id }}" >
                                                {{ $pieceworksOption->piecework }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.pieceworks.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_id'>Счет затрат выполненой работы</label>
                                    <div class="input-group mb-3"
>                                        <select name='account_id' value='account_id' id='account_id' type='text' placeholder="Счет затрат выполненой работы" class="form-control" title='Счет затрат выполненой работы' required>
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
                                    <label for='object_id'>Объект выполнения работ</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='object_id' id='object_id' type='text' placeholder="Объект выполнения работ" class="form-control" title='Объект выполнения работ' required>
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
                                    <label for='algorithm_id'>Алгоритм расчета суммы</label>
                                    <div class="input-group mb-3"
>                                        <select name='algorithm_id' value='algorithm_id' id='algorithm_id' type='text' placeholder="Алгоритм расчета суммы" class="form-control" title='Алгоритм расчета суммы' required>
                                            @foreach($algorithmsList as $algorithmsOption)
                                            <option value="{{ $algorithmsOption->id }}" >
                                                {{ $algorithmsOption->algorithm }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.algorithms.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quantity'>Количество выполненой работы</label>
                                    <input name='quantity' id='quantity' type='text' maxlength="50" class="form-control" title='Количество выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='price'>Цена единицы</label>
                                    <input name='price' id='price' type='text' maxlength="50" class="form-control" title='Цена единицы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма выполненой работы</label>
                                    <input name='amount' id='amount' type='text' maxlength="50" class="form-control" title='Сумма выполненой работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holidays_amount'>Сумма выполненой работы в праздники</label>
                                    <input name='holidays_amount' id='holidays_amount' type='text' maxlength="50" class="form-control" title='Сумма выполненой работы в праздники'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Отработано часов на выполнение наряда</label>
                                    <input name='hours' id='hours' type='text' maxlength="50" class="form-control" title='Отработано часов на выполнение наряда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.work-orders-amounts.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.work-orders-amounts.index') }}">{{ __('Отмена') }}</a>
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