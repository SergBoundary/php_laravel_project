@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalCards 
         $user, $personalCardsData, $manningOrderData, $allocationData, 
         $manningOrderList, $allocationList, 
         $manningOrderCount, $allocationCount
         */
    @endphp
    <div id="interface-modul" modul="human-resources-index"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3><small class="text-muted text-uppercase">{{ $interface['title'] }}</small></h3><br />
                @if(count($personalCardsList) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <th id="human-resources-index-personnel-number" class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-personnel-number'] }}</th>
                        <th id="human-resources-index-surname" class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-surname'] }}</th>
                        <th id="human-resources-index-name" class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-name'] }}</th>
                        <th id="human-resources-index-birth-date" class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-birth-date'] }}</th>
                        <th id="human-resources-index-sex"class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-sex'] }}</th>
                        <th id="human-resources-index-phone" class="align-middle" scope="col">{{ $interface['human-resources-index']['human-resources-index-phone'] }}</th>
                        <th scope="col">
                            @if ($access == 2)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.create') }}"><img id="form-button-add" src="/img/add_black_18dp.png" alt="{{ $interface['form-button']['form-button-add'] }}" title="{{ $interface['form-button']['form-button-add'] }}"></a>
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
                            <td>{{ $personalCardsRow->sex }}</td>
                            <td>{{ $personalCardsRow->phone }}</td>
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