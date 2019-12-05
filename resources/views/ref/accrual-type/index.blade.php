@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Objects $menu, $title, $objectsList */
        $objectGroups = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($objectsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Код объекта</th>
                        <th class="align-middle" scope="col">Объект выполнения работ</th>
                        <th class="align-middle" scope="col">Аббривиатура</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.objects.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($objectsList as $objectsRow)
                        <tr>
                            <td>{{ $objectsRow->code }}</td>
                            <td>{{ $objectsRow->title }}</td>
                            <td>{{ $objectsRow->abbr }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.objects.destroy', $objectsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.objects.show', $objectsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.objects.edit', $objectsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $objectGroups = $objectsRow->object_group;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.objects.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection