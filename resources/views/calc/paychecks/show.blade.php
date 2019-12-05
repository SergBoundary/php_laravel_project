@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Calculations\Paychecks $menu, $title, $paychecksList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $paychecksList->personal_card }}, {{ $paychecksList->surname }} {{ $paychecksList->first_name }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $paychecksList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $paychecksList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='balance_start'>Начальный остаток</label>
                                    <input name='balance_start' value='{{ $paychecksList->balance_start }}' id='balance_start' type='text' maxlength="50" readonly class="form-control" title='Начальный остаток'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='hourly'>Почасовая работа</label>
                                    <input name='hourly' value='{{ $paychecksList->hourly }}' id='hourly' type='text' maxlength="50" readonly class="form-control" title='Почасовая работа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='piecework'>Сдельная работа</label>
                                    <input name='piecework' value='{{ $paychecksList->piecework }}' id='piecework' type='text' maxlength="50" readonly class="form-control" title='Сдельная работа'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Начислено</label>
                                    <input name='accrual' value='{{ $paychecksList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Начислено'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention'>Удержано</label>
                                    <input name='retention' value='{{ $paychecksList->retention }}' id='retention' type='text' maxlength="50" readonly class="form-control" title='Удержано'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='issued_by'>Выдано</label>
                                    <input name='issued_by' value='{{ $paychecksList->issued_by }}' id='issued_by' type='text' maxlength="50" readonly class="form-control" title='Выдано'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='give_out'>К выдаче</label>
                                    <input name='give_out' value='{{ $paychecksList->give_out }}' id='give_out' type='text' maxlength="50" readonly class="form-control" title='К выдаче'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='debt'>Долг</label>
                                    <input name='debt' value='{{ $paychecksList->debt }}' id='debt' type='text' maxlength="50" readonly class="form-control" title='Долг'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('calc.paychecks.destroy', $paychecksList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('calc.paychecks.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('calc.paychecks.edit', $paychecksList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('calc.paychecks.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection