@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\Departments $menu, $title, $departmentsList */
        $departmentGroups = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($departmentsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Аббривиатура</th>
                        <th class="align-middle" scope="col">Название подразделения</th>
                        <th class="align-middle" scope="col">Бригады</th>
                        <th class="align-middle" scope="col">Сотрудники</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.departments.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($departmentsList as $departmentsRow)
                        <tr>
                            <td>{{ $departmentsRow->abbr }}</td>
                            <td>{{ $departmentsRow->title }}</td>
                            <td>5</td>
                            <td>25</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('ref.departments.destroy', $departmentsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.departments.show', $departmentsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.departments.edit', $departmentsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.departments.show', $departmentsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.departments.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection