@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Calculations\Payrolls $menu, $title, $payrollsList */
        $personalCards = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($payrollsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Начислено</th>
                        <th class="align-middle" scope="col">Удержано</th>
                        <th class="align-middle" scope="col">К выдаче</th>
                        <th class="align-middle" scope="col">Долг</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.payrolls.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($payrollsList as $payrollsRow)
                        @if ($personalCards != $payrollsRow->personal_card)
                        <tr>
                            <td colspan="8" class="text-muted text-uppercase"><em> {{ $payrollsRow->personal_card }}, {{ $payrollsRow->surname }} {{ $payrollsRow->first_name }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $payrollsRow->year }}</td>
                            <td>{{ $payrollsRow->month }}</td>
                            <td>{{ $payrollsRow->accrual }}</td>
                            <td>{{ $payrollsRow->retention }}</td>
                            <td>{{ $payrollsRow->give_out }}</td>
                            <td>{{ $payrollsRow->debt }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('calc.payrolls.destroy', $payrollsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.payrolls.show', $payrollsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.payrolls.edit', $payrollsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.payrolls.show', $payrollsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $payrollsRow->personal_card;
                            $years = $payrollsRow->year;
                            $months = $payrollsRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.payrolls.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection