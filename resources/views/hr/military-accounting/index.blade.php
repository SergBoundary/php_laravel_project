@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\MilitaryAccounting $menu, $title, $militaryAccountingList */
        $personalCards = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($militaryAccountingList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="2">Группа воинского учета</th>
                        <th class="align-middle" scope="col">Воинское звание</th>
                        <th class="align-middle" scope="col">Годность к службе</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.military-accounting.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($militaryAccountingList as $militaryAccountingRow)
                        @if ($personalCards != $militaryAccountingRow->personal_card)
                        <tr>
                            <td colspan="5" class="text-muted text-uppercase"><em> {{ $militaryAccountingRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td>{{ $militaryAccountingRow->accounting_group }}</td>
                            <td>{{ $militaryAccountingRow->military_rank }}</td>
                            <td>{{ $militaryAccountingRow->military_suitability }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.military-accounting.destroy', $militaryAccountingRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.military-accounting.show', $militaryAccountingRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.military-accounting.edit', $militaryAccountingRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $militaryAccountingRow->personal_card;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.military-accounting.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection