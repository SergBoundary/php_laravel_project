@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList */
        $personalCards = "";
        $departments = "";
        $positions = "";
        $positionProfessions = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($manningOrdersList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Подразделение</th>
                        <th class="align-middle" scope="col">Должность</th>
                        <th class="align-middle" scope="col">Формальная должность</th>
                        <th class="align-middle" scope="col">Назначен</th>
                        <th class="align-middle" scope="col">Снят</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.create') }}">{{ __('Добавить') }}</a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($manningOrdersList as $manningOrdersRow)
                        @if ($personalCards != $manningOrdersRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>{{ $manningOrdersRow->personal_card }}, {{ $manningOrdersRow->surname }} {{ $manningOrdersRow->first_name }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $manningOrdersRow->department }}</td>
                            <td>{{ $manningOrdersRow->position }}</td>
                            <td>{{ $manningOrdersRow->position_profession }}</td>
                            <td>{{ $manningOrdersRow->assignment_date }}</td>
                            <td>{{ $manningOrdersRow->resignation_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('hr.manning-orders.destroy', $manningOrdersRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.show', $manningOrdersRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.edit', $manningOrdersRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.show', $manningOrdersRow->id) }}">{{ __('Открыть') }}</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $manningOrdersRow->personal_card;
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