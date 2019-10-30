@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\WorkOrders $menu, $title, $workOrdersList */
        $departments = "";
        $objects = "";
        $teams = "";
        $accounts = "";
        $algorithms = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($workOrdersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="8">Дата наряда</th>
                        <th class="align-middle" scope="col">Номер наряда</th>
                        <th class="align-middle" scope="col">Сумма наряда</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.work-orders.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($workOrdersList as $workOrdersRow)
                        @if ($departments != $workOrdersRow->department)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $workOrdersRow->object)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $workOrdersRow->team)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($accounts != $workOrdersRow->account)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>    {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($algorithms != $workOrdersRow->algorithm)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>     {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $workOrdersRow->year)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>      {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $workOrdersRow->month)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>       {{ $workOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $workOrdersRow->date }}</td>
                            <td>{{ $workOrdersRow->number }}</td>
                            <td>{{ $workOrdersRow->amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.work-orders.destroy', $workOrdersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.work-orders.show', $workOrdersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.work-orders.edit', $workOrdersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $departments = $workOrdersRow->department;
                            $objects = $workOrdersRow->object;
                            $teams = $workOrdersRow->team;
                            $accounts = $workOrdersRow->account;
                            $algorithms = $workOrdersRow->algorithm;
                            $years = $workOrdersRow->year;
                            $months = $workOrdersRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.work-orders.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection