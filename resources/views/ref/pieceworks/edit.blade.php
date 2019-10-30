@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Pieceworks $menu, $title, $pieceworksList
         * @var \Illuminate\Database\Eloquent $pieceworksUnitsList, $accrualsList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('ref.pieceworks.update', $pieceworksList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('ref.pieceworks.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='pieceworks_unit_id'>Единица измерения</label>
                                    <div class="input-group mb-3"
>                                        <select name='pieceworks_unit_id' value='{{ $pieceworksList->pieceworks_units_id }}' id='pieceworks_unit_id' type='text' placeholder="Единица измерения" class="form-control" title='Единица измерения' required>
                                            @foreach($pieceworksUnitsList as $pieceworksUnitsOption)
                                            <option value="{{ $pieceworks_unitsOption->id }}" 
                                                @if($pieceworksUnitsOption->id == $pieceworksList->pieceworks_unit_id) selected @endif>
                                                {{ $pieceworksUnitsOption->pieceworks_unit }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.pieceworks-units.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual_id'>Счет затрат</label>
                                    <div class="input-group mb-3"
>                                        <select name='accrual_id' value='{{ $pieceworksList->accruals_id }}' id='accrual_id' type='text' placeholder="Счет затрат" class="form-control" title='Счет затрат' required>
                                            @foreach($accrualsList as $accrualsOption)
                                            <option value="{{ $accrualsOption->id }}" 
                                                @if($accrualsOption->id == $pieceworksList->accrual_id) selected @endif>
                                                {{ $accrualsOption->accrual }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <a class="btn btn-outline-secondary" href="{{ route('ref.accruals.create') }}">Добавить</a>
                                        </div>
                                    </div>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Название сдельной работы</label>
                                    <input name='title' value='{{ $pieceworksList->title }}' id='title' type='text' maxlength="50" class="form-control" title='Название сдельной работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='price'>Цена единицы</label>
                                    <input name='price' value='{{ $pieceworksList->price }}' id='price' type='text' maxlength="50" class="form-control" title='Цена единицы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <button type="submit" class="btn btn-secondary float-left">
                                        {{ __('Сохранить') }}
                                    </button>
                                    @if(session('success'))
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.pieceworks.show', $pieceworksList->id) }}">{{ __('Закрыть') }}</a>
                                    @else
                                        <a class='btn btn-outline-secondary' style="margin-left: 10px;" href="{{ route('ref.pieceworks.show', $pieceworksList->id) }}">{{ __('Отмена') }}</a>
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