@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardsData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{ $title }}</small></h3><br />
                @if(count($personalCardsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col">Табельный номер</th>
                        <th class="align-middle" scope="col">Фамилия</th>
                        <th class="align-middle" scope="col">Имя (первое имя)</th>
                        <th class="align-middle" scope="col">Дата рождения</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.create') }}"><img src="/img/add_black_18dp.png" alt="Добавить" title="Добавить"></a>
                            @endif
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalCardsList as $personalCardsRow)
                        <tr>
                            <td>{{ $personalCardsRow->personal_account }}</td>
                            <td>{{ $personalCardsRow->surname }}</td>
                            <td>{{ $personalCardsRow->first_name }}</td>
                            <td>{{ $personalCardsRow->born_date }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    @if ($access == 2)
                                    <form method="POST" action="{{ route('hr.personal-cards.destroy', $personalCardsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-cards.show', $personalCardsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-cards.edit', $personalCardsRow->id) }}"><img src="/img/edit_black_18dp.png" alt="Изменить" title="Изменить"></a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#"><img src="/img/delete_black_18dp.png" alt="Удалить" title="Удалить"></button>
                                    </form>
                                    @endif
                                    @if ($access == 1)
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-cards.show', $personalCardsRow->id) }}"><img src="/img/visibility_black_18dp.png" alt="Открыть" title="Открыть"></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection