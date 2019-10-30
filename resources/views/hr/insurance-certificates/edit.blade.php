@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\InsuranceCertificates $menu, $title, $insuranceCertificatesList
         * @var \Illuminate\Database\Eloquent $personalCardsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.insurance-certificates.update', $insuranceCertificatesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.insurance-certificates.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $insuranceCertificatesList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $insuranceCertificatesList->personal_card_id) selected @endif>
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
                                    <label for='certificate_series'>Серия свидетельства</label>
                                    <input name='certificate_series' value='{{ $insuranceCertificatesList->certificate_series }}' id='certificate_series' type='text' maxlength="50" class="form-control" title='Серия свидетельства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='certificate_number'>Номер свидетельства</label>
                                    <input name='certificate_number' value='{{ $insuranceCertificatesList->certificate_number }}' id='certificate_number' type='text' maxlength="50" class="form-control" title='Номер свидетельства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='insurance_fee'>Сумма взноса</label>
                                    <input name='insurance_fee' value='{{ $insuranceCertificatesList->insurance_fee }}' id='insurance_fee' type='text' maxlength="50" class="form-control" title='Сумма взноса'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='certificate_expiry'>Истечение срока действия</label>
                                    <input name='certificate_expiry' value='{{ $insuranceCertificatesList->certificate_expiry }}' id='certificate_expiry' type='text' maxlength="50" class="form-control" title='Истечение срока действия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.insurance-certificates.show', $insuranceCertificatesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.insurance-certificates.show', $insuranceCertificatesList->id) }}">{{ __('Отмена') }}</a>
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