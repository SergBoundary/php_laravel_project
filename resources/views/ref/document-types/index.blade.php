@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\DocumentTypes $menu, $title, $documentTypesList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($documentTypesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Название документа</th>
                        <th class="align-middle" scope="col">Абривиатура документа</th>
                        <th class="align-middle" scope="col">Стандартный документ</th>
                        <th class="align-middle" scope="col">Неизменная часть номера документа</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.document-types.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($documentTypesList as $documentTypesRow)
                        <tr>
                            <td>{{ $documentTypesRow->title }}</td>
                            <td>{{ $documentTypesRow->abbr }}</td>
                            <td>{{ $documentTypesRow->standart_status }}</td>
                            <td>{{ $documentTypesRow->standart_number }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.document-types.destroy', $documentTypesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.document-types.show', $documentTypesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.document-types.edit', $documentTypesRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.document-types.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection