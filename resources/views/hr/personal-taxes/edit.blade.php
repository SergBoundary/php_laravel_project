@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalTaxes $menu, $title, $personalTaxesList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $taxOfficesList, $taxRecipientsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-taxes.update', $personalTaxesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-taxes.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $personalTaxesList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $personalTaxesList->personal_card_id) selected @endif>
                                                {{ $personalCardsOption->personal_card }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_office_id'>Налоговая инспекция</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_office_id' value='{{ $personalTaxesList->tax_offices_id }}' id='tax_office_id' type='text' placeholder="Налоговая инспекция" class="form-control" title='Налоговая инспекция' required>
                                            @foreach($taxOfficesList as $taxOfficesOption)
                                            <option value="{{ $tax_officesOption->id }}" 
                                                @if($taxOfficesOption->id == $personalTaxesList->tax_office_id) selected @endif>
                                                {{ $taxOfficesOption->tax_office }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-offices.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_recipient_id'>Адресат сбора подоходного налога</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_recipient_id' value='{{ $personalTaxesList->tax_recipients_id }}' id='tax_recipient_id' type='text' placeholder="Адресат сбора подоходного налога" class="form-control" title='Адресат сбора подоходного налога' required>
                                            @foreach($taxRecipientsList as $taxRecipientsOption)
                                            <option value="{{ $tax_recipientsOption->id }}" 
                                                @if($taxRecipientsOption->id == $personalTaxesList->tax_recipient_id) selected @endif>
                                                {{ $taxRecipientsOption->tax_recipient }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-recipients.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-taxes.show', $personalTaxesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.personal-taxes.show', $personalTaxesList->id) }}">{{ __('Отмена') }}</a>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection