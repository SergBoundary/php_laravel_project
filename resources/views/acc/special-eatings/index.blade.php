@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\Accounting\SpecialEatings $menu, $title, $specialEatingsList */
        $personalCards = "";
        $years = "";
        $months = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($specialEatingsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Остаток суммы на начало месяца</th>
                        <th class="align-middle" scope="col">Сумма затрат</th>
                        <th class="align-middle" scope="col">Отработано часов за месяц</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.special-eatings.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($specialEatingsList as $specialEatingsRow)
                        @if ($personalCards != $specialEatingsRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $specialEatingsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($years != $specialEatingsRow->year)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $specialEatingsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($months != $specialEatingsRow->month)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>   {{ $specialEatingsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $specialEatingsRow->residual_amount }}</td>
                            <td>{{ $specialEatingsRow->amount }}</td>
                            <td>{{ $specialEatingsRow->hours }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('acc.special-eatings.destroy', $specialEatingsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.special-eatings.show', $specialEatingsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('acc.special-eatings.edit', $specialEatingsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $specialEatingsRow->personal_card;
                            $years = $specialEatingsRow->year;
                            $months = $specialEatingsRow->month;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('acc.special-eatings.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection