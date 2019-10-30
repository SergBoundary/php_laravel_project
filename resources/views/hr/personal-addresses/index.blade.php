@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalAddresses $menu, $title, $personalAddressesList */
        $personalCards = "";
        $cities = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalAddressesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="3">Индекс</th>
                        <th class="align-middle" scope="col">Улица</th>
                        <th class="align-middle" scope="col">Дом</th>
                        <th class="align-middle" scope="col">Квартира</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-addresses.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalAddressesList as $personalAddressesRow)
                        @if ($personalCards != $personalAddressesRow->personal_card)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em> {{ $personalAddressesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($cities != $personalAddressesRow->city)
                        <tr>
                            <td colspan="7" class="text-muted text-uppercase"><em>  {{ $personalAddressesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td>{{ $personalAddressesRow->postcode }}</td>
                            <td>{{ $personalAddressesRow->street }}</td>
                            <td>{{ $personalAddressesRow->house }}</td>
                            <td>{{ $personalAddressesRow->apartment }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-addresses.destroy', $personalAddressesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-addresses.show', $personalAddressesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-addresses.edit', $personalAddressesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $personalAddressesRow->personal_card;
                            $cities = $personalAddressesRow->city;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-addresses.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection