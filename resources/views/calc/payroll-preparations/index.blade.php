@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Calculations\PayrollPreparations $menu, $title, $payrollPreparationsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($payrollPreparationsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.payroll-preparations.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($payrollPreparationsList as $payrollPreparationsRow)
                        <tr>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('calc.payroll-preparations.destroy', $payrollPreparationsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.payroll-preparations.show', $payrollPreparationsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.payroll-preparations.edit', $payrollPreparationsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.payroll-preparations.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection