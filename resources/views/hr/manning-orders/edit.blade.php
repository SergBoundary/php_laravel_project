@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList
         * @var \Illuminate\Database\Eloquent $personalCardsList, $manningTablesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.manning-orders.update', $manningOrdersList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.manning-orders.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card_id'>Работник</label>
                                    <div class="input-group mb-3"
>                                        <select name='personal_card_id' value='{{ $manningOrdersList->personal_cards_id }}' id='personal_card_id' type='text' placeholder="Работник" class="form-control" title='Работник' required>
                                            @foreach($personalCardsList as $personalCardsOption)
                                            <option value="{{ $personal_cardsOption->id }}" 
                                                @if($personalCardsOption->id == $manningOrdersList->personal_card_id) selected @endif>
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
                                    <label for='manning_table_id'>Штатная должность</label>
                                    <div class="input-group mb-3"
>                                        <select name='manning_table_id' value='{{ $manningOrdersList->manning_tables_id }}' id='manning_table_id' type='text' placeholder="Штатная должность" class="form-control" title='Штатная должность' required>
                                            @foreach($manningTablesList as $manningTablesOption)
                                            <option value="{{ $manning_tablesOption->id }}" 
                                                @if($manningTablesOption->id == $manningOrdersList->manning_table_id) selected @endif>
                                                {{ $manningTablesOption->manning_table }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.manning-tables.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='assignment_date'>Дата назначения</label>
                                    <input name='assignment_date' value='{{ $manningOrdersList->assignment_date }}' id='assignment_date' type='text' maxlength="50" class="form-control" title='Дата назначения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='assignment_order'>Приказ о назначении</label>
                                    <input name='assignment_order' value='{{ $manningOrdersList->assignment_order }}' id='assignment_order' type='text' maxlength="50" class="form-control" title='Приказ о назначении'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='resignation_date'>Дата снятия</label>
                                    <input name='resignation_date' value='{{ $manningOrdersList->resignation_date }}' id='resignation_date' type='text' maxlength="50" class="form-control" title='Дата снятия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='resignation_order'>Приказ о снятии</label>
                                    <input name='resignation_order' value='{{ $manningOrdersList->resignation_order }}' id='resignation_order' type='text' maxlength="50" class="form-control" title='Приказ о снятии'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='salary'>Тариф</label>
                                    <input name='salary' value='{{ $manningOrdersList->salary }}' id='salary' type='text' maxlength="50" class="form-control" title='Тариф'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Оклад</label>
                                    <input name='tariff' value='{{ $manningOrdersList->tariff }}' id='tariff' type='text' maxlength="50" class="form-control" title='Оклад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.manning-orders.show', $manningOrdersList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.manning-orders.show', $manningOrdersList->id) }}">{{ __('Отмена') }}</a>
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