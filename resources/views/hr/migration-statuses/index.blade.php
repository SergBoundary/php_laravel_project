@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\MigrationStatuses $menu, $title, $migrationStatusesList */
        $personalCards = "";
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($migrationStatusesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Текущий статус пребывания</th>
                        <th class="align-middle" scope="col">Новый статус пребывания</th>
                        <th class="align-middle" scope="col">Дата открытия пребывания в стране</th>
                        <th class="align-middle" scope="col">Дата закрытия пребывания в стране</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.migration-statuses.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($migrationStatusesList as $migrationStatusesRow)
                        @if ($personalCards != $migrationStatusesRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $migrationStatusesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $migrationStatusesRow->country)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $migrationStatusesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $migrationStatusesRow->status_ol }}</td>
                            <td>{{ $migrationStatusesRow->status_new }}</td>
                            <td>{{ $migrationStatusesRow->date_opening }}</td>
                            <td>{{ $migrationStatusesRow->date_closing }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.migration-statuses.destroy', $migrationStatusesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.migration-statuses.show', $migrationStatusesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.migration-statuses.edit', $migrationStatusesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $migrationStatusesRow->personal_card;
                            $countries = $migrationStatusesRow->country;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.migration-statuses.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection