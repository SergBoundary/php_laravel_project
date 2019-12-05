@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\Allocations $menu, $title, $allocationsList */
        $personalCards = "";
        $objects = "";
        $teams = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($allocationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Работник</th>
                        <th class="align-middle" scope="col">Объект</th>
                        <th class="align-middle" scope="col">Бригада</th>
                        <th class="align-middle" scope="col">Прикреплен</th>
                        <th class="align-middle" scope="col">Откреплен</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.allocations.create') }}">{{ __('Добавить') }}</a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($allocationsList as $allocationsRow)
                        <tr>
                            <td>{{ $allocationsRow->personal_card }}, {{ $allocationsRow->surname }} {{ $allocationsRow->first_name }}</td>
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
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.show', $allocationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.edit', $allocationsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.allocations.show', $allocationsRow->id) }}">{{ __('Открыть') }}</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
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