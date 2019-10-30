@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\LastJobs $menu, $title, $lastJobsList */
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
                                    <input name='personal_card' value='{{ $lastJobsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='last_job'>Последнее место работы</label>
                                    <input name='last_job' value='{{ $lastJobsList->last_job }}' id='last_job' type='text' maxlength="50" readonly class="form-control" title='Последнее место работы'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='position_profession'>Основная профессия</label>
                                    <input name='position_profession' value='{{ $lastJobsList->position_profession }}' id='position_profession' type='text' maxlength="50" readonly class="form-control" title='Основная профессия'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_date'>Дата увольнения</label>
                                    <input name='dismissal_date' value='{{ $lastJobsList->dismissal_date }}' id='dismissal_date' type='text' maxlength="50" readonly class="form-control" title='Дата увольнения'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='dismissal_reason'>Причина увольнения</label>
                                    <input name='dismissal_reason' value='{{ $lastJobsList->dismissal_reason }}' id='dismissal_reason' type='text' maxlength="50" readonly class="form-control" title='Причина увольнения'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.last-jobs.destroy', $lastJobsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.last-jobs.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.last-jobs.edit', $lastJobsList->id) }}">{{ __('Изменить') }}</a>
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