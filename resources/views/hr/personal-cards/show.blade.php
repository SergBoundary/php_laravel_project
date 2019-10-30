@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCards $menu, $title, $personalCardsList */
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
                                    <label for='personal_account'>Табельный номер</label>
                                    <input name='personal_account' value='{{ $personalCardsList->personal_account }}' id='personal_account' type='text' maxlength="50" readonly class="form-control" title='Табельный номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='tax_number'>Индивидуальный налоговый номер</label>
                                    <input name='tax_number' value='{{ $personalCardsList->tax_number }}' id='tax_number' type='text' maxlength="50" readonly class="form-control" title='Индивидуальный налоговый номер'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='surname'>Фамилия</label>
                                    <input name='surname' value='{{ $personalCardsList->surname }}' id='surname' type='text' maxlength="50" readonly class="form-control" title='Фамилия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='first_name'>Имя (первое имя)</label>
                                    <input name='first_name' value='{{ $personalCardsList->first_name }}' id='first_name' type='text' maxlength="50" readonly class="form-control" title='Имя (первое имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='second_name'>Отчество (второе имя)</label>
                                    <input name='second_name' value='{{ $personalCardsList->second_name }}' id='second_name' type='text' maxlength="50" readonly class="form-control" title='Отчество (второе имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='nationality'>Национальность</label>
                                    <input name='nationality' value='{{ $personalCardsList->nationality }}' id='nationality' type='text' maxlength="50" readonly class="form-control" title='Национальность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_date'>Дата рождения</label>
                                    <input name='born_date' value='{{ $personalCardsList->born_date }}' id='born_date' type='text' maxlength="50" readonly class="form-control" title='Дата рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_city'>Город рождения</label>
                                    <input name='born_city' value='{{ $personalCardsList->born_city }}' id='born_city' type='text' maxlength="50" readonly class="form-control" title='Город рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_region'>Район рождения</label>
                                    <input name='born_region' value='{{ $personalCardsList->born_region }}' id='born_region' type='text' maxlength="50" readonly class="form-control" title='Район рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_district'>Область рождения</label>
                                    <input name='born_district' value='{{ $personalCardsList->born_district }}' id='born_district' type='text' maxlength="50" readonly class="form-control" title='Область рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_country'>Страна рождения</label>
                                    <input name='born_country' value='{{ $personalCardsList->born_country }}' id='born_country' type='text' maxlength="50" readonly class="form-control" title='Страна рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sex'>Пол</label>
                                    <input name='sex' value='{{ $personalCardsList->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control" title='Пол'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='marital_status'>Семейное положение</label>
                                    <input name='marital_status' value='{{ $personalCardsList->marital_status }}' id='marital_status' type='text' maxlength="50" readonly class="form-control" title='Семейное положение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='clothing_size'>Размер одежды</label>
                                    <input name='clothing_size' value='{{ $personalCardsList->clothing_size }}' id='clothing_size' type='text' maxlength="50" readonly class="form-control" title='Размер одежды'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='shoe_size'>Размер обуви</label>
                                    <input name='shoe_size' value='{{ $personalCardsList->shoe_size }}' id='shoe_size' type='text' maxlength="50" readonly class="form-control" title='Размер обуви'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='union_member'>Членство в профсоюзе</label>
                                    <input name='union_member' value='{{ $personalCardsList->union_member }}' id='union_member' type='text' maxlength="50" readonly class="form-control" title='Членство в профсоюзе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='disability'>Наличие инвалидости</label>
                                    <input name='disability' value='{{ $personalCardsList->disability }}' id='disability' type='text' maxlength="50" readonly class="form-control" title='Наличие инвалидости'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='disability'>Группа инвалидности</label>
                                    <input name='disability' value='{{ $personalCardsList->disability }}' id='disability' type='text' maxlength="50" readonly class="form-control" title='Группа инвалидности'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='pension_date'>Дата выхода на пенсию</label>
                                    <input name='pension_date' value='{{ $personalCardsList->pension_date }}' id='pension_date' type='text' maxlength="50" readonly class="form-control" title='Дата выхода на пенсию'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='pension_certificate'>Номер пенсионного удостоверения</label>
                                    <input name='pension_certificate' value='{{ $personalCardsList->pension_certificate }}' id='pension_certificate' type='text' maxlength="50" readonly class="form-control" title='Номер пенсионного удостоверения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='photo_url'>Фотография</label>
                                    <input name='photo_url' value='{{ $personalCardsList->photo_url }}' id='photo_url' type='text' maxlength="50" readonly class="form-control" title='Фотография'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-cards.destroy', $personalCardsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-cards.edit', $personalCardsList->id) }}">{{ __('Изменить') }}</a>
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