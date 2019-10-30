@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\ManningTables $menu, $title, $manningTablesList */
        $departments = "";
        $positions = "";
        $ranks = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($manningTablesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Количество работников в штате</th>
                        <th class="align-middle" scope="col">Оклад</th>
                        <th class="align-middle" scope="col">Тариф</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.manning-tables.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($manningTablesList as $manningTablesRow)
                        @if ($departments != $manningTablesRow->department)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $manningTablesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($positions != $manningTablesRow->position)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $manningTablesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($ranks != $manningTablesRow->rank)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $manningTablesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $manningTablesRow->quantity }}</td>
                            <td>{{ $manningTablesRow->salary }}</td>
                            <td>{{ $manningTablesRow->tariff }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.manning-tables.destroy', $manningTablesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.manning-tables.show', $manningTablesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.manning-tables.edit', $manningTablesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $departments = $manningTablesRow->department;
                            $positions = $manningTablesRow->position;
                            $ranks = $manningTablesRow->rank;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.manning-tables.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection