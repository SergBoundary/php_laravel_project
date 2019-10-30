@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\Accounting\AbsenceFromWorks $menu, $title, $absenceFromWorksList */
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
                                    <input name='personal_card' value='{{ $absenceFromWorksList->personal_card }}' id='personal_card' type='text' maxlength="50" readonly class="form-control" title='Работник'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='absence_classifier'>Вид отсутствия на работе</label>
                                    <input name='absence_classifier' value='{{ $absenceFromWorksList->absence_classifier }}' id='absence_classifier' type='text' maxlength="50" readonly class="form-control" title='Вид отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='start'>Начало периода отсутствия на работе</label>
                                    <input name='start' value='{{ $absenceFromWorksList->start }}' id='start' type='text' maxlength="50" readonly class="form-control" title='Начало периода отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='expiry'>Окончание периода отсутствия на работе</label>
                                    <input name='expiry' value='{{ $absenceFromWorksList->expiry }}' id='expiry' type='text' maxlength="50" readonly class="form-control" title='Окончание периода отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='rationale'>Обоснование отсутствия на работе</label>
                                    <input name='rationale' value='{{ $absenceFromWorksList->rationale }}' id='rationale' type='text' maxlength="50" readonly class="form-control" title='Обоснование отсутствия на работе'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('acc.absence-from-works.destroy', $absenceFromWorksList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.absence-from-works.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('acc.absence-from-works.edit', $absenceFromWorksList->id) }}">{{ __('Изменить') }}</a>
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