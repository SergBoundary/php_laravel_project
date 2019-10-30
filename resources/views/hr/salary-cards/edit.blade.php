@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\SalaryCards $menu, $title, $salaryCardsList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $banksList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.salary-cards.update', $salaryCardsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.salary-cards.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $salaryCardsList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $salaryCardsList->personal_card_id) selected @endif>
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
                                    <label for='bank_id'>Банк обслуживания</label>
                                    <div class="input-group mb-3"
>                                        <select name='bank_id' value='{{ $salaryCardsList->banks_id }}' id='bank_id' type='text' placeholder="Банк обслуживания" class="form-control" title='Банк обслуживания' required>
                                            @foreach($banksList as $banksOption)
                                            <option value="{{ $banksOption->id }}" 
                                                @if($banksOption->id == $salaryCardsList->bank_id) selected @endif>
                                                {{ $banksOption->bank }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.banks.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='payment_card'>Номер банковской карточки</label>
                                    <input name='payment_card' value='{{ $salaryCardsList->payment_card }}' id='payment_card' type='text' maxlength="50" class="form-control" title='Номер банковской карточки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Истечение срока действия</label>
                                    <input name='expiry' value='{{ $salaryCardsList->expiry }}' id='expiry' type='text' maxlength="50" class="form-control" title='Истечение срока действия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.salary-cards.show', $salaryCardsList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.salary-cards.show', $salaryCardsList->id) }}">{{ __('Отмена') }}</a>
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