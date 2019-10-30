@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Settings\Constants $menu, $title, $constantsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($constantsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название константы</th>
                        <th class="align-middle" scope="col">Числовой параметр</th>
                        <th class="align-middle" scope="col">Строчный параметр</th>
                        <th class="align-middle" scope="col">Дата и время включения константы</th>
                        <th class="align-middle" scope="col">Дата и время выключения константы</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.constants.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($constantsList as $constantsRow)
                        <tr>
                            <td>{{ $constantsRow->title }}</td>
                            <td>{{ $constantsRow->value_number }}</td>
                            <td>{{ $constantsRow->value_string }}</td>
                            <td>{{ $constantsRow->start }}</td>
                            <td>{{ $constantsRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('set.constants.destroy', $constantsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.constants.show', $constantsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('set.constants.edit', $constantsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('set.constants.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection