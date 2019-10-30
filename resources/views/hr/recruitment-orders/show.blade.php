@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\RecruitmentOrders $menu, $title, $recruitmentOrdersList */
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
                                    <input name='document' value='{{ $recruitmentOrdersList->document }}' id='document' type='text' maxlength="50" readonly class="form-control" title='Кадровый документ'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='personal_card'>Работник</label>
                                    <input name='personal_card' value='{{ $recruitmentOrdersList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_date'>Дата найма</label>
                                    <input name='employment_date' value='{{ $recruitmentOrdersList->employment_date }}' id='employment_date' type='text' maxlength="50" readonly class="form-control" title='Дата найма'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='employment_order'>Номер приказа о найме</label>
                                    <input name='employment_order' value='{{ $recruitmentOrdersList->employment_order }}' id='employment_order' type='text' maxlength="50" readonly class="form-control" title='Номер приказа о найме'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='probation'>Количество дней стажировки</label>
                                    <input name='probation' value='{{ $recruitmentOrdersList->probation }}' id='probation' type='text' maxlength="50" readonly class="form-control" title='Количество дней стажировки'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_date'>Дата увольнения</label>
                                    <input name='dismissal_date' value='{{ $recruitmentOrdersList->dismissal_date }}' id='dismissal_date' type='text' maxlength="50" readonly class="form-control" title='Дата увольнения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_order'>Номер приказа об увольнении</label>
                                    <input name='dismissal_order' value='{{ $recruitmentOrdersList->dismissal_order }}' id='dismissal_order' type='text' maxlength="50" readonly class="form-control" title='Номер приказа об увольнении'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_reason'>Причина увольнения</label>
                                    <input name='dismissal_reason' value='{{ $recruitmentOrdersList->dismissal_reason }}' id='dismissal_reason' type='text' maxlength="50" readonly class="form-control" title='Причина увольнения'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.recruitment-orders.destroy', $recruitmentOrdersList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.recruitment-orders.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.recruitment-orders.edit', $recruitmentOrdersList->id) }}">{{ __('Изменить') }}</a>
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