@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\WorkExperiences $menu, $title, $workExperiencesList */
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
                                    <input name='personal_card' value='{{ $workExperiencesList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_profession'>Основная профессия</label>
                                    <input name='position_profession' value='{{ $workExperiencesList->position_profession }}' id='position_profession' type='text' maxlength="50" readonly class="form-control" title='Основная профессия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_years'>Количество лет стажа до поступления</label>
                                    <input name='work_experience_years' value='{{ $workExperiencesList->work_experience_years }}' id='work_experience_years' type='text' maxlength="50" readonly class="form-control" title='Количество лет стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_months'>Количество месяцев стажа до поступления</label>
                                    <input name='work_experience_months' value='{{ $workExperiencesList->work_experience_months }}' id='work_experience_months' type='text' maxlength="50" readonly class="form-control" title='Количество месяцев стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_days'>Количество дней стажа до поступления</label>
                                    <input name='work_experience_days' value='{{ $workExperiencesList->work_experience_days }}' id='work_experience_days' type='text' maxlength="50" readonly class="form-control" title='Количество дней стажа до поступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='work_experience_continuous'>Количество дней непрерывного стажа</label>
                                    <input name='work_experience_continuous' value='{{ $workExperiencesList->work_experience_continuous }}' id='work_experience_continuous' type='text' maxlength="50" readonly class="form-control" title='Количество дней непрерывного стажа'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.work-experiences.destroy', $workExperiencesList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.work-experiences.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.work-experiences.edit', $workExperiencesList->id) }}">{{ __('Изменить') }}</a>
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