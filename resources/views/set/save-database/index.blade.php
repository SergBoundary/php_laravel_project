@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\SaveDatabase $menu, $title, $saveDatabaseList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($saveDatabaseList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название параметра</th>
                        <th class="align-middle" scope="col">Ответственный модуль</th>
                        <th class="align-middle" scope="col">Выполняемая команда</th>
                        <th class="align-middle" scope="col">День месяца запуска команды</th>
                        <th class="align-middle" scope="col">День недели запуска команды</th>
                        <th class="align-middle" scope="col">Время запуска команды</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.save-database.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($saveDatabaseList as $saveDatabaseRow)
                        <tr>
                            <td>{{ $saveDatabaseRow->title }}</td>
                            <td>{{ $saveDatabaseRow->module }}</td>
                            <td>{{ $saveDatabaseRow->comman }}</td>
                            <td>{{ $saveDatabaseRow->month_day }}</td>
                            <td>{{ $saveDatabaseRow->week_day }}</td>
                            <td>{{ $saveDatabaseRow->run_time }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.save-database.destroy', $saveDatabaseRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.save-database.show', $saveDatabaseRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.save-database.edit', $saveDatabaseRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.save-database.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection