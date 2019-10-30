@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\EmployeeFamilies $menu, $title, $employeeFamiliesList */
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
                                    <input name='personal_card' value='{{ $employeeFamiliesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='family_relation_type'>Степень родства</label>
                                    <input name='family_relation_type' value='{{ $employeeFamiliesList->family_relation_type }}' id='family_relation_type' type='text' maxlength="50" readonly class="form-control" title='Степень родства'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='surname'>Фамилия</label>
                                    <input name='surname' value='{{ $employeeFamiliesList->surname }}' id='surname' type='text' maxlength="50" readonly class="form-control" title='Фамилия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='first_name'>Имя (первое имя)</label>
                                    <input name='first_name' value='{{ $employeeFamiliesList->first_name }}' id='first_name' type='text' maxlength="50" readonly class="form-control" title='Имя (первое имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='second_name'>Отчество (второе имя)</label>
                                    <input name='second_name' value='{{ $employeeFamiliesList->second_name }}' id='second_name' type='text' maxlength="50" readonly class="form-control" title='Отчество (второе имя)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='born_date'>Дата рождения</label>
                                    <input name='born_date' value='{{ $employeeFamiliesList->born_date }}' id='born_date' type='text' maxlength="50" readonly class="form-control" title='Дата рождения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='sex'>Пол</label>
                                    <input name='sex' value='{{ $employeeFamiliesList->sex }}' id='sex' type='text' maxlength="50" readonly class="form-control" title='Пол'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.employee-families.destroy', $employeeFamiliesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.employee-families.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.employee-families.edit', $employeeFamiliesList->id) }}">{{ __('Изменить') }}</a>
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