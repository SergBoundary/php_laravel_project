@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\VisaStatuses $menu, $title, $visaStatusesList */
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
                                    <input name='personal_card' value='{{ $visaStatusesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_out'>Страна оформления визы</label>
                                    <input name='country_out' value='{{ $visaStatusesList->country_out }}' id='country_out' type='text' maxlength="50" readonly class="form-control" title='Страна оформления визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country_in'>Страна въезда</label>
                                    <input name='country_in' value='{{ $visaStatusesList->country_in }}' id='country_in' type='text' maxlength="50" readonly class="form-control" title='Страна въезда'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='opening_reason'>Основание открытия визы</label>
                                    <input name='opening_reason' value='{{ $visaStatusesList->opening_reason }}' id='opening_reason' type='text' maxlength="50" readonly class="form-control" title='Основание открытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='submitte'>Дата подачи документов в визовый орган</label>
                                    <input name='submitte' value='{{ $visaStatusesList->submitte }}' id='submitte' type='text' maxlength="50" readonly class="form-control" title='Дата подачи документов в визовый орган'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='incomplete'>Дата требования недостающих документов</label>
                                    <input name='incomplete' value='{{ $visaStatusesList->incomplete }}' id='incomplete' type='text' maxlength="50" readonly class="form-control" title='Дата требования недостающих документов'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visa_issue'>Дата выдачи визы</label>
                                    <input name='visa_issue' value='{{ $visaStatusesList->visa_issue }}' id='visa_issue' type='text' maxlength="50" readonly class="form-control" title='Дата выдачи визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='visa_type'>Тип визы</label>
                                    <input name='visa_type' value='{{ $visaStatusesList->visa_type }}' id='visa_type' type='text' maxlength="50" readonly class="form-control" title='Тип визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_opening'>Дата открытия визы</label>
                                    <input name='date_opening' value='{{ $visaStatusesList->date_opening }}' id='date_opening' type='text' maxlength="50" readonly class="form-control" title='Дата открытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='date_closing'>Дата закрытия визы</label>
                                    <input name='date_closing' value='{{ $visaStatusesList->date_closing }}' id='date_closing' type='text' maxlength="50" readonly class="form-control" title='Дата закрытия визы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='closing_reason'>Основание закрытия визы</label>
                                    <input name='closing_reason' value='{{ $visaStatusesList->closing_reason }}' id='closing_reason' type='text' maxlength="50" readonly class="form-control" title='Основание закрытия визы'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.visa-statuses.destroy', $visaStatusesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.visa-statuses.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.visa-statuses.edit', $visaStatusesList->id) }}">{{ __('Изменить') }}</a>
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