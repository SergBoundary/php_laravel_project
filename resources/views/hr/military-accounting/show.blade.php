@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\MilitaryAccounting $menu, $title, $militaryAccountingList */
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
                                    <input name='personal_card' value='{{ $militaryAccountingList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accounting_group'>Группа воинского учета</label>
                                    <input name='accounting_group' value='{{ $militaryAccountingList->accounting_group }}' id='accounting_group' type='text' maxlength="50" readonly class="form-control" title='Группа воинского учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='accounting_category'>Категория воинского учета</label>
                                    <input name='accounting_category' value='{{ $militaryAccountingList->accounting_category }}' id='accounting_category' type='text' maxlength="50" readonly class="form-control" title='Категория воинского учета'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='composition'>Состав</label>
                                    <input name='composition' value='{{ $militaryAccountingList->composition }}' id='composition' type='text' maxlength="50" readonly class="form-control" title='Состав'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_rank'>Воинское звание</label>
                                    <input name='military_rank' value='{{ $militaryAccountingList->military_rank }}' id='military_rank' type='text' maxlength="50" readonly class="form-control" title='Воинское звание'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_specialty'>Военная специальность</label>
                                    <input name='military_specialty' value='{{ $militaryAccountingList->military_specialty }}' id='military_specialty' type='text' maxlength="50" readonly class="form-control" title='Военная специальность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_suitability'>Годность к службе</label>
                                    <input name='military_suitability' value='{{ $militaryAccountingList->military_suitability }}' id='military_suitability' type='text' maxlength="50" readonly class="form-control" title='Годность к службе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='military_commissariat'>Место призыва и мобилизации</label>
                                    <input name='military_commissariat' value='{{ $militaryAccountingList->military_commissariat }}' id='military_commissariat' type='text' maxlength="50" readonly class="form-control" title='Место призыва и мобилизации'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.military-accounting.destroy', $militaryAccountingList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.military-accounting.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.military-accounting.edit', $militaryAccountingList->id) }}">{{ __('Изменить') }}</a>
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