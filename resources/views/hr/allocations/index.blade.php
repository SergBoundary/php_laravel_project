@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList */
        $personalCards = "";
    @endphp
    <div id="interface-modul" modul="allocations-index"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{ $interface['title'] }}</small></h3><br />
                @if(count($allocationsList) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="align-middle" scope="col">Сотрудник</th>
                        <th class="align-middle" scope="col">Т/н</th>
                        <th class="align-middle" scope="col">Объект</th>
                        <th class="align-middle" scope="col">Бригада</th>
                        <th class="align-middle" scope="col">Прикреплен</th>
                        <th class="align-middle" scope="col">Откреплен</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($allocationsList as $allocationsRow)
                        <tr>
                            @if ($personalCards != $allocationsRow->personal_card)
                                <td>{{ $allocationsRow->surname }} {{ $allocationsRow->first_name }}</td>
                                <td>{{ $allocationsRow->personal_card }}</td>
                            @else
                                <td colspan="2"> </td>
                            @endif
                            <td>{{ $allocationsRow->object }}</td>
                            <td>{{ $allocationsRow->team }}</td>
                            <td>{{ $allocationsRow->start }}</td>
                            <td>{{ $allocationsRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('hr.allocations.destroy', $allocationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.show', $allocationsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.edit', $allocationsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.show', $allocationsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $allocationsRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection