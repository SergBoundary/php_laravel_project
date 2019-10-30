@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\EmployeeAccrualChanges $menu, $title, $employeeAccrualChangesList
         * @var \Illuminate\Database\Eloquent $algorithmsList, $taxRatesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('acc.employee-accrual-changes.update', $employeeAccrualChangesList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('acc.employee-accrual-changes.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='algorithm_id'>Алгоритм начисления</label>
                                    <div class="input-group mb-3"
>                                        <select name='algorithm_id' value='{{ $employeeAccrualChangesList->algorithms_id }}' id='algorithm_id' type='text' placeholder="Алгоритм начисления" class="form-control" title='Алгоритм начисления' required>
                                            @foreach($algorithmsList as $algorithmsOption)
                                            <option value="{{ $algorithmsOption->id }}" 
                                                @if($algorithmsOption->id == $employeeAccrualChangesList->algorithm_id) selected @endif>
                                                {{ $algorithmsOption->algorithm }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.algorithms.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_rates_id'>Ставка налогообложения</label>
                                    <div class="input-group mb-3"
>                                        <select name='tax_rates_id' value='{{ $employeeAccrualChangesList->tax_rates_id }}' id='tax_rates_id' type='text' placeholder="Ставка налогообложения" class="form-control" title='Ставка налогообложения' required>
                                            @foreach($taxRatesList as $taxRatesOption)
                                            <option value="{{ $tax_ratesOption->id }}" 
                                                @if($taxRatesOption->id == $employeeAccrualChangesList->tax_rates_id) selected @endif>
                                                {{ $taxRatesOption->tax_rates }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.tax-rates.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Переформирование до даты</label>
                                    <input name='date_to' value='{{ $employeeAccrualChangesList->date_to }}' id='date_to' type='text' maxlength="50" class="form-control" title='Переформирование до даты'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Новое значение</label>
                                    <input name='amount' value='{{ $employeeAccrualChangesList->amount }}' id='amount' type='text' maxlength="50" class="form-control" title='Новое значение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-changes.show', $employeeAccrualChangesList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('acc.employee-accrual-changes.show', $employeeAccrualChangesList->id) }}">{{ __('Отмена') }}</a>
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