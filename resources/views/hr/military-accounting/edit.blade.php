@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\MilitaryAccounting $menu, $title, $militaryAccountingList
         * @var \Illuminate\Database\Eloquent $personalCardsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.military-accounting.update', $militaryAccountingList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.military-accounting.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $militaryAccountingList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $militaryAccountingList->personal_card_id) selected @endif>
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
                                    <label for='accounting_group'>Группа воинского учета</label>
                                    <input name='accounting_group' value='{{ $militaryAccountingList->accounting_group }}' id='accounting_group' type='text' maxlength="50" class="form-control" title='Группа воинского учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accounting_category'>Категория воинского учета</label>
                                    <input name='accounting_category' value='{{ $militaryAccountingList->accounting_category }}' id='accounting_category' type='text' maxlength="50" class="form-control" title='Категория воинского учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='composition'>Состав</label>
                                    <input name='composition' value='{{ $militaryAccountingList->composition }}' id='composition' type='text' maxlength="50" class="form-control" title='Состав'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_rank'>Воинское звание</label>
                                    <input name='military_rank' value='{{ $militaryAccountingList->military_rank }}' id='military_rank' type='text' maxlength="50" class="form-control" title='Воинское звание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_specialty'>Военная специальность</label>
                                    <input name='military_specialty' value='{{ $militaryAccountingList->military_specialty }}' id='military_specialty' type='text' maxlength="50" class="form-control" title='Военная специальность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_suitability'>Годность к службе</label>
                                    <input name='military_suitability' value='{{ $militaryAccountingList->military_suitability }}' id='military_suitability' type='text' maxlength="50" class="form-control" title='Годность к службе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_commissariat'>Место призыва и мобилизации</label>
                                    <input name='military_commissariat' value='{{ $militaryAccountingList->military_commissariat }}' id='military_commissariat' type='text' maxlength="50" class="form-control" title='Место призыва и мобилизации'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.military-accounting.show', $militaryAccountingList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.military-accounting.show', $militaryAccountingList->id) }}">{{ __('Отмена') }}</a>
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