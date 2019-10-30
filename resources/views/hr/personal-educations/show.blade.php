@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalEducations $menu, $title, $personalEducationsList */
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
                                    <input name='personal_card' value='{{ $personalEducationsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='education_type'>Уровень образования</label>
                                    <input name='education_type' value='{{ $personalEducationsList->education_type }}' id='education_type' type='text' maxlength="50" readonly class="form-control" title='Уровень образования'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='study_mode'>Режим (форма) обучения</label>
                                    <input name='study_mode' value='{{ $personalEducationsList->study_mode }}' id='study_mode' type='text' maxlength="50" readonly class="form-control" title='Режим (форма) обучения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='institution'>Учебное заведение</label>
                                    <input name='institution' value='{{ $personalEducationsList->institution }}' id='institution' type='text' maxlength="50" readonly class="form-control" title='Учебное заведение'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='specialty'>Специальность</label>
                                    <input name='specialty' value='{{ $personalEducationsList->specialty }}' id='specialty' type='text' maxlength="50" readonly class="form-control" title='Специальность'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='degree'>Квалификация (степень)</label>
                                    <input name='degree' value='{{ $personalEducationsList->degree }}' id='degree' type='text' maxlength="50" readonly class="form-control" title='Квалификация (степень)'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='degree_abbr'>Аббривиатура квалификации</label>
                                    <input name='degree_abbr' value='{{ $personalEducationsList->degree_abbr }}' id='degree_abbr' type='text' maxlength="50" readonly class="form-control" title='Аббривиатура квалификации'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='diploma'>Серия и номер диплома</label>
                                    <input name='diploma' value='{{ $personalEducationsList->diploma }}' id='diploma' type='text' maxlength="50" readonly class="form-control" title='Серия и номер диплома'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-educations.destroy', $personalEducationsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-educations.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-educations.edit', $personalEducationsList->id) }}">{{ __('Изменить') }}</a>
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