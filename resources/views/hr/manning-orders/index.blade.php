@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList */
        $personalCards = "";
        $manningTables = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($manningOrdersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Дата назначения</th>
                        <th class="align-middle" scope="col">Приказ о назначении</th>
                        <th class="align-middle" scope="col">Дата снятия</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($manningOrdersList as $manningOrdersRow)
                        @if ($personalCards != $manningOrdersRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $manningOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($manningTables != $manningOrdersRow->manning_table)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $manningOrdersRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $manningOrdersRow->assignment_date }}</td>
                            <td>{{ $manningOrdersRow->assignment_order }}</td>
                            <td>{{ $manningOrdersRow->resignation_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.manning-orders.destroy', $manningOrdersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.show', $manningOrdersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.edit', $manningOrdersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $manningOrdersRow->personal_card;
                            $manningTables = $manningOrdersRow->manning_table;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection