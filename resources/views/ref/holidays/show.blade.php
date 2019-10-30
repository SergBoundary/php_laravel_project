@extends('layouts.layout')

@section('content')
    @php 
        /** @var \App\Models\References\Holidays $menu, $title, $holidaysList */
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
                                    <label for='country'>Страна</label>
                                    <input name='country' value='{{ $holidaysList->country }}' id='country' type='text' maxlength="50" readonly class="form-control" title='Страна'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='year'>Год</label>
                                    <input name='year' value='{{ $holidaysList->year }}' id='year' type='text' maxlength="50" readonly class="form-control" title='Год'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='month'>Месяц</label>
                                    <input name='month' value='{{ $holidaysList->month }}' id='month' type='text' maxlength="50" readonly class="form-control" title='Месяц'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='holiday'>Праздничный день</label>
                                    <input name='holiday' value='{{ $holidaysList->holiday }}' id='holiday' type='text' maxlength="50" readonly class="form-control" title='Праздничный день'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='title'>Описание праздника</label>
                                    <input name='title' value='{{ $holidaysList->title }}' id='title' type='text' maxlength="50" readonly class="form-control" title='Описание праздника'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='not_work'>Не рабочий</label>
                                    <input name='not_work' value='{{ $holidaysList->not_work }}' id='not_work' type='text' maxlength="50" readonly class="form-control" title='Не рабочий'>
                                </div>
                                <div class='form-group col-md-10'>
                                    <label for='religion'>Религиозный</label>
                                    <input name='religion' value='{{ $holidaysList->religion }}' id='religion' type='text' maxlength="50" readonly class="form-control" title='Религиозный'>
                                </div>
                                <div class='form-group col-md-10'> </div>
                            </div>
                        </form>

                        <form name="delete" method="POST" action="{{ route('ref.holidays.destroy', $holidaysList->id) }}">
                            <div class="row justify-content-center">
                                <div class='form-group col-md-10'>
                                    @method('DELETE')
                                    @csrf
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.holidays.index') }}">{{ __('Закрыть') }}</a><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                    <a class="btn btn-outline-secondary" href="{{ route('ref.holidays.edit', $holidaysList->id) }}">{{ __('Изменить') }}</a>
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