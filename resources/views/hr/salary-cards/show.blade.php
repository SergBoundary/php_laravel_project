@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\SalaryCards $menu, $title, $salaryCardsList */
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
                                    <input name='personal_card' value='{{ $salaryCardsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='bank'>Банк обслуживания</label>
                                    <input name='bank' value='{{ $salaryCardsList->bank }}' id='bank' type='text' maxlength="50" readonly class="form-control" title='Банк обслуживания'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='payment_car'>Номер банковской карточки</label>
                                    <input name='payment_car' value='{{ $salaryCardsList->payment_car }}' id='payment_car' type='text' maxlength="50" readonly class="form-control" title='Номер банковской карточки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Истечение срока действия</label>
                                    <input name='expiry' value='{{ $salaryCardsList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Истечение срока действия'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.salary-cards.destroy', $salaryCardsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.salary-cards.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.salary-cards.edit', $salaryCardsList->id) }}">{{ __('Изменить') }}</a>
                                    <button type="submit" class="btn btn-outline-danger" href="#">{{ __('Удалить') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection