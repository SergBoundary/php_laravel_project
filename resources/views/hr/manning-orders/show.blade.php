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
                                    <input name='personal_card' value='{{ $manningOrdersList->personal_card }}, {{ $manningOrdersList->surname }} {{ $manningOrdersList->first_name }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='department'>Подразделение</label>
                                    <input name='department' value='{{ $manningOrdersList->department }}' id='department' type='text' maxlength="50" readonly class="form-control" title='Подразделение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position'>Должность</label>
                                    <input name='position' value='{{ $manningOrdersList->position }}' id='position' type='text' maxlength="50" readonly class="form-control" title='Должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_profession'>Формальная должность</label>
                                    <input name='position_profession' value='{{ $manningOrdersList->position_profession }}, {{ $manningOrdersList->position_profession_title }}' id='position_profession' type='text' maxlength="50" readonly class="form-control" title='Формальная должность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='assignment_date'>Дата назначения</label>
                                    <input name='assignment_date' value='{{ $manningOrdersList->assignment_date }}' id='assignment_date' type='date' maxlength="50" readonly class="form-control" title='Дата назначения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='resignation_date'>Дата назначения</label>
                                    <input name='resignation_date' value='{{ $manningOrdersList->resignation_date }}' id='resignation_date' type='date' maxlength="50" readonly class="form-control" title='Дата снятия'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        @if ($access == 2)
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
						@endif
                        @if ($access == 1)
                        <div class="row justify-content-center">
                            <div class='form-group col-md-10'>
								<a class="btn btn-outline-secondary" href="{{ route('hr.manning-orders.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </div>
						@endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection