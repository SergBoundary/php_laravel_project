@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Calculations\Paychecks $menu, $title, $paychecksList */
        $personalCards = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($paychecksList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Год</th>
                        <th class="align-middle" scope="col">Месяц</th>
                        <th class="align-middle" scope="col">Остаток</th>
                        <th class="align-middle" scope="col">Почасово</th>
                        <th class="align-middle" scope="col">Сдельно</th>
                        <th class="align-middle" scope="col">Начислено</th>
                        <th class="align-middle" scope="col">Удержано</th>
                        <th class="align-middle" scope="col">Выдано</th>
                        <th class="align-middle" scope="col">К выдаче</th>
                        <th class="align-middle" scope="col">Долг</th>
                        <th scope="col">
						    @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.paychecks.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
						    @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($paychecksList as $paychecksRow)
                        @if ($personalCards != $paychecksRow->personal_card)
                        <tr>
                            <td colspan="12" class="text-muted text-uppercase"><em>{{ $paychecksRow->personal_card }}, {{ $paychecksRow->surname }} {{ $paychecksRow->first_name }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $paychecksRow->year }}</td>
                            <td>{{ $paychecksRow->month }}</td>
                            <td>{{ $paychecksRow->balance_start }}</td>
                            <td>{{ $paychecksRow->hourly }}</td>
                            <td>{{ $paychecksRow->piecework }}</td>
                            <td>{{ $paychecksRow->accrual }}</td>
                            <td>{{ $paychecksRow->retention }}</td>
                            <td>{{ $paychecksRow->issued_by }}</td>
                            <td>{{ $paychecksRow->give_out }}</td>
                            <td>{{ $paychecksRow->debt }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('calc.paychecks.destroy', $paychecksRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.paychecks.show', $paychecksRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.paychecks.edit', $paychecksRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('calc.paychecks.show', $paychecksRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $paychecksRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('calc.paychecks.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection