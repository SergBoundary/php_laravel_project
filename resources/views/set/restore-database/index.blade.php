@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\RestoreDatabase $menu, $title, $restoreDatabaseList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($restoreDatabaseList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название параметра</th>
                        <th class="align-middle" scope="col">Ответственный модуль</th>
                        <th class="align-middle" scope="col">Выполняемая команда</th>
                        <th class="align-middle" scope="col">Параметр выполнения команды</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.restore-database.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($restoreDatabaseList as $restoreDatabaseRow)
                        <tr>
                            <td>{{ $restoreDatabaseRow->title }}</td>
                            <td>{{ $restoreDatabaseRow->module }}</td>
                            <td>{{ $restoreDatabaseRow->comman }}</td>
                            <td>{{ $restoreDatabaseRow->parametr }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.restore-database.destroy', $restoreDatabaseRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.restore-database.show', $restoreDatabaseRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.restore-database.edit', $restoreDatabaseRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.restore-database.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection