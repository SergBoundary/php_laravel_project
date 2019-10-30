@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\Provisions $menu, $title, $provisionsList */
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
                                    <label for='document'>Кадровый документ</label>
                                    <input name='document' value='{{ $provisionsList->document }}' id='document' type='text' maxlength="50" readonly class="form-control" title='Кадровый документ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='manning_orders'>Назначение работника</label>
                                    <input name='manning_orders' value='{{ $provisionsList->manning_orders }}' id='manning_orders' type='text' maxlength="50" readonly class="form-control" title='Назначение работника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_from'>Начало использования</label>
                                    <input name='date_from' value='{{ $provisionsList->date_from }}' id='date_from' type='text' maxlength="50" readonly class="form-control" title='Начало использования'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_to'>Окончание использования</label>
                                    <input name='date_to' value='{{ $provisionsList->date_to }}' id='date_to' type='text' maxlength="50" readonly class="form-control" title='Окончание использования'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='amount'>Сумма/стоимость средств</label>
                                    <input name='amount' value='{{ $provisionsList->amount }}' id='amount' type='text' maxlength="50" readonly class="form-control" title='Сумма/стоимость средств'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rationale_title'>Обоснование</label>
                                    <input name='rationale_title' value='{{ $provisionsList->rationale_title }}' id='rationale_title' type='text' maxlength="50" readonly class="form-control" title='Обоснование'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='provision_date'>Дата выдачи</label>
                                    <input name='provision_date' value='{{ $provisionsList->provision_date }}' id='provision_date' type='text' maxlength="50" readonly class="form-control" title='Дата выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='return_date'>Дата возврата</label>
                                    <input name='return_date' value='{{ $provisionsList->return_date }}' id='return_date' type='text' maxlength="50" readonly class="form-control" title='Дата возврата'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.provisions.destroy', $provisionsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.provisions.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.provisions.edit', $provisionsList->id) }}">{{ __('Изменить') }}</a>
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