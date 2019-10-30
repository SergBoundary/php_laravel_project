@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\DepartmentAccruals $menu, $title, $departmentAccrualsList */
        $accruals = "";
        $departments = "";
        $teams = "";
        $objects = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($departmentAccrualsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="7">Сумма начисления по подразделению</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.department-accruals.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($departmentAccrualsList as $departmentAccrualsRow)
                        @if ($accruals != $departmentAccrualsRow->accrual)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em> {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($departments != $departmentAccrualsRow->department)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>  {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($teams != $departmentAccrualsRow->team)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>   {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($objects != $departmentAccrualsRow->object)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>    {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $departmentAccrualsRow->year)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>     {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $departmentAccrualsRow->month)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em>      {{ $departmentAccrualsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $departmentAccrualsRow->accrual_amount }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.department-accruals.destroy', $departmentAccrualsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.department-accruals.show', $departmentAccrualsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.department-accruals.edit', $departmentAccrualsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $accruals = $departmentAccrualsRow->accrual;
                            $departments = $departmentAccrualsRow->department;
                            $teams = $departmentAccrualsRow->team;
                            $objects = $departmentAccrualsRow->object;
                            $years = $departmentAccrualsRow->year;
                            $months = $departmentAccrualsRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.department-accruals.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection