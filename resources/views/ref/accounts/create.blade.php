@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Accounts $menu, $title, $accountsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.accounts.store') }}">
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.accounts.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='title'>Код счета</label>
                                    <input name='title' id='title' type='text' maxlength="50" class="form-control" title='Код счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='description'>Название счета</label>
                                    <input name='description' id='description' type='text' maxlength="50" class="form-control" title='Название счета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='account_balance_type'>Тип счета в балансе</label>
                                    <input name='account_balance_type' id='account_balance_type' type='text' maxlength="50" class="form-control" title='Тип счета в балансе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='balance_type'>Тип остатка</label>
                                    <input name='balance_type' id='balance_type' type='text' maxlength="50" class="form-control" title='Тип остатка'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='task'>Задача</label>
                                    <input name='task' id='task' type='text' maxlength="50" class="form-control" title='Задача'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='currency_status'>Счет валютный</label>
                                    <input name='currency_status' id='currency_status' type='text' maxlength="50" class="form-control" title='Счет валютный'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='transaction_report'>Номер "журнал ордера"</label>
                                    <input name='transaction_report' id='transaction_report' type='text' maxlength="50" class="form-control" title='Номер "журнал ордера"'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='choose_account'>Выбрать счет</label>
                                    <input name='choose_account' id='choose_account' type='text' maxlength="50" class="form-control" title='Выбрать счет'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='inventory'>ТМЦ</label>
                                    <input name='inventory' id='inventory' type='text' maxlength="50" class="form-control" title='ТМЦ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='inventory_write_off'>Списание ТМЦ</label>
                                    <input name='inventory_write_off' id='inventory_write_off' type='text' maxlength="50" class="form-control" title='Списание ТМЦ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='clients'>Клиенты</label>
                                    <input name='clients' id='clients' type='text' maxlength="50" class="form-control" title='Клиенты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='objects'>Объекты учета</label>
                                    <input name='objects' id='objects' type='text' maxlength="50" class="form-control" title='Объекты учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='fixed_assets'>Основные средства</label>
                                    <input name='fixed_assets' id='fixed_assets' type='text' maxlength="50" class="form-control" title='Основные средства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='main_warehouse'>Основной склад</label>
                                    <input name='main_warehouse' id='main_warehouse' type='text' maxlength="50" class="form-control" title='Основной склад'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount_type'>Тип суммы</label>
                                    <input name='amount_type' id='amount_type' type='text' maxlength="50" class="form-control" title='Тип суммы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='type'>Вид</label>
                                    <input name='type' id='type' type='text' maxlength="50" class="form-control" title='Вид'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='gross_costs'>Валовые затраты</label>
                                    <input name='gross_costs' id='gross_costs' type='text' maxlength="50" class="form-control" title='Валовые затраты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-outline-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.accounts.index') }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.accounts.index') }}">{{ __('Отмена') }}</a>
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