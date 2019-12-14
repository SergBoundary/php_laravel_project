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
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($manningOrdersList) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="align-middle" scope="col">Подразделение</th>
                        <th class="align-middle" scope="col">Т/н</th>
                        <th class="align-middle" scope="col">Сотрудник</th>
                        <th class="align-middle" scope="col">Должность</th>
                        <th class="align-middle" scope="col">Формальная должность</th>
                        <th class="align-middle" scope="col">Назначен</th>
                        <th class="align-middle" scope="col">Снят</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.manning-orders.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($manningOrdersList as $manningOrdersRow)
                        <tr>
                            <td>
                                @if ($departments != $manningOrdersRow->department)
                                {{ $manningOrdersRow->department }}
                                @endif
                            </td>
                            @if ($personalCards != $manningOrdersRow->personal_card)
                            <td>
                                {{ $manningOrdersRow->personal_card }}
                            </td>
                            <td>
                                {{ $manningOrdersRow->surname }} {{ $manningOrdersRow->first_name }}
                            </td>
                            @else
                            <td colspan="2"> </td>
                            @endif
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
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.show', $manningOrdersRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.edit', $manningOrdersRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.manning-orders.show', $manningOrdersRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $departments = $manningOrdersRow->department;
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