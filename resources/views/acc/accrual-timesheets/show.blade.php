@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\AccrualTimesheets $menu, $title, $accrualTimesheetsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Вид начиcления</label>
                                    <input name='accrual' value='{{ $accrualTimesheetsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account'>Номера бухгалтерского счета</label>
                                    <input name='account' value='{{ $accrualTimesheetsList->account }}' id='account' type='text' maxlength="50" readonly class="form-control" title='Номера бухгалтерского счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='base_timesheet'>Запись отработанного времени</label>
                                    <input name='base_timesheet' value='{{ $accrualTimesheetsList->base_timesheet }}' id='base_timesheet' type='text' maxlength="50" readonly class="form-control" title='Запись отработанного времени'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект выполнения работ</label>
                                    <input name='object' value='{{ $accrualTimesheetsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект выполнения работ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Отработанные дни</label>
                                    <input name='year' value='{{ $accrualTimesheetsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Отработанные дни'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Отработанные часы</label>
                                    <input name='month' value='{{ $accrualTimesheetsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Отработанные часы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='days'>Месяц учета</label>
                                    <input name='days' value='{{ $accrualTimesheetsList->days }}' id='days' type='text' maxlength="50" readonly class="form-control" title='Месяц учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hours'>Год учета</label>
                                    <input name='hours' value='{{ $accrualTimesheetsList->hours }}' id='hours' type='text' maxlength="50" readonly class="form-control" title='Год учета'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.accrual-timesheets.destroy', $accrualTimesheetsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.accrual-timesheets.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.accrual-timesheets.edit', $accrualTimesheetsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection