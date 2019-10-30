@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\ManningTables $menu, $title, $manningTablesList
         * @var \Illuminate\Database\Eloquent $departmentsList, $positionsList, $ranksList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.manning-tables.update', $manningTablesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.manning-tables.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='department_id'>Подразделение</label>
                                    <div class="input-group mb-3"
>                                        <select name='department_id' value='{{ $manningTablesList->departments_id }}' id='department_id' type='text' placeholder="Подразделение" class="form-control" title='Подразделение' required>
                                            @foreach($departmentsList as $departmentsOption)
                                            <option value="{{ $departmentsOption->id }}" 
                                                @if($departmentsOption->id == $manningTablesList->department_id) selected @endif>
                                                {{ $departmentsOption->department }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.departments.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_id'>Должность</label>
                                    <div class="input-group mb-3"
>                                        <select name='position_id' value='{{ $manningTablesList->positions_id }}' id='position_id' type='text' placeholder="Должность" class="form-control" title='Должность' required>
                                            @foreach($positionsList as $positionsOption)
                                            <option value="{{ $positionsOption->id }}" 
                                                @if($positionsOption->id == $manningTablesList->position_id) selected @endif>
                                                {{ $positionsOption->position }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.positions.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rank_id'>Уровень квалификации</label>
                                    <div class="input-group mb-3"
>                                        <select name='rank_id' value='{{ $manningTablesList->ranks_id }}' id='rank_id' type='text' placeholder="Уровень квалификации" class="form-control" title='Уровень квалификации' required>
                                            @foreach($ranksList as $ranksOption)
                                            <option value="{{ $ranksOption->id }}" 
                                                @if($ranksOption->id == $manningTablesList->rank_id) selected @endif>
                                                {{ $ranksOption->rank }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.ranks.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='quantity'>Количество работников в штате</label>
                                    <input name='quantity' value='{{ $manningTablesList->quantity }}' id='quantity' type='text' maxlength="50" class="form-control" title='Количество работников в штате'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='salary'>Оклад</label>
                                    <input name='salary' value='{{ $manningTablesList->salary }}' id='salary' type='text' maxlength="50" class="form-control" title='Оклад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Тариф</label>
                                    <input name='tariff' value='{{ $manningTablesList->tariff }}' id='tariff' type='text' maxlength="50" class="form-control" title='Тариф'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.manning-tables.show', $manningTablesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.manning-tables.show', $manningTablesList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection