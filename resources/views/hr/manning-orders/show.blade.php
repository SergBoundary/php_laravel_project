@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\ManningOrders $menu, $title, $manningOrdersList */
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
                                    <input name='personal_card' value='{{ $manningOrdersList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='manning_table'>Штатная должность</label>
                                    <input name='manning_table' value='{{ $manningOrdersList->manning_table }}' id='manning_table' type='text' maxlength="50" readonly class="form-control" title='Штатная должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='assignment_date'>Дата назначения</label>
                                    <input name='assignment_date' value='{{ $manningOrdersList->assignment_date }}' id='assignment_date' type='text' maxlength="50" readonly class="form-control" title='Дата назначения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='assignment_order'>Приказ о назначении</label>
                                    <input name='assignment_order' value='{{ $manningOrdersList->assignment_order }}' id='assignment_order' type='text' maxlength="50" readonly class="form-control" title='Приказ о назначении'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='resignation_date'>Дата снятия</label>
                                    <input name='resignation_date' value='{{ $manningOrdersList->resignation_date }}' id='resignation_date' type='text' maxlength="50" readonly class="form-control" title='Дата снятия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='resignation_order'>Приказ о снятии</label>
                                    <input name='resignation_order' value='{{ $manningOrdersList->resignation_order }}' id='resignation_order' type='text' maxlength="50" readonly class="form-control" title='Приказ о снятии'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='salary'>Тариф</label>
                                    <input name='salary' value='{{ $manningOrdersList->salary }}' id='salary' type='text' maxlength="50" readonly class="form-control" title='Тариф'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tariff'>Оклад</label>
                                    <input name='tariff' value='{{ $manningOrdersList->tariff }}' id='tariff' type='text' maxlength="50" readonly class="form-control" title='Оклад'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.manning-orders.destroy', $manningOrdersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.manning-orders.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.manning-orders.edit', $manningOrdersList->id) }}">{{ __('Изменить') }}</a>
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