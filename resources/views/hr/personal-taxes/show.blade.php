@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalTaxes $menu, $title, $personalTaxesList */
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
                                    <input name='personal_card' value='{{ $personalTaxesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_office'>Налоговая инспекция</label>
                                    <input name='tax_office' value='{{ $personalTaxesList->tax_office }}' id='tax_office' type='text' maxlength="50" readonly class="form-control" title='Налоговая инспекция'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_recipient'>Адресат сбора подоходного налога</label>
                                    <input name='tax_recipient' value='{{ $personalTaxesList->tax_recipient }}' id='tax_recipient' type='text' maxlength="50" readonly class="form-control" title='Адресат сбора подоходного налога'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-taxes.destroy', $personalTaxesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-taxes.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-taxes.edit', $personalTaxesList->id) }}">{{ __('Изменить') }}</a>
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