@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Calculations\Payrolls $menu, $title, $payrollsList */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{ $title }}</h3></div>

                    <div class="card-body">

                        <form name="show">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $payrollsList->personal_card }}, {{ $payrollsList->surname }} {{ $payrollsList->first_name }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $payrollsList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $payrollsList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accrual'>Начислено</label>
                                    <input name='accrual' value='{{ $payrollsList->accrual }}' id='accrual' type='text' maxlength="50" readonly class="form-control" title='Начислено'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='retention'>Удержано</label>
                                    <input name='retention' value='{{ $payrollsList->retention }}' id='retention' type='text' maxlength="50" readonly class="form-control" title='Удержано'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='give_out'>К выдаче</label>
                                    <input name='give_out' value='{{ $payrollsList->give_out }}' id='give_out' type='text' maxlength="50" readonly class="form-control" title='К выдаче'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='debt'>Долг</label>
                                    <input name='debt' value='{{ $payrollsList->debt }}' id='debt' type='text' maxlength="50" readonly class="form-control" title='Долг'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
                        <form name="delete" method="POST" action="{{ route('calc.payrolls.destroy', $payrollsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('calc.payrolls.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('calc.payrolls.edit', $payrollsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('calc.payrolls.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection