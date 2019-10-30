@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\SalaryCards $menu, $title, $salaryCardsList */
        $personalCards = "";
        $banks = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($salaryCardsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Номер банковской карточки</th>
                        <th class="align-middle" scope="col">Истечение срока действия</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.salary-cards.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($salaryCardsList as $salaryCardsRow)
                        @if ($personalCards != $salaryCardsRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $salaryCardsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($banks != $salaryCardsRow->bank)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em>  {{ $salaryCardsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $salaryCardsRow->payment_car }}</td>
                            <td>{{ $salaryCardsRow->expiry }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.salary-cards.destroy', $salaryCardsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.salary-cards.show', $salaryCardsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.salary-cards.edit', $salaryCardsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $salaryCardsRow->personal_card;
                            $banks = $salaryCardsRow->bank;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.salary-cards.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection