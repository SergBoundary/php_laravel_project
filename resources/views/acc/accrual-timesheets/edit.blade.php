@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\AccrualTimesheets $menu, $title, $accrualTimesheetsList
         * @var \Illuminate\Database\Eloquent $accrualsList, $accountsList, $baseTimesheetsList, $objectsList, $yearsList, $monthsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.accrual-timesheets.update', $accrualTimesheetsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.accrual-timesheets.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Вид начиcления</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='{{ $accrualTimesheetsList->accruals_id }}' id='accrual_id' type='text' placeholder="Вид начиcления" class="form-control" title='Вид начиcления' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" 
                                                @if($accrualsOption->id == $accrualTimesheetsList->accrual_id) selected @endif>
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
                                    <label for='account_id'>Номера бухгалтерского счета</label>
                                    <div class="input-group mb-3"
>                                        <select name='account_id' value='{{ $accrualTimesheetsList->accounts_id }}' id='account_id' type='text' placeholder="Номера бухгалтерского счета" class="form-control" title='Номера бухгалтерского счета' required>
                                            @foreach($accountsList as $accountsOption)
                                            <option value="{{ $accountsOption->id }}" 
                                                @if($accountsOption->id == $accrualTimesheetsList->account_id) selected @endif>
                                                {{ $accountsOption->account }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accounts.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='base_timesheet_id'>Запись отработанного времени</label>
                                    <div class="input-group mb-3"
>                                        <select name='base_timesheet_id' value='{{ $accrualTimesheetsList->base_timesheets_id }}' id='base_timesheet_id' type='text' placeholder="Запись отработанного времени" class="form-control" title='Запись отработанного времени' required>
                                            @foreach($baseTimesheetsList as $baseTimesheetsOption)
                                            <option value="{{ $base_timesheetsOption->id }}" 
                                                @if($baseTimesheetsOption->id == $accrualTimesheetsList->base_timesheet_id) selected @endif>
                                                {{ $baseTimesheetsOption->base_timesheet }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('acc.base-timesheets.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object_id'>Объект выполнения работ</label>
                                    <div class="input-group mb-3"
>                                        <select name='object_id' value='{{ $accrualTimesheetsList->objects_id }}' id='object_id' type='text' placeholder="Объект выполнения работ" class="form-control" title='Объект выполнения работ' required>
                                            @foreach($objectsList as $objectsOption)
                                            <option value="{{ $objectsOption->id }}" 
                                                @if($objectsOption->id == $accrualTimesheetsList->object_id) selected @endif>
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
                                    <label for='year_id'>Отработанные дни</label>
                                    <div class="input-group mb-3"
>                                        <select name='year_id' value='{{ $accrualTimesheetsList->years_id }}' id='year_id' type='text' placeholder="Отработанные дни" class="form-control" title='Отработанные дни' required>
                                            @foreach($yearsList as $yearsOption)
                                            <option value="{{ $yearsOption->id }}" 
                                                @if($yearsOption->id == $accrualTimesheetsList->year_id) selected @endif>
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
                                    <label for='month_id'>Отработанные часы</label>
                                    <div class="input-group mb-3"
>                                        <select name='month_id' value='{{ $accrualTimesheetsList->months_id }}' id='month_id' type='text' placeholder="Отработанные часы" class="form-control" title='Отработанные часы' required>
                                            @foreach($monthsList as $monthsOption)
                                            <option value="{{ $monthsOption->id }}" 
                                                @if($monthsOption->id == $accrualTimesheetsList->month_id) selected @endif>
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
                                    <label for='days'>Месяц учета</label>
                                    <input name='days' value='{{ $accrualTimesheetsList->days }}' id='days' type='text' maxlength="50" class="form-control" title='Месяц учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Год учета</label>
                                    <input name='hours' value='{{ $accrualTimesheetsList->hours }}' id='hours' type='text' maxlength="50" class="form-control" title='Год учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.accrual-timesheets.show', $accrualTimesheetsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.accrual-timesheets.show', $accrualTimesheetsList->id) }}">{{ __('Отмена') }}</a>
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