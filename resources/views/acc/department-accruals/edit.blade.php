@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\DepartmentAccruals $menu, $title, $departmentAccrualsList
         * @var \Illuminate\Database\Eloquent $accrualsList, $departmentsList, $teamsList, $objectsList, $yearsList, $monthsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.department-accruals.update', $departmentAccrualsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.department-accruals.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Вид начиcления</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='{{ $departmentAccrualsList->accruals_id }}' id='accrual_id' type='text' placeholder="Вид начиcления" class="form-control" title='Вид начиcления' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" 
                                                @if($accrualsOption->id == $departmentAccrualsList->accrual_id) selected @endif>
                                                {{ $accrualsOption->accrual }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department_id'>Подразделение</label>
                                    <div class="input-group mb-3"
>                                        <select name='department_id' value='{{ $departmentAccrualsList->departments_id }}' id='department_id' type='text' placeholder="Подразделение" class="form-control" title='Подразделение' required>
                                            @foreach($departmentsList as $departmentsOption)
                                            <option value="{{ $departmentsOption->id }}" 
                                                @if($departmentsOption->id == $departmentAccrualsList->department_id) selected @endif>
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
                                    <label for='team_id'>Бригада</label>
                                    <div class="input-group mb-3"
>                                        <select name='team_id' value='{{ $departmentAccrualsList->teams_id }}' id='team_id' type='text' placeholder="Бригада" class="form-control" title='Бригада' required>
                                            @foreach($teamsList as $teamsOption)
                                            <option value="{{ $teamsOption->id }}" 
                                                @if($teamsOption->id == $departmentAccrualsList->team_id) selected @endif>
                                                {{ $teamsOption->team }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.teams.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object_id'>Объект</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='{{ $departmentAccrualsList->objects_id }}' id='object_id' type='text' placeholder="Объект" class="form-control" title='Объект' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" 
                                                @if($objectsOption->id == $departmentAccrualsList->object_id) selected @endif>
                                                {{ $objectsOption->object }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.objects.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year_id'>Год расчета</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='{{ $departmentAccrualsList->years_id }}' id='year_id' type='text' placeholder="Год расчета" class="form-control" title='Год расчета' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $departmentAccrualsList->year_id) selected @endif>
                                                {{ $yearsOption->year }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.years.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month_id'>Месяц расчета</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='{{ $departmentAccrualsList->months_id }}' id='month_id' type='text' placeholder="Месяц расчета" class="form-control" title='Месяц расчета' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" 
                                                @if($monthsOption->id == $departmentAccrualsList->month_id) selected @endif>
                                                {{ $monthsOption->month }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.months.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления по подразделению</label>
                                    <input name='accrual_amount' value='{{ $departmentAccrualsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" class="form-control" title='Сумма начисления по подразделению'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_date'>Дата ввода начисления</label>
                                    <input name='accrual_date' value='{{ $departmentAccrualsList->accrual_date }}' id='accrual_date' type='text' maxlength="50" class="form-control" title='Дата ввода начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='loaded'>Статус загрузки</label>
                                    <input name='loaded' value='{{ $departmentAccrualsList->loaded }}' id='loaded' type='text' maxlength="50" class="form-control" title='Статус загрузки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.department-accruals.show', $departmentAccrualsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.department-accruals.show', $departmentAccrualsList->id) }}">{{ __('Отмена') }}</a>
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