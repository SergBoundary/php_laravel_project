@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\References\TaxRecipients $menu, $title, $taxRecipientsList */
        $countries = "";
        $districts = "";
        $regions = "";
        $cities = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($taxRecipientsList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th class="align-middle" scope="col" colspan="5">Получатель подоходного налога</th>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-recipients.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($taxRecipientsList as $taxRecipientsRow)
                        @if ($countries != $taxRecipientsRow->country)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em> {{ $taxRecipientsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($districts != $taxRecipientsRow->district)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>  {{ $taxRecipientsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($regions != $taxRecipientsRow->region)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>   {{ $taxRecipientsRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($cities != $taxRecipientsRow->city)
                        <tr>
                            <td colspan="6" class="text-muted text-uppercase"><em>    {{ $taxRecipientsRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>{{ $taxRecipientsRow->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('ref.tax-recipients.destroy', $taxRecipientsRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-recipients.show', $taxRecipientsRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('ref.tax-recipients.edit', $taxRecipientsRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $countries = $taxRecipientsRow->country;
                            $districts = $taxRecipientsRow->district;
                            $regions = $taxRecipientsRow->region;
                            $cities = $taxRecipientsRow->city;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('ref.tax-recipients.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection