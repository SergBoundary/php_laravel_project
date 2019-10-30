@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\DepartmentAccruals $menu, $title, $departmentAccrualsList */
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
                                    <input name='accrual' value='{{ $departmentAccrualsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Вид начиcления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $departmentAccrualsList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='team'>Бригада</label>
                                    <input name='team' value='{{ $departmentAccrualsList->team }}' id='team' type='text' maxlength="50" readonly class="form-control" title='Бригада'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='object'>Объект</label>
                                    <input name='object' value='{{ $departmentAccrualsList->object }}' id='object' type='text' maxlength="50" readonly class="form-control" title='Объект'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_amount'>Сумма начисления по подразделению</label>
                                    <input name='accrual_amount' value='{{ $departmentAccrualsList->accrual_amount }}' id='accrual_amount' type='text' maxlength="50" readonly class="form-control" title='Сумма начисления по подразделению'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_date'>Дата ввода начисления</label>
                                    <input name='accrual_date' value='{{ $departmentAccrualsList->accrual_date }}' id='accrual_date' type='text' maxlength="50" readonly class="form-control" title='Дата ввода начисления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год расчета</label>
                                    <input name='year' value='{{ $departmentAccrualsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц расчета</label>
                                    <input name='month' value='{{ $departmentAccrualsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц расчета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='loade'>Статус загрузки</label>
                                    <input name='loade' value='{{ $departmentAccrualsList->loade }}' id='loade' type='text' maxlength="50" readonly class="form-control" title='Статус загрузки'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.department-accruals.destroy', $departmentAccrualsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.department-accruals.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.department-accruals.edit', $departmentAccrualsList->id) }}">{{ __('Изменить') }}</a>
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