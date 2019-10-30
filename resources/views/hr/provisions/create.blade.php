@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Provisions $menu, $title, $provisionsList
         * @var \Illuminate\Database\Eloquent $documentsList, $manningOrdersList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.provisions.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.provisions.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='document_id'>Кадровый документ</label>
                                    <div class="input-group mb-3"
>                                        <select name='document_id' value='document_id' id='document_id' type='text' placeholder="Кадровый документ" class="form-control" title='Кадровый документ' required>
                                            @foreach($documentsList as $documentsOption)
                                            <option value="{{ $documentsOption->id }}" >
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
                                    <label for='manning_orders_id'>Назначение работника</label>
                                    <div class="input-group mb-3"
>                                        <select name='manning_orders_id' value='manning_orders_id' id='manning_orders_id' type='text' placeholder="Назначение работника" class="form-control" title='Назначение работника' required>
                                            @foreach($manningOrdersList as $manningOrdersOption)
                                            <option value="{{ $manning_ordersOption->id }}" >
                                                {{ $manningOrdersOption->manning_orders }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('hr.manning-orders.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Начало использования</label>
                                    <input name='date_from' id='date_from' type='text' maxlength="50" class="form-control" title='Начало использования'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Окончание использования</label>
                                    <input name='date_to' id='date_to' type='text' maxlength="50" class="form-control" title='Окончание использования'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма/стоимость средств</label>
                                    <input name='amount' id='amount' type='text' maxlength="50" class="form-control" title='Сумма/стоимость средств'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rationale_title'>Обоснование</label>
                                    <input name='rationale_title' id='rationale_title' type='text' maxlength="50" class="form-control" title='Обоснование'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='provision_date'>Дата выдачи</label>
                                    <input name='provision_date' id='provision_date' type='text' maxlength="50" class="form-control" title='Дата выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='return_date'>Дата возврата</label>
                                    <input name='return_date' id='return_date' type='text' maxlength="50" class="form-control" title='Дата возврата'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.provisions.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('hr.provisions.index') }}">{{ __('Отмена') }}</a>
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