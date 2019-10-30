@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\VisaDocuments $menu, $title, $visaDocumentsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $visaStatusesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.visa-documents.update', $visaDocumentsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.visa-documents.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $visaDocumentsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $visaDocumentsList->personal_card_id) selected @endif>
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
                                    <label for='visa_status_id'>Запись в учете виз</label>
                                    <div class="input-group mb-3"
>                                        <select name='visa_status_id' value='{{ $visaDocumentsList->visa_statuses_id }}' id='visa_status_id' type='text' placeholder="Запись в учете виз" class="form-control" title='Запись в учете виз' required>
                                            @foreach($visaStatusesList as $visaStatusesOption)
                                            <option value="{{ $visa_statusesOption->id }}" 
                                                @if($visaStatusesOption->id == $visaDocumentsList->visa_status_id) selected @endif>
                                                {{ $visaStatusesOption->visa_status }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.visa-statuses.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Вид документа</label>
                                    <input name='type' value='{{ $visaDocumentsList->type }}' id='type' type='text' maxlength="50" class="form-control" title='Вид документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер документа</label>
                                    <input name='number' value='{{ $visaDocumentsList->number }}' id='number' type='text' maxlength="50" class="form-control" title='Номер документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_issued'>Дата выдачи документа</label>
                                    <input name='date_issued' value='{{ $visaDocumentsList->date_issued }}' id='date_issued' type='text' maxlength="50" class="form-control" title='Дата выдачи документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_expiration'>Дата окончания действия документа</label>
                                    <input name='date_expiration' value='{{ $visaDocumentsList->date_expiration }}' id='date_expiration' type='text' maxlength="50" class="form-control" title='Дата окончания действия документа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_inclusion'>Дата включения документа в пакет</label>
                                    <input name='date_inclusion' value='{{ $visaDocumentsList->date_inclusion }}' id='date_inclusion' type='text' maxlength="50" class="form-control" title='Дата включения документа в пакет'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_seizure'>Дата изъятия документа из пакета</label>
                                    <input name='date_seizure' value='{{ $visaDocumentsList->date_seizure }}' id='date_seizure' type='text' maxlength="50" class="form-control" title='Дата изъятия документа из пакета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.visa-documents.show', $visaDocumentsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.visa-documents.show', $visaDocumentsList->id) }}">{{ __('Отмена') }}</a>
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