@extends('layouts.layout')

@section('content')
    @php
        /** @var \App\Models\HumanResources\PersonalTaxes $menu, $title, $personalTaxesList */
        $personalCards = "";
        $taxOffices = "";
        $taxRecipients = "";
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><small class="text-muted text-uppercase">{{$title['name']}}</small></h3><br />
                @if(count($personalTaxesList) > 0)
                <table class="table table-hover">
                    <thead>
                        <th scope="col">
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-taxes.create') }}">{{ __('Добавить') }}</a>
                        </th>
                    </thead>
                    <tbody>
                        @foreach($personalTaxesList as $personalTaxesRow)
                        @if ($personalCards != $personalTaxesRow->personal_card)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em> {{ $personalTaxesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxOffices != $personalTaxesRow->tax_office)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>  {{ $personalTaxesRow->country }}</em></td>
                        </tr>
                        @endif
                        @if ($taxRecipients != $personalTaxesRow->tax_recipient)
                        <tr>
                            <td colspan="4" class="text-muted text-uppercase"><em>   {{ $personalTaxesRow->country }}</em></td>
                        </tr>
                        @endif
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Record editing">
                                    <form method="POST" action="{{ route('hr.personal-taxes.destroy', $personalTaxesRow->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-taxes.show', $personalTaxesRow->id) }}">{{ __('Открыть') }}</a>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('hr.personal-taxes.edit', $personalTaxesRow->id) }}">{{ __('Изменить') }}</a>
                                        <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @php
                            $personalCards = $personalTaxesRow->personal_card;
                            $taxOffices = $personalTaxesRow->tax_office;
                            $taxRecipients = $personalTaxesRow->tax_recipient;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p><em>Данные отсутствуют..</em></p>
                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-taxes.create') }}">{{ __('Добавить') }}</a>
                @endif
            </div>
        </div>
    </div>
@endsection