@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\RecruitmentOrders $menu, $title, $recruitmentOrdersList
         * @var \Illuminate\Database\Eloquent $documentsList, $personalCardsList, $dismissalReasonsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.recruitment-orders.update', $recruitmentOrdersList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.recruitment-orders.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='document_id'>Кадровый документ</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_id' value='{{ $recruitmentOrdersList->documents_id }}' id='document_id' type='text' placeholder="Кадровый документ" class="form-control" title='Кадровый документ' required>
                                            @foreach($documentsList as $documentsOption)
                                            <option value="{{ $documentsOption->id }}" 
                                                @if($documentsOption->id == $recruitmentOrdersList->document_id) selected @endif>
                                                {{ $documentsOption->document }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.documents.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $recruitmentOrdersList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $recruitmentOrdersList->personal_card_id) selected @endif>
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
                                    <label for='dismissal_reason_id'>Причина увольнения</label>
                                    <div class="input-group mb-3"
>                                        <select name='dismissal_reason_id' value='{{ $recruitmentOrdersList->dismissal_reasons_id }}' id='dismissal_reason_id' type='text' placeholder="Причина увольнения" class="form-control" title='Причина увольнения' required>
                                            @foreach($dismissalReasonsList as $dismissalReasonsOption)
                                            <option value="{{ $dismissal_reasonsOption->id }}" 
                                                @if($dismissalReasonsOption->id == $recruitmentOrdersList->dismissal_reason_id) selected @endif>
                                                {{ $dismissalReasonsOption->dismissal_reason }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.dismissal-reasons.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_date'>Дата найма</label>
                                    <input name='employment_date' value='{{ $recruitmentOrdersList->employment_date }}' id='employment_date' type='text' maxlength="50" class="form-control" title='Дата найма'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_order'>Номер приказа о найме</label>
                                    <input name='employment_order' value='{{ $recruitmentOrdersList->employment_order }}' id='employment_order' type='text' maxlength="50" class="form-control" title='Номер приказа о найме'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='probation'>Количество дней стажировки</label>
                                    <input name='probation' value='{{ $recruitmentOrdersList->probation }}' id='probation' type='text' maxlength="50" class="form-control" title='Количество дней стажировки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_date'>Дата увольнения</label>
                                    <input name='dismissal_date' value='{{ $recruitmentOrdersList->dismissal_date }}' id='dismissal_date' type='text' maxlength="50" class="form-control" title='Дата увольнения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_order'>Номер приказа об увольнении</label>
                                    <input name='dismissal_order' value='{{ $recruitmentOrdersList->dismissal_order }}' id='dismissal_order' type='text' maxlength="50" class="form-control" title='Номер приказа об увольнении'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.recruitment-orders.show', $recruitmentOrdersList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.recruitment-orders.show', $recruitmentOrdersList->id) }}">{{ __('Отмена') }}</a>
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