@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\WorkOrdersAmounts $menu, $title, $workOrdersAmountsList */
        $personalCards = "";
        $workOrders = "";
        $pieceworks = "";
        $accounts = "";
        $objects = "";
        $algorithms = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($workOrdersAmountsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="7">Сумма выполненой работы</th>
                        <th class="align-middle" scope="col">Сумма выполненой работы в праздники</th>
                        <th class="align-middle" scope="col">Отработано часов на выполнение наряда</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.work-orders-amounts.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($workOrdersAmountsList as $workOrdersAmountsRow)
                        @if ($personalCards != $workOrdersAmountsRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($workOrders != $workOrdersAmountsRow->work_order)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($pieceworks != $workOrdersAmountsRow->piecework)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $workOrdersAmountsRow->account)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>    {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $workOrdersAmountsRow->object)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>     {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($algorithms != $workOrdersAmountsRow->algorithm)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>      {{ $workOrdersAmountsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $workOrdersAmountsRow->amount }}</td>
                            <td>{{ $workOrdersAmountsRow->holidays_amount }}</td>
                            <td>{{ $workOrdersAmountsRow->hours }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.work-orders-amounts.destroy', $workOrdersAmountsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.work-orders-amounts.show', $workOrdersAmountsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.work-orders-amounts.edit', $workOrdersAmountsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $workOrdersAmountsRow->personal_card;
                            $workOrders = $workOrdersAmountsRow->work_order;
                            $pieceworks = $workOrdersAmountsRow->piecework;
                            $accounts = $workOrdersAmountsRow->account;
                            $objects = $workOrdersAmountsRow->object;
                            $algorithms = $workOrdersAmountsRow->algorithm;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.work-orders-amounts.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection