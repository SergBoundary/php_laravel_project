@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards $menu, $title, $personalCardsList
         * @var \Illuminate\Database\Eloquent $nationalitiesList, $citiesList, $regionsList, $districtsList, $countriesList, $maritalStatusesList, $clothingSizesList, $shoeSizesList, $disabilitiesList
         */
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"><h3>{{$title['name']}}</h3></div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('hr.personal-cards.update', $personalCardsList->id) }}">
                            @method('PATCH')
                            @csrf
                            @php
                                /** @var \Illuminate\Support\ViewErrorBag @errors */
                            @endphp
                            @include('hr.personal-cards.includes.result_messages')
                            <div class="row justify-content-center">
                                <div class='media form-group col-md-11'>
                                    <div>
                                        <input name='photo_url' value='{{ $personalCardsList->surname }}' src="{{ $personalCardsList->photo_url }}" id='photo_url' type='image' class="img-thumbnail mr-3" height="180" width="180">
                                    </div>
                                    <div class="media-body">
                                        <div class='form-row'>
                                            <div class="col-md-auto">
                                                <label for='surname' class="col-form-label col-form-label-sm">Фамилия</label>
                                                <input name='surname' value='{{ $personalCardsList->surname }}' id='surname' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class="col-md-auto">
                                                <label for='first_name' class="col-form-label col-form-label-sm">Имя</label>
                                                <input name='first_name' value='{{ $personalCardsList->first_name }}' id='first_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-auto">
                                                <label for='second_name' class="col-form-label col-form-label-sm">Отчество</label>
                                                <input name='second_name' value='{{ $personalCardsList->second_name }}' id='first_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                        </div>
                                        <div class='form-row'>
                                            <div class="col-md-3">
                                                <label for='personal_account' class="col-form-label col-form-label-sm">Табельный номер</label>
                                                <input name='personal_account' value='{{ $personalCardsList->personal_account }}' id='first_name' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Имя (первое имя)'>
                                            </div>
                                            <div class="col-md-5">
                                                <label for='full_name_latina' class="col-form-label col-form-label-sm">Фамилия и имя латиницей</label>
                                                <input name='full_name_latina' value='{{ $personalCardsList->full_name_latina }}' id='surname' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Фамилия'>
                                            </div>
                                            <div class='col-md-3'>
                                                <label for='tax_number' class="col-form-label col-form-label-sm">Налоговый номер</label>
                                                <input name='tax_number' value='{{ $personalCardsList->tax_number }}' id='tax_number' type='text' maxlength="15" readonly class="form-control form-control-sm" size="5" title='Индивидуальный налоговый номер'>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class='col-md-1'>
                                                <label for='sex' class="col-form-label col-form-label-sm">Пол</label>
                                                <input name='sex' value='{{ $personalCardsList->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control form-control-sm" title='Пол'>
                                            </div>
                                            <div class='col-md-auto'>
                                                <label for='born_date' class="col-form-label col-form-label-sm">Дата рождения</label>
                                                <input name='born_date' value='{{ $personalCardsList->born_date }}' id='born_date' type='date' maxlength="50" readonly class="form-control form-control-sm" title='Дата рождения'>
                                            </div>
                                        </div>
										<br>
										
                                        @if ($access == 2)
                                        </form>
                                        <form name="delete" method="POST" action="{{ route('hr.personal-cards.destroy', $personalCardsList->id) }}">
                                            <div class="form-row">
                                                <div class='form-group col-md-auto'>
                                                    @method('DELETE')
                                                    @csrf
                                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                    <a class="btn btn-outline-secondary btn-sm" href="{{ route('hr.personal-cards.edit', $personalCardsList->id) }}">{{ __('Изменить') }}</a>
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" href="#">{{ __('Удалить') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                        @if ($access == 1)
                                        <div class="form-row">
                                            <div class='form-group col-md-auto'>
                                        		<a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection