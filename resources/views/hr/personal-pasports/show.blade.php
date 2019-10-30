@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalPasports $menu, $title, $personalPasportsList */
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
                                    <input name='personal_card' value='{{ $personalPasportsList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='series'>Серия паспорта</label>
                                    <input name='series' value='{{ $personalPasportsList->series }}' id='series' type='text' maxlength="50" readonly class="form-control" title='Серия паспорта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='number'>Номер паспорта</label>
                                    <input name='number' value='{{ $personalPasportsList->number }}' id='number' type='text' maxlength="50" readonly class="form-control" title='Номер паспорта'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='issuing_date'>Дата выдачи</label>
                                    <input name='issuing_date' value='{{ $personalPasportsList->issuing_date }}' id='issuing_date' type='text' maxlength="50" readonly class="form-control" title='Дата выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='issuing_authority'>Орган выдачи</label>
                                    <input name='issuing_authority' value='{{ $personalPasportsList->issuing_authority }}' id='issuing_authority' type='text' maxlength="50" readonly class="form-control" title='Орган выдачи'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiration date'>Утратит силу</label>
                                    <input name='expiration date' value='{{ $personalPasportsList->expiration date }}' id='expiration date' type='text' maxlength="50" readonly class="form-control" title='Утратит силу'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-pasports.destroy', $personalPasportsList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-pasports.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-pasports.edit', $personalPasportsList->id) }}">{{ __('Изменить') }}</a>
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