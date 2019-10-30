@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\HumanResources\PersonalCitizenship $menu, $title, $personalCitizenshipList */
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
                                    <input name='personal_card' value='{{ $personalCitizenshipList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='country'>Страна</label>
                                    <input name='country' value='{{ $personalCitizenshipList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Страна'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Дата вступления</label>
                                    <input name='start' value='{{ $personalCitizenshipList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Дата вступления'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Дата выхода</label>
                                    <input name='expiry' value='{{ $personalCitizenshipList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Дата выхода'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('hr.personal-citizenship.destroy', $personalCitizenshipList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-citizenship.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('hr.personal-citizenship.edit', $personalCitizenshipList->id) }}">{{ __('Изменить') }}</a>
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