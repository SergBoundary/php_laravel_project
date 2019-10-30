@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\AccrualGroups $menu, $title, $accrualGroupsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($accrualGroupsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Группа начисления</th>
                        <th class="align-middle" scope="col">Описание группы расчета</th>
                        <th class="align-middle" scope="col">Тип начисления</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accrual-groups.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($accrualGroupsList as $accrualGroupsRow)
                        <tr>
                            <td>{{ $accrualGroupsRow->title }}</td>
                            <td>{{ $accrualGroupsRow->description }}</td>
                            <td>{{ $accrualGroupsRow->type }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.accrual-groups.destroy', $accrualGroupsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accrual-groups.show', $accrualGroupsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.accrual-groups.edit', $accrualGroupsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.accrual-groups.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection