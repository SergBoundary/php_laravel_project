@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Calculations\ClosingFinancialPeriods $menu, $title, $closingFinancialPeriodsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($closingFinancialPeriodsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.closing-financial-periods.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($closingFinancialPeriodsList as $closingFinancialPeriodsRow)
                        <tr>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('calc.closing-financial-periods.destroy', $closingFinancialPeriodsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.closing-financial-periods.show', $closingFinancialPeriodsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.closing-financial-periods.edit', $closingFinancialPeriodsRow->id) }}">{{ __('Изменить') }}</a>
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
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.closing-financial-periods.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection