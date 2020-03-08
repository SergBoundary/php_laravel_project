@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Objects $menu, $title, $objectsList */
        $objectGroups = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($objectsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Код</th>
                        <th class="align-middle" scope="col">Название объекта</th>
                        <th class="align-middle" scope="col">Бригады</th>
                        <th class="align-middle" scope="col">Сотрудники</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.objects.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($objectsList as $objectsRow)
                        <tr>
                            <td>{{ $objectsRow->abbr }}</td>
                            <td>{{ $objectsRow->title }}</td>
                            <td>2</td>
                            <td>5</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('ref.objects.destroy', $objectsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.objects.show', $objectsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.objects.edit', $objectsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.objects.show', $objectsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
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