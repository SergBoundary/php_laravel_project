@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\VisaStatuses $menu, $title, $visaStatusesList */
        $personalCards = "";
        $countries = "";
        $countries = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($visaStatusesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="4">Тип визы</th>
                        <th class="align-middle" scope="col">Дата открытия визы</th>
                        <th class="align-middle" scope="col">Дата закрытия визы</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.visa-statuses.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($visaStatusesList as $visaStatusesRow)
                        @if ($personalCards != $visaStatusesRow->personal_card)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $visaStatusesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $visaStatusesRow->country_out)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $visaStatusesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($countries != $visaStatusesRow->country_in)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $visaStatusesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $visaStatusesRow->visa_type }}</td>
                            <td>{{ $visaStatusesRow->date_opening }}</td>
                            <td>{{ $visaStatusesRow->date_closing }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.visa-statuses.destroy', $visaStatusesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.visa-statuses.show', $visaStatusesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.visa-statuses.edit', $visaStatusesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $visaStatusesRow->personal_card;
                            $countries = $visaStatusesRow->country_out;
                            $countries = $visaStatusesRow->country_in;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.visa-statuses.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection